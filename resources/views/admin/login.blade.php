<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url("css/login.css")}}">
    <link rel="stylesheet" href="{{url("css/footer.css")}}">

</head>
<body>

<div class="container" style="margin-bottom: 20px;">
    <div class="logo">
        <img src="images/logo.png" alt="State University Logo">
        <p><b>State University Of Bangladesh</b></p>

        <div class="login-form">
            <div class="row">
                <div class="col-md-12 text-light">
                    <h2>Admin Login</h2>
                </div>
            </div>
            <form action="{{url('/admin')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" name="userid" class="form-control" placeholder="Userid" required="required" value="{{old('userid')}}">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="form-group">
                    @if (Session::has('error'))
                        <p style="color: red">{{Session('error')}}</p>
                    @endif

                </div>
            </form>
        </div>

        <div>
        <a style="color: white; margin-left: 10px; margin-right: 10px;" href="{{url('/teacher/login')}}">TeacherLogin</a>
        <a style="color: white; margin-left: 10px; margin-right: 10px;" href="{{url('/adminlogin')}}">AdminLogin</a>
        <a style="color: white; margin-left: 10px; margin-right: 10px" href="{{url("/superadminlogin")}}">SuperAdminLogin</a>
        </div>

    </div>
</div>
@include("common.footer")


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
