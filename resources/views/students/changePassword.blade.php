<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/footer.css')}}">

    <style>

        .inputs{
            background: #0f6674;
            text-align: center;
            margin-top:20px;
            margin-left: 30px;
            margin-right: 30px;
            height: 380px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .inputs input{
            width: 300px;
        }

    </style>

</head>
<body>

@include('students.resources.views.common.navbar')

<div class="container">

    <div class="inputs">


        <h4 style="color: white; padding-top: 10px"><b>Change Password</b></h4>
        <hr style="color: white; background-color: white; height: 3px;">

        <form action="" method="post" style="padding-top: 20px;">
            <input style="border-radius: 5px;" type="password" name="currentPassword" placeholder="Current Password"><br/><br/>
            <input style="border-radius: 5px;" type="password" name="newPassowrd" placeholder="New Password"><br/><br/>
            <input style="border-radius: 5px;" type="password" name="confirmPassowrd" placeholder="Confirm Password"><br/><br/>
            <button type="submit" name="btnUpdate" style="width: 200px"><b>Update</b></button>
        </form>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
@include('students.resources.views.common.footer')
</body>
</html>


