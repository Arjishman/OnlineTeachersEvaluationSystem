<!doctype html>
<html lang="en">
<head>
    @include('teacher.common.head')
    <title>Teacher Homepage</title>

    <link rel="stylesheet" href="{{""}}/css/teacher.css">
</head>
<body>
@include('teacher.common.navbar')
<div class="container" id="teacher-body">
    <div class="row">

        <div class="col-md-12">
            <h3 class="text-center text-white">{{$tinfo->tname}}'s Info</h3>
            <hr id="headingHr">
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h5>Name: <span>{{$tinfo->tname}}</span></h5>
                    <h5>Current Year: {{$activeys->year}}</h5>
                </div>
                <div class="col-md-6">
                    <h5>Dept: <span>{{$tinfo->deptcode}}</span></h5>
                    <h5>Current Semester: {{$activeys->semester}}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-12" id="regCourses">
            <h4>Course List</h4>
            <hr>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-bordered" id="teacherTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Part</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Year</th>
                            <th scope="col">Evaluation Report</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($regcourses->unique('courseid') as $row)
                                <tr>
                                    <th class="teacherRow"></th>
                                    <td>{{$row->courseid}}</td>
                                    <td>{{$row->part}}</td>
                                    <td>{{$row->semester}}</td>
                                    <td>{{$row->year}}</td>
                                    <td>
                                        <a href="">
                                            <button class="btn btn-warning" type="submit">Show Report</button>
                                        </a>
                                    </td>
                                </tr>
                             @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>


    </div>
</div>


@include('teacher.common.footer')

<script src="{{url("")}}/js/bootstrap.min.js"></script>
<script src="{{url("")}}/js/studenthome1.js"></script>
</body>
</html>
