<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Roles;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index(Request $request)
    {
        if($request->ajax()) {
             
            $data = Sentinel::getRoleRepository()->select([
                'id',
                'slug',
                'name',
                'created_at',
                'updated_at',
            ])->whereNotIn('slug',['admin','superadmin']);
                return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $action = button('edit',route('role.edit', $data->id)).button('delete',route('role.delete', $data->id)); 
                    return $action;
                })
                
            ->make(true);
        }
        return view('admin.settings.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        // dd("s");
        
        $permissions = config('permission');
        return view('admin.settings.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'     => 'required|unique:roles|max:255', 
        ];

        $customMessages = [
            'name.required'    => trans('auth.role_name_required'),
            'name.unique'      => trans('auth.role_already_exists'),
        ];
        

        $this->validate($request, $rules, $customMessages);
        
        $permissions = [
             
            // dashboard 
            'user.view.dashboard'    =>  $request -> user_view_dashboard   == 'true' ? true : false,
            'user.add.dashboard'     =>  $request -> user_add_dashboard    == 'true' ? true : false,
            'user.edit.dashboard'    =>  $request -> user_edit_dashboard   == 'true' ? true : false,
            'user.delete.dashboard'  =>  $request -> user_delete_dashboard == 'true' ? true : false,

            
            // settings
            'user.view.settings'    =>  $request -> user_view_settings   == 'true' ? true : false,
            'user.add.settings'     =>  $request -> user_add_settings   == 'true' ? true : false,
            'user.edit.settings'    =>  $request -> user_edit_settings   == 'true' ? true : false,
            'user.delete.settings'  =>  $request -> user_delete_settings   == 'true' ? true : false,

            'user.view.category'    =>  $request -> user_view_category   == 'true' ? true : false,
            'user.add.category'     =>  $request -> user_add_category   == 'true' ? true : false,
            'user.edit.category'    =>  $request -> user_edit_category   == 'true' ? true : false,
            'user.delete.category'  =>  $request -> user_delete_category   == 'true' ? true : false,

            'user.view.media_gallery'    =>  $request -> user_view_media_gallery   == 'true' ? true : false,
            'user.add.media_gallery'     =>  $request -> user_add_media_gallery   == 'true' ? true : false,
            'user.edit.media_gallery'    =>  $request -> user_edit_media_gallery   == 'true' ? true : false,
            'user.delete.media_gallery'  =>  $request -> user_delete_media_gallery   == 'true' ? true : false,

            'user.view.media_news_event'    =>  $request -> user_view_media_news_event   == 'true' ? true : false,
            'user.add.media_news_event'     =>  $request -> user_add_media_news_event   == 'true' ? true : false,
            'user.edit.media_news_event'    =>  $request -> user_edit_media_news_event   == 'true' ? true : false,
            'user.delete.media_news_event'  =>  $request -> user_delete_media_news_event   == 'true' ? true : false,

            'user.view.manage_lab'    =>  $request -> user_view_manage_lab   == 'true' ? true : false,
            'user.add.manage_lab'     =>  $request -> user_add_manage_lab   == 'true' ? true : false,
            'user.edit.manage_lab'    =>  $request -> user_edit_manage_lab   == 'true' ? true : false,
            'user.delete.manage_lab'  =>  $request -> user_delete_manage_lab   == 'true' ? true : false,

            'user.view.manage_testimonial'    =>  $request -> user_view_manage_testimonial   == 'true' ? true : false,
            'user.add.manage_testimonial'     =>  $request -> user_add_manage_testimonial   == 'true' ? true : false,
            'user.edit.manage_testimonial'    =>  $request -> user_edit_manage_testimonial   == 'true' ? true : false,
            'user.delete.manage_testimonial'  =>  $request -> user_delete_manage_testimonial   == 'true' ? true : false,

            'user.view.manage_country'    =>  $request -> user_view_manage_country   == 'true' ? true : false,
            'user.add.manage_country'     =>  $request -> user_add_manage_country   == 'true' ? true : false,
            'user.edit.manage_country'    =>  $request -> user_edit_manage_country   == 'true' ? true : false,
            'user.delete.manage_country'  =>  $request -> user_delete_manage_country   == 'true' ? true : false,

            'user.view.manage_state'    =>  $request -> user_view_manage_state   == 'true' ? true : false,
            'user.add.manage_state'     =>  $request -> user_add_manage_state   == 'true' ? true : false,
            'user.edit.manage_state'    =>  $request -> user_edit_manage_state   == 'true' ? true : false,
            'user.delete.manage_state'  =>  $request -> user_delete_manage_state   == 'true' ? true : false,

            'user.view.manage_area'    =>  $request -> user_view_manage_area   == 'true' ? true : false,
            'user.add.manage_area'     =>  $request -> user_add_manage_area   == 'true' ? true : false,
            'user.edit.manage_area'    =>  $request -> user_edit_manage_area   == 'true' ? true : false,
            'user.delete.manage_area'  =>  $request -> user_delete_manage_area   == 'true' ? true : false,

            'user.view.manage_city'    =>  $request -> user_view_manage_city   == 'true' ? true : false,
            'user.add.manage_city'     =>  $request -> user_add_manage_city   == 'true' ? true : false,
            'user.edit.manage_city'    =>  $request -> user_edit_manage_city   == 'true' ? true : false,
            'user.delete.manage_city'  =>  $request -> user_delete_manage_city   == 'true' ? true : false,

            'user.view.home_visit'    =>  $request -> user_view_home_visit   == 'true' ? true : false,
            'user.add.home_visit'     =>  $request -> user_add_home_visit   == 'true' ? true : false,
            'user.edit.home_visit'    =>  $request -> user_edit_home_visit   == 'true' ? true : false,
            'user.delete.home_visit'  =>  $request -> user_delete_home_visit   == 'true' ? true : false,

            'user.view.test_booking'    =>  $request -> user_view_test_booking   == 'true' ? true : false,
            'user.add.test_booking'     =>  $request -> user_add_test_booking   == 'true' ? true : false,
            'user.edit.test_booking'    =>  $request -> user_edit_test_booking   == 'true' ? true : false,
            'user.delete.test_booking'  =>  $request -> user_delete_test_booking   == 'true' ? true : false,

            'user.view.packages'    =>  $request -> user_view_packages   == 'true' ? true : false,
            'user.add.packages'     =>  $request -> user_add_packages   == 'true' ? true : false,
            'user.edit.packages'    =>  $request -> user_edit_packages   == 'true' ? true : false,
            'user.delete.packages'  =>  $request -> user_delete_packages   == 'true' ? true : false,

            'user.view.request_call_back'    =>  $request -> user_view_request_call_back   == 'true' ? true : false,
            'user.add.request_call_back'     =>  $request -> user_add_request_call_back   == 'true' ? true : false,
            'user.edit.request_call_back'    =>  $request -> user_edit_request_call_back   == 'true' ? true : false,
            'user.delete.request_call_back'  =>  $request -> user_delete_request_call_back   == 'true' ? true : false,

            'user.view.careers'    =>  $request -> user_view_careers   == 'true' ? true : false,
            'user.add.careers'     =>  $request -> user_add_careers   == 'true' ? true : false,
            'user.edit.careers'    =>  $request -> user_edit_careers   == 'true' ? true : false,
            'user.delete.careers'  =>  $request -> user_delete_careers   == 'true' ? true : false,

            'user.view.job-post'    =>  $request -> user_view_job_post   == 'true' ? true : false,
            'user.add.job-post'     =>  $request -> user_add_job_post   == 'true' ? true : false,
            'user.edit.job-post'    =>  $request -> user_edit_job_post   == 'true' ? true : false,
            'user.delete.job-post'  =>  $request -> user_delete_job_post   == 'true' ? true : false,

            'user.view.contact_us'    =>  $request -> user_view_contact_us   == 'true' ? true : false,
            'user.add.contact_us'     =>  $request -> user_add_contact_us   == 'true' ? true : false,
            'user.edit.contact_us'    =>  $request -> user_edit_contact_us   == 'true' ? true : false,
            'user.delete.contact_us'  =>  $request -> user_delete_contact_us   == 'true' ? true : false,

            'user.view.department'    =>  $request -> user_view_department   == 'true' ? true : false,
            'user.add.department'     =>  $request -> user_add_department   == 'true' ? true : false,
            'user.edit.department'    =>  $request -> user_edit_department   == 'true' ? true : false,
            'user.delete.department'  =>  $request -> user_delete_department   == 'true' ? true : false,

            'user.view.brochures'    =>  $request -> user_view_brochures   == 'true' ? true : false,
            'user.add.brochures'     =>  $request -> user_add_brochures   == 'true' ? true : false,
            'user.edit.brochures'    =>  $request -> user_edit_brochures   == 'true' ? true : false,
            'user.delete.brochures'  =>  $request -> user_delete_brochures   == 'true' ? true : false,

            'user.view.home_visit_area'    =>  $request -> user_view_home_visit_area   == 'true' ? true : false,
            // 'user.view_detilas.home_visit_area'     =>  $request -> user_view_detilas_home_visit_area   == 'true' ? true : false,
            'user.delete.home_visit_area'  =>  $request -> user_delete_home_visit_area   == 'true' ? true : false,

            'user.view.sample_collection'    =>  $request -> user_view_sample_collection   == 'true' ? true : false,
            'user.delete.sample_collection'  =>  $request -> user_delete_sample_collection   == 'true' ? true : false,

            
        ];

        Sentinel::getRoleRepository()->createModel()->create([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            'permissions'  =>  $permissions,
        ]);
  
        Flash::success(__('auth.role_creation_successful'));
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role           = Sentinel::findRoleById($id);
        $permissions    = $role->permissions ?? config('permission');
        // dd($permissions);
        return view('admin.settings.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataDb = Sentinel::findRoleById($id);
        
        if (empty($dataDb)) {
            Flash::error( __('global.denied')); 
            return redirect()->back();
        }
 

        $permissions = [
             
            // Withdrawal 
            'user.view.dashboard'    =>  $request -> user_view_dashboard   == 'true' ? true : false,
            'user.add.dashboard'     =>  $request -> user_add_dashboard    == 'true' ? true : false,
            'user.edit.dashboard'    =>  $request -> user_edit_dashboard   == 'true' ? true : false,
            'user.delete.dashboard'  =>  $request -> user_delete_dashboard == 'true' ? true : false,

            // Search or Add 
            'user.view.settings'    =>  $request -> user_view_settings   == 'true' ? true : false,
            'user.add.settings'     =>  $request -> user_add_settings   == 'true' ? true : false,
            'user.edit.settings'    =>  $request -> user_edit_settings   == 'true' ? true : false,
            'user.delete.settings'  =>  $request -> user_delete_settings   == 'true' ? true : false,

            'user.view.category'    =>  $request -> user_view_category   == 'true' ? true : false,
            'user.add.category'     =>  $request -> user_add_category   == 'true' ? true : false,
            'user.edit.category'    =>  $request -> user_edit_category   == 'true' ? true : false,
            'user.delete.category'  =>  $request -> user_delete_category   == 'true' ? true : false,

            'user.view.media_gallery'    =>  $request -> user_view_media_gallery   == 'true' ? true : false,
            'user.add.media_gallery'     =>  $request -> user_add_media_gallery   == 'true' ? true : false,
            'user.edit.media_gallery'    =>  $request -> user_edit_media_gallery   == 'true' ? true : false,
            'user.delete.media_gallery'  =>  $request -> user_delete_media_gallery   == 'true' ? true : false,

            'user.view.media_news_event'    =>  $request -> user_view_media_news_event   == 'true' ? true : false,
            'user.add.media_news_event'     =>  $request -> user_add_media_news_event   == 'true' ? true : false,
            'user.edit.media_news_event'    =>  $request -> user_edit_media_news_event   == 'true' ? true : false,
            'user.delete.media_news_event'  =>  $request -> user_delete_media_news_event   == 'true' ? true : false,

            'user.view.manage_lab'    =>  $request -> user_view_manage_lab   == 'true' ? true : false,
            'user.add.manage_lab'     =>  $request -> user_add_manage_lab   == 'true' ? true : false,
            'user.edit.manage_lab'    =>  $request -> user_edit_manage_lab   == 'true' ? true : false,
            'user.delete.manage_lab'  =>  $request -> user_delete_manage_lab   == 'true' ? true : false,

            'user.view.manage_testimonial'    =>  $request -> user_view_manage_testimonial   == 'true' ? true : false,
            'user.add.manage_testimonial'     =>  $request -> user_add_manage_testimonial   == 'true' ? true : false,
            'user.edit.manage_testimonial'    =>  $request -> user_edit_manage_testimonial   == 'true' ? true : false,
            'user.delete.manage_testimonial'  =>  $request -> user_delete_manage_testimonial   == 'true' ? true : false,

            
            'user.view.manage_country'    =>  $request -> user_view_manage_country   == 'true' ? true : false,
            'user.add.manage_country'     =>  $request -> user_add_manage_country   == 'true' ? true : false,
            'user.edit.manage_country'    =>  $request -> user_edit_manage_country   == 'true' ? true : false,
            'user.delete.manage_country'  =>  $request -> user_delete_manage_country   == 'true' ? true : false,

            'user.view.manage_state'    =>  $request -> user_view_manage_state   == 'true' ? true : false,
            'user.add.manage_state'     =>  $request -> user_add_manage_state   == 'true' ? true : false,
            'user.edit.manage_state'    =>  $request -> user_edit_manage_state   == 'true' ? true : false,
            'user.delete.manage_state'  =>  $request -> user_delete_manage_state   == 'true' ? true : false,

            'user.view.manage_city'    =>  $request -> user_view_manage_city   == 'true' ? true : false,
            'user.add.manage_city'     =>  $request -> user_add_manage_city   == 'true' ? true : false,
            'user.edit.manage_city'    =>  $request -> user_edit_manage_city   == 'true' ? true : false,
            'user.delete.manage_city'  =>  $request -> user_delete_manage_city   == 'true' ? true : false,

            'user.view.manage_area'    =>  $request -> user_view_manage_area   == 'true' ? true : false,
            'user.add.manage_area'     =>  $request -> user_add_manage_area   == 'true' ? true : false,
            'user.edit.manage_area'    =>  $request -> user_edit_manage_area   == 'true' ? true : false,
            'user.delete.manage_area'  =>  $request -> user_delete_manage_area   == 'true' ? true : false,

            'user.view.home_visit'    =>  $request -> user_view_home_visit   == 'true' ? true : false,
            'user.add.home_visit'     =>  $request -> user_add_home_visit   == 'true' ? true : false,
            'user.edit.home_visit'    =>  $request -> user_edit_home_visit   == 'true' ? true : false,
            'user.delete.home_visit'  =>  $request -> user_delete_home_visit   == 'true' ? true : false,

            'user.view.test_booking'    =>  $request -> user_view_test_booking   == 'true' ? true : false,
            'user.add.test_booking'     =>  $request -> user_add_test_booking   == 'true' ? true : false,
            'user.edit.test_booking'    =>  $request -> user_edit_test_booking   == 'true' ? true : false,
            'user.delete.test_booking'  =>  $request -> user_delete_test_booking   == 'true' ? true : false,

            'user.view.packages'    =>  $request -> user_view_packages   == 'true' ? true : false,
            'user.add.packages'     =>  $request -> user_add_packages   == 'true' ? true : false,
            'user.edit.packages'    =>  $request -> user_edit_packages   == 'true' ? true : false,
            'user.delete.packages'  =>  $request -> user_delete_packages   == 'true' ? true : false,

            'user.view.request_call_back'    =>  $request -> user_view_request_call_back   == 'true' ? true : false,
            'user.add.request_call_back'     =>  $request -> user_add_request_call_back   == 'true' ? true : false,
            'user.edit.request_call_back'    =>  $request -> user_edit_request_call_back   == 'true' ? true : false,
            'user.delete.request_call_back'  =>  $request -> user_delete_request_call_back   == 'true' ? true : false,

            'user.view.careers'    =>  $request -> user_view_careers   == 'true' ? true : false,
            'user.add.careers'     =>  $request -> user_add_careers   == 'true' ? true : false,
            'user.edit.careers'    =>  $request -> user_edit_careers   == 'true' ? true : false,
            'user.delete.careers'  =>  $request -> user_delete_careers   == 'true' ? true : false,
            
            'user.view.job-post'    =>  $request -> user_view_job_post   == 'true' ? true : false,
            'user.add.job-post'     =>  $request -> user_add_job_post   == 'true' ? true : false,
            'user.edit.job-post'    =>  $request -> user_edit_job_post   == 'true' ? true : false,
            'user.delete.job-post'  =>  $request -> user_delete_job_post   == 'true' ? true : false,

            'user.view.contact_us'    =>  $request -> user_view_contact_us   == 'true' ? true : false,
            'user.add.contact_us'     =>  $request -> user_add_contact_us   == 'true' ? true : false,
            'user.edit.contact_us'    =>  $request -> user_edit_contact_us   == 'true' ? true : false,
            'user.delete.contact_us'  =>  $request -> user_delete_contact_us   == 'true' ? true : false,

            'user.view.department'    =>  $request -> user_view_department   == 'true' ? true : false,
            'user.add.department'     =>  $request -> user_add_department   == 'true' ? true : false,
            'user.edit.department'    =>  $request -> user_edit_department   == 'true' ? true : false,
            'user.delete.department'  =>  $request -> user_delete_department   == 'true' ? true : false,

            'user.view.brochures'    =>  $request -> user_view_brochures   == 'true' ? true : false,
            'user.add.brochures'     =>  $request -> user_add_brochures   == 'true' ? true : false,
            'user.edit.brochures'    =>  $request -> user_edit_brochures   == 'true' ? true : false,
            'user.delete.brochures'  =>  $request -> user_delete_brochures   == 'true' ? true : false,

            'user.view.home_visit_area'    =>  $request -> user_view_home_visit_area   == 'true' ? true : false,
            // 'user.view_detilas.home_visit_area'     =>  $request -> user_view_detilas_home_visit_area   == 'true' ? true : false,
            'user.delete.home_visit_area'  =>  $request -> user_delete_home_visit_area   == 'true' ? true : false,

            'user.view.sample_collection'    =>  $request -> user_view_sample_collection   == 'true' ? true : false,
            'user.delete.sample_collection'  =>  $request -> user_delete_sample_collection   == 'true' ? true : false,
        ];

        Sentinel::findRoleById($id)->update(['permissions'  =>  null]);

        Sentinel::findRoleById($id)->update([
            'name'         =>  $request->name,
            'slug'         =>  Str::slug($request->name),
            'permissions'  =>  $permissions,
        ]);
       
        Flash::success( __('auth.role_update_successful'));

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDb = Sentinel::getUser();
        $dataDb = Sentinel::findRoleById($id);

        if (empty($dataDb)) {
            Flash::error(__('global.not_found'));

            return redirect()->route('role.index');
        }

        $dataDb->users()->detach($userDb);
        $dataDb->delete();

        Flash::success(__('auth.role_delete_successful'));

        return redirect()->route('role.index');
    } 
}
