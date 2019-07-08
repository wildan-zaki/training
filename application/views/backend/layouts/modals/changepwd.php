<!--Change Password Modal-->
<form action="<?=base_url('backend/user/changepwd')?>" method="post" enctype="multipart/form-data">
    <?php $this->session->set_flashdata('current_url', $this->uri->uri_string()); ?>
    <div class="modal fade" id="changePwdModal" tabindex="-1" role="dialog" aria-labelledby="changePwdModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">New Password <small class="form-control-feedback" style="color:red;"> *</small></label>
                        <input type="password" class="form-control" name="fuserpassword" id="password" placeholder="New Password" value="" />
                        <small class="form-control-feedback" style="color:red;">  </small>
                    </div>
                    <div class="form-group">
                        <label for="passwordconf">Confirm Password <small class="form-control-feedback" style="color:red;"> *</small></label>
                        <input type="password" class="form-control" name="passwordconf" id="passwordconf" placeholder="Confirm Password" value="" />
                        <small class="form-control-feedback" style="color:red;">  </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>