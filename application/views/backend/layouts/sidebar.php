<ul>
    <?php
    foreach($menu as $key => $val){
        if(!array_key_exists('child', $val)){
            ?>
            <li class="<?=array_key_exists('current', $val)?'active':''?>">
                <a href="<?=$val['url']?>"><span class="<?=$val['icon']?>"></span> <span class="nav_title"><?=$key?></span></a>
            </li>
            <?php
        }
        else{
            ?>
            <li class="<?=array_key_exists('current', $val)?'active':''?>">
                <a href="#">
                    <span class="<?=$val['icon']?>"></span>
                    <span class="nav_title"><?=$key?></span>
                </a>
                <div class="sub_panel">
                    <div class="side_inner">
                        <ul>
                            <?php

                            foreach($val['child'] as $key_child => $val_child){
                                ?>
                                <li class="<?=array_key_exists('current', $val_child)?'active':''?>">
                                    <a href="<?=$val_child['url']?>"><span class="side_icon <?=$val_child['icon']?>"></span><?=$key_child?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>

        <?php
    }
    ?>
</ul>