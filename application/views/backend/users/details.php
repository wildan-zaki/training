<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/user/update/'.$user->fuserid)?>">
            <div class="btn btn-warning float-md-right float-sm-left">
                <i class="ion-edit"></i> Update
            </div>
        </a>

        <!-- <?php
        if($sess['fuserid'] != $user->fuserid){
            ?>
            <button class="btn btn-danger delete" data-id="<?=$user->fuserid?>" data-name="<?=$user->fusername?>">
                <i class="ion-trash-a"></i> Delete
            </button>
        <?php
        }
        ?> -->
    </div>

    <div class="panel-body">
        <div class="form-group">
            <label class="col-md-12">Name</label>
            <div class="col-md-12">
                <input type="text" value="<?=$user->fusername?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Email</label>
            <div class="col-md-12">
                <input type="text" value="<?=$user->fuseremail?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Role</label>
            <div class="col-md-12">
                <input type="text" value="<?=$user->frolename?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Address</label>
            <div class="col-md-12">
                <input type="text" value="<?=$user->fuseraddress?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Register Date</label>
            <div class="col-md-12">
                <input type="text" value="<?=$user->created_at?>" id="registerdate" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Birthdate</label>
            <div class="col-md-12">
                <input type="text" value="<?=$user->fuserbirthdate?>" id="birthdate" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <?php if($sess['froleid'] != 1) { ?>
            <div class="notadmin">
            <div class="form-group">
                <label class="col-md-12">NIK</label>
                <div class="col-md-12">
                    <input type="text" value="<?=$user->fnik?>" id="fnik" class="form-control form-control-line" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">NPWP</label>
                <div class="col-md-12">
                    <input type="text" value="<?=$user->fnpwp?>" id="fnpwp" class="form-control form-control-line" >
                </div>
            </div>    
        </div>
        <?php } ?>
        <div class="form-group">
            <label class="col-md-12">Status</label>
            <div class="col-md-12">
                <?php
                $status = 'Confirmed';
                if($user->fuserstatus == 2){
                    $status = "Suspended";
                }
                else if($user->fuserstatus == 0){
                    $status = "Not Confirmed";
                }
                ?>
                <input type="text" value="<?=$status?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('.delete').on('click', function(){
            var confirm = window.confirm('Delete user: ' + $(this).data('name') + ' ?');

            if (confirm){
                $('.mask-submitted-container').show();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?=base_url('backend/user/delete/')?>' + $(this).data('id'),
                    success: function( res ) {
                        if(res.status == 1){
                            window.location.href = "<?=base_url('backend/user')?>";
                        }else{
                            alert(res.message);
                            $('.mask-submitted-container').hide();
                        }
                    },
                    error: function ( msg ) {
                        alert("An error occured. Please contact your system administrator");
                        console.log(msg);
                        $('.mask-submitted-container').hide();
                    }
                });
            }
        });
    });
</script>