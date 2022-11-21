<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Country Name *</label>
    <div class="col-10">
        {{ Form::select('country_id', $country, null, array('class'=>'form-control', 'placeholder'=>'Please select ...' ,'required','disabled')) }}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">State Name *</label>
    <div class="col-10">
        {!! Form::text('state', null, ['class' => 'form-control', 'autocomplete' => 'off','required','disabled']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">State Code *</label>
    <div class="col-10">
        {!! Form::number('state_code', null, ['class' => 'form-control', 'autocomplete' => 'off','onKeyPress'=>"if(this.value.length==3) return false;",'required']) !!}
    </div>
</div>

<div class="row mb-3">
    <input type="hidden" name="status" value="0" checked="checked">
    <label class="col-2 text-end col-form-label">Status</label>
    <div class="col-10">
      @if(isset($state))
            @if($state->status)
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

