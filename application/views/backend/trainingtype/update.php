<form action="<?=base_url('backend/trainingtype/doUpdate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Update</button>
            <input type="hidden" name="ftraintypeid" value="<?=$trainingtype->ftraintypeid?>">
        </div>

        <div class="panel-body">

            <div class="form-group">
                <label for="ftraintypename">Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="ftraintypename" id="ftraintypename" placeholder="Full Name" value="<?=$trainingtype->ftraintypename?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="ftraintypestatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="ftraintypestatus" id="ftraintypestatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=$trainingtype->ftraintypestatus == 1 ? 'selected':''?>>Active</option>
                    <option value="0" <?=$trainingtype->ftraintypestatus == 0 ? 'selected':''?>>Not Active</option>
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