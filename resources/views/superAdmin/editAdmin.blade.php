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
                        <h3>Edit {{$admin->empname}}'s Informations</h3>
                        <hr style="height: 1px; background-color: black; width: 300px">
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{url("/superadmin/$admin->empid")}}" method="post">

                                    @csrf
                                    @method("PATCH")
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputName4">Name</label>
                                            <input type="text" class="form-control" id="inputName4" name="empname" placeholder="Employee Name" value="{{old('employeeName',$admin->empname)}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmployeeID4">Employee ID</label>
                                            <input type="text" class="form-control" id="inputEmployeeID" name="empid" placeholder="Employee ID" value="{{old('employeeId',$admin->empid)}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputDeptCode">Dept. Code</label>
                                        <select id="inputDeptCode" name="deptcode" class="form-control">
                                            <option selected value="null">Choose...</option>
                                            <option value="CSE">CSE</option>
                                            <option value="Law">Law</option>
                                            <option value="Pharmacy">Pharmacy</option>
                                            <option value="FET">Food Engineering</option>
                                            <option value="English">English</option>
                                            <option value="BBA">BBA</option>
                                            <option value="Architecture">Architecture</option>
                                            <option value="JCM">Journalism</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
