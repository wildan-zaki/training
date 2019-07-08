<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/certificate/update/'.$certificate->fcertificateid)?>">
            <div class="btn btn-warning float-md-right float-sm-left">
                <i class="ion-edit"></i> Update
            </div>
        </a>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <label for="fcertificatenumber">Certificate Number <small class="form-control-feedback" style="color:red;"> *</small></label>
            <input type="text" class="form-control" name="fcertificatenumber" id="fcertificatenumber" placeholder="Full Name" value="<?=$certificate->fcertificatenumber?>" disabled/>
            <small class="form-control-feedback" style="color:red;">  </small>
        </div>
        <div class="form-group">
            <label for="ftrainplanid">Training Name <small class="form-control-feedback" style="color:red;"> *</small></label>
            <select name="ftrainplanid" id="ftrainplanid" class="form-control select2" disabled>
                <option value="">-- Please Select One --</option>
                <?php foreach ($training as $ty) { ?>
                    <?php 
                    if($ty['ftrainplanid'] == $certificate->ftrainplanid){ ?>
                        <option value="<?=$certificate->ftrainplanid?>" selected><?=$certificate->ftrainplanname?></option>
                    <?php

                    } else { ?>
                    <option value="<?=$ty['ftrainplanid']?>"><?=$ty['ftrainplanname']?></option>
                <?php } } ?>
            </select>
            <small class="form-control-feedback" style="color:red;">  </small>
        </div>
        <div class="form-group">
            <label for="fusercertif">Given To <small class="form-control-feedback" style="color:red;"> *</small></label>
            <select name="fusercertif" id="input_training" class="form-control select2" disabled>
                <option value="">-- Please Select One --</option>
                <?php foreach ($membertra as $ty) { 
                    if($certificate->fusercertif == $ty->fuserid) {
                    ?>
                    <option value="<?=$ty->fuserid?>" selected><?=$ty->fusername?></option>
                    <?php 
                } else { 
                    ?>
                    <option value="<?=$ty->fuserid?>"><?=$ty->fusername?></option>
                <?php } }?>

            </select>
        </div>
        <div class="form-group">
            <label class="col-md-12">Created at</label>
            <div class="col-md-12">
                <input type="text" value="<?=$certificate->created_at?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Modified at</label>
            <div class="col-md-12">
                <input type="text" value="<?=$certificate->updated_at?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Status</label>
            <div class="col-md-12">
                <?php
                $status = 'Active';
                if($certificate->fcertificatestatus == 0){
                    $status = "Not Active";
                }
                ?>
                <input type="text" value="<?=$status?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
    </div>
</div>