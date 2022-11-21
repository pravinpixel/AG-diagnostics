    
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Lab Name *</label>
                                        <div class="col-10">
                                            <input type="text" name="lab_name" value="{{ $manageLab['lab_name'] }}" required class="form-control">
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{ $manageLab['id'] }}" name="id" >
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Address</label>
                                        <div class="col-10">
                                            <input type="text" name="address" value="{{ $manageLab['address'] }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Country Name *</label>
                                        <div class="col-10">
                                            {{-- {{ Form::select('country_id', $country, null, array('class'=>'form-control', 'placeholder'=>'Please select ...' ,'required','id'=>'country_id')) }} --}}
                                            <select name="country_id" id="country_id"  class="selectpicker form-control" placeholder='Please select ...'  required>
                                                <option value="">Select Country</option>
                                                @foreach($country as $key=>$val)
                                                <option value="{{ $val['id'] }}"  <?php echo "{{$val->id}}" == "{{$manageLab->country_id}}" ?   "selected" : '' ;?> >{{ $val['country'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" id="country_code" value="{{$countryCode->country_code}}" >
                                    <input type="hidden" id="state_code" value="{{$stateCode->state_code}}" >
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">State Name *</label>
                                        <div class="col-10">
                                            
                                            <select name="state_id" id="state_id"  class="selectpicker form-control" placeholder='Please select ...' required >
                                                
                                                @foreach($state as $key=>$val)
                                                <option value="{{ $val['id'] }}"  <?php echo "{{$val->id}}" == "{{$manageLab->state_id}}" ?   "selected" : '' ;?> >{{ $val['state'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">City Name *</label>
                                        <div class="col-10">
                                            
                                            <select name="city_id" id="city_id"  class="selectpicker form-control" placeholder='Please select ...' required >
                                               
                                                @foreach($city as $key=>$val)
                                                <option value="{{ $val['id'] }}"  <?php echo "{{$val->id}}" == "{{$manageLab->city_id}}" ?   "selected" : '' ;?> >{{ $val['city'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Area Name *</label>
                                        <div class="col-10">
                                            <select name="area_id" id="area_id"  class="selectpicker form-control" placeholder='Please select ...' required>
                                                <option>Select Area</option>
                                                @foreach($area as $key=>$val)
                                                <option value="{{ $val['id'] }}"  <?php echo "{{$val->id}}" == "{{$manageLab->area_id}}" ?   "selected" : '' ;?> >{{ $val['area'] }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Location Map Url</label>
                                        <div class="col-10">
                                            <input type="text" name="location_map_url" value="{{ $manageLab['location_map_url'] }}" class="form-control">
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Location Map</label>
                                        <div class="col-10">
                                            <input type="text" name="location_map" value="{{ $manageLab['location_map'] }}" class="form-control">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Latitude</label>
                                        <div class="col-10">
                                            <input type="text" name="latitude" value="{{ $manageLab['latitude'] }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Longitude</label>
                                        <div class="col-10">
                                            <input type="text" name="longitude" value="{{ $manageLab['longitude'] }}" required class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Near By</label>
                                        <div class="col-10">
                                            <input type="text" name="near_by" value="{{ $manageLab['near_by'] }}"  class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="row mb-3" id="warehouseId">
                                            
                                            <label class="col-2 text-end col-form-label">
                                                <div>Timing</div>
                                                {{-- <a  class="link add_button" title="Add field"><u>+ Add</u></a> --}}
                                            </label>
                                            <div class="col-md-10 ">
                                                <table class="table">
                                                    <tbody class="field_wrapper">
                                                    <tr>
                                                         <?php $timing = explode(',', $manageLab->timing); ?>
                                                        <td>
                                                            @foreach($timing as $key=>$val)
                                                            <div class=".removeDiv">
                                                            
                                                            <input type="text" name="timing[{{ $key }}]" value="{{ $val }}" required class="form-control">
                                                            </div>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <?php $count = explode(',',$manageLab->timing_day); ?>
                                                            @foreach($count as  $key=>$val)
                                                            <div class=".removeDiv">
                                                            {{-- {{ Form::select('timing_day', $timingDay, null, array('class'=>'form-control', 'placeholder'=>'Please select ...' ,'required')) }} --}}
                                                            <select name="timing_day[{{ $key }}]"  class="selectpicker form-control" title="Select days...">
                                                                @foreach($timingDay as $key=> $valu)
                                                                    <option value="{{$valu->id}}"  <?php echo "{{$valu->id}}" == "{{$val}}" ?   "selected" : '' ;?>>{{$valu->days}}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                            {{-- <button class="btn btn-danger remove_button" >X</button> --}}
                                                            @endforeach
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>




                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    {{-- //landline --}}
                                    <div class="row mb-3">
                                        <div class="row mb-3" id="landline_div"> {{-- warehouseId --}}
                                           
                                            <label class="col-2 text-end col-form-label">
                                                <div>Landline No</div>
                                                {{-- <a  class="link add_button_landline" title="Add" ><u>+ Add</u></a> --}}
                                            </label>
                                            <?php $timinglandline = explode(',', $manageLab->landline); ?>
                                            <div class="col-md-10 ">
                                            <table class="table">
                                               
                                                <tbody class="field_wrapper_landline">
                                                    @foreach($timinglandline as $key=>$val)
                                                  <tr>
                                                   
                                                    <td width="10%">
                                                        <input type="number" name="time_landline" value="{{$countryCode->country_code}}" required class="form-control time_landline" disabled>
                                                    </td>
                                                    <td width="10%">
                                                        <input type="number" name="time_landline_code" value="{{ $stateCode->state_code }}"  required class="form-control time_landline_code" disabled>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="time_landline_number[{{$key}}]" value="{{ $val }}" onKeyPress="if(this.value.length==10) return false;" class="form-control">
                                                    </td>
                                                    {{-- <td>
                                                        <button class="btn btn-danger remove_button" >X</button>
                                                    </td> --}}
                                                    
                                                  </tr>
                                                  @endforeach
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="row mb-3 " id="mobile_div"> {{-- warehouseId --}}
                                            
                                            <label class="col-2 text-end col-form-label">
                                                <div>Mobile No *</div>
                                                <a  class="link add_button_mobile" title="Add" ><u>+ Add</u></a>
                                            </label>
                                            <?php $mobile = explode(',', $manageLab->mobile); ?>
                                            <div class="col-md-10 ">
                                                <table class="table">
                                                    <tbody class="field_wrapper_mobile">
                                                        @foreach($mobile as $key=>$val)
                                                    <tr>
                                                        <td width="10%">
                                                                <input type="number" name="time_mobile_code" value="{{$countryCode->country_code}}" required class="form-control time_mobile_code" disabled>
                                                        </td>
                                                        <td>
                                                                <input type="number" name="time_mobile[{{$key}}]" value="{{ $val }}" onKeyPress="if(this.value.length==10) return false;" required class="form-control time_mobile">
                                                        </td>
                                                        
                                                        <td>
                                                            <button class="btn btn-danger remove_button" >X</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Toll Free Number</label>
                                        <div class="col-10">
                                            <input type="number" name="toll_free_number" value="{{ $manageLab['toll_free_number'] }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Contact Person</label>
                                        <div class="col-10">
                                            <input type="text" name="contact_person" value="{{ $manageLab['contact_person'] }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Email</label>
                                        <div class="col-10">
                                            <input type="email" name="email" value="{{ $manageLab['email'] }}" pattern ="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control">
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Facilities</label>
                                        <div class="col-10">
                                            <textarea class="summernote" name="facilities">{{ $manageLab['facilities'] }}</textarea>
                                        </div>
                                    </div> 
                                    <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Specialty</label>
                                        <div class="col-10">
                                            <input type="text" name="specialty" value="{{ $manageLab['specialty'] }}" class="form-control">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Department</label>
                                        <div class="col-10">
                                            <input type="text" name="department" value="{{ $manageLab['department'] }}"  class="form-control">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Meta Title</label>
                                        <div class="col-10">
                                            <input type="text" name="meta_title" value="{{ $manageLab['meta_title'] }}"  class="form-control">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Meta Keyword</label>
                                        <div class="col-10">
                                            <input type="text" name="meta_keyword" value="{{ $manageLab['meta_keyword'] }}"  class="form-control">
                                        </div>
                                    </div> --}}
                                    {{-- <div class="row mb-3">
                                        <label class="col-2 text-end col-form-label">Meta Description</label>
                                        <div class="col-10">
                                            <input type="text" name="meta_description" value="{{ $manageLab['meta_description'] }}" class="form-control">
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
                                          
                                                @if($manageLab->status)
                                                    <input type="checkbox" id="status" name="status" value="{{ $manageLab['status'] }}" checked="checked">
                                                @else
                                                    <input type="checkbox" id="status" name="status" value="0" >
                                                @endif
                                           
                                        </div>
                                    </div>
                                    
                            
                               




@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        // $( "#country_id" ).trigger(); 
        // $( "#state_id" ).trigger(); 
      $('.summernote').summernote();
    });
</script>
    <script type="text/javascript">

       $('#country_id').on('change', function() {
        $("#state_id").html('');
        var id = this.value;
        var url = '{{ route("manage.edit", ":id") }}';
            url = url.replace(':id',id);
            $.ajax({
            type: "GET",
            url: url,
            data: { id: this.value} ,
            success: function(resultData){
                // alert(JSON.stringify(resultData))
                // alert(resultData.data.length)
                $("#state_id").append('<option>Select State</option>');
                for(var i=0; i<resultData.data.length; i++){
                    $("#state_id").append('<option value="'+resultData.data[i].id+'" >'+ resultData.data[i].state+'</option>');
                }  
                $("#country_code").val(resultData.countryCode.country_code);
                $(".time_landline").val(resultData.countryCode.country_code);
                $(".time_mobile_code").val(resultData.countryCode.country_code);
               
               
            }
        });
        });

        $('#state_id').on('change', function() {
        $("#city_id").html('');
        var id = this.value;
        var url = '{{ route("manage.city_id", ":id") }}';
            url = url.replace(':id',id);
            $.ajax({
            type: "GET",
            url: url,
            data: { id: this.value} ,
            success: function(resultData){
                // alert(resultData)
                // alert(JSON.stringify(resultData))
                // alert(resultData.data.length)
                // $("#state_id").append('<option>Select City</option>');
                $("#city_id").append('<option>Select City</option>');
                for(var i=0; i<resultData.data.length; i++){
                    $("#city_id").append('<option value="'+resultData.data[i].id+'" >'+ resultData.data[i].city+'</option>');
                }  
                $("#state_code").val(resultData.stateCode.state_code); 
                $(".time_landline_code").val(resultData.stateCode.state_code);
                // $( "#city_id" ).change(); 
            }
        });


        });

        $('#city_id').on('change', function() {
        $("#area_id").html('');
        var id = this.value;
        var url = '{{ route("manage.area_id", ":id") }}';
            url = url.replace(':id',id);
            $.ajax({
            type: "GET",
            url: url,
            data: { id: this.value} ,
            success: function(resultData){
                // alert(resultData)
                // alert(JSON.stringify(resultData))
                // alert(resultData.data.length)
                $("#area_id").append('<option>Select Area</option>');
                for(var i=0; i<resultData.data.length; i++){
                    $("#area_id").append('<option value="'+resultData.data[i].id+'" >'+ resultData.data[i].area+'</option>');
                }  
                $( "#area_id" ).change(); 
            }
        });
        });
        
    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><button class="btn btn-danger remove_button" ></button></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
    
        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            var cnt = {{ $manageLabCount }};
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
    var state_code = $( "#state_code" ).val();
    var country_code = $( "#country_code" ).val();
    //Once add button is clicked
    
    $(addButton_landline).click(function(){
        
        var cnt = {{ $landlineCount }};
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
          
            // alert($( "#country_code" ).val());
            $(".time_landline").val($( "#country_code" ).val());
            $(".time_landline_code").val($( "#state_code" ).val());
        
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
    var x = 1+1; //Initial field counter is 1
    var country_code = $( "#country_code" ).val();
    //Once add button is clicked
    $(addButton_mobile).click(function(){
        //Check maximum number of input fields
        if(x < maxField_mobile){ 
            x++; //Increment field counter
            // alert(x);
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
            // alert(country_code)
            $(".time_mobile_code").val($( "#country_code" ).val());
         
           
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