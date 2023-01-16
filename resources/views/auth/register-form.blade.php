<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form">
    <form action="{{route('web.register')}}" method="post" id="register-form">
        @csrf
        <h1>Sign up</h1>
        <div class="content">
            <div class="input-field">
                <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" id="InputName">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field">
                <input type="email" placeholder="Email"  name="email" value="{{ old('email') }}" id="InputEmail" >
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field">
                <input type="password" placeholder="Password" name="password" id="InputPassword" >
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-field">
                <input type="password" placeholder="password Confirmation" name="password_confirmation" id="InputPasswordConformation">
            </div>

        </div>
        <div class="action">
            <button type="submit" class="btn btn-dark" >Sign up</button>
        </div>
    </form>
</div>
<!-- partial -->
<script  src="{{asset('assets/script.js')}}"></script>
<script type="text/javascript">
    $('#register-form').on('submit',function(e){
    e.preventDefault();

    let name = $('#InputName').val();
    let email = $('#InputEmail').val();
    let password = $('#InputPassword').val();
    let password_confirmation = $('#InputPasswordConformation').val();


    $.ajax({
        url: "/register/",
        type:"POST",
        data:{
        "_token": "{{ csrf_token() }}",
        name:name,
        email:email,
        password:password,
        password_confirmation:password_confirmation

        },
        success:function(response){
            window.location.replace('/home')
        },

});
});
</script>
</body>
</html>
