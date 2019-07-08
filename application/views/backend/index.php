<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="stat_box">
                <div class="stat_ico color_d"><i class="ion-calendar"></i></div>
                <div class="stat_content">
                    <h4>My Birthdate</h4>
                    <?php $mydate = strtotime($this->session->userdata('fuserbirthdate')); ?>
                    <p><?=date('Y-m-d', $mydate)?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>