<form action="<?=base_url('backend/certificate/doUpdate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="form-group">
                <label for="fcertificatenumber">Certificate Number <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fcertificatenumber" id="fcertificatenumber" placeholder="Full Name" value="<?=$certificate->fcertificatenumber?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="ftrainplanid">Training Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select name="ftrainplanid" id="ftrainplanid" class="form-control select2">
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
                <select name="fusercertif" id="input_training" class="form-control select2">
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
                <label for="images">File</label>
                <a href="<?=base_url($certificate->img)?>">Preview file</a>
                <input type="file" class="form-control" name="ffilecertificate" id="images" value="" accept="image/*" multiple="multiple" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fcertificatestatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fcertificatestatus" id="fcertificatestatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=$certificate->fcertificatestatus == 1 ? 'selected':''?>>Active</option>
                    <option value="0" <?=$certificate->fcertificatestatus == 0 ? 'selected':''?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="fcertificateid" value="<?=$certificate->fcertificateid?>">
        </div>
    </div>
</form>

<script>

    $(document).ready(function () {

        $('.select2').select2();

        $('.ts_datepicker').datepicker();

        $("#image").change(function() {
            readURL(this, '.img-preview');
        });
    });
</script>