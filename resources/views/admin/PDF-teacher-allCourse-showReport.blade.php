<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <style>
        hr{
            background: black;
            width: 10%;
            float: left;
            margin-left: 3%;
            margin-top: -5px;
            height: 1px
        }
        #Openended{
            counter-reset: section;
        }

        #ans{
            counter-reset: section1;
        }

        .opQ:before{
            counter-increment: section;
            content: "Q" counter(section)". ";
        }
        .AnswerOpen:before{
            counter-increment: section1;
            content: "Answer" counter(section1)": ";
        }

    </style>
</head>
<body>

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
            </div>

        </div>

        <div class="col-md-12">
            <h3 class="ml-5">MCQ :</h3>
        </div>

        <div class="col-md-12" style="margin:-10px 10%">
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
        </div>

        <div class="col-md-12" style="margin:-5px 10%">
            @foreach($openResult->unique('courseid') as $row1)
                <div class="row">
                    <div class="col-md-12">
                        <h4>CourseID: {{$row1->courseid}}:</h4>
                    </div>
                    @foreach($qopen->unique('categoryid') as $row2)
                        <div class="col-md-12">
                            <div class="row" id="Openended">
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="text-center"><span>{{$row2->categoryid}}. </span><span>{{$row2->categorydesc}}:</span></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        @foreach($qopen as $row3)
                                            @if($row3->categoryid == $row2->categoryid && $row3->categorydesc == $row2->categorydesc)
                                                <div class="col-md-12" id="ans"><h5 class="opQ"><b>Q. </b>{{$row3->qdesopenended}}</h5></div>

                                                @foreach($openResult as $row4)
                                                    @if($row4->qdesopenended == $row3->qdesopenended && $row1->courseid == $row4->courseid)
                                                        <div class="col-md-12" ><p><span><b class="AnswerOpen">Answer: </b></span>{{$row4->answerdesc}}</p></div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        <hr style="background: black; height: 1px; width: 95%">
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
