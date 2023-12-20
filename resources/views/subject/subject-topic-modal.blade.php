<div class="modal fade" tabindex="-1" id="video">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Video</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('subjects.add-topic', ['subject' => $subject]) }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="video">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="video_src">Video</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="video_src" placeholder="Enter video_src" name="video_src" />
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 mt-2">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Topic form</span>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" tabindex="-1" id="file">
    <div class="modal-dialog" role="file">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add File</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('subjects.add-topic', ['subject' => $subject]) }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="file">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="file_src">File</label>
                            <div class="form-control-wrap">
                                <input type="file" class="form-control" id="file_src" placeholder="Enter file_src" name="file_src" />
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 mt-2">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Topic form</span>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" tabindex="-1" id="announcement">
    <div class="modal-dialog" role="file">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Announcement</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('subjects.add-topic', ['subject' => $subject]) }}" class="row" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="announcement">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-2">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Topic form</span>
            </div>
        </div>
    </div>
</div>
