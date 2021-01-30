@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
            </div>
            <div class="col-md-12" id="page-heading">
                <h3 class="text-center">Select to show the evaluation Report</h3>
            </div>
            <div class="col-md-12 ml-2 mr-2">
                <div class="container">
                    <form action="{{url('/admin/evaluationreport')}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="semester">Select Semester</label>
                                <select name="semester" class="form-control" id="semester">
                                    <option value="Summer">Summer</option>
                                    <option value="Spring">Spring</option>
                                    <option value="Fall">Fall</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="year">Select Year</label>
                                <select name="year" class="form-control" id="year">
                                    <option value="2020" selected>2020</option>
                                    <option value="2019" disabled>2019</option>
                                    <option value="2018" disabled>2018</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="deptcode">Select Dept.</label>
                                <input type="text" class="form-control" id="deptcode" name="deptcode" value="{{session('empDeptcode')}}" readonly>
                            </div>
                            <div class="form-group col">
                                <label for="courseid">Select CourseID</label>
                                <select name="courseid" class="form-control" id="courseid">
                                    @foreach($courseinfo as $row)
                                        <option value="{{$row->courseid}}">{{$row->courseid}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="tid">Select TeacherID</label>
                                <select name="tid" class="form-control" id="tid">
                                    @foreach($courseinfo->unique('teacherinfo_id') as $row)
                                        <option value="{{$row->teacherinfo_id}}">{{$row->teacherinfo_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Show Report</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
