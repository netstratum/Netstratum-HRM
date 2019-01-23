<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/leavedate.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" media="screen, projection" />
<body>
    <div class="container-fluid">
        <div class="page-header">
            <div class="pull-left">
		<h1>Employee Leave</h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered leavecolor">
                    <div class="box-title leavecolor">
			<h3>
                            <i class="icon-user"></i>
                                Leave Modules
			</h3>
                    </div>
                    <div class="box-content nopadding bordercolor">
                       <?php 
                        $session=new CHttpSession;
                        $session->open();

                        $myInfo = Yii::app()->menu->getOtherMenu(0, $session['user_role'],'leave',$superviser_cnt); 
                        

                        ?>
                        
                        <div class="tab-content padding tab-content-inline tab-content-bottom">
                           
                                                        
                            <div class="tab-pane" id="reqleave" style="display:none;">
                                <form method="POST" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Leave/Reqleave" 
                                      id="rleave" method="POST" class="form-horizontal" class="form-horizontal">
                                    
                                    <div class="span10">
                                        <div class="control-group">
                                            <label for="type" class="control-label right">Leave Type:</label>
                                            <div class="controls" id="ltype">
                                                
                                                
                                                <?php 
                                                    if (count($leavearray)>0){?>
                                                <select id="leavetype" name="leavetype" >
                                                    <option value="">--Select--</option>
                                                       <?php foreach($leavearray as $leaves){
                                                            ?>
                                                    <option value="<?php echo $leaves['id'];?>"><?php echo $leaves['name']; ?></option>
                                                        <?php } ?>
                                                </select>
                                                  <?php  }
                                                ?>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="control-group" id="leavebalance" style="display: none;">
                                            <label for="leave" class="control-label right">Leave Balance:</label>
                                            <div class="controls">
                                                <input type="text" id="lbalance" name="lbalance" value="" style="width: 250px;" 
                                                       disabled="disabled">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="type" class="control-label right">From:</label>
                                            <div class="controls">
                                                <input type="text" name="fromleave" id="fromleave" 
                                                       class="input-medium ui-datepicker" value="" style="width: 250px;">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="type" class="control-label right">To:</label>
                                            <div class="controls">
                                                <input type="text" name="toleave" id="toleave" 
                                                    class="input-medium ui-datepicker" value="" style="width: 250px;">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="type" class="control-label right">Partial Days:</label>
                                            <div class="controls">
                                                <select name="pdays" id="pdays" class="input-xlarge">                                                    
                                                    <option value="">--Select--</option>                                                    
                                                    <option value="1">Start Day Only</option>
                                                    <option value="2">End Day Only</option>
                                                    <option value="3">Start & End Day</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group" id="sday" style="display:none;">
                                            <label for="day" class="control-label right">Start Day:</label>
                                            <div class="controls">
                                                <select required="" name="startday" id="startday" class="input-xlarge">                                                 
                                                 <option value="">--select--</option>
                                                 <option value="halfday_morning">Half Day Morning</option>
                                                 <option value="halfday_evening">Half Day Evening</option>
                                                
                                                </select>
                                                
                                                <span style="margin-left: 10px; display: none;" id="specific">
                                                From:                                                
                                                                                                              
                                                    <select name="fromtime" id="fromtime" class="span1">
                                                        
                                                        <?php 
                                                        foreach (range(9, 20) as $from){?>
                                                        <option value="<?php echo $from;?>"><?php echo $from;?></option>
                                                        <?php }?>
                                                        
                                                    </select>
                                                    
                                                To: 
                                                    <select name="totime" id="totime" class="span1">
                                                        
                                                        <?php 
                                                        foreach (range(9, 20) as $to){?>
                                                        <option value="<?php echo $to;?>" <?php if($to==18){ ?>selected="selected"<?php } ?>>
                                                            <?php echo $to;?></option>
                                                        <?php }?>
                                                        
                                                    </select>
                                                
                                                
                                                Duration:
                                                    <input type="text" name="duration" id="duration" 
                                                           class="span1" value="8" disabled="disabled">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group" id="eday" style="display:none;">
                                            <label for="day" class="control-label right">End Day:</label>
                                            <div class="controls">
                                                <select name="endday" id="endday" class="input-xlarge">
                                                 <option value="">--select--</option>
                                                 <option value="halfday_morning">Half Day Morning</option>
                                                 <option value="halfday_evening">Half Day Evening</option>
                                                 
                                                </select>
                                                <span style="margin-left: 10px; display: none;" id="endspecific">
                                                From:                                                
                                                                                                              
                                                    <select name="endfrom" id="endfrom" class="span1">
                                                        
                                                        <?php 
                                                        foreach (range(9, 20) as $from){?>
                                                        <option value="<?php echo $from;?>"><?php echo $from;?></option>
                                                        <?php }?>
                                                        
                                                    </select>
                                                    
                                                To: 
                                                    <select name="endto" id="endto" class="span1">
                                                        
                                                        <?php 
                                                        foreach (range(9, 20) as $to){?>
                                                        <option value="<?php echo $to;?>" <?php if($to==18){?> selected="selected" <?php } ?>>
                                                            <?php echo $to;?></option>
                                                        <?php }?>
                                                        
                                                    </select>
                                                    
                                                Duration:
                                                    <input type="text" name="endduration" id="endduration" 
                                                           class="span1" value="8" disabled="disabled">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="day" class="control-label right">Reason:</label>
                                            <div class="controls">
                                                <textarea cols="50" rows="4" id="comments" name="comments" style="width: 250px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" id="reqbutton" name="reqbutton" class='btn btn-primary' 
                                                   value="Apply">
                                            <input id="req_discard" type="reset" class='btn' value="Discard Changes">
                                        </div>
                                        <div class="alert alert-success span8" id="reqalert" style="display: none;">
                                            <button data-dismiss="alert" class="close" type="button"></button>
                                            <strong>  <span id="req_alert" >       Success!</span></strong>
                                        </div>
                                      </div>              
                                </form>
                            
                            
                        </div>
                        <div class="tab-pane active" id="assignleave">
                        <div class="box-title" style="margin-bottom:26px;">
                                <h3>
                                    <i class="icon-reorder"></i>
                                    Assign Leave
                                </h3>
                            </div>
                            <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Leave/Assignleave" id="assleave" method="POST" class="form-horizontal">
                                <div class="span10">
                                    <div class="control-group">
                                            <label for="leave" class="control-label right">Assign Employee:</label>
                                            <div class="controls">
                                                <input type="text" id="assiemp" name="assiemp" class='input-xlarge' value="">

                                            </div>
                                    </div>
                                    <div class="control-group" id="assleavetype" style="display: none;">
                                            <label for="type" class="control-label right">Assign Leave Type:</label>
                                            <div class="controls" id="leavelist">

                                            
                                                                                                                                                                                                
                                                
                                            </div>
                                    </div>
                                    <div class="control-group" id="asslbalance" style="display: none;">
                                            <label for="leave" class="control-label right">Leave Balance:</label>
                                            <div class="controls">
                                                <input type="text" id="albalance" name="albalance" class='input-xlarge' 
                                                       value="" disabled="disabled">
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="type" class="control-label right">From:</label>
                                            <div class="controls">
                                                <input type="text" name="assfromleave" id="assfromleave" 
                                                class="input-medium datepicker " value="" style="width:250px;">
                                            </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="type" class="control-label right">To:</label>
                                        <div class="controls">
                                            <input type="text" name="asstoleave" id="asstoleave" 
                                            class="input-medium datepicker " value="" style="width:250px;">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="type" class="control-label right">Partial Days:</label>
                                        <div class="controls">
                                            <select name="asspdays" id="asspdays" class="input-xlarge">                                                    
                                                <option value="">--Select--</option>                                                    
                                                <option value="1">Start Day Only</option>
                                                <option value="2">End Day Only</option>
                                                <option value="3">Start & End Day</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" id="assisday" style="display:none;">
                                        <label for="day" class="control-label right">Start Day:</label>
                                        <div class="controls">
                                            <select required="" name="assistartday" id="assistartday" class="input-xlarge">
                                             <option value="1">Half Day Morning</option>
                                             <option value="2">Half Day Evening</option>
                                             
                                            </select>

                                            <span style="margin-left: 10px; display: none;" id="assispecific">
                                            From:                                                

                                                <select name="assfromtime" id="assfromtime" class="span1">

                                                    <?php 
                                                    foreach (range(9, 20) as $from){?>
                                                    <option value="<?php echo $from;?>"><?php echo $from;?></option>
                                                    <?php }?>

                                                </select>

                                            To: 
                                                <select name="asstotime" id="asstotime" class="span1">

                                                    <?php 
                                                    foreach (range(9, 20) as $to){?>
                                                    <option value="<?php echo $to;?>" <?php if($to==18){ ?>selected="selected"<?php } ?>>
                                                        <?php echo $to;?></option>
                                                    <?php }?>

                                                </select>


                                            Duration:
                                                <input type="text" name="assduration" id="assduration" 
                                                       class="span1" value="8" disabled="disabled">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group" id="asseday" style="display:none;">
                                        <label for="day" class="control-label right">End Day:</label>
                                        <div class="controls">
                                            <select required="" name="assendday" id="assendday" class="input-xlarge">
                                             <option value="1">Half Day Morning</option>
                                             <option value="2">Half Day Evening</option>
                                            
                                            </select>
                                            <span style="margin-left: 10px; display: none;" id="assendspecific">
                                            From:                                                

                                                <select name="assendfrom" id="assendfrom" class="span1">

                                                    <?php 
                                                    foreach (range(9, 20) as $from){?>
                                                    <option value="<?php echo $from;?>"><?php echo $from;?></option>
                                                    <?php }?>

                                                </select>

                                            To: 
                                                <select name="assendto" id="assendto" class="span1">

                                                    <?php 
                                                    foreach (range(9, 20) as $to){?>
                                                    <option value="<?php echo $to;?>" <?php if($to==18){?> selected="selected" <?php } ?>>
                                                        <?php echo $to;?></option>
                                                    <?php }?>

                                                </select>

                                            Duration:
                                                <input type="text" name="assendduration" id="assendduration" 
                                                       class="span1" value="8" disabled="disabled">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="day" class="control-label right">Remarks:</label>
                                        <div class="controls">
                                            <textarea cols="50" rows="4" id="asscomments" name="asscomments" class='input-xlarge'></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="button" id="assibutton" name="assibutton" class='btn btn-primary' 
                                               value="Save">
                                        <input id="assignreset" type="reset" class='btn' value="Discard changes">
                                    </div>
                                    <div class="alert alert-success span8" id="assialert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="assign_message"> Success!</span></strong>
                                    </div>
                                    <div class="alert alert-error span8" id="assierror" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="assign_error_message"> Success!</span></strong>
                                    </div>
                                </div>
                                <input type="hidden" id="emp_id" name="emp_id">
                            </form>

                        </div>
                        <div class="tab-pane active" id="leavetypes" style="display:none;">
                            <form action="" id="viewleaves" method="POST" class="form-horizontal">
                              <div class="container-fluid">
                               <div class="row-fluid"> 
                                <div class="span12">
                                   <div class="box box-color box-bordered">
                                       <div class="box-title">
                                            <h3>Manage Leaves</h3>									                                                                                
                                       </div>
                                    <div class="box-content nopadding">
                                        <div style="float: right;padding-top: 9px;padding-right: 5px;">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">ADD LEAVE</button>
                                        </div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="leaves" style="width:100%;">
                                            <thead>
                                                <tr>
                                                   
                                                    <th >Name</th>
                                                    <th >Leave Max Number</th>
                                                    <th >Probation Period</th>  
                                                    <th>Leave Type</th>                                                  
                                                    <th>Options</th>
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
                            
                         <div class="tab-pane active" id="myleave" >
                            <form action="" id="myleaveform" method="POST" class="form-horizontal">
                              <div class="container-fluid">
                               <div class="row-fluid"> 
                                <div class="span12">
                                   <div class="box box-color box-bordered">
                                       <div class="box-title">
                                            <h3>My Leave Report</h3>                                                                                                                    
                                       </div>
                                    <div class="box-content nopadding">
                                          <div id="display_search_myreport" class="datatable_custom"><label class="custom_label"  >Date From:</label>  <div class="custom_label" ><input type="text" id="datefrom_myreport" name="datefrom_myreport" class='span10' value="" ></div> <label  class="custom_label">  Date To:</label><div class="custom_label" ><input type="text" id="dateto_myreport" name="dateto_myreport" class='span10' value="" ></div> <label  class="custom_label"> Leave Status:</label><div class="custom_label" > <select name="leave_status_myreport" id="leave_status_myreport" class="input-medium">
                        <option value="">Select All</option>
                        <option value="pending" <?php if ($_REQUEST['myleaveid']==''){?> selected="selected"<?php } ?>>Pending</option>
                        <option value="taken">Taken</option>
                        <option value="reject">Rejected</option>
                        <option value="approve">Scheduled</option>
                        <option value="cancel">Cancelled</option>
                    </select></div></div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="myreporttable">
                                            <thead>
                                                <tr>
                                                  
                                                    <th style="width: 20%;">Leave Type </th>
                                                    <th style="width: 15%;">From Date</th>
                                                    <th style="width: 15%;">To Date</th>  
                                                    <th style="width: 20%;">Reason</th>
                                                    <th class='hidden-480'>Status</th>

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
  <div class="tab-pane " id="addholiday">
  <div class="box">
  <div class="box-title" style="margin-bottom:26px;">
                                <h3>
                                    <i class="icon-reorder"></i>
                                    Manage Holidays
                                </h3>
                            </div>
                            </div>
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Holiday/Addholiday" id="holidayform" method="POST" class="form-horizontal">
        <div class="span5">
            <div class="control-group">
                <label for="leave" class="control-label right">Holiday Name:</label>
                <div class="controls">
                    <input type="text" id="holidayname" name="holidayname" class='input-xlarge' value="">
                </div>
            </div>
            <div class="control-group">
                <label for="leave" class="control-label right">Holiday Date:</label>
                <div class="controls">
                    <input type="text" id="holidaydate" name="holidaydate" class='input-xlarge' value="">
                </div>
            </div>
            <div class="control-group">
                <label for="leave" class="control-label right">Holiday Type:</label>
                <div class="controls">
                    <select required="" name="holidaytype" id="holidaytype" class="input-xlarge">
                        <option value="">--Select--</option>
                        <option value="1">Holiday</option>
                        <option value="2">Optional</option>
                    </select>
                </div>
            </div>
           
            <div class="form-actions">
                <input type="button" id="holidaybtn" name="holidaybtn" class='btn btn-primary' value="Save">
                <input type="reset" class='btn' value="Discard changes">

            </div>
            <div class="alert alert-success span8" id="assign_holiday" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="assign_holiday_message"> Success!</span></strong>
                                    </div>
        </div>
        <div class="span7">
            <table class="table table-hover table-nomargin table-bordered usertable" id="holidaytable">
                <thead>
                    <tr>                        
                        <th style="width: 30%;">Name</th>
                        <th style="width: 20%;">Date</th>
                        <th style="width: 20%;">Type</th>                                                    
                        <th class='hidden-480'>Options</th>
                    </tr>
                </thead>
            </table>
        </div>
    </form>

