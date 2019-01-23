<body>
    <div class="container-fluid">
        <div class="page-header">
            <div class="pull-left">
                <h1>Add Project</h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered leavecolor">
                    <div class="box-title leavecolor">
                        <h3>
                            <i class="icon-user"></i>
                                Project Modules
			</h3>
                    </div>
                    <div class="box-content nopadding bordercolor">
                        <ul class="tabs tabs-inline tabs-top">                            
                            <li class='active'>
                                <a href="#viewprojecttab" data-toggle='tab'>View Project</a>
                            </li>
                            <li style="display: none;" class="dis">
                                <a href="#addprojecttab" data-toggle='tab'>Add Project</a>
                            </li>
                        </ul>
                        <div class="tab-content padding tab-content-inline tab-content-bottom" id="newproject">
                            <div class="tab-pane" id="addprojecttab">                                
                                <form method="POST" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Timesheet/Newproject" id="addprojectform" method="POST" class="form-horizontal" class="form-horizontal">                                    
                                    <div class="span10">
                                        <div style="float: right;padding-top: 9px;padding-right: 5px;">
                                            <button type="button" class="btn btn-success" id="viewprojectsbtn" name="viewprojectsbtn" style="width: 250px;">VIEW PROJECTS</button>
                                        </div>
                                        <div style="float: right;padding-top: 9px;padding-right: 5px;">
                                            <button type="button" class="btn btn-success" id="addprojecttasksbtn" name="addprojecttasksbtn" style="width: 250px;display: none;">ADD PROJECT TASKS</button>
                                        </div>
                                        <div class="control-group">
                                            <label for="name" class="control-label right">Project Name:</label>                                            
                                            <div class="controls">
                                                <input type="text" id="projectname" name="projectname" class='input-xlarge' value="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="status" class="control-label right">Project Status:</label>
                                            <div class="controls">
                                                <select name="projectstatus" id="projectstatus" style="width: 284px;">
                                                <option value="">--Select--</option>
                                                <option value="initial">Initial</option>
                                                <option value="progress">Progress</option>
                                                <option value="completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="status" class="control-label right">Active:</label>
                                            <div class="controls">
                                                <select name="projectactivate" id="projectactivate" style="width: 284px;">
                                                <option value="">--Select--</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" id="updateprojectbtn" name="updateprojectbtn" class='btn btn-primary' value="Update" style="display: none;">
                                            <input type="button" id="addprojectbtn" name="addprojectbtn" class='btn btn-primary' value="Save" style="display: none;">
                                            <input type="reset" id="addprojectreset" class='btn' value="Discard Changes">
                                        </div>
                                        <div class="alert alert-success span8" id="addprojectalert" style="display: none;">
                                            <button data-dismiss="alert" class="close" type="button"></button>
                                            <strong>  <span id="addproject_alert" >       Added Successfully!</span></strong>
                                        </div>
                                        <div class="tab-content padding tab-content-inline tab-content-bottom" id="viewprojecttaks" style="display: none;">
                                            <div class="container-fluid">
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                        <div class="box box-color box-bordered">
                                                            <div class="box-title">
                                                                <h3>Project Tasks</h3>
                                                            </div>
                                                        </div>
                                                        <table class="table table-hover table-nomargin table-bordered usertable" id="projecttasktable">
                                                            <thead>
                                                                <tr>                                                                    
                                                                    <th style="width: 40%;">Task Name</th>
                                                                    <th style="width: 40%;">Created Date</th>
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
                        
                        <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Timesheet/Newtask" id="taskpopupform" method="POST" class="form-horizontal">
                            <div class="span10">
                                <div style="display:none;" class="modal fade popup1" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>                                                
                                                </button>
                                                <h4 class="modal-title" id="taskModalLabel">Add project Tasks</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="control-group">
                                                    <label for="project" class="control-label right span4">Task Name:</label>
                                                    <div class="controls">
                                                        <input type="text" id="projtaskname" name="projtaskname" style="width: 150px;" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer1">
                                                <input type="button" id="updatetaskbtn" name="updatetaskbtn" class='btn btn-primary' value="Update">
                                                <input type="button" id="addtaskbtn" name="addtaskbtn" class='btn btn-primary' value="Save">
                                                <input type="reset" class='btn' value="Discard changes">
                                                <div class="alert alert-success span8" id="addtaskalert" style="display: none;">
                                                    <button data-dismiss="alert" class="close" type="button"></button>
                                                    <strong>  <span id="addtask_alert" >       Success!</span></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <div class="tab-content padding tab-content-inline tab-content-bottom" id="viewproject">
                            <div class="tab-pane" id="viewprojecttab">
                                <div class="container-fluid">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="box box-color box-bordered">
                                                <div class="box-title">
                                                    <h3>Projects</h3>
                                                </div>
                                                <div class="box-content nopadding" id="projectlist">
                                                  <div style="float: right;padding-top: 9px;padding-right: 5px;">
                                                      <button type="button" class="btn btn-success" id="addnewproject" name="addnewproject">ADD NEW PROJECT</button>
                                                  </div>
                                                <table class="table table-hover table-nomargin table-bordered usertable" id="projecttable">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th style="width: 30%;">Project Name</th>
                                                            <th style="width: 30%;">Project Status</th>
                                                            <th class='hidden-480'>Options</th>
                                                        </tr>
                                                    </thead>
                                                </table>
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
        </div>
    </div>
</body>
<script type="text/javascript">
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";
    var tasktable = "";
    var taskid = "";
    $(document).ready(function(){
    $('ul.tabs-top > li').click(function(){
            if ($(this).children().attr('href') == '#addprojecttab'){
                $('#viewprojecttab').hide();
                $('#addprojecttab').show();
            }
            else if($(this).children().attr('href') == '#viewprojecttab'){
                $('#addprojecttab').hide();
                $('#viewprojecttab').show();
            }
            else{
                $('#viewprojecttab').hide();
                $('#addprojecttab').hide();
            }
        });
        $( "ul.tabs-top li:first-child" ).trigger('click');
    });
</script>
<script src="js/newproject.js"></script>
<script src="js/viewproject.js"></script>
<script src="js/addtask.js"></script>
