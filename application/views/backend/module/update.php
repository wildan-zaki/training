<form action="<?=base_url('backend/module/doUpdate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="fmoduleid" value="<?=$module->fmoduleid?>">
        </div>

        <div class="panel-body">

            <div class="form-group">
                <label for="fmodulename">Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fmodulename" id="fmodulename" placeholder="Full Name" value="<?=$module->fmodulename?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="images">File</label>
                <a href="<?=base_url($module->img)?>">Preview file</a>
                <input type="file" class="form-control" name="ffilemodule" id="filemodule" value="" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*"/>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fmodulestatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fmodulestatus" id="fmodulestatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=$module->fmodulestatus == 1 ? 'selected':''?>>Active</option>
                    <option value="0" <?=$module->fmodulestatus == 0 ? 'selected':''?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
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