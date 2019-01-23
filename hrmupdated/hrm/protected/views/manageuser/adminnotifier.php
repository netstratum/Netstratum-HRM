
<body>
    <div class="page-header">
        <div class="pull-left">
            <h1>Employee Notification</h1>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span10">
            <div class="box box-color box-bordered leavecolor">
                <div class="box-title leavecolor">
                    <h3>
                        <i class="icon-user"></i>
                        Notifier
                    </h3>
                </div>
                <div class="box-content nopadding bordercolor">
                    <div class="tab-content padding tab-content-inline tab-content-bottom">
                        <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Addnotification" id="notificationform" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label for="notifier" class="control-label right">Select Group:</label>
                                <div class="controls" id="notificationgrp">
                                    <?php 
                                        $getgroupnames = HrmUserMaster::model()->getallnotificationgroups();
                                        if(count($getgroupnames)>0){
                                            ?>
                                    <select id="workgroup" name="workgroup" style="width: 285px;">
                                        <option value="0">--Select All--</option>
                                        <?php foreach ($getgroupnames as $gnames){?>
                                        <option value="<?php echo $gnames['id'];?>"><?php echo $gnames['job_category'];?></option>
                                        <?php } ?>
                                    </select>
                                        <?php } ?>                                            
                                    
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="notifier" class="control-label right">Message:</label>
                                <div class="controls">
                                    <textarea cols="50" rows="4" id="notificationmsg" name="notificationmsg" class='input-xlarge'></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="button" id="notificationbtn" name="notificationbtn" class='btn btn-primary' value="Send">
                                <input type="reset" class='btn' value="Reset">
                            </div>
                            <div class="alert alert-success span8" id="notificationalert" style="display: none;">
                                <button data-dismiss="alert" class="close" type="button"></button>
                                <strong>          New Notification added!</strong>
                            </div>
                            <div class="tab-content padding tab-content-inline tab-content-bottom" id="notifier">
                                <div class="container-fluid">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="box box-color box-bordered">
                                                <div class="box-title">
                                                    <h3>Notifications</h3>
                                                </div>
                                            </div>
                                            <table class="table table-hover table-nomargin table-bordered usertable" id="notificationtable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20%;">Team</th>
                                                        <th style="width: 30%;">Message</th>
                                                        <th style="width: 30%;">Date</th>
                                                        <th class='hidden-480'>Options</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="display:none;" class="modal fade popup1" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">  
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>                                                
                                </button>
                                <h4 class="modal-title" id="notificationModalLabel">Members Include</h4>
                            </div>
                            <div class="modal-body">
                                <div class="control-group">
                                   
                                    <div class="controls">
                                        
                                        <div id="noticename" name="noticename">
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>                                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
var baseurl="<?php echo Yii::app()->request->baseUrl; ?>"; 
var notetable= "";
</script>
<!--<script src="js/notification.js"></script>-->
<script src="js/newnotification.js"></script>
<script src="js/viewnotification.js"></script>