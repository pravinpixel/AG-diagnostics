@extends('admin.enquiry.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Package List
            </div>
           
        
        </div>
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>Date</th>
                        <th>Full Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                       <th>Message</th>
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
                ajax: "{{ route('enquiry_package.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"created_at", name : "created_at"},
                    {data:"name", name : "name"},
                    {data:"mobile", name : "mobile"},
                    {data:"email", name : "email"},
                    {data:"message", name : "message"},
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
                        var url = '{{ route("enquiry_package.status", ":id") }}';
                        url = url.replace(':id',id);
                        $.ajax({
                        type: "GET",
                        url: url,
                        data: { val: val, id : id} ,
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