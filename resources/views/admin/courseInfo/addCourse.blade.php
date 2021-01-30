@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Add new Course</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url('admin/addcourse')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <label for="courseid">Course ID</label>
                                    <input type="text" name="courseid" class="form-control" placeholder="Course Id">
                                </div>
                                <div class="col">
                                    <label for="year">Year</label>
                                    <input type="text" name="year" class="form-control" placeholder="Running year" value="{{session('activeYear')}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="semester">Semester</label><br>
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="Summer">Summer</option>
                                        <option value="Spring">Spring</option>
                                        <option value="Fall">Fall</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="qsetmcq">MCQ Qset</label><br>
                                    <select name="qsetmcq" id="qsetmcq" class="form-control">
                                        @foreach($qsetmcq as $row)
                                        <option value="{{$row->qset}}">{{$row->qset}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="part">Part</label>
                                    <select name="part" id="" class="form-control">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="teacherinfo_id">Assigned Teacher ID</label><br>
                                    <select name="teacherinfo_id" id="" class="form-control">
                                        @foreach($tid as $row)
                                            <option value="{{$row->tid}}">{{$row->tid}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="deptcode">Dept. Code</label>
                                    <input type="text" class="form-control" id="deptcode" name="deptcode" value="{{session('empDeptcode')}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="qsetopen">Open End Qset</label><br>
                                    <select name="qsetopen" id="qsetopen" class="form-control">
                                        @foreach($qsetopen as $row)
                                            <option value="{{$row->qset}}">{{$row->qset}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn-primary" value="Register">
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
