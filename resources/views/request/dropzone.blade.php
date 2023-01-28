<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laravel Multiple Image Upload Using DropzoneJS</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
</head>
<body>
<div class="container-fluid">
    <br/>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class = "panel-title">Select Image</h3>
        </div>
        <div class="panel-body">
            <form id="dropzoneForm" class="dropzone" action="{{route('dropzone.upload')}}">
                @csrf
            </form>
            <div align="center">
                <button type="button" class="btn btn-info" id="submit-all">Upload</button>
            </div>
            
        </div>
    </div>
    <br/>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Uploaded Images</h3>
        </div>
        <div class="panel-body" id="uploaded_image">
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    Dropzone.options.dropzoneForm = {
        autoProcessQueue : false,
        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
        init:function(){
            var submitButton = document.querySelector("#submit-all");
            myDropzone = this;
            submitButton.addEventListener('click',function(){
                myDropzone.processQueue();

            });
            this.on("complete",function(){
                if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){
                    var _this = this;
                    _this.removeAllFiles();


                }
                load_images();
            });

        }
    };
    load_images();
    function load_images()
    {
        $.ajax({
            url:"{{route('dropzone.fetch')}}",
            success:function(data)
            {
                $('#uploaded_image').html(data);
            }
        })
    }
    $(document).on('click','.remove_button',function(){
        var name = $(this).attr('id');
        $.ajax({
            url:"{{route('dropzone.delete')}}",
            data: {name : name},
            success:function(data){
                load_images();

            }

        })
    });
</script>