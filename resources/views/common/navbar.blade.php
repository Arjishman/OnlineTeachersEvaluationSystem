<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url("css/studenthome.css")}}">

</head>
<body>

<div class="header">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-center">
        <div class="container">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav navbar-center">
                <a class="nav-item nav-link" href="{{url('/student')}}"><b>Home</b></a>
                <a class="nav-item nav-link" href="#"><b>Registered Courses</b></a>
                <!--a class="nav-item nav-link" href="{{url('/changePassword')}}"><b>Change Password</b></a>-->
                <a class="nav-item nav-link" href="{{url('/student/logout')}}"><b>Logout</b></a>
            </div>
        </div>
        </div>



    </nav>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
</body>
</html>
