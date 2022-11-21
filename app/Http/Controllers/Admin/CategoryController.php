<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
       
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.category'))
        {

        }
        
        if($request->ajax()) {

            $data = Category::select('*');
           
            return DataTables::eloquent($data)

                ->addIndexColumn()     
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.category'))
                    $edit=button('edit',route('category.edit', $data->id));

                    if($user->hasAccess('user.delete.category'))
                    $delete = button('delete',route('category.delete', $data->id));

                    return $edit.$delete;
                })

                
                ->addColumn('status', function($data) {
                   
                   return toggleButton('status',route('category.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.category.index');
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request,$id = null)
    {
        $this->validate($request, [
            
            'category' => 'required|unique:categories,category,'. $id.',id,deleted_at,NULL',
        ]); 
       $category =  Category::updateOrCreate(["id"=> $id],$request->all());
       Flash::success( __('action.saved', ['type' => 'Category']));
       return redirect()->route('category.index');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        // dd("d");
        return view('admin.category.edit', compact('category'));
    }
    public function delete($id = null)
    {
        $category  = Category::find($id);
        $category->delete();
        Flash::success( __('action.deleted', ['type' => 'Category']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $category  = Category::find($request->id);
        if($request->val == 1)
        {
            $category->status = 0;
            $category->save();
        }
        else{
            $category->status = 1;
            $category->save();
        }
        Flash::success( __('action.status', ['type' => 'Category']));

    }
}
