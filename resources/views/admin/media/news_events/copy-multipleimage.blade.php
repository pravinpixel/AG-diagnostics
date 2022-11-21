@extends('admin.media.imageLayout')

@section('admin_master_content')
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<style>
    .btn-light {
  color: #fff;
  background-color: #848382;
  border-color: #848382;
}
    .btn-light:hover {
    color: #fff;
    background-color: var(--primary2);
    border-color: var(--primary3);
    }
    .dropzone {
            background: #e3e6ff;
            border-radius: 13px;
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
            border: 2px dotted #1833FF;
            margin-top: 50px;
        }
</style>

    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Create Multiple Image
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 py-4">
                <h4 class="text-center font-weight-bold"> Multiple Images Upload</h4>
                <form method="post" action="{{route('dropzone.store')}}" enctype="multipart/form-data"
                            class="dropzone" id="dropzone">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}" >
                
                </form>
                <div class="row ">
                    <div class="text-center my-3">
                        <a href="{{ route('events.index') }}" class="btn btn-light">Back</a>
                    </div>
                </div> 
            </div>
        </div>
    </div>
           
    <div class="card custom table-card">
      
        <div class="card-body"> 
            <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                <thead> 
                    <tr>
                        <th>S.No </th>
                        <th>Image</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$val)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td> <img src="{{asset('upload/media/news_events/multipleImage/').'/'.$id.'/'.$val->image}}" alt="No image" id="image_tag" width="70" height="70"></td>
                        <td>
                            <a  onclick="multipleImageDelete({{$val->id}})" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Edit"> 
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize         :       1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
    $(document).ready(function () {
    $('#data-table').DataTable({
        "bFilter": false,
        "bInfo": false
    });
});
</script>
<?php $ids = (URL::current()) ?>
<?php $ids = explode('/',$ids);?>
<?php $ids = end($ids); ?>

<?php $ids = substr($ids, -2) ?> 
<script type="text/javascript">
       function multipleImageDelete(id)
        {


            var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    text: "Are you sure you want to Deslete?",
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
                        $.ajax({
                            type: "GET",
                            url: "{{ route('multipleImage.delete')}}",
                            data: { 
                                "id": id,
                            
                            },
                            success: function(resultData){
                            
                                location.reload();
                            
                            }
                        });
                    }
                });


            
        }
        
    Dropzone.options.dropzone =
     {
        maxFilesize: 10,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file)
        {
            var name = file.upload.filename;
            $.ajax({
               
                type: 'POST',
               
                url: "{{ route('dropzone.delete')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "filename": name,
                    "id":{{$ids}},
                },
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response)
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
    };
    </script>