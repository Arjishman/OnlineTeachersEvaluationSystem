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
                                <button type="button" class="btn btn-success"><a class="text-white" href="{{url('/admin/addstudents')}}">Add Student</a></button>
                                <button type="button" class="btn btn-warning" data-target="#mymodel" data-toggle="modal">Add from Excel</button>
                            </div>
                        </div>
                    </div>
                    {{--End of buton section--}}

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-dark bg-dark justify-content-between">
                                <a class="navbar-brand">Student List</a>
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
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Dept</th>
                                    <th scope="col">Registration Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->sid}}</td>
                                            <td>{{$student->sname}}</td>
                                            <td>{{$student->semail}}</td>
                                            <td>{{$student->deptcode}}</td>
                                            <td>{{$student->created_at}}</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{url("admin/student/$student->sid/editStudent")}}">
                                                        <button type="submit" class="btn btn-primary mr-1">Edit</button>
                                                    </a>
                                                    <form action="{{url("admin/student/$student->sid")}}" method="post" onsubmit="return confirm('Are you sure to delete this row?')">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$students->links()}}

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
                                    <form action="{{url('/admin/students')}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="file" id="studentFile" accept="">
                                        </div>
                                        <button type="submit" id="submit1" class="btn btn-success" onclick="submit_form()">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script type="text/javascript">

        function submit_form() {
            var filelength = $("#studentFile")[0].files.length;
            if (filelength === 0) {
                $("#submit1").attr('type','button');
            }
            else {
                $("#submit1").attr('type','submit');
            }
        }

    </script>

{{--    <script type="text/javascript">
        $(document).ready(function () {

            fetch_students_data();

            function fetch_students_data(query = '') {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/action',
                    data: {query: query},
                    success: function(data){
                        $('tbody').html(data.table_data);
                        console.log(data.table_data);
                    },
                    error: function () {
                        alert("Failed to update");
                    }
                });

            }

            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_students_data(query);
            });

        });



    </script>--}}

@endsection
