@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">All Evaluation Result</h2>
            </div>

            <div class="col-md-12">
                <div class="container">

                    <table class="table table-striped" id="evaluationReportTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">TeacherID</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Mean Score</th>
                            <th scope="col">Total Weight</th>
                            <th scope="col">Positive Response</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                        <tr>
                            <th class="count"></th>
                            <td>{{$row->tid}}</td>
                            <td>{{$row->courseid}}</td>
                            <td>{{$row->mean_score}}</td>
                            <td>{{$row->total_weight}}</td>
                            <td>{{$row->positive_response}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
