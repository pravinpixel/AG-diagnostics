

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Job Title *</label>
    <div class="col-10">
        {!! Form::text('job_title', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">City Id</label>
    <div class="col-10">
        {{ Form::select('cityId', $city, null, array('class'=>'form-control', 'placeholder'=>'Please select City','required' )) }}

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Department</label>
    <div class="col-10">
        {{ Form::select('department_id', $department, null, array('class'=>'form-control', 'placeholder'=>'Please select Department' )) }}

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Experience *</label>
    <div class="col-10">
        {!! Form::text('experience', null, ['class' => 'form-control','id'=>'experience', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Education</label>
    <div class="col-10">
        {!! Form::text('education', null, ['class' => 'form-control','id'=>'education', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Job Purpose</label>
    <div class="col-10">
        {!! Form::textarea('job_purpose', null, ['class' => 'form-control', 'id'=>'job_purpose', 'autocomplete' => 'off',]) !!}

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Responsibilities</label>
    <div class="col-10">
        <div class="form-group">
            {{-- <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea> --}}
            {!! Form::textarea('responsibilities', null, ['class' => 'ckeditor form-control', 'id'=>'responsibilities', 'autocomplete' => 'off',]) !!}

        </div>

    </div>
</div>


<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10">
        {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
        @if(isset($job))
            @if($job->status)
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
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

    <script type="text/javascript">
 

       $(document).ready(function() {
            $('#status').click(function() {
                if (!$(this).is(':checked')) {
                    $(this).val(0);
                // return confirm("Are you sure?");
                }
                else if($(this).is(':checked')) {
                    $(this).val(1);
                // return confirm("Are you sure111?");
                }
            });
        });
        
        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file


    </script>  
@endsection