@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Edit Student</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url("admin/student/$student->sid")}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">Name</label>
                                    <input type="text" name="sname" class="form-control" placeholder="Student Name" value="{{old('sname',$student->sname)}}">
                                </div>
                                <div class="col">
                                    <label for="inputEmail">Email</label>
                                    <input type="text" name="semail" class="form-control" placeholder="Student email" value="{{old('semail',$student->semail)}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">ID</label>
                                    <input type="text" name="sid" class="form-control" placeholder="Student id" value="{{old('sid',$student->sid)}}">
                                </div>
                                <div class="col">
                                    <label for="inputID">Department</label>
                                    <input type="text" name="deptcode" class="form-control" placeholder="Department" value="{{old('deptcode',$student->deptcode)}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn-primary" value="Update">
                            </div>
                            <div class="form-group row">
                                @foreach($errors->all() as $error)
                                    <p style="color: red;">{{$error}}</p><br/>
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
