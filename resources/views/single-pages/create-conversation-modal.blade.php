<div class="modal fade" tabindex="-1" id="chat">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Conversation</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('messages.storeConversation') }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="video">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-2">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Chat System</span>
            </div>
        </div>
    </div>
</div>

