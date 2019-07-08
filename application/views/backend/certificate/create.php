<form action="<?=base_url('backend/certificate/doCreate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="form-group">
                <label for="fcertificatenumber">Certificate Number <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fcertificatenumber" id="fcertificatenumber" placeholder="e.g. CERT-0001" value="<?=set_value('fcertificatenumber')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="ftrainplanid">Training Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select name="ftrainplanid" id="ftrainplanid" class="form-control xxx select2">
                    <option value="">-- Please Select One --</option>
                    <?php foreach ($training as $ty) { ?>
                        <option value="<?=$ty['ftrainplanid']?>"><?=$ty['ftrainplanname']?></option>
                    <?php } ?>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fusercertif">Given To <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select name="fusercertif" id="input_training" class="form-control select2">
                    <option value="">-- Please Select One --</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ffilecertificate">Upload Certificate</label>
                <input type="file" class="form-control" name="ffilecertificate" id="filemodule" value="" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*"/>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fcertificatestatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fcertificatestatus" id="fcertificatestatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=set_select('fcertificatestatus', '1')?>>Active</option>
                    <option value="0" <?=set_select('fcertificatestatus', '0')?>>Not Active</option>
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
    var i;
    function getAllmember (e) {
        var data = e.params.data;
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: '<?=base_url('backend/training/getfinishmember/')?>' + data.id
        })
            .done(function(res){
                var result = res.filter(function (el){
                    console.log()
                    return el.ftrainplanid  = data.id;
                });
                var select2_arrays = [];
                for(var i in result){
                    select2_arrays.push({
                        id:result[i].fuserid,
                        text:result[i].fusername
                    });
                }

                console.log(result);
                $('#input_training').find('option[value!=""]').remove();
                $('#input_training').val(null);
                $('#input_training').trigger('change');

                $('#input_training').select2({
                    data:select2_arrays
                });
            })
            .fail(function(res){
                console.log("Failed");
                console.log(res);
            });
    }

    $(document).ready(function () {
        $('.select2').select2();

        $('#ftrainplanid').on("select2:select", function (e) { getAllmember(e); });
        $('#ftrainplanid').on("select2:unselect", function (e) { getAllmember(e); });
    });
</script>