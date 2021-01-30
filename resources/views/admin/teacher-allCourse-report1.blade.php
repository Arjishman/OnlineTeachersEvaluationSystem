@extends("admin/master")

@section("content")

    <div class="content-wrapper">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Teacher Course Report Selection</h2>
                </div>

                    <div class="col-md-12">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div>


                <div class="col-md-12">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="tid" >Select Teacher ID</label>
                                <select name="tid" id="tid" class="form-control">
                                    @foreach($teacherInfo as $row)
                                    <option value="{{$row->tid}}">{{$row->tid}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="semester" >Select Semester</label>
                                <select name="semester" id="semester" class="form-control">
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Fall">Fall</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="year">Select Year</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="2020">2020</option>
                                    <option value="2019">2020</option>
                                    <option value="2018">2020</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="deptcode">Dept. Code</label>
                                <input type="text" class="form-control" id="deptcode" value="{{session('empDeptcode')}}" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col ml-2">
                                <a href="{{url('admin/teacher-select-course')}}">
                                    <button type="submit" class="btn btn-primary mb-2">Show Report</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
