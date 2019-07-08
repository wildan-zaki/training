<form action="<?=base_url('backend/position/doUpdate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">

        <div class="panel-body">

            <div class="form-group">
                <label for="fpositionname">Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fpositionname" id="fpositionname" placeholder="e.g. Staff" value="<?=$position->fpositionname?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fpositionstatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fpositionstatus" id="fpositionstatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=$position->fpositionstatus == 1 ? 'selected':''?>>Active</option>
                    <option value="0" <?=$position->fpositionstatus == 0 ? 'selected':''?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="fpositionid" value="<?=$position->fpositionid?>">
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