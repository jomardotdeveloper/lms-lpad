<div class="modal fade" tabindex="-1" id="questionModal">
    <div class="modal-dialog" role="file">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Question</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="type">Type</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="type" id="type">
                                    <option value="identification">Identification</option>
                                    <option value="multiple_choice">Multiple Choice</option>
                                    <option value="true_false">True/False</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Question</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="question" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-none" id="choiceACol">
                        <div class="form-group">
                            <label class="form-label" for="name">Choice A</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="choiceAInput" placeholder="Enter choice" name="name" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-none" id="choiceBCol">
                        <div class="form-group">
                            <label class="form-label" for="name">Choice B</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="choiceBInput" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-none" id="choiceCCol">
                        <div class="form-group">
                            <label class="form-label" for="name">Choice C</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="choiceCInput" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-none" id="choiceDCol">
                        <div class="form-group">
                            <label class="form-label" for="name">Choice D</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="choiceDInput" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>








                    <div class="col-sm-12 d-none" id="trueOrFalseColAnswer">
                        <div class="form-group">
                            <label class="form-label" for="answer">Answer</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="type" id="trueOrFalseAnswer">
                                    <option value="True">True</option>
                                    <option value="False">False</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 d-none" id="multipleChoiceColAnswer">
                        <div class="form-group">
                            <label class="form-label" for="answer">Answer</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="type" id="multipleChoiceAnswer">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12" id="identificationColAnswer">
                        <div class="form-group">
                            <label class="form-label" for="answer">Answer</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="identificationAnswer" placeholder="Enter answer" name="answer" required/>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 mt-2">
                    <button class="btn btn-primary" id="btnAddQuestion">Add Question</button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Question form</span>
            </div>
        </div>
    </div>
</div>
