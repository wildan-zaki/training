<form action="<?=base_url('backend/user/doUpdate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="form-group">
                <label for="fusername">Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fusername" id="fusername" placeholder="Full Name" value="<?=$user->fusername?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fuseremail">Email <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="email" class="form-control" name="fuseremail" id="fuseremail" placeholder="Email" value="<?=$user->fuseremail?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fuserpassword">New Password</label>
                <input type="password" class="form-control" name="fuserpassword" id="fuserpassword" placeholder="Password" value="" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="passwordconf">Confirm Password</label>
                <input type="password" class="form-control" name="passwordconf" id="passwordconf" placeholder="Confirm Password" value="" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="froleid">Role <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select name="froleid" id="froleid" class="form-control select2">
                    <option value="1" <?=$user->froleid == 1 ? 'selected':''?>>Admin</option>
                    <option value="2" <?=$user->froleid == 2 ? 'selected':''?>>Member</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fuserfullname">Birthdate <small class="form-control-feedback" style="color:red;"> *</small></label>
                <div class="input-group date ts_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                    <input class="form-control" type="text" name="fuserbirthdate" placeholder="yyyy-mm-dd" value="<?=$user->fuserbirthdate?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="fuseraddress" >Address</label>
                <input type="text" value="<?=$user->fuseraddress?>" name="fuseraddress" class="form-control form-control-line">
            </div>
            <?php if($user->froleid != 1) { ?>
            <div class="form-group">
                <label for="fnik">NIK</label>
                <input type="text" name="fnik" value="<?=$user->fnik?>" id="fnik" class="form-control form-control-line" >
            </div>
            <div class="form-group">
                <label for="fnpwp">NPWP</label>
                <input type="text" value="<?=$user->fnpwp?>" id="fnpwp" name="fnpwp" class="form-control form-control-line" >
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="fuserstatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fuserstatus" id="fuserstatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=$user->fuserstatus == 1 ? 'selected':''?>>Confirmed</option>
                    <option value="2" <?=$user->fuserstatus == 2 ? 'selected':''?>>Suspended</option>
                    <option value="0" <?=$user->fuserstatus == 0 ? 'selected':''?>>Not Confirmed</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="fuserid" value="<?=$user->fuserid?>">
        </div>
    </div>
</form>

<script>

    $(document).ready(function () {

        $('.ts_datepicker').datepicker();

        $("#image").change(function() {
            readURL(this, '.img-preview');
        });
    });
</script>