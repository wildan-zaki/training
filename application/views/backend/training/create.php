<form action="<?=base_url('backend/training/doCreate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <button type="submit" class="btn btn-success">Create</button>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label for="ftrainplanname">Training Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="ftrainplanname" id="ftrainplanname" placeholder="Training Name" value="<?=set_value('ftrainplanname')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="ftraintypeid">Type <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select name="ftraintypeid" id="input_type" class="form-control xxx select2">
                    <option value="">-- Please Select One --</option>
                    <?php foreach ($type as $ty) { ?>
                        <option value="<?=$ty->ftraintypeid?>"><?=$ty->ftraintypename?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ftrainstartdate">Start Date <small class="form-control-feedback" style="color:red;"> *</small></label>
                <div class="input-group date ts_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                    <input class="form-control" type="text" name="ftrainstartdate" placeholder="yyyy-mm-dd" value="<?=set_value('ftrainstartdate')?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="ftrainenddate">End Date <small class="form-control-feedback" style="color:red;"> *</small></label>
                <div class="input-group date ts_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                    <input class="form-control" type="text" name="ftrainenddate" placeholder="yyyy-mm-dd" value="<?=set_value('ftrainenddate')?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="ftrainenddate">Training Member <small class="form-control-feedback" style="color:red;"> *</small></label>
                <table class="table table-striped form-sep" id="tableConditions">
                    <thead> 
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th></th>
                        </tr>
                    </thead>
                        <tbody> 
                            <?php
                                $p=1; 
                            ?>
                            <tr id="member_row_<?=$p?>">
                                <td>
                                    <select type="text" class="form-control cond-input-value xxx select2" name="ftrainmember[fuserid][]">
                                        <option value="">--Please Select One--</option>
                                        <?php foreach($member as $mem){ ?>
                                             <option value="<?=$mem['fuserid']?>"><?=$mem['fusername']?></option>                                        
                                         <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="ftrainmember[position][]" class="form-control select-conditions xxx select2">
                                        <option value="">--Please Select One--</option>
                                        <?php foreach($position as $pos){ ?>
                                            <option value="<?=$pos->fpositionid?>"><?=$pos->fpositionname?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="tr_add_conditions">
                                <td colspan="3"></td>
                                <td><a href="javascript:void(0);" class="btn btn-sm btn-primary tr_add_btn_conditions" data-tr="#members_row_<?=$p?>">Add</a></td>
                            </tr>
                            <tr class="tr_clone_conditions" style="display:none">
                                <td>
                                    <select type="text" class="form-control cond-input-value" name="ftrainmember[fuserid][]">
                                        <option value="">--Please Select One--</option>
                                        <?php foreach($member as $mem2){ ?>
                                             <option value="<?=$mem2['fuserid']?>"><?=$mem2['fusername']?></option>                                        
                                         <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="ftrainmember[position][]" class="form-control select-conditions">
                                        <option value="">--Please Select One--</option>
                                        <?php foreach($position as $pos){ ?>
                                            <option value="<?=$pos->fpositionid?>"><?=$pos->fpositionname?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-default tr_remove">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="ftrainingstatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control xxx select2" name="ftrainingstatus" id="ftrainingstatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=set_select('ftrainingstatus', '1')?>>Active</option>
                    <option value="0" <?=set_select('ftrainingstatus', '0')?>>Not Active</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.xxx').select2();

        if($('.tr_add_conditions').length)
        {   
            $('.tr_add_btn_conditions').on('click', function(e) {

                tr_row = $('#tableConditions');
                $tr_id = ($(tr_row).find('tbody tr[id^="member_row_"]').length)+1;

                e.preventDefault();
                $('#tableConditions:last').find('.xxx').select2('destroy');
                var $cloned_tr = $(tr_row).find('tbody tr.tr_clone_conditions').clone(true);
                $cloned_tr.find('select').addClass('xxx');
                $cloned_tr.attr({
                    id: 'member_row_' +  $tr_id
                }).removeAttr('style').removeAttr('class');
                $cloned_tr.insertBefore($(tr_row).find('tbody tr.tr_add_conditions'));
                $('.xxx').select2();
            });
        }

        $(document).on('click','.tr_remove', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        })

        $('.ts_datepicker').datepicker();
    });
</script>