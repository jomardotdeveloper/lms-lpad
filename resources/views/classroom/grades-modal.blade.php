

<div class="modal fade" tabindex="-1" id="computeGradesModal">
    <div class="modal-dialog" role="file">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Compute Grades</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('classrooms.compute-grades') }}" class="row" method="POST">
                    @csrf
                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Test Names</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Quiz #1, Quiz #2, Quiz #3" name="test_names" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Percentages</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="10, 20, 30" name="percentages" required/>
                            </div>
                        </div>
                    </div>




                    <div class="col-sm-12 mt-2">
                        <input type="submit" value="Compute" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Compute Grades</span>
            </div>
        </div>
    </div>
</div>
