<!--start summary-->   
<!-- <?php
echo "<pre>";
print_r($finished_train);
echo "<pre>";
 ?>  -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="invoice-title">
                                        <div style="width:50%" class="header">
                                            <h1 align="center">TRAINING REPORT</h1>
                                        </div> 
                                    </div>
                                    <hr>
                                    
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <!-- <table id="user_tbl" class="table table-condensed" border="1px" bgcolor="#eee">
                                            <thead>
                                                <th>Training Name</th>
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </thead>
                                            <?php foreach ($finished_train as $train) { ?>
                                                <tbody>
                                                    <td><?=$train['ftrainplanname']?></td>
                                                    <td><?=$train['ftraintypename']?></td>
                                                    <td><?=$train['ftrainstartdate']?></td>
                                                    <td><?=$train['ftrainenddate']?></td>
                                                </tbody>
                                            <?php } ?>
                                        </table> -->
                                        <table width="100%" cellspacing="6" cellpadding="5" align="center">
                                            <tr>
                                                <td colspan="4" align="center">Contoh Laporan</td>
                                            </tr>
                                            <tr>
                                                <th>Training Name</th>
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        <?php foreach ($finished_train as $train) { ?>
                                            <tr>
                                                <td><?=$train['ftrainplanname']?></td>
                                                <td><?=$train['ftraintypename']?></td>
                                                <td><?=$train['ftrainstartdate']?></td>
                                                <td><?=$train['ftrainenddate']?></td>
                                            </tr>
                                        <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="load1">
                                <div class="col-md-12" id="load2">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Detail</strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-condensed" >
                                                    
                                                    <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        <tr>
                                                            <td>Finished Training : </td>
                                                            <td id="td_nama"><?=$total_finish?></td>
                                                            <td id="td_email"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total training : </td>
                                                            <td id="td_date"><?=$total_training?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end summary-->
<style>

</style>