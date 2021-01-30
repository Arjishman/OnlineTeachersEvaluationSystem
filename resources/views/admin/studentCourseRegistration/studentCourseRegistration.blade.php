@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Student Course Registration</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url('admin/course-registration')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="courseId">Course Id</label><br>
                                    <select name="courseid" id="courseId" class="form-control">
                                        @foreach($cid as $row)
                                        <option value="{{$row->courseid}}">{{$row->courseid}}"</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="studentId">Student Id</label><br>
                                    <select name="sid" id="studentId" class="form-control">
                                        @foreach($sid as $row)
                                            <option value="{{$row->sid}}">{{$row->sid}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn-primary" value="Register"><br>
                            </div>
                            @foreach($errors->all() as $error)
                                <p style="color: red">{{$error}}</p>
                            @endforeach
                        </form>
                    </div>
                    <div class="col-md-1"><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
