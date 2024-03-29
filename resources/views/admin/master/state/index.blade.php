@extends('admin.master.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                State List
            </div>
            <form action="{{ route('state.sync') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary ms-3">
                    <i class="fa fa-refresh me-2" aria-hidden="true"></i>
                    Sync Data</button>
            </form>
            <?php $user = Sentinel::getUser(); ?>
            <?php if($user->hasAccess('user.add.manage_state')){ ?>
            {{-- <a href="{{ route('state.create') }}" class="btn btn-primary ms-3">
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
                        <th>State Name</th>
                        <th>State code</th>
                        <th>Country</th>
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
                ajax: "{{ route('state.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id',orderable: false, searchable: false},
                    {data:"state", name : "state"},
                    {data:"state_code", name : "state_code"},
                    {data:"country.country", name : "country.country"},
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
                        var url = '{{ route("state.status", ":id") }}';
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