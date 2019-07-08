<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/training/update/'.$training->ftrainplanid)?>">
            <div class="btn btn-warning float-md-right float-sm-left">
                <i class="ion-edit"></i> Update
            </div>
        </a>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label for="ftrainplanname">Training Name <small class="form-control-feedback" style="color:red;"> *</small></label>
            <input readonly type="hidden" class="form-control" name="ftrainplanid" id="ftrainplanid" placeholder="Training ID" value="<?=$training->ftrainplanid?>" />
            <input readonly type="text" class="form-control" name="ftrainplanname" id="ftrainplanname" placeholder="Training Name" value="<?=$training->ftrainplanname?>" />
            <small class="form-control-feedback" style="color:red;">  </small>
        </div>
        <div class="form-group">
            <label for="ftraintypeid">Type <small class="form-control-feedback" style="color:red;"> *</small></label>
            <select name="ftraintypeid" id="input_type" class="form-control xxx select2" disabled="">
                <option value="<?=$training->ftraintypeid?>"><?=$training->traintype?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="ftrainstartdate">Start Date <small class="form-control-feedback" style="color:red;"> *</small></label>
            <div class="input-group date ts_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                <input readonly type="text" value="<?=$training->ftrainstartdate?>" id="startdate" class="form-control form-control-line" readonly="">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="ftrainenddate">End Date <small class="form-control-feedback" style="color:red;"> *</small></label>
            <div class="input-group date ts_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                <input readonly type="text" value="<?=$training->ftrainenddate?>" id="enddate" class="form-control form-control-line" readonly="">
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
                            $data_member = unserialize($training->ftrainmember);
                        ?>
                        <?php foreach ($data_member as $dt_member) { ?>
                            <tr id="member_row_<?=$p?>">
                                <td>
                                    <select type="text" class="form-control cond-input-value xxx select2" name="ftrainmember[fuserid][]" disabled="">
                                        <option value="<?=$dt_member['fuserid']?>"><?=$dt_member['fusername']?></option>
                                    </select>
                                </td>
                                <td>
                                    <select name="ftrainmember[position][]" class="form-control select-conditions xxx select2" disabled="">
                                        <option value="<?=$dt_member['fpositionid']?>"><?=$dt_member['fpositionname']?></option>
                                    </select>
                                </td>
                            </tr>
                            <?php
                            $p++;
                        } ?><!-- 
                        
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
                        </tr> -->
                    </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="ftrainingstatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
            <select class="form-control xxx select2" name="ftrainingstatus" id="ftrainingstatus" disabled="">
                <option value="<?=$training->ftrainingstatus?>"><?php if($training->ftrainingstatus == 1){ echo "Active"; }else{ echo "Not Active"; }?></option>
            </select>
            <small class="form-control-feedback" style="color:red;">  </small>
        </div>
    </div>
</div>