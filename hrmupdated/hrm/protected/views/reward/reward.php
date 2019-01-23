<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/leavedate.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" media="screen, projection" />
<body>
<style>
.form-horizontal .control-label {
    text-align: left;
    width: 145px;
}
.error {
    color: #d21b1b !important;
    border-color: #d21b1b !important;
    cursor: default !important;
}
#peerdatable_length select{
    width:60px;
}
#reporttableReward_length select{
    width:60px;
}
</style>

    <div class="container-fluid">
        <div class="page-header">
            <div class="pull-left">
		<h1></h1>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-color box-bordered leavecolor">
                    <div class="box-title leavecolor">
			<h3>
                            <i class="icon-user"></i>
                            Rewards & Recognition
			</h3>
                    </div>
                    <div class="box-content nopadding bordercolor">
                       <?php 
                        $session=new CHttpSession;
                        $session->open();
                        ?>

                        <ul class="tabs tabs-inline tabs-top">

                            <li  class="active">
<a data-toggle="tab" href="#ManageReward"> <?php 

if ($session['user_role']==1 or $session['user_role']==2 or $supervisor==true){?>Manage Rewards<?php }else{?>Rewards<?php } ?>  </a>
                            </li>

                           <?php  if ($session['user_role']==1 or $session['user_role']==2 or $session['user_role']==5){?> 
                            <li  >
                                <a data-toggle="tab" href="#redeemedtab"> Redeemed Points </a>
                            </li>
                           <?php } ?>
                            <li  >
                                <a data-toggle="tab" href="#recognition"> Recognition </a>
                            </li>

                            <li  >
                                <a data-toggle="tab" href="#peer_recognition"> Add Peer Recognition </a>
                            </li>

                        </ul>
                        
                        
                        <div class="tab-pane active" id="peerrecognition">
                        <div class="box-title" style="margin-bottom:26px;">
                                <h3>
                                    <i class="icon-reorder"></i>
                                    Add Peer Recognition
                                </h3>
                            </div>
                            <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Reward/peerRec" id="peerform" method="POST" class="form-horizontal">
                                <div class="span10">
                                    <div class="control-group">
                                            <label for="leave" class="control-label right">Select Coworker *:</label>
                                            <div class="controls">
                                                <input type="text" id="peercoworker" name="peercoworker" class='input-xlarge' value="">

                                            </div>
                                    </div>
                                 
                                    <div class="control-group">
                                            <label for="type" class="control-label right">Recognized for *:</label>
                                            <div class="controls">
                                                <input type="text" name="peerrecognizedfor" id="peerrecognizedfor" 
                                                class="input-medium datepicker " value="" style="width:250px;">
                                            </div>
                                    </div>
                                  
                                                                   
                                   
                                    <div class="control-group">
                                        <label for="day" class="control-label right">Congratulatory
