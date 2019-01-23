<body>
    <div class="tab-content padding tab-content-inline tab-content-bottom" id="supervisorreport">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="box box-color box-bordered">
                        <div class="box-title">
                          <h3>
                            Employee Timesheet Report
                          </h3>                          
                          
                        </div>                                                                                               
                        <div class="box-content nopadding" id="empreportlist">
<!--                            <div style="float: right;padding-top: 9px;padding-right: 5px;">
                              <button type="button" class="btn btn-success" id="printreportbtn" name="printreportbtn">DOWNLOAD</button>
                            </div>-->
                            <div id="emptimesearch" class="datatable_custom">
                                <label class="custom_label"  >Date From:</label>
                                <div class="custom_label" >
                                    <input type="text" id="empdatefrom_mytimesheet" name="empdatefrom_mytimesheet" class='span10' value="" style="width: 100px;">
                                </div>
                                <label  class="custom_label">  Date To:</label>
                                <div class="custom_label" >
                                 <input type="text" id="empdateto_mytimesheet" name="empdateto_mytimesheet" class='span10' value="" style="width: 100px;">
                                </div>
                                <label  class="custom_label">  Employee Name:</label>
                                <div class="custom_label" >
                                 <input type="text" id="empname_mytimesheet" name="empname_mytimesheet" class='span10' value="" style="width: 100px;">
                                </div>
                                <label  class="custom_label">  Search Project:</label>
                                <div class="custom_label" >
                                 <input type="text" id="empsearchproject_mytimesheet" name="empsearchproject_mytimesheet" class='span10' value="" style="width: 100px;">
                                </div>
                                <label  class="custom_label">  Search Task:</label>
                                <div class="custom_label" >
                                 <input type="text" id="empsearchtask_mytimesheet" name="empsearchtask_mytimesheet" class='span10' value="" style="width: 100px;">
                                </div>
                                <label  class="custom_label">  Group Tasks:</label>
                                <div class="custom_label" >
                                    <input type="checkbox" id="checktask_mytimesheet" name="checktask_mytimesheet" value="checked">
                                </div>
                            </div>
                            
                            <table class="table table-hover table-nomargin table-bordered usertable" id="emptimesheettable">
                                <thead>
                                    <tr>                                       
                                       <th style="width: 20%;">Project Name</th>
                                       <th style="width: 20%;">Task Name</th>
                                       <th style="width: 20%;">Employee Name</th>
                                       <th style="width: 20%;">Date</th>
                                       <th style="width: 20%;">Hours</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th id="emptotalid"></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <table class="table table-hover table-nomargin table-bordered usertable" id="emptasksheettable" 
                                   style="display: none;">
                                <thead>
                                    <tr>                                       
                                       <th style="width: 20%;">Project Name</th>
                                       <th style="width: 20%;">Task Name</th>
                                       <th style="width: 20%;">Employee Name</th>
                                       <th style="width: 20%;">Total</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th colspan="3" style="text-align:right">Total:</th>
                                    <th id="taskemptotalid"></th>
                                    </tr>
                                </tfoot>
                            </table>
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
<script src="js/emptimesheetreport.js?<?php echo time();?>"></script>