<div class="row page-titles">
    <div class="col-lg-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><?=$name?></h3>
        <ol class="breadcrumb">
            <?php
            foreach($breadcrumb as $key => $val){
                if($val != null){?>
                    <li class="breadcrumb-item"><a href="<?=$val?>"><?=$key?></a></li>
                    <?php
                }
                else{?>
                    <li class="breadcrumb-item active"><?=$key?></li>
                    <?php
                }
                ?>
                <?php
            }
            ?>
        </ol>
    </div>
    <!-- <div class="col-md-6 col-4 align-self-center">
    </div> -->
</div>