Message *:</label>
                                        <div class="controls">
                                            <textarea cols="50" rows="4" id="peermessage" name="peermessage" class='input-xlarge'></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="button" id="peersubmit" name="peersubmit" class='btn btn-primary' 
                                               value="Send">
                                        <input id="peerreset" type="reset" class='btn' value="Discard changes">
                                    </div>
                                    <div class="alert alert-success span8" id="peeralert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="peer_message"> Successfully send the peer recognition!</span></strong>
                                    </div>
                                    <div class="alert alert-error span8" id="peererror" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="peer_error_message"> </span></strong>
                                    </div>
                                </div>
                                
                            </form>

                        </div>
                       

                        
                        <div class="tab-pane active" id="redeemedlist" style="display:none;">
                            <form action="" id="redeemedlistform" method="POST" class="form-horizontal">
                              <div class="container-fluid">
                               <div class="row-fluid"> 
                                <div class="span12">
                                   <div class="box box-color box-bordered">
                                       <div class="box-title">
                                     <h3>Redeemed Points</h3>       
                                  
                                       </div>

                                     

                                    <div class="box-content nopadding" >
                                   
                                        <div style="clear:both"></div>
                                        <div id="display_search" class="datatable_custom">
                                        <label class="custom_label"  >Date From:</label> 
                                         <div class="custom_label" ><input type="text" id="redeemed_datefrom" name="redeemed_datefrom" class='span10' value="" >
                                         </div> 
                                         <label  class="custom_label">  Date To:</label>
                                         <div class="custom_label" ><input type="text" id="redeemed_dateto" name="redeemed_dateto" class='span10' value="" ></div> 
                                         
                                         <label  class="custom_label"> Employee Name:</label><div class="custom_label" > <input type="text" id="redeemed_employeename" name="redeemed_employeename" class='span10' value="" ></div>
                                         
                                         </div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="redeemeddatable" >
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Date </th>
                                                    <th style="width: 20%;">Employee Name </th>
                                                    <th style="width: 15%;">Redeemed Points</th>
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


                        <div class="tab-pane active" id="recognition_admin_super" style="display:none;">
                            <form action="" id="recognitionform" method="POST" class="form-horizontal">
                              <div class="container-fluid">
                               <div class="row-fluid"> 
                                <div class="span12">
                                   <div class="box box-color box-bordered">
                                       <div class="box-title">
                                     <h3>Recognition</h3>       
                                  
                                       </div>

                                     

                                    <div class="box-content nopadding" >
                                   
                                        <div style="clear:both"></div>
                                        <div id="display_search" class="datatable_custom">
                                        <label class="custom_label"  >Date From:</label> 
                                         <div class="custom_label" ><input type="text" id="peer_datefrom" name="peer_datefrom" class='span10' value="" >
                                         </div> 
                                         <label  class="custom_label">  Date To:</label>
                                         <div class="custom_label" ><input type="text" id="peer_dateto" name="peer_dateto" class='span10' value="" ></div> 
                                         <?php  if ($session['user_role']==1 or $session['user_role']==2){?> 
                                         <label  class="custom_label"> Employee Name:</label><div class="custom_label" > <input type="text" id="peer_employeename" name="peer_employeename" class='span10' value="" ></div>
                                         <?php } ?>
                                         </div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="peerdatable" >
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Date </th>
                                                    <th style="width: 20%;">Recognized by </th>
                                                    <?php  if ($session['user_role']==1 or $session['user_role']==2){?> 
                                                    <th style="width: 15%;">Recognized for</th>
                                                    <?php }else{ ?>
                                                        <th style="width: 15%;">Peer to Peer Recognition</th>
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
                        
                        <div class="tab-pane active" id="rewards_admin_super" style="display:none;">
                            
                              <div class="container-fluid">
                               <div class="row-fluid"> 
                                <div class="span12">
                                   <div class="box box-color box-bordered">
                                       <div class="box-title">
                                     <h3>Rewards</h3>       
                                  
                                       </div>
                                       
                                       

                                     <div id="addRewardDiv" style="display:none;margin-top:10px;" >
                                         <?php  if ($session['user_role']==1 or $session['user_role']==2 or $supervisor==true){?> <div style="float:right; height:30px;"><button type="button" class="btn btn-success"  id="view_reward">VIEW REWARDS</button></div> <?php  } ?>
<form  id="recognitionaddform" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Reward/AddReward" id="addformreward" method="POST" class="form-horizontal">
<div class="span10">

     <div class="control-group">
            <label for="leave" class="control-label right">Select Coworker *:</label>
            <div class="controls">
                <input type="text" id="rewardcoworker" name="rewardcoworker" class='input-xlarge' value="">
                                            
            </div>
    </div>
    
    <div class="control-group">
            <label for="leave" class="control-label right">Points in your kitty *:</label>
            <div class="controls">
                <input type="text" readonly id="pointsinyourkitty" name="aspointsinyourkittysiemp" class='input-xlarge' value="1000">

            </div>
    </div>

    <div class="control-group">
            <label for="leave" class="control-label right">Assign Reward Points *:</label>
            <div class="controls">
            <select name="awardpoints" id="awardpoints" style="width: 284px;">
                                                <option value="">--Select--</option>
                                                <option value="250">250</option>
                                                <option value="500">500</option>
                                                <option value="750">750</option>
                                                </select>

            </div>
    </div>
 
    <div class="control-group">
            <label for="type" class="control-label right">Recognized for *:</label>
            <div class="controls">
                <input type="text" name="awardrecognizedfor" id="awardrecognizedfor" 
                class="input-medium datepicker " value="" style="width:250px;">
            </div>
    </div>
  
                                   
   
    <div class="control-group">
        <label for="day" class="control-label right">Congratulatory
Message *:</label>
        <div class="controls">
            <textarea cols="50" rows="4" id="awardmessage" name="awardmessage" class='input-xlarge'></textarea>
        </div>
    </div>
    <div class="form-actions">
        <input type="button" id="assinRewardbutton" name="assinRewardbutton" class='btn btn-primary' 
               value="Assign">
        <input id="assignrewardreset" type="reset" class='btn' value="Discard changes">
    </div>
    <div class="alert alert-success span8" id="assialertreward" style="display: none;">
        <button data-dismiss="alert" class="close" type="button"></button>
        <strong> <span id="assign_reward_message"> Successfully assigned the points</span></strong>
    </div>
    <div class="alert alert-error span8" id="assierrorreward" style="display: none;">
        <button data-dismiss="alert" class="close" type="button"></button>
        <strong> <span id="assign_reward_error_message"> </span></strong>
    </div>
</div>

</form>

     </div>
                                 <form action="" method="POST" class="form-horizontal">

                                    <div class="box-content nopadding" id="showRewardDiv"  >
                                    <?php 

if (($session['user_role']!=1 and $session['user_role']!=2 and $supervisor!=true) and $points>0){?><div class="span10" id="redeemDiv" style="margin-left:30px;margin-top:20px;font-size:14px;float:right;"><strong>Hurray!!! Congratulations <?php echo $session['name'];?>! You have Earned a total of <?php echo $points;?> Reward points!</strong> <span   style="float:right;display:inline-block;margin-right:10px;"><button type="button" class="btn btn-success" data-toggle="modal" id="redeem_reward">REDEEM POINTS</button></span></div>
 
<div style="clear:both"></div>
 <?php } ?> 

                                    <?php if ($supervisor==true){ ?>
                                    <div style="float: right;padding-top: 9px;padding-right: 5px;">
                                            <button type="button" class="btn btn-success" data-toggle="modal" id="add_reward">ADD REWARD</button>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?>
                                        <div id="display_search" class="datatable_custom">
                                        <label class="custom_label"  >Date From:</label> 
                                         <div class="custom_label" ><input type="text" id="datefromReward" name="datefromReward" class='span10' value="" >
                                         </div> 
                                         <label  class="custom_label">  Date To:</label>
                                         <div class="custom_label" ><input type="text" id="datetoReward" name="datetoReward" class='span10' value="" ></div> 
                                         <?php if ($supervisor==true or $session['user_role']==1 or $session['user_role']==2){ ?>
                                         <label  class="custom_label"> Employee Name:</label><div class="custom_label" > <input type="text" id="reward_employeename" name="reward_employeename" class='span10' value="" ></div><?php } ?></div>
                                        <table class="table table-hover table-nomargin table-bordered usertable" id="reporttableReward" style="margin-top:30px !important;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Date </th>                                                   
                                                    <th style="width: 20%;">Recognized by </th>
                                                   <?php  if ($session['user_role']!=1 and $session['user_role']!=2 and $supervisor!=true) { ?>
                                                    <th style="width: 15%;"> Supervisor Recognition </th>
                                                   <?php }else{?>
                                                    <th style="width: 15%;">Recognized for</th>
                                                   <?php } ?>
                                                    <th style="width: 15%;">Points Awarded</th>  
                                                    <th style="width: 20%;">Total Points</th>
                                                    <th class='hidden-480'>Redeemed?</th> 
                                                    
                                                </tr>
                                            </thead>
                                        </table>
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
            
        </div>
        
    </div>
    </div>
</body>
<script type="text/javascript">


var user_role = "<?php  echo $session[user_role];?>"; 
var total_points = "<?php echo $points;?>";
var availableDates = [];
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>"; 
    $(document).ready(function(){
    $('ul.tabs-top > li').click(function(){

        
        if ($(this).children().attr('href') == '#ManageReward'){
           
            $('#rewards_admin_super').show();
            $('#showRewardDiv').show();
            $('#addRewardDiv').hide();            
            $('#recognition_admin_super').hide();
            $('#peerrecognition').hide();
            $('#redeemedlist').hide();
            
            
            
        }
        else if ($(this).children().attr('href') == '#recognition'){
            $('#recognition_admin_super').show();
            $('#rewards_admin_super').hide();
            $('#peerrecognition').hide();
            $('#redeemedlist').hide();
           
      
        }else if($(this).children().attr('href') == '#peer_recognition'){
            $('#peerrecognition').show();
            $('#recognition_admin_super').hide();
            $('#rewards_admin_super').hide();
            $('#redeemedlist').hide();
        } else if ($(this).children().attr('href') == '#redeemedtab'){

            $('#peerrecognition').hide();
            $('#recognition_admin_super').hide();
            $('#rewards_admin_super').hide();
            $('#redeemedlist').show();

        }

    });  

    $( "ul.tabs-top li:first-child" ).trigger('click');

    $( "#add_reward" ).click(function(){
       
        $('#showRewardDiv').hide();
        $('#addRewardDiv').show(); 

    });


     $('#view_reward').click(function(){
   
        $('#rewards_admin_super').show();
            $('#showRewardDiv').show();
            $('#addRewardDiv').hide();            
            $('#recognition_admin_super').hide();
            $('#peerrecognition').hide();

    });


   }); 
</script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/rewards.js"></script>
