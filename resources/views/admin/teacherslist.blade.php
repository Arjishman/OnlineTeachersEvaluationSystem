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
                    @if ($message = Session::get('alert'))
                        <div class="alert alert-danger" role="alert">
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
                                <button type="button" class="btn btn-success"><a class="text-white" href="{{url('/admin/addteacher')}}">Add Teacher</a></button>
                            </div>
                        </div>
                    </div>
                    {{--End of buton section--}}

                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-dark bg-dark justify-content-between">
                                <a class="navbar-brand">Teachers List</a>
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
                                    <th scope="col">Dept</th>
                                    <th scope="col">Registration Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @foreach($teachers as $row)
                                     <tr>
                                         <td>{{$row->tid}}</td>
                                         <td>{{$row->tname}}</td>
                                         <td>{{$row->deptcode}}</td>
                                         <td>{{$row->created_at}}</td>
                                         <td>
                                             <div class="btn-group" role="group" aria-label="Basic example">
                                                 <a href="{{url("admin/teacher/$row->tid/editTeacher")}}">
                                                     <button type="submit" class="btn btn-primary mr-1">Edit</button>
                                                 </a>
                                                 <form action="{{url("admin/teacher/$row->tid")}}" method="post" onsubmit="return confirm('Are you sure to delete this row?')">
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

                            {{$teachers->links()}}

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

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
