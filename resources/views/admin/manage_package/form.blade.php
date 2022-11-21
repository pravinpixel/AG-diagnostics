<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Package Name</label>
    <div class="col-10">
        <input type="text" value="{{ $manage_package->packageName }}" name="packageName" placeholder="Package Name " class="form-control" disabled >
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Package Code</label>
    <div class="col-10">
        <input type="text" value="{{ $manage_package->packageCode }}" name="packageCode" placeholder="Package Code " class="form-control" disabled >

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Primary Id</label>
    <div class="col-10">
        <input type="number" disabled value="{{ $manage_package->packageCode }}" name="primaryId" placeholder="Primary Id " class="form-control" required >

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">City</label>
    <div class="col-10">
        {{-- {!! Form::select('cityId', $city ,null,['class' => 'form-control', 'placeholder'=>'Please Select city', 'autocomplete' => 'off','required']) !!} --}}
    <select class="form-control" name="cityId" id="cityId" disabled >
        <option value="">Select Option</option>
            @foreach ( $city as $key=>$val )
                <option value="{{ $val->cityId }}" @if(isset($manage_package->cityId) && $manage_package->cityId == $val->cityId )selected @endif>{{ $val->city }}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Test Lists</label>
    <div class="col-10">
        {{ $manage_package->testLists }}
    </div>
</div> 
{{-- <div class="row mb-3">
    <label class="col-2 text-end col-form-label">Test Lists *</label>
    <div class="col-10">
        <select class="js-example-basic-multiple form-control" name="testLists[]" multiple="multiple">
            @foreach($test_include as $key=>$val)
            <option value="{{ $val->testName }}">{{ $val->testName }}</option> 
            @endforeach
          </select>
    </div>
</div> --}}
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Test Schedule</label>
    <div class="col-10">
        <input type="text" class="form-control" id="testSchedule" name="testSchedule" disabled value="{{ $manage_package->testSchedule }}"  >
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">SampleType</label>
    <div class="col-10">
        {{ $manage_package->testLists }}
        {{-- <input type="text" class="form-control" id="sampleType" name="sampleType" value="" min="" max="" > --}}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Age Restrictions</label>
    <div class="col-10">
        <input type="text" class="form-control" id="ageRestrictions" name="ageRestrictions" value="{{ $manage_package->ageRestrictions }}"  disabled>

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Pre Requisties</label>
    <div class="col-10">
        <input type="text" class="form-control" id="preRequisties" name="preRequisties" value="{{ $manage_package->preRequisties }}" disabled>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Report Availability</label>
    <div class="col-10">
        <input type="text" class="form-control" id="reportAvailability" name="reportAvailability" disabled value="{{ $manage_package->reportAvailability }}" >
    </div>
</div>
{{-- <div class="row mb-3">
    <label class="col-2 text-end col-form-label">Condition *</label>
    <div class="col-10">
        {!! Form::select('condition_id', $condition ,null, ['class' => 'form-control', 'placeholder'=>'Please Select Condition', 'autocomplete' => 'off','required']) !!}
    </div>
</div> --}}
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Comments</label>
    <div class="col-10">
        <textarea name="comments" class="form-control" id="comments" cols="30" rows="10" disabled>{{ $manage_package->comments }}</textarea>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Fees</label>
    <div class="col-10">
        <input type="text" class="form-control" id="fees" name="fees" value="{{ $manage_package->fees }}" disabled >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Home Visit</label>
  
    <label class="col-2 text-end col-form-label">Yes</label>
    {{-- {{Form::radio('home_collection', 1,null, ['class' => 'form-check-input','id' => 'home_collection_yes','required' ])}} --}}
    <input type="radio" class="form-check-input" id="home_collection_yes" name="home_collection" value="" disabled @if(isset($manage_package->homeVisit) && $manage_package->homeVisit == "Y" ) checked @endif >

    <label class="col-2 text-end col-form-label">No</label>
    {{-- {{Form::radio('home_collection', 0,null, ['class' => 'form-check-input','id' => 'home_collection_no','required' ])}} --}}
    <input type="radio" class="form-check-input" id="home_collection_no" name="home_collection" value="" disabled @if(isset($manage_package->homeVisit) && $manage_package->homeVisit == "N" ) checked @endif >
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Discount Fees</label>
    <div class="col-10">
        <input type="text" class="form-control" id="discountFees" name="discountFees" value="{{ $manage_package->discountFees }}" disabled >
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Meta Title</label>
    <div class="col-10">
        <input type="text" class="form-control" placeholder="Meta Title" id="meta_title" name="meta_title" value="{{ $manage_package->meta_title }}" >
    </div>
</div>


<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Meta Description</label>
    <div class="col-10">
        {!! Form::text('meta_description' ,null, ['class' => 'form-control', 'placeholder'=>'Meta Description', 'autocomplete' => 'off']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Meta Keyword</label>
    <div class="col-10">
        {!! Form::text('meta_keyword',null, ['class' => 'form-control', 'placeholder'=>'Meta Keyword', 'autocomplete' => 'off']) !!}
    </div>
</div>


{{-- <div class="row mb-3">
    <label class="col-2 text-end col-form-label">Test Include *</label>
    <div class="col-10" id="form_checkbox">
        @if(isset($manage_package))
            <?php 
            // $include = json_decode($manage_package->tests_included); 
             ?>
            @foreach($test_include as $key=>$val)
            <label><input type="checkbox" name="tests_included[]"  class ="form-check-input tests_included" value="{{ $val->id }}"<?php  echo in_array($val->id,$include)? "checked" : '';?> required > {{ $val->test }}</label><br>
            @endforeach
        @else
            @foreach($test_include as $key=>$val)
            <label><input type="checkbox" name="tests_included[]" class ="form-check-input tests_included" value="{{ $val->id }}"  > {{ $val->testName }}</label><br>
            @endforeach
       @endif

    </div>
</div> --}}

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Is Selected</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10" >
        {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
        <input type="checkbox" id="is_selected" name="is_selected" value="1" @if(isset($manage_package->is_selected)&& $manage_package->is_selected == '1') checked @endif>
        
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10" >
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


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        
        

       $(document).ready(function() {
            //select2 start 
            $('.js-example-basic-multiple').select2();
            //select2 end
            
            $('#status').click(function() {
                if (!$(this).is(':checked')) {
                    $(this).val(0);
                }
                else if($(this).is(':checked')) {
                    $(this).val(1);
                // return confirm("Are you sure111?");
                }
            });
        });
        
        $(document).ready(function() {
            $("input[name='list']").serializeArray();
            // $(".tests_included").trigger("click");
            if($('.tests_included').is(':checked')){
                $('.tests_included').prop('required',false);
            }
        })
        
   
    </script> 
    <script type="text/javascript">
        $(function () {
            $("#submit").click(function () {
                // alert(jQuery('#form_checkbox input[type=checkbox]:checked').length)
                if (jQuery('#form_checkbox input[type=checkbox]:checked').length < 1) {
                    $('.tests_included').prop('required',true);
                }
                else if(jQuery('#form_checkbox input[type=checkbox]:checked').length > 0)
                {
                    $('.tests_included').prop('required',false);
                }
            });
        });

        $(".tests_included").click(function () {
            if($('.tests_included').is(':checked')){
                $('.tests_included').prop('required',false);
            }
        });
            
     
      
        
    </script> 
@endsection

