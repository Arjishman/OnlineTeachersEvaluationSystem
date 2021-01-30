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
                                <a href="{{url('admin/addquestions')}}"><button class="btn btn-primary" type="submit">Add Questions</button></a>
                            </div>
                        </div>
                    </div>
                    {{--End of buton section--}}

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-dark bg-dark justify-content-between">
                                <a href="#" class="navbar-brand">Question List</a>
                                <form class="form-inline" method="get">
                                    <input class="form-control mr-sm-2" id="search" name="search" type="search" placeholder="Search by name or id" aria-label="Search">
                                </form>
                            </nav>
                        </div>

                        <div class="col-md-12" id="mcqList">
                            <h3 class="text-center">MCQ List</h3>
                            <table class="table table-striped" id="student-table">
                                <thead>
                                <tr>
                                    <th scope="col">Question Set</th>
                                    <th scope="col">Category ID</th>
                                    <th scope="col">Category Desc</th>
                                    <th scope="col">Question Desc.</th>
                                    <th scope="col">Op 1</th>
                                    <th scope="col">Op 2</th>
                                    <th scope="col">Op 3</th>
                                    <th scope="col">Op 4</th>
                                    <th scope="col">Op 5</th>
                                    <th scope="col">Dept</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($mcq as $row)
                                        <tr>
                                            <td>{{$row->qset}}</td>
                                            <td>{{$row->categoryid}}</td>
                                            <td>{{$row->categorydesc}}</td>
                                            <td>{{$row->qdescription}}</td>
                                            <td>{{$row->qopdes1}}</td>
                                            <td>{{$row->qopdes2}}</td>
                                            <td>{{$row->qopdes3}}</td>
                                            <td>{{$row->qopdes4}}</td>
                                            <td>{{$row->qopdes5}}</td>
                                            <td>{{$row->deptcode}}</td>
                                            <td>
                                                <form action="{{url("admin/mcqqlist/$row->id")}}" method="post" onsubmit="return confirm('Are you sure to delete this row?')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$mcq->links()}}

                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection
