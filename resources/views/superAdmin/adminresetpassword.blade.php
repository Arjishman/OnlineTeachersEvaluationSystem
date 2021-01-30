@extends("superAdmin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 text-center">
                        <h3>Reset {{$admin->empname}}'s password</h3>
                        <hr style="height: 1px; background-color: black; width: 300px">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{url("/superadmin/$admin->empid")}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputName4">New Password</label>
                                            <input type="password" class="form-control" id="pass" name="emppw" placeholder="New Password">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmployeeID4">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmPass" name="confirmpass" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <button class="btn btn-primary ml-2" id="submitBtn" type="button">Reset</button>
                                        <p class="text-red ml-3" id="error"></p>
                                    </div>
                                    <script !src="">

                                           $("#submitBtn").on('click',function () {
                                               var p1 = $("#pass").val();
                                               var p2 = $("#confirmPass").val();
                                                if (p1 === p2){
                                                    $(this).attr('type','submit');
                                                    $("#error").text(" ");
                                                }else {
                                                    $("#error").text('Confirm password did not match');
                                                    this.attr('type','button');
                                                }
                                           })

                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
