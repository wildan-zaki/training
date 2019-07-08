<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/trainingtype/update/'.$trainingtype->ftraintypeid)?>">
            <div class="btn btn-warning float-md-right float-sm-left">
                <i class="ion-edit"></i> Update
            </div>
        </a>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <label class="col-md-12">Name</label>
            <div class="col-md-12">
                <input type="text" value="<?=$trainingtype->ftraintypename?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Created at</label>
            <div class="col-md-12">
                <input type="text" value="<?=$trainingtype->created_at?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Modified at</label>
            <div class="col-md-12">
                <input type="text" value="<?=$trainingtype->updated_at?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Status</label>
            <div class="col-md-12">
                <?php
                $status = 'Active';
                if($trainingtype->ftraintypestatus == 0){
                    $status = "Not Active";
                }
                ?>
                <input type="text" value="<?=$status?>" class="form-control form-control-line" readonly="">
            </div>
        </div>
    </div>
</div>