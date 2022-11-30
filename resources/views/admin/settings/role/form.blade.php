<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Role Name</label>
    <div class="col-10">
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
    </div>
</div>
 
<table class="table table-bordered table-centered  tr-sm table-hover">
    <thead class="bg-primary-2 text-white">
        <tr>
            <th rowspan="2" width="200px">Menus</th>
            {{-- <th colspan="4"><input onclick="toggle(this);" type="checkbox" class="form-check-input me-2"> Permissions</th> --}}
        </tr>
        <tr>
            {{-- old --}}
            <th><input type="checkbox" onclick="view_alls(this);" id="view_all" class="form-check-input me-2"> View</th>
            <th><input type="checkbox" onclick="add_alls(this);" id="add_all"class="form-check-input me-2"> Add</th>
            <th><input type="checkbox" onclick="edit_alls(this);" id="edit_all"class="form-check-input me-2"> Edit</th>
            <th><input type="checkbox" onclick="delete_alls(this);" id="delete_all"class="form-check-input me-2"> Delete</th>

            {{-- new --}}
            {{-- <th> View</th>
            <th> Add</th>
            <th> Edit</th>
            <th> Delete</th> --}}
        </tr>
    </thead>
    <tbody>
        {{-- <tr>
            <th>Dashboard</th>
            <td><input type="checkbox" {{ $permissions['user.view.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.dashboard"></td>
            <td><input type="checkbox" {{ $permissions['user.add.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.dashboard"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.dashboard"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.dashboard'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.dashboard"></td>
        </tr> --}}
        {{-- <tr>
            <th>Settings </th>
            <td><input type="checkbox" {{ $permissions['user.view.settings'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.settings"></td>
            <td><input type="checkbox" {{ $permissions['user.add.settings'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.settings"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.settings'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.settings"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.settings'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.settings"></td>
        </tr> --}}
        <tr>
            <th>Manage Category </th>
            <td><input type="checkbox" {{ $permissions['user.view.category'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.category"></td>
            <td><input type="checkbox" {{ $permissions['user.add.category'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.category"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.category'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.category"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.category'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.category"></td>
        </tr>
        <tr>
            <th>Media Gallery </th>
            <td><input type="checkbox" {{ $permissions['user.view.media_gallery'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.media_gallery"></td>
            <td><input type="checkbox" {{ $permissions['user.add.media_gallery'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.media_gallery"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.media_gallery'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.media_gallery"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.media_gallery'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.media_gallery"></td>
        
        </tr>
        <tr>
            <th>News & Events </th>
            <td><input type="checkbox" {{ $permissions['user.view.media_news_event'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.media_news_event"></td>
            <td><input type="checkbox" {{ $permissions['user.add.media_news_event'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.media_news_event"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.media_news_event'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.media_news_event"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.media_news_event'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.media_news_event"></td>
        </tr>
        {{-- <tr>
            <th>Manage Lab </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_lab'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_lab"></td>
            <td><input type="checkbox" {{ $permissions['user.add.manage_lab'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.manage_lab"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.manage_lab'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.manage_lab"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_lab'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_lab"></td>
        </tr> --}}
        <tr>
            <th>Home Visit Area </th>
            <td><input type="checkbox" {{ $permissions['user.view.home_visit_area'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.home_visit_area"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.home_visit_area'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.home_visit_area"></td>
        </tr>
        <tr>
            <th>Sample Collection Center</th>
            <td><input type="checkbox" {{ $permissions['user.view.sample_collection'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.sample_collection"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.sample_collection'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.sample_collection"></td>
        </tr>
        <tr>
            <th>Manage Testimonial </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_testimonial'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_testimonial"></td>
            <td><input type="checkbox" {{ $permissions['user.add.manage_testimonial'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.manage_testimonial"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.manage_testimonial'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.manage_testimonial"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_testimonial'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_testimonial"></td>
        </tr>
        <tr>
            <th>Manage Test </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_test'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_test"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_test'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_test"></td>
        </tr>
        <tr>
            <th>Manage Package </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_package'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_package"></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.edit.manage_package'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.manage_package"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_package'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_package"></td>
        </tr>
        <tr>
            <th>Banner</th>
            <td><input type="checkbox" {{ $permissions['user.view.banner'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.banner"></td>
            <td><input type="checkbox" {{ $permissions['user.add.banner'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.banner"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.banner'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.banner"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.banner'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.banner"></td>
        </tr>
        <tr>
            <th>Manage Country </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_country'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_country"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_country'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_country"></td>
        </tr>
        <tr>
            <th>Manage State </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_state'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_state"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_state'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_state"></td>
        </tr>
        <tr>
            <th>Manage City </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_city'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_city"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_city'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_city"></td>
        </tr>
        {{-- <tr>
            <th>Manage Area </th>
            <td><input type="checkbox" {{ $permissions['user.view.manage_area'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.manage_area"></td>
            <td><input type="checkbox" {{ $permissions['user.add.manage_area'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.manage_area"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.manage_area'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.manage_area"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.manage_area'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.manage_area"></td>
        </tr> --}}
        <tr>
            <th>Brochures</th>
            <td><input type="checkbox" {{ $permissions['user.view.brochures'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.brochures"></td>
            <td><input type="checkbox" {{ $permissions['user.add.brochures'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.brochures"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.brochures'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.brochures"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.brochures'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.brochures"></td>
        </tr>
        <tr>
            <th>Manage Home Visit</th>
            <td><input type="checkbox" {{ $permissions['user.view.home_visit'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.home_visit"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.home_visit'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.home_visit"></td>
        </tr>
        <tr>
            <th>Enquiry Packages</th>
            <td><input type="checkbox" {{ $permissions['user.view.packages'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.packages"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.packages'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.packages"></td>
        </tr>
        <tr>
            <th>Enquiry Contact Us</th>
            <td><input type="checkbox" {{ $permissions['user.view.contact_us'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.contact_us"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.contact_us'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.contact_us"></td>
        </tr>
        {{-- <tr>
            <th>Manage Test Booking </th>
            <td><input type="checkbox" {{ $permissions['user.view.test_booking'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.test_booking"></td>
            <td><input type="checkbox" {{ $permissions['user.add.test_booking'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.test_booking"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.test_booking'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.test_booking"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.test_booking'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.test_booking"></td>
        </tr> --}}
        
       
        {{-- <tr>
            <th>Manage Request Call Back</th>
            <td><input type="checkbox" {{ $permissions['user.view.request_call_back'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.request_call_back"></td>
            <td><input type="checkbox" {{ $permissions['user.add.request_call_back'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.request_call_back"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.request_call_back'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.request_call_back"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.request_call_back'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.request_call_back"></td>
        </tr> --}}
        <tr>
            <th>Manage Careers</th>
            <td><input type="checkbox" {{ $permissions['user.view.careers'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.careers"></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" {{ $permissions['user.delete.careers'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.careers"></td>
        </tr>
        <tr>
            <th>Job Post</th>
            <td><input type="checkbox" {{ $permissions['user.view.job-post'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.job_post"></td>
            <td><input type="checkbox" {{ $permissions['user.add.job-post'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.job_post"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.job-post'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.job_post"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.job-post'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.job_post"></td>
        </tr>
       
        <tr>
            <th>Department</th>
            <td><input type="checkbox" {{ $permissions['user.view.department'] == 'true' ?  "checked" : ""}} value="true" class="view form-check-input" name="user.view.department"></td>
            <td><input type="checkbox" {{ $permissions['user.add.department'] == 'true' ?  "checked" : ""}} value="true" class="add form-check-input" name="user.add.department"></td>
            <td><input type="checkbox" {{ $permissions['user.edit.department'] == 'true' ?  "checked" : ""}} value="true" class="edit form-check-input" name="user.edit.department"></td>
            <td><input type="checkbox" {{ $permissions['user.delete.department'] == 'true' ?  "checked" : ""}} value="true" class="delete form-check-input" name="user.delete.department"></td>
        </tr>
        
        

       
        
        
        
        
    </tbody>
</table> 