@extends("admin/master")

@section("content")

    <div class="content-wrapper">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{--Button section--}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn">
                                <button type="button" class="btn btn-success"><a class="text-white" href="{{url('/admin/addcourse')}}">Add Single Course</a></button>
                                <button type="button" class="btn btn-warning" data-target="#mymodel" data-toggle="modal">Add from Excel</button>
                            </div>
                        </div>
                    </div>
                    {{--End of buton section--}}

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-dark bg-dark justify-content-between">
                                <a class="navbar-brand">Course List</a>
                                <form class="form-inline" method="get">
                                    <input class="form-control mr-sm-2" id="search" name="search" type="search" placeholder="Search by name or id" aria-label="Search">
                                </form>
                            </nav>
                        </div>
                        <div class="col-md-12" id="student-t">
                            <div style="height: 10px">
                                <span></span>
                            </div>
                            <table class="table table-striped" id="student-table">
                                <thead>
                                <tr>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Part</th>
                                    <th scope="col">Teacher ID</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">MCQ Set</th>
                                    <th scope="col">Openended Set</th>
                                    <th scope="col">Evaluation</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $row)
                                        <tr>
                                            <td>{{$row->courseid}}</td>
                                            <td>{{$row->year}}</td>
                                            <td>{{$row->semester}}</td>
                                            <td>{{$row->part}}</td>
                                            <td>{{$row->teacherinfo_id}}</td>
                                            <td>{{$row->deptcode}}</td>
                                            @if($row->qsetmcq)
                                                <td>{{$row->qsetmcq}}</td>
                                            @else
                                                <td>Null</td>
                                            @endif

                                            @if($row->qsetmcq)
                                                <td>{{$row->qsetopen}}</td>
                                            @else
                                                <td>Null</td>
                                            @endif
                                            <td>
                                                <input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Open" data-off="Close" {{ $row->openforevaluation ? 'checked' : '' }}>
                                            </td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{url("/admin/course/$row->id/editcourse")}}">
                                                        <button type="submit" class="btn-primary mr-1">Edit</button>
                                                    </a>
                                                    <form action="{{url("admin/course/$row->id")}}" method="post" onsubmit="return confirm('Are you sure to delete this course information?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$courses->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="mymodel">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Excel Import</h3>
                                <hr>
                            </div>

                            <div class="modal-body">
                                <div class="choose-file">
                                    <form id="addExcel" action="{{url('/admin/courses')}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="file" id="cid" accept="xlsx">
                                        </div>
                                        <button type="button" id="submit" class="btn btn-success" onclick="submit_form()">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(function () {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') === true ? 1 : 0;
                var user_id = $(this).data('id');
                console.log(status);
                console.log(user_id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/course/statusupdate',
                    data: {status : status, user_id: user_id},
                    success: function(data){
                        console.log(data.success)
                    },
                    error: function () {
                        alert("Failed to update");
                    }
                });
            });

        });


        function submit_form() {
            var filelength = $("#cid")[0].files.length;
            if (filelength === 0) {
                $("#submit").attr('type','button');
            }
            else {
                $("#submit").attr('type','submit');
            }
        }

    </script>

@endsection
