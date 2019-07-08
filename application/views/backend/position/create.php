<form action="<?=base_url('backend/position/doCreate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="form-group">
                <label for="fpositionname">Position Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fpositionname" id="fpositionname" placeholder="e.g. Staff" value="<?=set_value('fpositionname')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fpositionstatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fpositionstatus" id="fpositionstatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=set_select('fpositionstatus', '1')?>>Active</option>
                    <option value="0" <?=set_select('fpositionstatus', '0')?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
    });
</script>