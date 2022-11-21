<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Category Name *</label>
    <div class="col-10">
        {!! Form::text('category', null, ['class' => 'form-control', 'autocomplete' => 'off', 'required']) !!}
    </div>
</div>

<div class="row mb-3">
    <input type="hidden" name="status" value="0" checked="checked">
    <label class="col-2 text-end col-form-label">Status</label>
    <div class="col-10">
        @if(isset($category))
            @if($category->status)
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
