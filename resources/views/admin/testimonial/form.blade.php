<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Testimonial Title *</label>
    <div class="col-10">
        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Date *</label>
    <div class="col-10">
        {!! Form::date('date', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Type *</label>
  
    <label class="col-2 text-end col-form-label">Text</label>
    {{Form::radio('type', 1,null, ['class' => 'form-check-input','id' => 'text','required',old('type') ])}}
    <label class="col-2 text-end col-form-label">Video</label>
    {{Form::radio('type', 2,null, ['class' => 'form-check-input','id' => 'video','required',old('type') ])}}

    @if(isset($test))
    <input type="hidden" id="type_value" value="{{ $test->type }}" >
    @endif

</div>
<div class="row mb-3 text_area">
    <label class="col-2 text-end col-form-label">Testimonial</label>
    <div class="col-10">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'id'=>'description', 'autocomplete' => 'off',]) !!}
        {{-- <textarea class="summernote" name="description"  value="{{old('description')}}">{{old('description')}}</textarea> --}}
        
    </div>
</div>
<div class="row mb-3 video_url" >
    <label class="col-2 text-end col-form-label">Testimonial Video URL *</label>
    <div class="col-10">
        {!! Form::text('video_url', null, ['class' => 'form-control',"id"=>"video_url",  'autocomplete' => 'off','required']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Testimonial given by *</label>
    <div class="col-10">
        {!! Form::text('given_by', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Photo</label>
    <div class="col-10">
        {!! Form::file('file', ['class' => 'form-control', "id"=>"attachment", 'autocomplete' => 'off',"accept"=>"image/*"]) !!}
    </div>
</div>
<div class="row mb-3">
    {{-- <label class="col-2 text-end col-form-label">Description</label> --}}
    <div class="col-2"></div>
    <div class="col-5">
        @if(isset($test))
            @if($test->photo)
            <img src="{{asset('upload/testimonial/photo').'/'.$test->photo}}" alt="No image" id="image_tag" width="100" height="100">
            @endif
        @endif
    </div>
</div>
<div class="row mb-3 video_url">
    <label class="col-2 text-end col-form-label">Video Cover Image</label>
    <div class="col-10">
        {!! Form::file('video_cover_image', ['class' => 'form-control', "id"=>"attachment", 'autocomplete' => 'off',"accept"=>"image/*"]) !!}
    </div>
</div>
<div class="row mb-3 video_url">
    {{-- <label class="col-2 text-end col-form-label">Description</label> --}}
    <div class="col-2"></div>
    <div class="col-5">
        @if(isset($test))
            @if($test->video_cover_image)
            <img src="{{asset('upload/testimonial/video_cover_image').'/'.$test->video_cover_image}}" alt="No image" id="image_tag" width="100" height="100">
            @endif
        @endif
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Designation *</label>
    <div class="col-10">
        {!! Form::text('designation', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <input type="hidden" name="status" value="0" checked="checked">
    <label class="col-2 text-end col-form-label">Status</label>
    <div class="col-10">
        {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
        @if(isset($country))
            @if($country->status)
                <input type="checkbox" id="status" name="status" value="1" checked="checked">
            @else
                <input type="checkbox" id="status" name="status" value="0" >
            @endif
      @else
        <input type="checkbox" id="status" name="status" value="1" checked="checked">
      @endif
    </div>
</div>
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200
      });
      var summernoteValidator = summernoteForm.validate({
        // errorElement: "div",
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        // ignore: ':hidden:not(.summernote),.note-editable.card-block',
       
    });
      
    });
</script>
    <script type="text/javascript">
       
       $(document).ready(function() {
        if($('#type_value').val() == 1)
        {
            // alert("yes");
            $('#description').prop('required',false);
            $('.video_url').hide();
            $('#video_url').val('http://example');
        }
        else if($('#type_value').val() == 2){
                $('.text_area').hide();
                $('.video_url').show();  
                $('#description').prop('required',false);
                $('#description').val('');
                $('#video_url').prop('required',true);
        }
        else{
            $('.text_area').show();
        }
        $("input[name$='type']").click(function() {
            // alert($(this).val())
            if($(this).val() == 1)
            {
                $('.text_area').show();
                $('.video_url').hide();
               
                $('#video_url').prop('required',false);
                $('#video_url').val('http://example');
                $('#description').prop('required',true);
                if($('#image_tag').attr('src'))
                {
                    $('#description').prop('required',false);
                    $('.video_url').hide();
                }
                
            }
            if($(this).val() == 2)
            {
                $('.text_area').hide();
                $('.video_url').show();  
                $('#video_url').val('');  
                
                $('#description').prop('required',false);
                $(".summernote").summernote('reset');
                $('#video_url').prop('required',true);
            }

        });

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
        
       
     
    </script>  
@endsection
