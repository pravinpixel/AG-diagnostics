<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Country Name *</label>
    <div class="col-10">
        {{ Form::select('country_id', $country, null, array('class'=>'form-control', 'placeholder'=>'Please select ...' ,'required')) }}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">State Name *</label>
    <div class="col-10">
        {{ Form::select('state_id', $state, null, array('class'=>'form-control', 'placeholder'=>'Please select ...' ,'required')) }}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">City Name *</label>
    <div class="col-10">
        {{ Form::select('city_id', $city, null, array('class'=>'form-control', 'placeholder'=>'Please select ...' ,'required')) }}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Area Name *</label>
    <div class="col-10">
        {!! Form::text('area', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Post Code *</label>
    <div class="col-10">
        {!! Form::number('area_code', null, ['class' => 'form-control', 'autocomplete' => 'off','required','onKeyPress'=>"if(this.value.length==6) return false;"]) !!}
    </div>
</div>
{{-- <div class="row mb-3">
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
</div> --}}
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10">
        {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
        @if(isset($area))
            @if($area->status)
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

