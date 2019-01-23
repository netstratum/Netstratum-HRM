<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/leavedate.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" media="screen, projection" />
<body>
<style>
.ui-autocomplete{
    z-index: 100000 !important;
}
</style>
    <div class="container-fluid">    
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered leavecolor">
                    <div class="box-title leavecolor">
                        <h3>
                            <i class="icon-user"></i>
                                Employee Resources
            </h3>
                    </div>
                    <div class="box-content nopadding bordercolor">                                                                                              
                        
                        <div class="tab-content padding tab-content-inline tab-content-bottom" id="hardware_allresources">
                            <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="box box-color box-bordered">
                                            <div class="box-title">
                                                <h3>Hardware Resources</h3>
                                                <div style="float: right;padding-right: 50px;">                                                    
                                                    <button type="button" class="btn btn-success" id="hardware_img" name="hardware_img" style="width: 135px;">NEW HARDWARE</button>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="hardware_resource_table">
                                            <thead>
                                                <tr>                                                                                                                    
                                                    <th style="width: 20%;">Hardware Name</th>
                                                    <th style="width: 10%;">Sl. No</th>
                                                    <th style="width: 20%;">Make</th>
                                                    <th style="width: 15%;">Expiry Date</th>
                                                    <th style="width: 20%;">Owner</th>                                                    
                                                    <th class='hidden-480'>Options</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content padding tab-content-inline tab-content-bottom" id="software_allresources">
                            <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="box box-color box-bordered">
                                            <div class="box-title">
                                                <h3>Software Resources</h3>
                                                <div style="float: right;padding-right: 50px;">                                                
                                                <button type="button" class="btn btn-success" id="software_img" name="software_img" style="width: 135px;">NEW SOFTWARE</button>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="software_resource_table">
                                            <thead>
                                                <tr>                                                                         
                                                    <th style="width: 20%;">Software Name</th>
                                                    <th style="width: 10%;">Sl. No</th>
                                                    <th style="width: 20%;">Make</th>
                                                    <th style="width: 15%;">Expiry Date</th>
                                                    <th style="width: 20%;">Owner</th>                                                    
                                                    <th class='hidden-480'>Options</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                            <form method="POST" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Resource/Hardwaredetails" id="new_hardware" class="form-horizontal">
                                <div class="span10">
                                    <div style="display:none;" class="modal fade" id="hardware_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>                                                
                                                    </button>
                                                    <h4 align="center" class="modal-title" id="hardwareModalLabel">New Hardware Resources</h4>
                                                </div>
                                                <div class="modal-body">  
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Hardware Name:</label>
                                                        <div class="controls">
                                                            <input type="text" id="hard_name" name="hard_name" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Serial Number:</label>
                                                        <div class="controls">
                                                            <input type="text" id="hard_serial" name="hard_serial" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Make:</label>
                                                        <div class="controls">
                                                            <input type="text" id="hard_make" name="hard_make" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Model:</label>
                                                        <div class="controls">
                                                            <input type="text" id="hard_model" name="hard_model" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Remarks:</label>
                                                        <div class="controls">
                                                            <textarea id="hard_remarks" name="hard_remarks" style="width: 150px;"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Vendor:</label>
                                                        <div class="controls">
                                                            <textarea id="hard_vendor" name="hard_vendor" style="width: 150px;"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Warranty:</label>
                                                        <div class="controls">
                                                            <input placeholder="YEAR" type="text" id="hard_warranty_year" name="hard_warranty_year" style="width: 69px;"><input placeholder="MONTH" type="text" id="hard_warranty_month" name="hard_warranty_month" style="width: 69px;">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Purchase Date:</label>
                                                        <div class="controls">
                                                            <input type="text" id="hard_pdate" name="hard_pdate" style="width: 150px;">
                                                        </div>
                                                    </div>

						 <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">MAC address1:</label>
                                                        <div class="controls">
                                                            <input type="text" id="mac_address1" name="mac_address1" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                  <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">MAC address2:</label>
                                                        <div class="controls">
                                                            <input type="text" id="mac_address2" name="mac_address2" style="width: 150px;">
                                                        </div>
                                                    </div>
						  <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">MAC address3:</label>
                                                        <div class="controls">
                                                            <input type="text" id="mac_address3" name="mac_address3" style="width: 150px;">
                                                        </div>
                                                    </div>
							<div class="control-group">
                                                        <label for="hardware" class="control-label right span4">MAC address4:</label>
                                                        <div class="controls">
                                                            <input type="text" id="mac_address4" name="mac_address4" style="width: 150px;">
                                                        </div>
                                                    </div>



                                                    <div class="modal-footer1">                                                        
                                                        <input type="button" id="hardware_btn" name="hardware_btn" class='btn btn-primary' value="Save" style="display: none;">
                                                        <input type="button" id="hardware_update" name="hardware_update" class='btn btn-primary' value="Update" style="display: none;">
                                                        <input type="reset" class='btn' value="Discard changes">
                                                        <div class="alert alert-success span8" id="hardware_alert" style="display: none;">                                                            
                                                            <strong>  <span id="hard_alert" >       Success!</span></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                     
                        
                            <form method="POST" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Resource/Softwaredetails" id="new_software" class="form-horizontal">
                                <div class="span10">
                                    <div style="display:none;" class="modal fade" id="software_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span aria-hidden="true">&times;</span>                                                
                                                    </button>
                                                    <h4 align="center" class="modal-title" id="softwareModalLabel">New Software Resources</h4>
                                                </div>
                                                <div class="modal-body">                                                    
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Software Name:</label>
                                                        <div class="controls">
                                                            <input type="text" id="soft_name" name="soft_name" style="width: 150px;" value="">
                                                        </div>
                                                    </div>
                                                     <div class="control-group">
                                                        <label for="hardware" class="control-label right span4">Serial Number:</label>
                                                        <div class="controls">
                                                            <input type="text" id="soft_serial" name="soft_serial" style="width: 150px;">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Make:</label>
                                                        <div class="controls">
                                                            <input type="text" id="soft_maker" name="soft_maker" style="width: 150px;" value="">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Model:</label>
                                                        <div class="controls">
                                                            <input type="text" id="soft_model" name="soft_model" style="width: 150px;" value="">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Remarks:</label>
                                                        <div class="controls">
                                                            <textarea id="soft_remark" name="soft_remark" style="width: 150px;" value=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Vendor:</label>
                                                        <div class="controls">
                                                            <textarea id="soft_vendor" name="soft_vendor" style="width: 150px;" value=""></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Warranty:</label>
                                                        <div class="controls">
                                                            <input placeholder="YEAR" type="text" id="soft_warranty_year" name="soft_warranty_year" style="width: 69px;" value=""><input placeholder="MONTH" type="text" id="soft_warranty_month" name="soft_warranty_month" style="width: 69px;" value="">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="software" class="control-label right span4">Purchase Date:</label>
                                                        <div class="controls">
                                                            <input type="text" id="soft_pdate" name="soft_pdate" style="width: 150px;" value="">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer1">                                                        
                                                        <input type="button" id="software_btn" name="software_btn" class='btn btn-primary' value="Save" style="display: none;">
                                                        <input type="button" id="software_update" name="software_update" class='btn btn-primary' value="Update" style="display: none;">
                                                        <input type="reset" class='btn' value="Discard changes">
                                                        <div class="alert alert-success span8" id="software_alert" style="display: none;">                                                            
                                                            <strong>  <span id="soft_alert" >       Success!</span></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        



                            <div style="display:none;" class="modal fade" id="history_hardware_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>                                                
                                                </button>
                                                <h4 align="center" class="modal-title" id="hardware_modal_label">Hardware History</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover table-nomargin table-bordered usertable" id="hard_history">
                                            <thead>
                                                <tr>                                                                         
                                                    <th style="width: 25%;">Name</th>
                                                    <th style="width: 25%;">Assigned Date</th>
                                                    <th style="width: 15%;">Returned Date</th>
                                               
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            
                                        </table>
                                               
                                            <div class="modal-footer1">                                                        
                                                                           
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div style="display:none;" class="modal fade" id="history_software_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>                                                
                                                </button>
                                                <h4 align="center" class="modal-title" id="hardware_modal_label">Software History</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover table-nomargin table-bordered usertable" id="soft_history">
                                            <thead>
                                                <tr>                                                                         
                                                    <th style="width: 25%;">Name</th>
                                                    <th style="width: 25%;">Assigned Date</th>
                                                    <th style="width: 15%;">Returned Date</th>
                                               
                                                </tr>
                                            </thead><tbody></tbody>
                                        </table>
                                               
                                            <div class="modal-footer1">                                                        
                                                                                                      
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                        <form method="POST" action="" id="hardware_assign" class="form-horizontal">
                            <div class="span10">
                                <div style="display:none;" class="modal fade" id="assign_hardware_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>                                                
                                                </button>
                                                <h4 align="center" class="modal-title" id="hardware_modal_label">Assign Hardware</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="control-group">
                                                    <label for="hardware" class="control-label right span4">Employee:</label>
                                                    <div class="controls">
                                                        <input type="text" id="hard_emp_assign" name="hard_emp_assign" style="width: 200px;z-index: 1000;" value="">
                                                    </div>
                                                </div>
                                              <!--  <div class="control-group">
                                                    <label for="hardware" class="control-label right span4">Serial Number:</label>
                                                    <div class="controls">
                                                        <input type="text" id="hard_serial_assign" name="hard_serial_assign" style="width: 200px;">
                                                    </div>
                                                </div> -->
                                                <div class="modal-footer1">                                                        
                                                    <input type="button" id="hardware_assign_btn" name="hardware_assign_btn" class='btn btn-primary' value="Save">
                                                    <input type="reset" class='btn' value="Discard changes">                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <form method="POST" action="" id="software_assign" class="form-horizontal">
                            <div class="span10">
                                <div style="display:none;" class="modal fade" id="assign_software_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>                                                
                                                </button>
                                                <h4 align="center" class="modal-title" id="software_modal_label">Assign Software</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="control-group">
                                                    <label for="software" class="control-label right span4">Employee:</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-medium" id="soft_emp_assign" name="soft_emp_assign" style="width: 200px;">
                                                    </div>
                                                </div>
                                              <!--  <div class="control-group">
                                                    <label for="software" class="control-label right span4">Serial Number:</label>
                                                    <div class="controls">
                                                        <input type="text" id="soft_serial_assign" name="soft_serial_assign" style="width: 200px;" value="">
                                                    </div>
                                                </div> -->
                                                <div class="modal-footer1">                                                        
                                                    <input type="button" id="software_assign_btn" name="software_assign_btn" class='btn btn-primary' value="Save">
                                                    <input type="reset" class='btn' value="Discard changes">                                                    
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
</body>
<script type="text/javascript">
var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";
var hardware = "";
var software = "";
</script>
<script src="js/resource.js"></script>
<script src="js/editresource.js"></script>

