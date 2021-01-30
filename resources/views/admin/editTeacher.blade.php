@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4"><span></span></div>
                    <div class="col-md-4"><h3>Add new Teacher</h3></div>
                    <div class="col-md-4"><span></span></div>
                </div>
                <div class="row">
                    <div class="col-md-1"><span></span></div>
                    <div class="col-md-10">
                        <form action="{{url("admin/teacher/{$teacher->tid}")}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputID">Name</label>
                                    <input type="text" name="tname" class="form-control" placeholder="Teacher's Name" value="{{old('tname',$teacher->tname)}}">
                                </div>
                                <div class="col">
                                    <label for="inputEmail">Teacher's ID</label>
                                    <input type="text" name="tid" class="form-control" placeholder="Teacher's ID" value="{{old('tid',$teacher->tid)}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="inputDeptCode">Dept. Code</label>
                                    <input type="text" class="form-control" id="inputDeptCode" name="deptcode" value="{{old('tname',$teacher->deptcode)}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn-primary" value="Update Teacher Info">
                            </div>
                            <div class="form-group row">
                                @foreach($errors->all() as $error)
                                    <p style="color: red">{{$error}}</p>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="col-md-1"><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
