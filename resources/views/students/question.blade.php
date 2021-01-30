<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Question</title>

    <link rel="stylesheet" href="{{url("")}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url("")}}/css/footer.css">
    <link rel="stylesheet" href="{{url("")}}/css/questionPage.css">

    <script src="{{url("")}}/js/jquery-3.4.1.slim.min.js"></script>

    <style>
        body {
            /* Set "my-sec-counter" to 0 */
            counter-reset: my-sec-counter;
        }

        #openended{
            counter-reset: section;
        }

        h3::before {
            /* Increment "my-sec-counter" by 1 */
            counter-increment: my-sec-counter;
            content: "Q" counter(my-sec-counter) ". ";
        }

        h4::before{
            counter-increment: section;
            content: "Q" counter(section)". ";
        }

        .category{
            font-size: 130%;
            font-weight: bold;
            color: #D4EAE0;
        }
    </style>

</head>
<body>

@include("students.common.navbar");

<div class="container" id="questionContainer">
    <div class="row">
        <div class="col-md-12" id="questionContents">

            <div class="col-md-12" id="heading">
                <h2>Evaluation Form</h2>
            </div>

            <div class="col-md-12" id="info">
                <h6 class="text-white">Subject Code: <span>{{$courseinfo->courseid}}</span></h6>
                <h6 class="text-white">Teacher ID: <span>{{$courseinfo->tid}}</span></h6>
            </div>

            <div class="row">
                <div class="col-md-1"><span></span></div>

                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url("/student/question/$courseinfo->id")}}" method="post">
                                @csrf
                                <input type="hidden" name="sid" value="{{$courseinfo->sid}}">
                                @foreach($mcqcategory as $row1)
                                <div class="col-md-12">
                                    <p class="mb-0 category"><span>{{$row1->categoryid}}:</span><span>{{$row1->categorydesc}}</span></p>
                                </div>
                                @foreach($mcq as $row)
                                    @if($row->categorydesc == $row1->categorydesc)

                                            <input type="hidden" name="qidmcq[]" value="{{$row->id}}">

                                <div class="col-md-12 mcq">
                                    <div class="d-flex flex-row question-title">
                                        <h3 class="text-warning"></h3>
                                        <h5 class="mt-1 ml-2 text-white">{{$row->qdescription}}</h5>
                                    </div>
                                    <div class="options">
                                        <div class="form-check form-inline float-left">
                                            <input class="form-check-input form-inline" type="radio" name="qopdes[{{$row->id}}]" id="qopdes1{{$row->id}}" value="1">
                                            <label class="form-check-label text-white" for="qopdes1{{$row->id}}">
                                                {{$row->qopdes1}}
                                            </label>
                                        </div>
                                        <div class="form-check form-inline float-left">
                                            <input class="form-check-input form-inline" type="radio" name="qopdes[{{$row->id}}]" id="qopdes2{{$row->id}}" value="2">
                                            <label class="form-check-label text-white" for="qopdes2{{$row->id}}">
                                                {{$row->qopdes2}}
                                            </label>
                                        </div>
                                        <div class="form-check form-inline float-left">
                                            <input class="form-check-input form-inline" type="radio" name="qopdes[{{$row->id}}]" id="qopdes3{{$row->id}}" value="3">
                                            <label class="form-check-label text-white" for="qopdes3{{$row->id}}">
                                                {{$row->qopdes3}}
                                            </label>
                                        </div>
                                        <div class="form-check form-inline float-left">
                                            <input class="form-check-input form-inline" type="radio" name="qopdes[{{$row->id}}]" id="qopdes4{{$row->id}}" value="4">
                                            <label class="form-check-label text-white" for="qopdes4{{$row->id}}">
                                                {{$row->qopdes4}}
                                            </label>
                                        </div>
                                        <div class="form-check form-inline float-left">
                                            <input class="form-check-input form-inline" type="radio" name="qopdes[{{$row->id}}]" id="qopdes5{{$row->id}}" value="5">
                                            <label class="form-check-label text-white" for="qopdes5{{$row->id}}">
                                                {{$row->qopdes5}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <hr style="background: white;">
                                </div>
                                @endif
                                @endforeach
                                @endforeach


                                @foreach($opencategory as $row1)
                                <div class="col-md-12">
                                    <p class="mb-0 category"><span>{{$row1->categoryid}}:</span><span>{{$row1->categorydesc}}</span></p>
                                </div>
                                @foreach($openended as $row)
                                    @if($row->categorydesc === $row1->categorydesc)
                                            <input type="hidden" name="qidopenended[]" value="{{$row->id}}">
                                <div class="col-md-12 mt-2 openended">
                                    <div class="form-group">
                                        <label class="text-white d-flex" for="openendedAnswer">
                                            <h4 class="text-warning open"></h4>
                                            <h5 class="mt-1 ml-2 text-white">{{$row->qdesopenended}}</h5>
                                        </label>
                                        <textarea class="form-control openEnd" name="openended[{{$row->id}}]" id="openendedAnswer" cols="15" rows="2"></textarea>
                                    </div>
                                </div>
                                     @endif
                                @endforeach
                                @endforeach



                                <div class="col-md-12 mb-3 d-flex">
                                    <button type="submit" id="submitBtn" class="btn btn-warning w-25">Submit</button>
                                    @foreach($errors->all() as $error)
                                        <div class="text-red"><span>{{$error}}</span></div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"><span></span></div>
            </div>

        </div>
    </div>
</div>


@include('students.common.footer')
<script src="{{url("")}}/js/bootstrap.min.js"></script>
<script src="{{url(" ")}}/js/student.js"></script>


</body>
</html>
