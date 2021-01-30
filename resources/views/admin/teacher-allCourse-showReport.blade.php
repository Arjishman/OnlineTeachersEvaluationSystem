@extends("admin/master")

@section("content")

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h3 class="text-center">{{$teacherInfo->tname}}</h3><br>
                            <h3 class="text-center" style="margin-top: -30px">ID: {{$teacherInfo->tid}}</h3><br>
                            <p class="text-center" style="margin-top: -30px">Semester: {{$semester}} || Year: {{$year}}</p>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-success" href="{{route('show-teacherEvaluationPdf',['tid'=>$teacherInfo->tid,'year'=>$year,'semester'=>$semester])}}">Download as PDF</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <h3 class="ml-5">MCQ :</h3>
                    <hr style="background: black; width: 10%; float: left; margin-left: 3%; margin-top: -5px">
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Course ID</th>
                                    <th scope="col">Mean Score</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Positive Response</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalMeanscore = 0;
                                    $totalPositiveResponse = 0;
                                    $totalWeight = 0;
                                @endphp
                                @foreach($mcq as $row)
                                <tr>
                                    <td>{{$row->courseid}}</td>
                                    <td>{{$row->mean_score}}</td>
                                    <td>{{$row->total_weight}}</td>
                                    <td>{{$row->positive_response}}</td>
                                </tr>
                                    @php
                                        $meanscore = $row->mean_score;
                                        $weight = $row->total_weight;
                                        $totalMeanscore = $totalMeanscore + $meanscore * $weight;
                                        $totalWeight = $totalWeight + $weight
                                    @endphp
                                @endforeach
                                <tr>
                                    <th></th>
                                    <th>Total: {{$v = number_format($totalMeanscore/$totalWeight,3)}}</th>
                                    <th></th>
                                    <th>Total: {{number_format((($v - 1)/4)*100,2)}}%</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h3 class="ml-5">Open Ended :</h3>
                    <hr style="background: black; width: 17%; float: left; margin-left: 3%; margin-top: -5px">
                </div>

                <div class="col-md-12" style="margin:0 10%">
                    @foreach($openResult->unique('courseid') as $row1)
                    <div class="row">
                        <div class="col-md-12">
                            <h4>CourseID: {{$row1->courseid}}</h4>
                        </div>
                        @foreach($qopen->unique('categoryid') as $row2)
                        <div class="col-md-12">
                            <div class="row" id="OpenEnded">
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text-center"><span>{{$row2->categoryid}}. </span><span>{{$row2->categorydesc}}:</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10" id="answerOpen">
                                    <div class="row">
                                        @foreach($qopen as $row3)
                                            @if($row3->categoryid == $row2->categoryid && $row3->categorydesc == $row2->categorydesc)
                                            <div class="col-md-12"><h5 class="opQ">{{$row3->qdesopenended}}</h5></div>

                                                @foreach($openResult as $row4)
                                                    @if($row4->qdesopenended == $row3->qdesopenended && $row1->courseid == $row4->courseid)
                                                        <div class="col-md-12 "><p><span><b>Answer: </b></span>{{$row4->answerdesc}}</p></div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection
