

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Title *</label>
    <div class="col-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Brochure *</label>
    <div class="col-10">
        <input type="file" name="brochure" id="brochure" class="form-control" autocomplete="off" value="{{ $brochure->brochure ?? '' }}">
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Type *</label>
    <div class="col-10">
        <select name="type" class="form-control" required>
            <option value="">Select Option</option>
            <option value="package_booklets" <?php  echo $brochure->type == 'package_booklets' ? "selected" : '' ;   ?>>Package Booklets</option>
            <option value="technical_leaflets" <?php  echo $brochure->type == 'technical_leaflets' ? "selected" : '' ;   ?>>Technical Leaflets</option>
        </select>
    </div>
</div>
@if(isset($brochure['brochure']))
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">{{  $brochure['brochure'] ?? '' }} </label>
    <div class="col-10">
        <a href="{{ asset('upload/brochure/'.$brochure['brochure']) }}" class="m-1 shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download>
            <i class="bi bi-download"></i>
        </a>
        <a href="{{ route('brochures_delete',$brochure->id) }}" class="m-1 shadow-sm btn btn-sm text-primary btn-outline-light">
            <i class="bi bi-trash-fill"></i>
        </a>
        <input type="hidden" id="brochure_check" name="" value="{{ $brochure->brochure }}">
    </div>
</div>
@endif  
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Brochure Image</label>
    <div class="col-10">
        {!! Form::file('file', ['class' => 'form-control', "id"=>"image", 'autocomplete' => 'off',"accept"=>"image/*",'required']) !!}
    </div>
</div>  
<div class="row mb-3 video_url">
    <div class="col-2"></div>
    <div class="col-5">
        @if(isset($brochure))
            @if($brochure->image)
            <img src="{{asset('upload/brochure_image').'/'.$brochure->image}}" alt="No Image" id="image_tag" width="100" height="100">
            @endif
        @endif
    </div>
</div>  

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10">
        @if(isset($brochure))
            @if($brochure->status)
                <input type="checkbox" id="status" name="status" value="1" checked="checked">
            @else
                <input type="checkbox" id="status" name="status" value="0" >
            @endif
        @else
            <input type="checkbox" id="status" name="status" value="1" checked="checked">
        @endif
    </div>
</div>
<?php $ids = (URL::current()) ?>
<?php $ids = explode('/',$ids);?>
<?php $ids = end($ids); ?>

<?php $ids = substr($ids, -2) ?> 

@section('scripts')


    <script type="text/javascript">

       $(document).ready(function() {


        if($('#image_tag').attr('src'))
        {
            $('#image').prop('required',false);
            
        }

            $('#status').click(function() {
                if (!$(this).is(':checked')) {
                    $(this).val(0);
                }
                else if($(this).is(':checked')) {
                    $(this).val(1);
                }
            });

            var valueCh = $('#brochure_check').val();
            // alert(valueCh)
            if(valueCh){
                $('#brochure').removeAttr('required');
               
            }
            else{
                $('#brochure').attr('required',true);
                
            }



        });
        
        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file


    </script>  
@endsection