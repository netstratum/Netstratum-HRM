<body> 
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3>
                            Email Template
                        </h3>
                    </div>
                    <div class="box-content nopadding">
                        <table class="table table-hover table-nomargin table-bordered usertable" id="emailtable">
                            <thead>
                                <tr>
                                    
                                    <th style="width: 25%;">From Address</th>
                                    <th style="width: 25%;">Bcc</th>
                                    <th style="width: 25%;">Display Name</th>
                                    <th class='hidden-480'>Options</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    
        <div class="span10">
            <div style="display:none;" class="modal fade popup" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="maillabel">Edit Mail Template</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row-fluid" style="display: none;" id="maileditor">
                                <div class="span12">
                                    <div class="span6">
                                        <div class="control-group">
                                            <label for="mail" class="control-label right span4">From Mail:</label>
                                            <div class="controls span6">
                                                <input type="text" id="frommail" name="frommail" class="" value="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="mail" class="control-label right span4">BCC Mail:</label>
                                            <div class="controls span6">
                                                <input type="text" id="bccmail" name="bccmail" class="" value="">
                                            </div>
                                        </div>   
                                        <div class="control-group">
                                            <label for="mail" class="control-label right span4">Subject:</label>
                                            <div class="controls span6">
                                                <textarea  cols="50" rows="4" style="width:205px;" id="subjectmail" name="subjectmail" class="" value=""></textarea> 
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="span6">
                                      <div class="controls span9">
<!--                                          <table id="temptable">
                                              <thead>
                                                  <tr>
                                                      <th>DYNAMIC VARIABLE</th>
                                                      <th>DESCRIPTION</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td></td>
                                                      <td></td>
                                                  </tr>
                                              </tbody>
                                          </table>-->
                                          <table style="width: 100%;" class="table table-hover table-nomargin table-bordered usertable grid" id="temptable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25%;">DYNAMIC VARIABLE</th>
                                                    <th style="width: 80%;">DESCRIPTION</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                          </table>
                                      </div>
                                    </div>
                                    
                                    
                                    <div style="clear:both;"></div>
                                        <div class="box">
                                                <div class="box-title">
                                                        <h3><i class="icon-th"></i> Mail Editor</h3>
                                                </div>
                                                <div class="box-content nopadding">
                                                    <form action="" method="POST" class='form-wysiwyg' id="mailform">
                                                        <textarea id="ck" name="ck" class='ckeditor span12' rows="3"></textarea>
                                                    </form>
                                                </div>
                                            
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" id="mailbtn" name="mailbtn" class='btn btn-primary' value="Save">
                            <div class="alert alert-success span8" id="mailalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong>Update Success!</strong>
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
    <script src="js/mail.js"></script>