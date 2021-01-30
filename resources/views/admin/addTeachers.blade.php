@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Add new Teacher</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url('admin/addteacher')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">Name</label>
                                    <input type="text" name="tname" class="form-control" placeholder="Teacher's Name">
                                </div>
                                <div class="col">
                                    <label for="inputEmail">Teacher's ID</label>
                                    <input type="text" name="tid" class="form-control" placeholder="Teacher's ID">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Teacher's Password">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="showPass">
                                        <label class="form-check-label" for="gridCheck">
                                            Show Password
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="inputDeptCode">Dept. Code</label>
                                    <input type="text" name="deptcode" class="form-control" value="{{session('empDeptcode')}}" readonly>
                                </div>
                            </div>
                            {{--Show password Script--}}
                            <script !src="">
                                var showPass = document.getElementById("showPass");
                                var passwordInput = document.getElementById("password");
                                showPass.addEventListener("click",function () {
                                    if (passwordInput.type === "password"){
                                        passwordInput.type = "text";
                                    }else {
                                        passwordInput.type = "password";
                                    }
                                })
                            </script>
                            <div class="form-group row">
                                <input type="submit" class="btn-primary" value="Register">
                            </div>
                            <div class="form-group row">
                                @foreach($errors->all() as $error)
                                    <p style="color: red">{{$error}}</p>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
