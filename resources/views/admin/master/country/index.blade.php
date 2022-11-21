@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Country List
            </div>
            <?php $user = Sentinel::getUser(); ?>
            <?php if($user->hasAccess('user.add.manage_country')){ ?>
            {{-- <a href="{{ route('country.create') }}" class="btn btn-primary ms-3">
                <i class="fa fa-plus me-2" aria-hidden="true"></i>
                Add New
            </a> --}}
            <?php } ?>
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No</th>
                        <th>Country Name</th>
                        <th>ISO Code(3 digit)</th>
                        <th>ISO Code(2 digit)</th>
                        <th>Dial Code</th>
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
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route('country.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"country", name : "country"},
                    {data:"iso_code_three", name : "iso_code_three",orderable: false, searchable: false},
                    {data:"iso_code_two", name : "iso_code_two",orderable: false, searchable: false},
                    {data:"country_code", name : "country_code"},
                    {data:"status", name : "status",orderable: false, searchable: false},
                    {data:"action", name : "action", orderable: false, searchable: false}
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
                        var url = '{{ route("country.status", ":id") }}';
                        url = url.replace(':id',id);
                        $.ajax({
                        type: "GET",
                        url: url,
                        data: { val: val, id : id} ,
                        success: function(resultData){
                            // toastr.warning("{{ session('warning') }}");
                            toastr.success("{{ Session::get('message', 'Status Successfully Updated') }}");
                            $('#data-table').DataTable().ajax.reload();
                            
                        }
                    });
                }
            });
           
            
        }
       
        // $( document ).on("click", "#status", function(e) {
        //     alert($(this).val())
        //     // e.preventDefault();
        //     // var stat = find("span#span_id").val(); // get the status current value

        //     // $.get('./db_file', function(data) {
        //     //     if (data.stat != stat)
        //     //     $("#span_id").removeClass("label label-error").addClass("label label-success");
        //     // }, "json");
        // });
    </script>  
@endsection