<!doctype html>
<html lang="en">
<head>
    @include('students.common.head')
    <title>Student Home Page</title>

    <link rel="stylesheet" href="{{url("")}}/css/studenthome1.css">

    <script src="{{url("")}}/js/jquery-3.4.1.slim.min.js"></script>
</head>
<body>
{{--Head Navbar Section Starts--}}
@include('students/common/navbar');
{{--Head Navbar Section ends--}}


{{--Main Contentes Starts--}}

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12" id="main-contents">

            {{--Page Heading Starts--}}
            <div class="col-md-12" id="page-heading">
                <h2 class="header text-center">Welcome {{$student->sname}}</h2>
                <hr>
            </div>
            {{--Page Heading Ends--}}

            <div class="container">
                <form class="p-3">
                    <div class="row" id="studentInfo">

                        <div class="col-md-6">

                            <div class="form-group row">
                                <label for="program" class="col-sm-3 col-form-label text-white mr-0 pr-0">Department</label>
                                <div class="col-sm-9 ml-0 pl-0">
                                    <input type="text" class="form-control" name="program" id="program" value="{{$student->deptcode}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="studentId" class="col-sm-3 col-form-label text-white mr-0 pr-0">Student ID</label>
                                <div class="col-sm-9 ml-0 pl-0">
                                    <input type="text" class="form-control" name="studentId" id="studentId" value="{{$student->sid}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="date" class="col-sm-2 col-form-label mr-0 pr-0 text-white">Date</label>
                                <div class="col-sm-10 ml-0 pl-0">
                                    <input type="text" class="form-control" name="date" id="date" value="{{date('d M Y')}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="studentName" class="col-sm-4 col-form-label mr-0 pr-0 text-white">Student Name</label>
                                <div class="col-sm-8 ml-0 pl-0">
                                    <input type="text" style="width: 100%" class="form-control" name="studentName" id="studentName" value="{{$student->sname}}" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


                <div class="row">
                    <div class="col-md-3"><span></span></div>
                    <div class="col-md-3 col-sm-6 text-center"><span class="text-white">Running Year: 2020</span></div>
                    <div class="col-md-3 col-sm-6 text-center"><span class="text-white">Running Semester: Summer</span></div>
                    <div class="col-md-3"><span></span></div>
                </div>


                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10 text-center">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Evaluate</th>
                                <th scope="col">Course Code</th>
                                <th scope="col">Lecturer</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($regCourses as $row)
                                <tr>
                                    <td><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal{{$row->id}}">Evaluate</button></td>
                                    <td>{{$row->courseid}}</td>
                                    <td>{{$row->tname}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--Modal Starts--}}
                        @foreach($regCourses as $row)
                        <div class="row justify-content-center">

                            <div class="col-md-6 justify-content-center" id="open-for-evaluate">

                                <div class="modal fade bd-example-modal-sm" id="modal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Evaluation Status</h5>
                                                    <div class="container">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    @if($row->openforevaluation == 1 && $row->evaluationstatus == 0)
                                                        <span>Open for Evaluation</span>
                                                    @elseif($row->evaluationstatus == 1)
                                                        <span>Evaluated</span>
                                                    @else
                                                        <span>Closed</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    @if($row->openforevaluation == 1 && $row->evaluationstatus == 0)
                                                        <a href="{{route('remindHelper',['courseid'=>$row->courseid,'sid'=>$student->sid])}}"><button class="btn-dark mb-2 mt-2" type="submit">Evaluate</button></a>
                                                    @else
                                                        <span></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach

                    </div>

                    {{--Modal Ends--}}
                    <div class="col-md-1"><span></span></div>
                </div>

            </div>
        </div>
    </div>
</div>

{{--Main Contentes Ends--}}


{{--Footer section starts--}}
@include('students/common/footer');
{{--Footer Section Ends--}}

<script src="{{url("")}}/js/bootstrap.min.js"></script>
<script src="{{url("")}}/js/studenthome1.js"></script>
</body>
</html>
