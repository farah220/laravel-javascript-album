<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="login-form">
    <form action="{{route('web.login')}}" method="post" id="login-form">
        @csrf
        <h1>Login</h1>
        <div class="content">
            <div class="input-field">
                <input type="email" placeholder="Email" name="email" id="InputEmail">
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
            <a href="{{route('web.register-form')}}" class="link">sign up?</a>
        </div>
        <div class="action">
            <button type="submit" class="btn btn-dark">Sign in</button>
        </div>
    </form>
</div>
<!-- partial -->
<script  src="{{asset('assets/script.js')}}"></script>
<script type="text/javascript">
    $('#login-form').on('submit',function(e){
        e.preventDefault();

        let email = $('#InputEmail').val();
        let password = $('#InputPassword').val();

        $.ajax({
            url: "/login/",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                email:email,
                password:password,
            },
            success:function(response){
               window.location.replace('/home')
            },
        });
    });


</script>

</body>
</html>
