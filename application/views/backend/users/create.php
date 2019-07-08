<form action="<?=base_url('backend/user/doCreate')?>" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label for="fuseremail">Email <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="email" class="form-control" name="fuseremail" id="fuseremail" placeholder="Email" value="<?=set_value('fuseremail')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fuserpassword">Password <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="password" class="form-control" name="fuserpassword" id="fuserpassword" placeholder="Password" value="" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="passwordconf">Confirm Password <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="password" class="form-control" name="passwordconf" id="passwordconf" placeholder="Confirm Password" value="" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="froleid">Role <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select name="froleid" id="froleid" class="form-control select2">
                    <option value="">--Please Select One--</option>
                    <option value="1" <?=set_select('froleid', 1)?>>Admin</option>
                    <option value="2" <?=set_select('froleid', 2)?>>Member</option>
                </select>
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fusername">Name <small class="form-control-feedback" style="color:red;"> *</small></label>
                <input type="text" class="form-control" name="fusername" id="fusername" placeholder="Full Name" value="<?=set_value('fusername')?>" />
                <small class="form-control-feedback" style="color:red;">  </small>
            </div>
            <div class="form-group">
                <label for="fuserbirthdate">Birthdate <small class="form-control-feedback" style="color:red;"> *</small></label>
                <div class="input-group date ts_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                    <input class="form-control" type="text" name="fuserbirthdate" placeholder="yyyy-mm-dd" value="<?=set_value('fuserbirthdate')?>">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group">
                <label for="userAddress" class="control-label">Address Detail *</label>
                
                    <textarea class="form-control" rows="3" id="eventAddress" name="fuseraddress" required><?=set_value('fuseraddress')?></textarea>
            </div>
            <div id="notadmin">
              <div class="form-group">
                  <label for="fnik">NIK <small class="form-control-feedback" style="color:red;"> *</small></label>
                  <input type="text" class="form-control" name="fnik" id="fnik" placeholder="NIK" value="<?=set_value('fnik')?>" />
                  <small class="form-control-feedback" style="color:red;">  </small>
              </div>
              <div class="form-group">
                  <label for="fnpwp">NPWP <small class="form-control-feedback" style="color:red;"> *</small></label>
                  <input type="text" class="form-control" name="fnpwp" id="fnpwp" placeholder="NPWP" value="<?=set_value('fnpwp')?>" />
                  <small class="form-control-feedback" style="color:red;">  </small>
              </div>
            </div>
            <div class="form-group">
                <label for="fuserstatus">Status <small class="form-control-feedback" style="color:red;"> *</small></label>
                <select class="form-control select2" name="fuserstatus" id="fuserstatus">
                    <option value="">-- Please Select One --</option>
                    <option value="1" <?=set_select('fuserstatus', '1')?>>Active</option>
                    <option value="0" <?=set_select('fuserstatus', '0')?>>Not Active</option>
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

    $( "#pac-input" ).keypress(function() {
        if ( event.which == 13) {
            event.preventDefault(); 
        }
    });
    

    $(document).ready(function () {

        $('.select2').select2();

        $('#froleid').on("select2:select", function (e) { 
          var mydata = e.params.data;
          if(mydata.id == 1) {
            $('#notadmin').addClass("hide");
          }else{
            $('#notadmin').removeClass("hide");
          }
          // console.log(mydata.id);
        });

        $('.ts_datepicker').datepicker();

        $("#image").change(function() {
            readURL(this, '.img-preview');
        });
    });
</script>