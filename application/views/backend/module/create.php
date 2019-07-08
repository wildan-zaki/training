<form action="<?=base_url('backend/module/doCreate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Create</button>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="fmodulename">Module Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fmodulename" id="fmodulename" placeholder="Full Name" value="<?=set_value('fmodulename')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="ffilemodule">Upload Module</label>
                <input type="file" class="form-control" name="ffilemodule" id="filemodule" value="" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*"/>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fmodulestatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fmodulestatus" id="fmodulestatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=set_select('fmodulestatus', '1')?>>Active</option>
                    <option value="0" <?=set_select('fmodulestatus', '0')?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.select2').select2();
        CKEDITOR.replace( 'fproductdesc', {
            plugins: 'wysiwygarea,toolbar,basicstyles'
        });

        $('#images').on('change', function () {
            $('.gallery').remove();
            handleFileSelect('images-preview', 'img-preview');
        });
    });
</script>