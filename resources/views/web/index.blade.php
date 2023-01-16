<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{asset('assets/card.css')}}" rel="stylesheet" type="text/css">
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

<div class="container-fluid">
    <div class="row py-4">

        @foreach(auth()->user()->albums as $album)

            <div class="col-3 text-center">

                <div class="card" style="width: 250px; height: 200px; background-image:url('{{ asset('storage/Images/Albums/' . $album['image'] ) }}');  margin: 10px; display:inline-block; background-color: #4a5568 " >
                    <a href="{{route('web.album',$album->id)}}">
                        <div class="card-body" style="text-align:center;position:relative">

                            <h4 class="card-title"  style="text-align: center; text-decoration-color: #1a202c; font-weight: bold; ">{{$album->name}}</h4>

                        </div>
                    </a>
                    <form  method="POST" action="{{route('albums.destroy',$album)}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="position: absolute;top:-15px;border-radius: 50px;right: -15px"> <i class="text-left fa fa-trash" style="font-size:20px;color:whitesmoke; text-align: end"></i></button>
                    </form>
                </div>

            </div>

        @endforeach

    </div>
</div>
<div style="position: fixed;
width: 100px;
    bottom: 0px;
    right: 0px;
    margin:40px;
    padding:30px;
    border-radius:70%;
">
    <!-- Button trigger modal -->
    <button type="button" style="width: 40px; height: 40px;"  class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        +
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('albums.store')}}" method="POST" id="album-form" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">

                <div>
                    <label style=" font-weight: bold">album's name</label>
                    <br/>
                    <input type="text" id="InputName" name="name" placeholder="enter album's name" style="width: 200px; border-radius:3px;">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <br/>
                    <label style=" font-weight: bold">select cover image</label>
                    <br/>
                    <input type="file" id="InputImage" accept=".png, .jpg, .jpeg" name="image" style="width: 200px; border-radius:3px;">
                    @error('image')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
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
<script type="text/javascript">

        $('#album-form').on('submit',function(e){

        e.preventDefault();

        let data = new FormData(this);

        $.ajax({
            url: "/albums/",
            type:"POST",
            data: data,
            processData: false,
            contentType: false,
            success:function(response){
                Swal.fire({
                        title:"album",
                        icon:"success",
                        text:'album added successfully',
                        timer:5000,
                        showConfirmButton:false
                    },
                ).then(()=>{
                    window.location.reload()
                })
            },


        });
    });

</script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
