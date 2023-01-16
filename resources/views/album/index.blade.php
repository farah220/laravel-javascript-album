<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{asset('assets/card.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/main.css')}}" rel="stylesheet" type="text/css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <form action="{{route('web.logout')}}" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="btn bg-transparent" style="cursor:pointer" >
                    <i class="text-md-left fa fa-sign-out" style="font-size:20px;color:whitesmoke; text-align: end"></i>
                </button>
                <span style="color: white"> Hey,{{auth()->user()->name}}</span>
            </form>

        </ul>

    </div>
</nav>
<div style="position: fixed;
    width: 100px;
    bottom: 0px;
    right: 0px;
    margin:40px;
    padding:30px;
    border-radius:70%;
    z-index: 1000;">
    <!-- Button trigger modal -->
    <button type="button" style="width: 40px; height: 40px;"  class="btn btn-dark fw-bolder" data-bs-toggle="modal" data-bs-target="#exampleModal">
        +
    </button>
</div>

<div class="row py-4">
        @foreach($album->images as $img)
        <div class="col-3 text-center mb-4 image-box" data-image-src="{{ asset('storage/Images/images/' . $img['name'] ) }}">

            <div class="card" style="
                width: 250px;
                height: 200px;
                background-image:url('{{ asset('storage/Images/images/' . $img['name'] ) }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                margin: 10px"
            ></div>
            <div class="d-flex flex-column fw-bold text-muted">
                <span>{{$img->name}}</span>

                <span>{{ date("Y-m-d" , strtotime($img->created_at)) }}</span>
            </div>
        </div>

        @endforeach
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{route('images.store')}}" method="post" enctype="multipart/form-data" id="my-form">
                @csrf
                <div class="modal-body">

                    <div>
                        <input hidden name="album_id" value="{{$album->id}}" id="Inputalbum_id">

                            <div class="multiple-uploader" id="multiple-uploader">
                                <div class="mup-msg">
                                    <span class="mup-main-msg">click to upload images.</span>
                                    <span class="mup-msg" id="max-upload-number">Upload up to 10 images</span>
                                    <span class="mup-msg">Only images, pdf and psd files are allowed for upload</span>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-body text-center">

                    <img src="" id="modal-image" class="w-100">

                </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="{{asset('assets/js/Multiple-Uploader.js')}}"></script>
<script>

    let multipleUploader = new MultipleUploader('#multiple-uploader').init({
        maxUpload : 20, // maximum number of uploaded images
        maxSize:2, // in size in mb
        filesInpName:'images', // input name sent to backend
        formSelector: '#my-form', // form selector
    });

    $('#my-form').on('submit',function(e){
        e.preventDefault();
        let data = new FormData(this)
        $.ajax({
            url: "/images/",
            type:"POST",
            data,
            processData:false,
            contentType:false,
            success:function(response){
                Swal.fire({
                        title:"images",
                        icon:"success",
                        text:'images added successfully',
                        timer:5000,
                        showConfirmButton:false
                    },
                ).then(()=>{
                    window.location.reload()
                })

            },
        },

        );
    });

    $('.image-box').click( function () {

        $('#imageModal').modal('show')
        $('#modal-image').attr('src' , $(this).data('image-src'))
    });
</script>
</body>
</html>