</div>
                        <div class="tab-pane active" id="lreport">
                            <form action="" id="leavereportform" method="POST" class="form-horizontal">
                              <div class="container-fluid">
                               <div class="row-fluid"> 
                                <div class="span12">
                                   <div class="box box-color box-bordered">
                                       <div class="box-title"><?php if ($session['user_role']==1 or $session['user_role']==2){?>
                                            <h3>Employee Leave Status</h3>                                                                                                                   
                                      <?php }else{?>
                                     <h3>Subordinate Leave Status</h3>       
                                     <?php }?>
                                       </div>
                                    <div class="box-content nopadding">
                                        <div id="display_search" class="datatable_custom"><label class="custom_label"  >Date From:</label>  <div class="custom_label" ><input type="text" id="datefrom" name="datefrom" class='span10' value="" ></div> <label  class="custom_label">  Date To:</label><div class="custom_label" ><input type="text" id="dateto" name="dateto" class='span10' value="" ></div> <label  class="custom_label"> Leave Status:</label><div class="custom_label" > <select name="leave_status" id="leave_status" class="input-medium">
                        <option value="">Select All</option>
                        <option value="pending" selected="selected">Pending</option>
                        <option value="taken">Taken</option>
                        <option value="reject">Rejected</option>
                        <option value="approve">Scheduled</option>
                    </select></div></div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="reporttable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Employee Name </th>
                                                    <th style="width: 20%;">Leave Type </th>
                                                    <th style="width: 15%;">From Date</th>
                                                    <th style="width: 15%;">To Date</th>  
                                                    <th style="width: 20%;">Reason</th>
                                                    <th class='width: 10%;'>Days</th>
                                                    <th class='hidden-480'>Status</th>
                                                    <?php if ($session['user_role']==1 or $session['user_role']==2){?>
                                                    <th class='hidden-480'>Options</th>
                                                    <?php } ?>
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

                        <div class="tab-pane active" id="otherleave" style="display:none;">
                            <form action="" id="oleaves" method="POST" class="form-horizontal">
                                <div class="container-fluid">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="box box-color box-bordered">
                                                <div class="box-title">
                                                    <h3>Custom Leaves</h3>
                                                </div>
                                                <div class="box-content nopadding">
                                                   
                                                  
                                                                                                   
                                                    <table class="table table-hover table-nomargin table-bordered usertable" id="othertable">
                                                        <thead>
                                                            <tr>
                                                              
                                                                <th style="width: 20%;">Leave Type</th>
                                                                <th style="width: 20%;">Leave Number</th>
                                                                <th style="width: 20%;">Expiry Date</th>
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
                        
                            <form action="" id="oholiday" method="POST" class="form-horizontal">
                                <div class="span10">
                                    <div style="display:none;" class="modal fade popup" id="otherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                    
                                                </button>
                                                <h4 class="modal-title" id="otherlabel">Employee Custom Leaves</h4>
                                              </div>
                                              <div class="modal-body">
                                                
                                                  <div class="control-group">
                                                    <label for="leave" class="control-label right span4">Search Employee:</label>
                                                    <div class="controls span6">
                                                         <input type="text" id="suggemp" name="suggemp" class='input-medium' value="" >
                                                    </div>
                                                 </div>
                                                 <div class="control-group">
                                                    <label for="leave" class="control-label right span4">Leave Types:</label>
                                                    <div class="controls span6">
                                                        <label  id="customleave"></label>
                                                    </div>
                                                 </div>
                                                 <div class="control-group">
                                                    <label for="leave" class="control-label right span4">Leave Number:</label>
                                                    <div class="controls span6">
                                                        <input type="text" id="customleaveno" name="customleaveno" class="input-medium" value="">
                                                    </div>
                                                 </div>
                                              </div>
                                              <div class="modal-footer">
                                                 <input type="button" id="custombtn" name="custombtn" class='btn btn-primary' value="Save">
                                                 <input type="reset" class='btn' value="Discard changes">
                                                  <div class="alert alert-success span8" id="assign_custom" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="assign_custom_message"> Success!</span></strong>
                                    </div>
                                              </div>
                                             
                                            </div> 
                                        </div>
                                    </div> 
                                </div> 
                                 <input type="hidden" id="cus_emp" name="cus_emp" value="">
                            </form>    

                            <form action="" id="alertpopup" method="POST" class="form-horizontal">
                                <div class="span10">
                                    <div style="display:none;" class="modal fade popup" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:50% !important;">
                                        <div class="modal-dialog" >
                                            <div class="">
                                              <div class="">
                                                <button type="button" class="close" data-dismiss="modal" style="margin-top:5px;padding-right:5px;">
                                                <span aria-hidden="true">&times;</span>
                                    
                                                </button>
                                             
                                              </div>
                                              <div class="modal-body">
                                                 <div class="control-group" style="text-align:center; color:red;">
                                                   <h4 class="red">Please search an employee</h4>
                                                    
                                                 </div>
                                                
                                              </div>
                                              
                                            </div> 
                                        </div>
                                    </div> 
                                </div> 
                            </form>    
                            
                        <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Leave/Addleaves" id="leavepopupform" method="POST" class="form-horizontal">
                        <div class="span10">   
                            <div style="display:none;" class="modal fade popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <!--<span class="sr-only">Close</span>-->
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Employee Leaves</h4>
                              </div>
                              <div class="modal-body">
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Leave Name:</label>
                                    <div class="controls span6">
                                        <input type="text" id="leavename" name="leavename" class="input-xlarge" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Leave Number:</label>
                                    <div class="controls span6">
                                        <input type="text" id="leavemax" name="leavemax" class="input-xlarge" value="">
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label for="leave" class="control-label right span4">Expiry Date:</label>
                                    <div class="controls span6">
                                        <input type="text" id="expiry_date" name="expiry_date" class="input-xlarge" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Probation Period:</label>
                                    <div class="controls span6">
                                        <input type="text" id="leaveprobation" name="leaveprobation" class="input-xlarge" value="">
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">                                
                                <input type="button" id="popupbtn" name="popupbtn" class='btn btn-primary' value="Save">
                                <input type="reset" class='btn' value="Discard changes">
                                <div class="alert alert-success span8" id="leavealert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="popup_leave_mess">          Success!</span></strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>        
                        </form>          


                         <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Leave/cancel" id="leavecancelform" method="POST" class="form-horizontal">
                        <div class="span8">   
                            <div style="display:none;" class="modal fade popup" id="leaveCancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <!--<span class="sr-only">Close</span>-->
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Cancel Leave</h4>
                              </div>
                              <div class="modal-body">
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Leave Type:</label>
                                    <div class="controls span6" id="cancel_leave_type">
                                        
                                    </div>
                                </div>
                                <div class="control-group" >
                                    <label for="leave" class="control-label right span4">Leave Date:</label>
                                    <div class="controls span6" id="cancel_leave_date">
                                       
                                    </div>
                                    <input type="hidden" name="cancel_leave_id" id="cancel_leave_id" value="">
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Reason:</label>
                                    <div class="controls span6">
                                        <textarea id="leave_cancel" name="leave_cancel" class="input-xlarge" value=""></textarea>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">                                
                                <input type="button" id="cancelpopupbtn" name="cancelpopupbtn" class='btn btn-primary' value="Cancel Leave">
                                <input type="reset" id="cancelreset" class='btn' value="Discard changes">
                                <div class="alert alert-success span8" id="leavecancelalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="leave_cancel_message" >Success!</span></strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>        
                        </form>     


                         <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Leave/Approve" id="leaveApproveform" method="POST" class="form-horizontal">
                        <div class="span8">   
                            <div style="display:none;" class="modal fade popup" id="leaveApprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <!--<span class="sr-only">Close</span>-->
                                </button>
                                <h4 class="modal-title" id="leaveApprove_head"> </h4>
                              </div>
                              <div class="modal-body">
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Leave Type:</label>
                                    <div class="controls span6" id="approve_leave_type">
                                        
                                    </div>
                                </div>
                                <div class="control-group" >
                                    <label for="leave" class="control-label right span4">Leave Date:</label>
                                    <div class="controls span6" id="approve_leave_date">
                                       
                                    </div>
                                    <input type="hidden" name="approve_leave_id" id="approve_leave_id" value="">
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Reason:</label>
                                    <div class="controls span6">
                                        <textarea id="leave_approve_text" name="leave_approve_text" class="input-xlarge" value=""></textarea>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">                                
                                <input type="button" id="approvepopupbtn" name="approvepopupbtn" class='btn btn-primary' value="Cancel Leave">
                                <input type="reset" id="approvereset" class='btn' value="Discard changes">
                                <div class="alert alert-success span8" id="leaveapprovealert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong>  <span id="approve_message"   >     Success!</span></strong>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>        
                        </form>    


                                
                        <form action="" id="editleavepopupform" method="POST" class="form-horizontal">
                        <div class="span10">   
                        <div style="display:none;" class="modal fade popup" id="editmyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                    <!--<span class="sr-only">Close</span>-->
                                </button>
                                <h4 class="modal-title" id="editmyModalLabel">Edit Leaves</h4>
                              </div>
                              <div id="loading-image" align="center" style="display:none;">
                                    <?php $loadimg = Yii::app()->request->baseUrl.'/profilepictures/pageloader.gif'; ?>
                                    <img src="<?php echo $loadimg ;?>"/>
                              </div>
                              <div class="modal-body" id="popupbody" style="display:none;">
                                  
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Leave Name:</label>
                                    <div class="controls span6">
                                        <input type="text" id="editleavename" name="editleavename" class="input-xlarge" value="<?php echo $editarray['name'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Leave Number:</label>
                                    <div class="controls span6">
                                        <input type="text" id="editleavemax" name="editleavemax" class="input-xlarge" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4"> Expiry Date:</label>
                                    <div class="controls span6">
                                        <input type="text" id="edit_expiry_date" name="edit_expiry_date" class="input-xlarge" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="leave" class="control-label right span4">Probation Period:</label>
                                    <div class="controls span6">
                                        <input type="text" id="editleaveprobation" name="editleaveprobation" class="input-xlarge" value="">
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">                                
                                <input type="button" id="editpopupbtn" name="editpopupbtn" class='btn btn-primary' value="Update">
                                <input type="reset" class='btn' value="Discard changes">
                                <div class="alert alert-success span8" id="editleavealert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong>Update Success!</strong>
                                </div>
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
<?php $myleaveid = $_REQUEST['myleaveid'];?>
var myleaveid = "<?php  echo $myleaveid;?>"; 
var user_role = "<?php  echo $session[user_role];?>"; 
var availableDates = [];
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>"; 
    $(document).ready(function(){
    $('ul.tabs-top > li').click(function(){

        
        if ($(this).children().attr('href') == '#myleave'){
            $('#otherleave').hide();
            $('#leavetypes').hide();
             $('#reqleave').hide();
              $('#assignleave').hide();
               $('#lreport').hide();
               $('#addholiday').hide();
             
            $('#myleave').show();

            
            
        }
        else if ($(this).children().attr('href') == '#otherleave'){
            $('#otherleave').show();
            $('#leavetypes').hide();
            $('#myleave').hide();
            $('#reqleave').hide();
             $('#assignleave').hide();
              $('#lreport').hide();
              $('#addholiday').hide();
            
        }
        else if($(this).children().attr('href') == '#leavetypes'){
            $('#leavetypes').show();
            $('#otherleave').hide();
            $('#myleave').hide();
            $('#reqleave').hide();
             $('#assignleave').hide();
              $('#lreport').hide();
              $('#addholiday').hide();
        }else if($(this).children().attr('href') == '#assignleave'){
        
             $('#leavetypes').hide();
            $('#otherleave').hide();
            $('#myleave').hide();
            $('#reqleave').hide();
             $('#assignleave').show();
              $('#lreport').hide();
              $('#addholiday').hide();
        }else if($(this).children().attr('href') == '#reqleave'){
        
             $('#leavetypes').hide();
            $('#otherleave').hide();
            $('#myleave').hide();
            $('#assignleave').hide();
            $('#reqleave').show();
            $('#lreport').hide();
            $('#addholiday').hide();
          }else if($(this).children().attr('href') == '#lreport'){
        
             $('#leavetypes').hide();
            $('#otherleave').hide();
            $('#myleave').hide();
            $('#assignleave').hide();
            $('#reqleave').hide();
             $('#lreport').show();  
             $('#addholiday').hide();  
        }else if($(this).children().attr('href') == '#holiday'){
        
             $('#leavetypes').hide();
            $('#otherleave').hide();
            $('#myleave').hide();
            $('#assignleave').hide();
            $('#reqleave').hide();
             $('#lreport').hide();  
             $('#addholiday').show();  
        }else{
             $('#leavetypes').hide();
            $('#otherleave').hide();
            $('#myleave').hide();
            $('#reqleave').hide();
             $('#assignleave').hide();
             $('#addholiday').hide();
        }

    });  

    $( "ul.tabs-top li:first-child" ).trigger('click');

   }); 
</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/reqleave.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/assignleave.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/viewleaves.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/addleaves.js"></script>