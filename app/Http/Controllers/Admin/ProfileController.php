<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Laracasts\Flash\Flash;


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        // Sentinel::getUser()->name
        $user = Sentinel::getUser();
        $data = User::find($user->id);
    $data['password'] =  $data['password'];

        return view('admin.profile.index',compact('data'));
    }
    public function store(Request $request)
    {

        $id = $request->id;
        $request->validate([
            'email' => 'required|unique:users,email,'.$id. ',id',
            'name'      => 'required',

        ]);
        $ins['name']              = $request->name;
        $ins['email']             = $request->email;
        $info = User::updateOrCreate(['id' => $id],$ins);
        if($request->old_password && $request->password )
        {
            $request->validate([
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            ]);
            if ((Hash::check($request->get('old_password'), Sentinel::getUser()->password))) {
                $ins['password']            = Hash::make($request->password);
                $error = 0;
                $info = User::updateOrCreate(['id' => $id],$ins);
                $message = (isset($id) && !empty($id)) ? 'Updated Successfully' :'Added successfully';

            } else {
                $error = 1;
                $message = "Old password dons't match";
                // return response()->json(['error'=> $error, 'message' => $message]);
                // Flash::success( __('action.saved', ['type' => 'Profile']));
                return redirect()->back();
            }

        }
        Flash::success( __('action.saved', ['type' => 'Profile']));
        return redirect()->route('admin.dashboard');
           

        
    }
}
