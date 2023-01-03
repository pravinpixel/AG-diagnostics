

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Title *</label>
    <div class="col-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Type *</label>
    <div class="col-10">
        <select name="type" class="form-control" required>
            <option value="">Select Option</option>
            <option value="package_booklets">Package Booklets</option>
            <option value="technical_leaflets">Technical Leaflets</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Brochure *</label>
    <div class="col-10">
        {{-- {!! Form::file('brochure', ['class' => 'form-control', 'autocomplete' => 'off','required']) !!} --}}
        <input type="file" name="brochure" id="brochure" class="form-control" autocomplete="off" value="{{ $brochure->brochure ?? '' }}" required>
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
        <input type="hidden" id="brochure_check" value="{{ $brochure->brochure }}">
    </div>
</div>
@endif  
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Brochure Image</label>
    <div class="col-10">
        {!! Form::file('file', ['class' => 'form-control', "id"=>"image", 'autocomplete' => 'off',"accept"=>"image/*",'required']) !!}
    </div>
</div>  

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10">
        {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
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
            $('#status').click(function() {
                if (!$(this).is(':checked')) {
                    $(this).val(0);
                }
                else if($(this).is(':checked')) {
                    $(this).val(1);
                }
            });

            var valueCh = $('#brochure_check').val();
            if(valueCh){
                $('#brochure').removeAttr('required');
                // var $el = $('#brochure');
                // $el.wrap('<form>').closest('form').get(0).value(1);
            }



        });
        
        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file


    </script>  
@endsection