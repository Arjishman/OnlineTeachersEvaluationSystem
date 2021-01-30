@extends("admin/master")

@section("content")

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">

                {{--Option Container Starts--}}
                <div class="optionContainer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" id="setMcqBtn" class="btn btn-outline-success m-2">Add MCQ Questions</button>
                                <button type="submit" id="setOpenEndBtn" class="btn btn-outline-info m-2">Add Open End Questions</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Option Container ends--}}


                {{--addMcqQuestionContainer starts--}}
                <div class="addQuestionMcqContainer d-none">
                    <div class="row">

                        <div class="col-md-12">
                            <h3 class="text-center mb-3 mt-3">Add MCQ Question</h3>
                        </div>

                        <div class="col-md-1"><span></span></div>
                        <div class="col-md-10 m-3">
                            <form>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="questionSetmcq">Question Set name</label>
                                        <input type="text" class="form-control" id="questionSetmcq" name="qset" placeholder="Give a set name...">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="categoryIdmcq">Question Category ID</label>
                                        <input type="text" class="form-control" id="categoryIdmcq" name="categoryid" placeholder="Give a category ID..">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qcategorydesMcq">Question Category Description</label>
                                        <input type="text" id="qcategorydesMcq" name="categorydesc" class="form-control" placeholder="Category Description">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="qdesmcq">Question Description</label>
                                        <input type="text" class="form-control" id="qdesmcq" name="qdesmcq" placeholder="Question Description...">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label for="qopdes1">Option A Description</label>
                                        <input type="text" class="form-control" id="qopdes1" name="qopdes1" placeholder="Option A">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qopdes2">Option B Description</label>
                                        <input type="text" class="form-control" id="qopdes2" name="qopdes2" placeholder="Option B">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qopdes3">Option C Description</label>
                                        <input type="text" class="form-control" id="qopdes3" name="qopdes3" placeholder="Option C">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qopdes4">Option D Description</label>
                                        <input type="text" class="form-control" id="qopdes4" name="qopdes4" placeholder="Option D">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qopdes5">Option E Description</label>
                                        <input type="text" class="form-control" id="qopdes5" name="qopdes5" placeholder="Option E">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="deptcode">Department</label>
                                        <input type="text" class="form-control" id="deptcodeMcq" name="deptcode" value="{{session('empDeptcode')}}" readonly>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <Button type="button" class="btn btn-success" id="addMcqBtn">Add Qestion</Button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"><span></span></div>

                    </div>
                </div>
                {{--addMcqQuestionContainer ends--}}


                {{--addOpenEndedQuestionContainer starts--}}
                <div class="setQuestionOpenEndedContainer d-none">
                    <div class="row">

                        <div class="col-md-12">
                            <h3 class="text-center mb-3 mt-3">Add Open End Question</h3>
                        </div>
                        <div class="col-md-1"><span></span></div>
                        <div class="col-md-10 m-3">
                            <form>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="questionSetOpenEnd">Question Set name</label>
                                        <input type="text" class="form-control" name="qset" id="questionSetOpenEnd" placeholder="Give question set name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="categoryidOpen">Question Category ID</label>
                                        <input type="text" class="form-control" id="categoryidOpen" name="categoryid" placeholder="Give Category ID....">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="categorydescOpen">Question Category Description</label>
                                        <input type="text" class="form-control" id="categorydescOpen" name="categorydesc" placeholder="Give Category description....">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-9 mt-2">
                                        <label for="qdescOpen">Question Description</label>
                                        <input type="text" class="form-control" name="qdescopenended" id="qdescOpen" placeholder="Question Description...">
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <label for="deptcodeOpen">Department</label>
                                        <input type="text" class="form-control" name="deptcode" id="deptcodeOpen" value="{{session('empDeptcode')}}" readonly>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col">
                                        <Button type="button" class="btn btn-success" id="addOpenEndedBtn">Add Qestion</Button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"><span></span></div>

                    </div>
                </div>
                {{--addOpenEndedQuestionContainer ends--}}

            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection
