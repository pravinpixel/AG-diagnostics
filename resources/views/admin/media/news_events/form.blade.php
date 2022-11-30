
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Title *</label>
    <div class="col-10">
        {!! Form::text('event_name', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Start on(DD/MM/YYY) *</label>
    <div class="col-10">
        {!! Form::date('start', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Description</label>
    <div class="col-10">
        {!! Form::textarea('description', null, ['class' => 'summernote', 'autocomplete' => 'off']) !!}
        
    </div>
</div>

<div class="row mb-3 photo_url">
    <label class="col-2 text-end col-form-label">Desktop Image *</label>
    <div class="col-10">
        {!! Form::file('file', ['class' => 'form-control', "id"=>"photo", 'autocomplete' => 'off','accept'=>'image/png, image/jpeg, image/jpeg','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <div class="col-2"></div>
    <div class="col-5">
        @if(isset($events))
            @if($events->photo)
            <img src="{{asset('upload/media/news_events/photo').'/'.$events->photo}}" alt="No image" id="image_tag" width="100" height="100">
            @endif
        @endif
    </div>
</div>
<div class="row mb-3 photo_url">
    <label class="col-2 text-end col-form-label">Mobile Image *</label>
    <div class="col-10">
        {!! Form::file('file', ['class' => 'form-control','name'=>"mobile_image", "id"=>"mobile_image", 'autocomplete' => 'off','accept'=>'image/png, image/jpeg, image/jpeg','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <div class="col-2"></div>
    <div class="col-5">
        @if(isset($events))
            @if($events->photo)
            <img src="{{asset('upload/media/news_events/mobile_image').'/'.$events->mobile_image}}" alt="No image" id="mobile_image_tag" width="100" height="100">
            @endif
        @endif
    </div>
</div>

<div class="row mb-3 video_url" id="">
    <label class="col-2 text-end col-form-label">Video URL</label>
    <div class="col-10">
        {!! Form::text('video_url', null, ['class' => 'form-control',"id"=>"video_url",  'autocomplete' => 'off']) !!}
    </div>
</div>


<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10">
        {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
        @if(isset($feature))
            @if($feature->status)
                <input type="checkbox" id="status" name="status" value="1" checked="checked">
            @else
                <input type="checkbox" id="status" name="status" value="0" >
            @endif
        @else
            <input type="checkbox" id="status" name="status" value="1" checked="checked">
        @endif
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Meta Title</label>
    <div class="col-10">
        {!! Form::text('meta_title', null, ['class' => 'form-control','placeholder'=>'Meta Title', 'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Meta Keyword</label>
    <div class="col-10">
        {!! Form::text('meta_keyword', null, ['class' => 'form-control','placeholder'=>'Meta Keyword',  'autocomplete' => 'off']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Meta Description</label>
    <div class="col-10">
        {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>
</div>
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200
      });
      
    });
</script>

    <script type="text/javascript">


        
    $(document).ready(function(){
       
        if($('#image_tag').attr('src'))
        {
            $('#photo').prop('required',false);
        }
        if($('#mobile_image_tag').attr('src'))
        {
            $('#mobile_image').prop('required',false);
        }
        
        
        
});
        




        
    </script>  
@endsection

