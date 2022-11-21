
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Lab Name *</label>
                                        <div class="col-10">
                                            <input type="text" name="lab_name" value="{{old('lab_name')}}" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Address</label>
                                        <div class="col-10">
                                            <input type="text" name="address" value="{{old('address')}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Country Name *</label>
                                        <div class="col-10">
                                            
                                            <select name="country_id" id="country_id" class="form-control" onchange="get_state(this.value)" required>
                                                <option value="">Please select country</option>
                                                @if(isset($country) && !empty($country))
                                                    @foreach ($country as $key => $value)
                                                        <option value="{{ $key }}" @if( old('country_id') == $key ) selected @endif> {{ $value }}</option>                                                        
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="country_code" value="" >
                                    <input type="hidden" id="state_code" value="" >
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">State Name *</label>
                                        <div class="col-10">
                                            
                                            <select name="state_id" id="state_id"  class="selectpicker form-control" onchange="get_city(this.value)"  placeholder='Please select ...' required>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">City Name *</label>
                                        <div class="col-10">
                                           
                                            <select name="city_id" id="city_id"  class="selectpicker form-control"  onchange="get_area(this.value)" placeholder='Please select ...' required>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Area Name *</label>
                                        <div class="col-10">
                                            <select name="area_id" id="area_id"  class="selectpicker form-control" placeholder='Please select ...' required>
                                               
                                            </select>
                                            
                                        </div>
                                    </div> --}}
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Location Map Url</label>
                                        <div class="col-10">
                                            {!! Form::text('location_map_url', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">(or)</label>
                                       
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Location Map</label>
                                        <div class="col-10">
                                            {!! Form::text('location_map', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">(or)</label>
                                       
                                    </div> --}}
                                   
                                    {{-- <div class="row">
                                        <div class="row mb-3">
                                            <label class="col-2 text-end col-form-label">Latitude</label>
                                            <div class="col-6">
                                                {!! Form::text('latitude', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-2 text-end col-form-label">Longitude</label>
                                            <div class="col-6">
                                                {!! Form::text('longitude', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    --}}
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Near By</label>
                                        <div class="col-10">
                                            {!! Form::text('near_by', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="row mb-3" id="warehouseId"> 
                                            <label class="col-2 text-end col-form-label">
                                                <div>Timing *</div>
                                                {{-- <a  class="link add_button" title="Add field"><u>+ Add</u></a> --}}
                                            </label>
                                           <div class="col-md-10">
                                                <table class="table">
                                                    <tbody class="field_wrapper">
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="timing[1]"  value="{{old('timing[1]')}}" required class="form-control">
                                                        </td>
                                                        <td>
                                                            <select name="timing_day[1]"  class="selectpicker form-select" required data-live-search="true" data-live-search-style="begins" title="Select days...">
                                                                <option value="">Select Days</option>
                                                                @foreach($timingDay as $days)
                                                                
                                                                    <option value="{{$days->id}}">{{$days->days}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="row mb-3 " id="landline_div"> {{-- warehouseId --}}
                                            {{-- <label class="col-2 text-end col-form-label">Landline No *</label>
                                            <li class="list-group-item border-0 p-0 mb-3">
                                                <a  class="btn btn-primary add_button_landline" title="Add" >Add</a>
                                            </li> --}}
                                            <label class="col-2 text-end col-form-label">
                                                <div>Landline No</div>
                                                {{-- <a  class="link add_button_landline" title="Add" ><u>+ Add</u></a> --}}
                                            </label>
                                            <div class="col-md-10 ">
                                                <table class="table">
                                                    <tbody class="field_wrapper_landline">
                                                    <tr>
                                                        <td width="10%">
                                                                <input type="number" name="time_landline[1]" id="time_landline[1]" class="form-control time_landline" disabled>
                                                        </td>
                                                        <td width="10%">
                                                                <input type="number" name="time_landline_code[1]" id="time_landline_code[1]" class="form-control time_landline_code" disabled>
                                                        </td>
                                                        <td>
                                                                <input type="number" name="time_landline_number[1]" onKeyPress="if(this.value.length==10) return false;" class="form-control">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="row mb-3" id="mobile_div"> {{-- warehouseId --}}
                                            {{-- <label class="col-2 text-end col-form-label">Mobile No *</label>
                                            <li class="list-group-item border-0 p-0 mb-3">
                                                <a  class="btn btn-primary add_button_mobile" title="Add" >Add</a>
                                            </li> --}}
                                            <label class="col-2 text-end col-form-label">
                                                <div>Mobile No *</div>
                                                <a  class="link add_button_mobile" title="Add" ><u>+ Add</u></a>
                                            </label>
                                            {{-- <div class="row">
                                                <div class="col-4">
                                                    <input type="number" name="time_mobile_code[1]" id="time_mobile_code[1]" required class="form-control time_mobile_code" disabled>
                                                </div>
                                                <div class="col-4">
                                                    <input type="number" name="time_mobile[1]" onKeyPress="if(this.value.length==10) return false;" required class="form-control time_mobile">
                                                </div>
                                                
                                            </div> --}}
                                            <div class="col-md-10">
                                                <table class="table">
                                                    <tbody class="field_wrapper_mobile">
                                                    
                                                    <tr>
                                                    
                                                        <td width="10%">
                                                                <input type="number" name="time_mobile_code[1]" id="time_mobile_code[1]" required class="form-control time_mobile_code" disabled>
                                                        </td>
                                                        <td>
                                                                <input type="number"  name="time_mobile[1]" onKeyPress="if(this.value.length==10) return false;" value="9940344041" required class="form-control time_mobile">
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Toll Free Number</label>
                                        <div class="col-10">
                                            {!! Form::number('toll_free_number', null, ['class' => 'form-control', 'autocomplete' => 'off','pattern'=>"[7-9]{1}[0-9]{9}"]) !!}
                                        </div>
                                    </div> --}}
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Contact Person</label>
                                        <div class="col-10">
                                            {!! Form::text('contact_person', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Email</label>
                                        <div class="col-10">
                                            {!! Form::text('email', null, ['class' => 'form-control', 'type'=>'email', 'autocomplete' => 'off','pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"]) !!}
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Facilities</label>
                                        <div class="col-10">
                                            <textarea class="summernote" name="facilities"  value="{{old('facilities')}}">{{old('facilities')}}</textarea>
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Specialty</label>
                                        <div class="col-10">
                                            {!! Form::text('specialty', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Department</label>
                                        <div class="col-10">
                                            {!! Form::text('department', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Meta Title</label>
                                        <div class="col-10">
                                            {!! Form::text('meta_title', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Meta Keyword</label>
                                        <div class="col-10">
                                            {!! Form::text('meta_keyword', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Meta Description</label>
                                        <div class="col-10">
                                            {!! Form::text('meta_description', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Facilities</label>
                                        <div class="col-10">
                                            <textarea id="mytextarea" name="mytextarea">Hello, World!</textarea>
                                        </div>
                                    </div> --}}
                                  
                                    
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Status</label>
                                        <input type="hidden" name="status" value="0" checked="checked">
                                        <div class="col-10">
                                            {{-- {!! Form::checkbox('status',1,null, ['checked' => 'checked']) !!} --}}
                                            @if(isset($manage))
                                                @if($manage->status)
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
    });
</script>
<script type="text/javascript">
    
    
        // alert(localStorage.getItem('state_id'))
    // $('#state_id').val(localStorage.getItem('state_id'));
    // $('#country_id').change();
    
</script>
    <script type="text/javascript">

        if( "{{ old('country_id') }}") {
            let cn_id = "{{ old('country_id') }}";
            get_state(cn_id);
        }
        if( "{{ old('state_id') }}") {
            let st_id = "{{ old('state_id') }}";
            get_city(st_id);
        }
        if( "{{ old('city_id') }}") {
            let ct_id = "{{ old('city_id') }}";
            get_area(ct_id);
        }

        function get_state(country_id) {
            
            var state_id = $("#state_id").val('');

            var state  = "{{ old('state_id') }}";
            if( state ) {
                state_id = state;
            }
            $(".time_landline").html('');
            $(".time_landline_code").html('');
            $(".time_mobile_code").html('');
            $(".time_landline").val('');
            $(".time_landline_code").val('');
            $(".time_mobile_code").val('');

            
            $.ajax({
                type: "GET",
                url: "{{ route('get.state')}}",
                data: { id: country_id},
                success: function(resultData){
                   
                    $("#state_id").append('<option>Select State</option>');
                
                    for(var i=0; i<resultData.data.length; i++){
                        var selected = '';
                        if( state_id != '' && state_id == resultData.data[i].id ) { 
                            selected = 'selected';
                        }
                        $("#state_id").append('<option value="'+resultData.data[i].stateId+'" '+selected+' >'+ resultData.data[i].state+'</option>');
                    }  
                    $(".time_landline").val(resultData.countryCode.country_code);
                    $(".time_mobile_code").val(resultData.countryCode.country_code);
                
                }
            });

        }
    
    function get_city(state_id) {
        var city_id = $("#city_id").val('');

        var city  = "{{ old('city_id') }}";
        if( city ) {
            city_id = city;
        }
        $("#city_id").html('');
        
            $.ajax({
            type: "GET",
            url: "{{ route('get.city')}}",
            data: { id:state_id} ,
            success: function(resultData){
                $("#city_id").append('<option>Select City</option>');
                for(var i=0; i<resultData.data.length; i++){
                    var selected = '';
                        if( city_id != '' && city_id == resultData.data[i].id ) { 
                            selected = 'selected';
                        }
                    $("#city_id").append('<option value="'+resultData.data[i].id+'"  '+selected+' >'+ resultData.data[i].city+'</option>');
                } 
                $(".time_landline_code").val(resultData.stateCode.state_code);
                // $( "#city_id" ).change(); 
            }
        });
    }
    function get_area(city_id) {
        var area_id = $("#area_id").val('');

        var area  = "{{ old('area_id') }}";
        if( area ) {
            area_id = area;
        }
        $("#area_id").html('');
       
            $.ajax({
            type: "GET",
            url: "{{ route('get.area')}}",
            data: { id: city_id } ,
            success: function(resultData){
              
                $("#area_id").append('<option>Select Area</option>');
                for(var i=0; i<resultData.data.length; i++){
                    var selected = '';
                        if( area_id != '' && area_id == resultData.data[i].id ) { 
                            selected = 'selected';
                        }
                    $("#area_id").append('<option value="'+resultData.data[i].id+'"  '+selected+' >'+ resultData.data[i].area+'</option>');
                }  
                $( "#area_id" ).change();  
            }
        });
    }

        
        
    $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><button class="btn btn-danger remove_button" ></button></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(`
                


                
                        
                        <tr>
                        
                        <td>
                            <input type="text" name="timing[${x}]" id="timing_day[${x}]" class="form-control">
                        </td>
                        <td>
                            <select name="timing_day[${x}]" id="timing_day[${x}]" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select days...">
                                @foreach($timingDay as $days)
                                    <option value="{{$days->id}}">{{$days->days}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger remove_button" >X</button>
                        </td>
                        </tr>
               


            `); //Add field html
            $('.selectpicker').selectpicker({
            style: 'btn-link',
            });
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent().parent().remove(); //Remove field html
        x--; //Decrement field counter
    });
});
        


$(document).ready(function(){
    var maxField_landline = 10; //Input fields increment limitation
    var addButton_landline = $('.add_button_landline'); //Add button selector
    var wrapper_landline = $('.field_wrapper_landline'); //Input field wrapper
    var fieldHTML_landline = '<div><input type="text" name="field_name[]" value=""/><button class="btn btn-danger remove_button" ></button></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton_landline).click(function(){
        //Check maximum number of input fields
        if(x < maxField_landline){ 
            x++; //Increment field counter
            $(wrapper_landline).append(`
            

            
                        <tr>
                        
                        <td>
                            
                                <input type="number" name="time_landline[${x}]"  id="time_landline[${x}]" required class="form-control time_landline"  disabled>
                          
                        </td>
                        <td>

                                <input type="number" name="time_landline_code[${x}]" id="time_landline_code[${x}]" required class="form-control time_landline_code" disabled>
                          
                        </td>
                        <td>
                           
                                <input type="number" name="time_landline_number[${x}]" id="time_landline_code[${x}]" onKeyPress="if(this.value.length==10) return false;" required class="form-control">
                           
                        </td>
                        <td>
                            <button class="btn btn-danger remove_button" >X</button>
                        </td>
                        
                        </tr>
                   


            `); //Add field html
            // alert($('.time_landline').val());
            $('.time_landline').val($('.time_landline').val());
            $('.time_landline_code').val($('.time_landline_code').val())
            $('.selectpicker').selectpicker({
            style: 'btn-link',
            });
        }
    });
    
    //Once remove button is clicked
    $(wrapper_landline).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent().parent().remove(); //Remove field html
        x--; //Decrement field counter
    });
});



$(document).ready(function(){
    var maxField_mobile = 10; //Input fields increment limitation
    var addButton_mobile = $('.add_button_mobile'); //Add button selector
    var wrapper_mobile = $('.field_wrapper_mobile'); //Input field wrapper
    var fieldHTML_mobile = '<div><input type="text" name="field_name[]" value=""/><button class="btn btn-danger remove_button" ></button></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton_mobile).click(function(){
        //Check maximum number of input fields
        if(x < maxField_mobile){ 
            x++; //Increment field counter
            $(wrapper_mobile).append(`
               



               

             
                        <tr>
                        
                        <td>
                                <input type="number" name="time_mobile_code[${x}]" id="time_mobile_code[${x}]" required class="form-control time_mobile_code" disabled>
                        </td>
                        <td>
                                <input type="number" name="time_mobile[${x}]" id="time_mobile[${x}]" onKeyPress="if(this.value.length==10) return false;" required class="form-control time_mobile">
                        </td>
                        
                        <td>
                            <button class="btn btn-danger remove_button" >X</button>
                        </td>
                        
                        </tr>
                    


            `); //Add field html
            $('.time_mobile_code').val($('.time_mobile_code').val());
            $('.selectpicker').selectpicker({
            style: 'btn-link',
            });
        }
    });
    
    //Once remove button is clicked
    $(wrapper_mobile).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent().parent().remove(); //Remove field html
        x--; //Decrement field counter
    });
});
        
    </script>  
@endsection