

<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Story Title *</label>
    <div class="col-10">
        {!! Form::text('story_title', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Date(DD/MM/YYY) *</label>
    <div class="col-10">
        {!! Form::date('date', null, ['class' => 'form-control', 'autocomplete' => 'off','required']) !!}
    </div>
</div>

{{-- <div class="row mb-3">
    <label class="col-2 text-end col-form-label">Story Url</label>
    <div class="col-10">
        {!! Form::text('story_url', null, ['class' => 'form-control','id'=>'story_url', 'autocomplete' => 'off']) !!}
    </div>
</div> --}}
{{-- <div class="row mb-3">
    <label class="col-2 text-end col-form-label">Source *</label>
    <div class="col-10">
        {!! Form::text('description', null, ['class' => 'form-control',  'autocomplete' => 'off','required']) !!}
    </div>
</div> --}}
<div class="row mb-3">
    <label class="col-2 text-end col-form-label">Image *</label>
    <div class="col-10">
        {!! Form::file('file', ['class' => 'form-control', "id"=>"attachment", 'autocomplete' => 'off',"accept"=>"image/*",'required']) !!}
        <p>(Size 100*100)</p>
    </div>
</div>
<div class="row mb-3 video_url">
    {{-- <label class="col-2 text-end col-form-label">Description</label> --}}
    <div class="col-2"></div>
    <div class="col-5">
        @if(isset($feature))
            @if($feature->pdf)
            <img src="{{asset('upload/media/feature/image').'/'.$feature->pdf}}" alt="No Image" id="image_tag" width="100" height="100">
            @endif
        @endif
    </div>
</div>



{{-- <div class="row mb-3">
    <label class="col-2 text-end col-form-label">Video Link</label>
    <div class="col-10">
        {!! Form::text('video_link', null, ['class' => 'form-control',  'autocomplete' => 'off']) !!}
    </div>
</div> --}}
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
<?php $ids = (URL::current()) ?>
<?php $ids = explode('/',$ids);?>
<?php $ids = end($ids); ?>

<?php $ids = substr($ids, -2) ?> 
@section('scripts')
    <script type="text/javascript">
       

       if($('#image_tag').attr('src'))
        {
            $('#attachment').prop('required',false);
            
        }


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

        $("#attachment").on('change', function(e){
            for(var i = 0; i < this.files.length; i++){
                let fileBloc = $('<span/>', {class: 'file-block'}),
                    fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                fileBloc.append('<span class="file-delete"><span>+</span></span>')
                    .append(fileName);
                $("#filesList > #files-names").append(fileBloc);
            };
            // Ajout des fichiers dans l'objet DataTransfer
            for (let file of this.files) {
                dt.items.add(file);
            }
            // Mise à jour des fichiers de l'input file après ajout
            this.files = dt.files;

            // EventListener pour le bouton de suppression créé
            $('span.file-delete').click(function(){
                let name = $(this).next('span.name').text();
                // Supprimer l'affichage du nom de fichier
                $(this).parent().remove();
                for(let i = 0; i < dt.items.length; i++){
                    // Correspondance du fichier et du nom
                    if(name === dt.items[i].getAsFile().name){
                        // Suppression du fichier dans l'objet DataTransfer
                        dt.items.remove(i);
                        continue;
                    }
                }
                // Mise à jour des fichiers de l'input file après suppression
                document.getElementById('attachment').files = dt.files;
            });
        });


        function deletePdf(id)
        {
           
            var productId = {{ $ids }};
            $.ajax({
                    type:'GET',
                    url:'{{route('feature.delete-Pdf')}}',
                    data: {
                        "pdfKey": id,
                        "productId" :productId,
                    },
                    success:function(response){
                        console.log(response);
                        location.reload();
                    }
                   
                });

        } 
    </script>  
@endsection

