<form action="<?=base_url('backend/trainingtype/doCreate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Create</button>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="ftraintypename">Trainingtype Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="ftraintypename" id="ftraintypename" placeholder="Eg: IT Industry" value="<?=set_value('ftraintypename')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="ftraintypestatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="ftraintypestatus" id="ftraintypestatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=set_select('ftraintypestatus', '1')?>>Active</option>
                    <option value="0" <?=set_select('ftraintypestatus', '0')?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
    });
</script>