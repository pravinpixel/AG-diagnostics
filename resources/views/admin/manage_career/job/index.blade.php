@extends('admin.manage_career.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Careers
            </div>
            <?php $user = Sentinel::getUser(); ?>
            <?php if($user->hasAccess('user.add.job-post')){ ?>
            <a href="{{ route('job-post.create') }}" class="btn btn-primary ms-3">
                <i class="fa fa-plus me-2" aria-hidden="true"></i>
                Add New
            </a>
            <?php } ?>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>Job Title </th>
                        <th>City</th>
                        <th>Department</th>
                        <th>Experience </th>
                        <th>Education</th>
                        <th>Number Vacancies</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('#data-table').DataTable({
                "pageLength": 50,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('job-post.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"job_title", name : "job_title"},
                    {data:"city.city", name : "city.city"},
                    {data:"department_name", name : "department_name"},
                    {data:"experience", name : "experience"},
                    {data:"education", name : "education"},
                    {data:"posts", name : "posts"},
                    {data:"status", name : "status",orderable: false},
                    {data:"action", name : "action",orderable: false},
                ],
            });
        });
        
        function statuschange(val,id)
        {
            var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    text: "Are you sure want to change status?",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn-light rounded-pill btn",
                            closeModal: true,
                        },
                        confirm: {
                            text: "Yes! Change",
                            value: true,
                            visible: true,
                            className: "btn btn-danger rounded-pill",
                            closeModal: true
                        }
                    },
                }).then((isConfirm) => {
                    if (isConfirm) {
                        var url = '{{ route("job-post.status", ":id") }}';
                        url = url.replace(':id',id);
                        $.ajax({
                        type: "GET",
                        url: url,
                        data: { val: val, id : id } ,
                        success: function(resultData){
                            toastr.success("{{ Session::get('message', 'Status Successfully Updated') }}");
                            $('#data-table').DataTable().ajax.reload();
                            
                        }
                    });
                    }
                });
        }
    </script>  
@endsection