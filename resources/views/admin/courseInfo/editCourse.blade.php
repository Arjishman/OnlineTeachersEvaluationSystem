@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Edit Course</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url("admin/course/$course->id")}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <div class="col">
                                    <label for="courseid">Course ID</label>
                                    <input type="text" name="courseid" class="form-control" placeholder="Course Id" value="{{old('courseid',$course->courseid)}}">
                                </div>
                                <div class="col">
                                    <label for="year">Year</label>
                                    <input type="text" name="year" class="form-control" placeholder="Running year" value="{{old('year',$course->year)}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="Fall">Fall</option>
                                        <option value="Spring">Spring</option>
                                        <option value="Summer">Summer</option>
                                    </select>
                                    <input type="hidden" id="semesterValue" value="{{$course->semester}}">
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
                            <script !src="" type="text/javascript">
                                var v = document.querySelector('#semesterValue').value;
                                var v1 = document.getElementById('semester');
                                for (var i = 0; i < v1.length; i++){
                                    if (v1[i].value === v){
                                        v1[i].selected = true;
                                    }
                                }
                            </script>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="part">Part</label>
                                    <select name="part" id="part" class="form-control">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    <input type="hidden" value="{{$course->part}}" id="partValue">
                                </div>
                                <script !src="">
                                    var v = document.querySelector('#partValue').value;
                                    var v1 = document.getElementById('part');
                                    for (var i = 0; i < v1.length; i++){
                                        if (v1[i].value === v){
                                            v1[i].selected = true;
                                        }
                                    }
                                </script>
                                <div class="col">
                                    <label for="teacherinfo_id">Assigned Teacher ID</label>
                                    <select name="teacherinfo_id" id="teacher_id" class="form-control">
                                        @foreach($tid as $row)
                                            <option value="{{$row->tid}}">{{$row->tid}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="tid" value="{{$course->teacherinfo_id}}">
                                </div>
                                <script !src="">
                                    var teacherId = document.querySelector('#tid').value;
                                    var tid = document.getElementById('teacher_id');
                                    for (var i = 0; i < tid.length; i++){
                                        if (tid[i].value === teacherId){
                                            tid[i].selected = true;
                                        }
                                    }
                                </script>
                                <div class="col">
                                    <label for="deptcode">Dept. Code</label>
                                    <input type="text" id="deptcode" name="deptcode" class="form-control" value="{{session('empDeptcode')}}" readonly>
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
                                <input type="submit" class="btn-primary" value="Update">
                            </div>
                        </form>
                        @foreach($errors->all() as $error)
                            <p style="color: red">{{$error}}</p>
                            @endforeach
                    </div>
                    <div class="col-md-1"><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
