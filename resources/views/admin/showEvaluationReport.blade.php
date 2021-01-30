@extends("admin/master")

@section("content")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h4>Teacher ID: <span>{{$tid}}</span></h4>
                        <h4>Course id: <span>{{$courseid}}</span></h4>
                        <hr style="height: 1px; width: 50%; background: black">
                        <h5>MCQ</h5>
                        <hr style="width: 20%; background: black">
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-success" href="{{route('show-tEvSingleCoursePdf',['tid'=>$tid,'year'=>$year,'semester'=>$semester,'courseid'=>$courseid])}}">Download as PDF</a>
                    </div>
                </div>

            </div>

            <div class="container">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="font-weight-bold text-center">Categories</h5>
                                <div class="row">
                                    <div class="col" style="margin-top: 11px"><span></span></div>
                                </div>
                                <hr style="background: black">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-weight-bold text-center">Questions</h5>
                                    <div class="row">
                                        <div class="col" style="margin-top: 11px"><span></span></div>
                                    </div>
                                    <hr style="background: black">
                                </div>
                                <div class="col-md-3">
                                    <h5 class="font-weight-bold text-center">Responses</h5>
                                    <div class="row mb-0">
                                        <div class="col text-center"><h6>Op1</h6></div>
                                        <div class="col text-center"><h6>Op2</h6></div>
                                        <div class="col text-center"><h6>Op3</h6></div>
                                        <div class="col text-center"><h6>Op4</h6></div>
                                        <div class="col text-center"><h6>Op5</h6></div>
                                    </div>
                                    <hr style="background: black; margin-top: -0px">
                                </div>
                                <div class="col-md-2">
                                    <h5 class="font-weight-bold text-center">Mean Score</h5>
                                    <div class="row">
                                        <div class="col" style="margin-top: 11px"><span></span></div>
                                    </div>
                                    <hr style="background: black">
                                </div>
                                <div class="col-md-1">
                                    <h6 class="font-weight-bold text-center" style="padding-bottom: 4px">Positive Response</h6>
                                    <hr style="background: black">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                @php
                    $overallMeanScore = 0;
                    $totalQuestions = 0;
                @endphp
                @foreach($mcqctg as $row)
                    @php
                        $totalMeanScore = 0;
                        $totalPosRes=0;
                        $catNumber = 0;
                        $catAvgMeanScore = 0;
                    @endphp
                <div class="col-md-12 mb-0 pb-0">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6><span>{{$row->categoryid}}</span>. <span>{{$row->categorydesc}} :</span></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10" id="QuestionValues">
                            <div class="row">
                                @foreach($mcq->unique('qdescription') as $row1)
                                    @php
                                        $r1 = 0;
                                        $r2 = 0;
                                        $r3 = 0;
                                        $r4 = 0;
                                        $r5 = 0;
                                    @endphp
                                    @if($row1->categoryid == $row->categoryid && $row1->categorydesc == $row->categorydesc)
                                        <div class="col-md-6">
                                            <h6 class="questions">{{$row1->qdescription}}</h6>
                                        </div>
                                @foreach($mcq as $m)
                                      @if($m->categoryid == $row->categoryid && $m->qdescription == $row1->qdescription)
                                          @if($m->response == 1)
                                           @php
                                            $r1++;
                                           @endphp
                                           @elseif($m->response == 2)
                                              @php
                                              $r2++;
                                             @endphp
                                           @elseif($m->response == 3)
                                              @php
                                              $r3++;
                                             @endphp
                                           @elseif($m->response == 4)
                                              @php
                                              $r4++;
                                             @endphp
                                           @elseif($m->response == 5)
                                              @php
                                              $r5++;

                                             @endphp
                                           @endif
                                        @endif
                                @endforeach
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col text-center"><h6>{{$r1}}</h6></div>
                                                <div class="col text-center"><h6>{{$r2}}</h6></div>
                                                <div class="col text-center"><h6>{{$r3}}</h6></div>
                                                <div class="col text-center"><h6>{{$r4}}</h6></div>
                                                <div class="col text-center"><h6>{{$r5}}</h6></div>
                                            </div>
                                        </div>
                                    @php
                                        $catNumber++;
                                        $x = 0;
                                        $x = $r1+ $r2+ $r3+ $r4+ $r5;
                                        $meanScore = (($r1 * 1 + $r2 * 2 + $r3 * 3 + $r4 * 4 + $r5 * 5)/$x);
                                        $totalMeanScore = $totalMeanScore + $meanScore;
                                        $overallMeanScore = $overallMeanScore + $meanScore;
                                        $p = (($meanScore-1)/4) * 100;
                                    @endphp
                                <div class="col-md-2 text-center">
                                    <h6>{{number_format($meanScore,2)}}</h6>
                                </div>
                                <div class="col-md-1 text-center">
                                    <h6>{{number_format($p,2)."%"}}</h6>
                                </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <hr style="background: black">
                    </div>
                    <div class="col-md-12" style="margin-top: -10px">
                        <div class="row">

                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="row mb-3">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1 text-right font-weight-bold">Total:</div>
                                    @php
                                        $catAvgMeanScore = $totalMeanScore/$catNumber;
                                        $totalPosRes = (($catAvgMeanScore-1)/4)*100;
                                    @endphp
                                    <div class="col-md-2 text-center font-weight-bold">{{number_format($catAvgMeanScore,2)}}</div>
                                    <div class="col-md-1 font-weight-bold">{{number_format($totalPosRes,2)."%"}}</div>
                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach
                @foreach($mcq->unique('qdescription') as $q)
                    @php
                        $totalQuestions++;
                    @endphp
                @endforeach
                @php
                    $overallMeanScore = $overallMeanScore/$totalQuestions;
                    $totalPositiveResponse = (($overallMeanScore-1)/4)*100;
                @endphp

                <div class="col-md-12">
                    <div class="container">
                        <hr style="background: black;">
                        <div class="row">
                            <div class="col-md-4 text-center"><h5 class="font-weight-bold">Total Mean Score: {{number_format($overallMeanScore,3)}}</h5></div>
                            <div class="col-md-4 text-center"><h5 class="font-weight-bold">Total Positive Response: {{number_format($totalPositiveResponse,2)."%"}}</h5></div>
                            <div class="col-md-4 text-center"><h5 class="font-weight-bold">Total Submission: {{count($mcq)/$totalQuestions}}</h5></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <form action="/admin/addevaluationresult" method="post">
                            @csrf
                            <input type="hidden" name="mean_score" id="mean_score" value="{{number_format($overallMeanScore,3)}}">
                            <input type="hidden" name="positive_response" id="positive_response" value="{{number_format($totalPositiveResponse,2)}}">
                            <input type="hidden" name="total_weight" id="total_weight" value="{{count($mcq)/$totalQuestions}}">
                            <input type="hidden" name="courseid" id="courseid1" value="{{$courseid}}">
                            <input type="hidden" name="tid" id="tid" value="{{$tid}}">
                            <input type="hidden" name="year" id="year" value="{{$year}}">
                            <input type="hidden" name="semester" id="semester" value="{{$semester}}">
                            <button class="btn btn-primary" id="submitBtn" type="button">Save To Database</button>
                        </form>
                    </div>
                </div>

             </div>
            <script !src="" type="text/javascript">

                $(function () {
                    $("#submitBtn").on('click',function (e) {
                        var positive_response = $('#positive_response').val();
                        var mean_score = $("#mean_score").val();
                        var total_weight = $('#total_weight').val();
                        var tid = $('#tid').val();
                        var courseid = $('#courseid1').val();
                        var year = $('#year').val();
                        var semester = $('#semester').val();
                        $.ajax({
                            type: "post",
                            method: "POST",
                            dataType: "json",
                            url: '/admin/addevaluationresult',
                            data:{
                                positive_response: positive_response,
                                mean_score: mean_score,
                                total_weight: total_weight,
                                tid: tid,
                                courseid:courseid,
                                year: year,
                                semester: semester
                            },
                            success: function (data) {
                                alert('Successfully Stored!!!');
                                console.log(data.success);
                            },
                            error: function () {
                                alert("Failed To Store!!!");
                            }
                        });
                    })
                });

            </script>

           <div class="col-md-12 text-center mt-3">
               <h5>Open Ended</h5>
               <hr style="background: black; width: 50%">
           </div>

            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        @foreach($openctg as $row)
                        <div class="col-md-12">
                            <div class="row" id="OpenEnded">
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text-center"><span>{{$row->categoryid}}. </span><span>{{$row->categorydesc}}:</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10" id="answerOpen">
                                    <div class="row">
                                        @foreach($open->unique('qdesopenended') as $row1)
                                        @if($row1->categoryid == $row->categoryid && $row1->categorydesc == $row->categorydesc)
                                                <div class="col-md-12"><h5 class="opQ">{{$row1->qdesopenended}}</h5></div>
                                                @foreach($open as $row2)
                                                    @if($row2->qdesopenended == $row1->qdesopenended)
                                                    <div class="col-md-12 "><p class="answer">{{$row2->answerdesc}}</p></div>
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
                </div>
            </div>

        </div>
    </div>
    <!-- /.content-wrapper -->



@endsection
