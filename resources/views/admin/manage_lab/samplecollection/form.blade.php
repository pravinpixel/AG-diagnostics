<div class="row mb-3">
    <label class="col-2 text-end col-form-label">centerId</label>
    <div class="col-10">
        <input type="text" value="{{ $data->centerId }}" name="centerId" placeholder="centerId" class="form-control" disabled >
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Phone</label>
    <div class="col-10">
        <input type="text" value="{{ $data->phone }}" name="phone" placeholder="Phone" class="form-control" disabled >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Email</label>
    <div class="col-10">
        <input type="text" value="{{ $data->email }}" name="email" placeholder="Email" class="form-control" disabled >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">localityId</label>
    <div class="col-10">
        <input type="text" value="{{ $data->localityId }}" name="localityId" placeholder="localityId" class="form-control" disabled >

    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Location</label>
    <div class="col-10">
        <input type="text" name="location" id="location" class="form-control" autocomplete="off" value="{{ $data->location ?? '' }}" disabled>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Timing</label>
    <div class="col-10">
        <input type="text" name="timing" id="timing" class="form-control" autocomplete="off" value="{{ $data->timing ?? '' }}" disabled>
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Address</label>
    <div class="col-10">
        <textarea name="address" class="form-control" id="address" cols="5" rows="5" disabled>{{ $data->address }}</textarea>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">City Id</label>
    <div class="col-10">
        <input type="number" readonly value="{{ $data->cityId }}" name="cityId" placeholder="cityId" class="form-control" disabled >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">City</label>
    <div class="col-10">
        {{-- {!! Form::select('cityId', $city ,null,['class' => 'form-control', 'placeholder'=>'Please Select city', 'autocomplete' => 'off','required']) !!} --}}
    <select class="form-control" name="cityId" id="cityId" disabled >
        <option value="">Select Option</option>
            @foreach ( $city as $key=>$val )
                <option value="{{ $val->cityId }}" @if(isset($data->cityId) && $data->cityId == $val->cityId )selected @endif>{{ $val->city }}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">State Id</label>
    <div class="col-10">
        <input type="text" class="form-control" id="stateId" name="stateId" disabled value="{{ $data->stateId }}"  >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">State</label>
    <div class="col-10">
        <input type="text" class="form-control" id="state" name="state" disabled value="{{ $data->state }}"  >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Latitude</label>
    <div class="col-10">
        <input type="text" class="form-control" id="latitude" name="latitude" disabled value="{{ $data->latitude }}"  >
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Longitude</label>
    <div class="col-10">
        <input type="text" class="form-control" id="longitude" name="longitude" disabled value="{{ $data->longitude }}"  >
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Google Review Link</label>
    <div class="col-10">
        <input type="text" class="form-control" id="googleReviewLink" name="googleReviewLink" disabled value="{{ $data->googleReviewLink }}"  >
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">WhatsApp Link</label>
    <div class="col-10">
        <input type="text" class="form-control" id="whatsAppLink" name="whatsAppLink" value="{{ $data->whatsAppLink }}" disabled >
    </div>
</div>


<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Sorting Order</label>
    <div class="col-10">
        {!! Form::text('sorting_order',null, ['class' => 'form-control', 'placeholder'=>'Sorting Order', 'autocomplete' => 'off']) !!}
    </div>
</div>

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Status</label>
    <input type="hidden" name="status" value="0" checked="checked">
    <div class="col-10" >
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

