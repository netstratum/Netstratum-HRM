<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roundcube.css" media="screen, projection" />
<iframe id="iframeid" src=""  height="600" width="100%" frameBorder="0" scrolling="no">
    
</iframe>

<form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Roundcubemail/Addnewdata" id="roundpopupform" method="POST" class="form-horizontal">
    <div class="span6">
        <div style="display:none;" class="modal fade popup" id="roundpopupmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="roundheader">Mail Login</h4>                        
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <label for="mail" class="control-label right span4">Username:</label>
                            <div class="controls span6">
                                <?php 
                                $session=new CHttpSession;
                                $session->open();
                                ?>
                                <input type="text" id="roundusername" data-rule-email="true" name="roundusername" class="input-xlarge" value="<?php echo $session['username'];?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="mail" class="control-label right span4">Password:</label>
                            <div class="controls span6">
                                <input type="password" id="roundpassword" name="roundpassword" class="input-xlarge" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <input type="button" id="roundbtn" name="roundbtn" class='btn btn-primary' value="Save">
                         <input type="reset" class='btn' value="Discard changes">
                         <div class="alert alert-success span4" id="rmailalert" style="display: none;">
                            <button data-dismiss="alert" class="close" type="button"></button>
                            <strong>Mail details added!</strong>
                         </div>
                         <div class="alert alert-danger span4" id="rmailerror" style="display: none;">
                            <button data-dismiss="alert" class="close" type="button"></button>
                            <strong>Valid password needed!</strong>
                         </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
<div class="modal_round"></div>
</form>
<script type="text/javascript">
    <?php
        $session=new CHttpSession;
        $session->open();
        
    ?>
    var roundid = '<?php echo $session['roundid']?>';
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";
    var domain = "66.6.131.39";
    //var domain = "localhost";
</script>

<script src="js/roundcubemail.js?<?php echo time();?>"></script>
