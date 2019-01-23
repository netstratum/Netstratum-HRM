<body>
    <div class="container-fluid">
        <div class="page-header">
            <div class="pull-left">
                <h1>Add Timesheet</h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered leavecolor">
                    <div class="box-title leavecolor">
                        <h3>
                            <i class="icon-user"></i>
                                Project Timesheets
			</h3>
                    </div>
                    <div class="box-content nopadding bordercolor">
                        <div class="tab-content padding tab-content-inline tab-content-bottom" id="newtimesheet">
                            <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Timesheet/Createtimesheet" id="addtimesheetform" method="POST" class="form-horizontal">
                                <div class="span10">
                                    <div class="control-group">
                                        <label for="time" class="control-label right">Select Project:</label>                     
                                        <div class="controls" id="projectnameslist">
                                            <?php
                                            $session = new CHttpSession;
                                            $session->open();
                                            $pnames = HrmProjects::model()->getallprojectname($session['empnumber']);                                                                                                                                      
                                           if(count($pnames)>0){
                                            ?>
                                            <select id="projectlist" name="projectlist" >
                                                <option value="">--Select--</option>
                                                <?php foreach ($pnames as $names){?>
                                                <option value="<?php echo $names['id'];?>"><?php echo $names['project_name']?></option>
                                                <?php } ?>
                                            </select>
                                           <?php } ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="time" class="control-label right">Select Task:</label>
                                        <div class="controls" id="tasklistsdata">
                                            <select id="tasklist" name="tasklist">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="time" class="control-label right">Timesheet for week:</label>
                                        <div class="controls" id="weeks">
                                            <select id="weeklist" name="weeklist">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" id="displayweeks">
                                      
                                    </div>
                                    <div class="form-actions">
                                        <input type="button" id="weektimesheetbtn" name="weektimesheetbtn" class='btn btn-primary' value="Save">                                        
                                        <input type="reset" id="weektimesheetreset" class='btn' value="Discard Changes">
                                    </div>
                                    <div class="alert alert-success span8" id="addtimsheetalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong>  <span id="addtimesheet_alert" >       Added Successfully!</span></strong>
                                    </div>
                                    <div class="tab-content padding tab-content-inline tab-content-bottom" id="viewweeks">
                                        <div class="container-fluid">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="box box-color box-bordered">
                                                        <div class="box-title">
                                                            <h3>Time Sheet</h3>
                                                        </div>
                                                    </div>
<!--                                                    <div id="timesearch" class="datatable_custom">
                                                        <label class="custom_label"  >Search Date:</label>
                                                        <div class="custom_label" >
                                                            <input type="text" id="search_timesheet" name="search_timesheet" class='span10' value="" style="width: 100px;">
                                                        </div>
                                                    </div>-->
                                                    <table class="table table-hover table-nomargin table-bordered usertable" id="weekstable">
                                                        <thead>
                                                            <tr>                                                                
                                                                <th style="width: 30%;">Task Name</th>
                                                                <th style="width: 30%;">Task Date</th>
                                                                <th style="width: 20%;">Task Hour</th>
                                                                <th class='hidden-480'>Options</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
<script type="text/javascript">
var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";

</script>
<script src="js/newtimesheet.js"></script>
