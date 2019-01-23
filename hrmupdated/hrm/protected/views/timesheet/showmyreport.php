<body>
    <div class="tab-content padding tab-content-inline tab-content-bottom" id="showreport">
      <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
                  <div class="box box-color box-bordered">
                      <div class="box-title">
                          <h3>
                            My Timesheet Report
                          </h3>
                      </div>
                      
                      <div class="box-content nopadding" id="reportlist">
                          <div id="mytimesearch" class="datatable_custom">
                             <label class="custom_label"  >Date From:</label>  
                             <div class="custom_label" >
                                 <input type="text" id="datefrom_mytimesheet" name="datefrom_mytimesheet" class='span10' value="" >
                             </div> 
                             <label  class="custom_label">  Date To:</label>
                             <div class="custom_label" >
                                 <input type="text" id="dateto_mytimesheet" name="dateto_mytimesheet" class='span10' value="" >
                             </div>
                             <label  class="custom_label">  Search Project:</label>
                             <div class="custom_label" >
                                 <input type="text" id="searchproject_mytimesheet" name="searchproject_mytimesheet" class='span10' value="" >
                             </div>
                             <label  class="custom_label">  Search Task:</label>
                             <div class="custom_label" >
                                 <input type="text" id="searchtask_mytimesheet" name="searchtask_mytimesheet" class='span10' value="" >
                             </div>
                          </div>
                          <table class="table table-hover table-nomargin table-bordered usertable" id="mytimesheettable">
                              <thead>
                                  <tr>
                                      <th style="width: 20%;">Project Name</th>
                                      <th style="width: 20%;">Task Name</th>
                                      <th style="width: 20%;">Date</th>
                                      <th style="width: 20%;">Hours</th>
                                  </tr>
                              </thead> 
                                <tfoot>
                                    <tr>
                                    <th colspan="3" style="text-align:right">Total:</th>
                                    <th id="totalid"></th>
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
<script src="js/showtimereport.js?<?php echo time();?>"></script>