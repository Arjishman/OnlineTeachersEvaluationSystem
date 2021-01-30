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
                                <button type="button" class="btn btn-success"><a class="text-white" href="{{url('/admin/course-registration')}}">Register Student for Course</a></button>
                            </div>
                        </div>
                    </div>
                    {{--End of buton section--}}

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-dark bg-dark justify-content-between">
                                <a class="navbar-brand">Student Course Registration List</a>
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
                                    <th scope="col">Course Id</th>
                                    <th scope="col">Student Id</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Evaluation Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courseReg as $row)
                                    <tr>
                                        <td>{{$row->courseid}}</td>
                                        <td>{{$row->sid}}</td>
                                        <td>{{$row->sname}}</td>
                                        @if($row->evaluationstatus == 0)
                                            <td id="">Not Evaluated</td>
                                        @else
                                            <td id="">Evaluated</td>
                                        @endif

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{url("admin/course-registration/$row->id/edit")}}">
                                                    <button type="submit" class="btn btn-primary mr-1">Edit</button>
                                                </a>
                                                <form action="{{url("admin/course-registration/$row->id")}}" method="post" onsubmit="return confirm('Are you sure to delete this row?')">
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

                            {{$courseReg->links()}}

                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

@endsection
