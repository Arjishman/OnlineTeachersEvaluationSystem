@extends("superAdmin.master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 text-center">
                        <h3>Register new Admin</h3>
                        <hr style="height: 1px; background-color: black; width: 300px">
                    </div>



                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{url("/superadmin/addadmin")}}" method="post">
                                    @csrf
                                    <input type="hidden" name="role" value="2">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputName4">Name</label>
                                            <input type="text" class="form-control" id="inputName4" name="empname" placeholder="Admin Name" value="{{old('empname')}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmployeeID4">Employee ID</label>
                                            <input type="text" class="form-control" id="inputEmployeeID" name="empid" placeholder="Admin ID" value="{{old('empid')}}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Password</label>
                                            <input type="password" class="form-control" id="inputPassword4" name="emppw" placeholder="Password" value="{{old("emppw")}}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="showPass">
                                                <label class="form-check-label" for="gridCheck">
                                                    Show Password
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputDeptCode">Dept. Code</label>
                                            <select id="inputDeptCode" name="deptcode" class="form-control">
                                                <option selected value="null">Choose...</option>
                                                <option value="CSE">CSE</option>
                                                <option value="Law">Law</option>
                                                <option value="Pharmacy">Pharmacy</option>
                                                <option value="FET">Food & Nutrition</option>
                                                <option value="English">English</option>
                                                <option value="BBA">BBA</option>
                                                <option value="Architecture">Architecture</option>
                                                <option value="JCM">Journalism</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--Show password Script--}}
                                    <script !src="">
                                        var showPass = document.getElementById("showPass");
                                        var passwordInput = document.getElementById("inputPassword4");
                                        showPass.addEventListener("click",function () {
                                                if (passwordInput.type === "password"){
                                                    passwordInput.type = "text";
                                                }else {
                                                    passwordInput.type = "password";
                                                }
                                        })

                                    </script>

                                    <button type="submit" class="btn btn-primary">Register</button>
                                    @foreach($errors->all() as $error)
                                        <p style="color: red">{{$error}}</p>
                                    @endforeach
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
