<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css" media="screen, projection" />
<body>

    <div class="container-fluid">
            <div class="page-header">
                <div class="pull-left">
                    <h1>User Profile</h1>
                </div>

            </div>
            
            <div class="row-fluid">
                <div class="span12 prof">
                    <div class="box box-color box-bordered leavecolor">
                        <div class="box-title leavecolor">
                            <h3>
                                <i class="icon-user"></i>
                                Edit user profile
                            </h3>
                        </div>
                        <div class="box-content nopadding bordercolor">
                        <ul class="tabs tabs-inline tabs-top">
                             <li class='active' >
                                 <a href="#profile" data-toggle='tab'><i class="icon-user"></i> Profile</a>
                             </li>
                                <li  <?php if ($_REQUEST['emp_number']=='' and $user_role<3){?>style="display:none;"<?php }?>>
                                <a href="#econtact" data-toggle='tab'>Emergency Contact</a>
            </li>
                         <li <?php if ($_REQUEST['emp_number']=='' and $user_role<3){?>style="display:none;"<?php }?>>
                            <a href="#dependent" data-toggle='tab'>Dependency</a>
            </li>
                        <li <?php if ($_REQUEST['emp_number']=='' and $user_role<3){?>style="display:none;"<?php }?>>
                            <a href="#job" data-toggle='tab'>Job</a>
            </li>
                        <li <?php if ($_REQUEST['emp_number']=='' and $user_role<3){?>style="display:none;"<?php }?>>
                            <a href="#report" data-toggle='tab'>Report To</a>
            </li>

            <li <?php if ($_REQUEST['emp_number']=='' or $user_role>2){?>style="display:none;"<?php }?>>
                          <a href="#leavedays" data-toggle='tab'>Add Week Holidays</a>
            </li>
                     <!--   <li>
                            <a href="#salary" data-toggle='tab'>Salary</a>
            </li>-->
                      <!--  
                        <li>
                            <a href="#qualification" data-toggle='tab'>Qualifications</a>
            </li>-->
                    </ul>
                                                    
           
        <div class="tab-content padding tab-content-inline tab-content-bottom">
            <div class="tab-pane active" id="profile">
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/UserReg" id="profileform" method="POST" class="form-horizontal" 
          enctype="multipart/form-data">
        <div class="row-fluid">
        <div class="span2">
        <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="max-width: 100px; max-height: 150px;">
                    <?php
//                     $dateadded = date('Y-m-d');
                    if(file_exists('profilepictures/main-'.$editddata['userid'].'.jpg') and $editddata['userid']>0)
                    {
                        $im = Yii::app()->request->baseUrl.'/profilepictures/main-'.$editddata['userid'].'.jpg?'.time();
                        
                    }
                    else
                    {                            
                        $im = Yii::app()->request->baseUrl.'/profilepictures/default.jpg?'.time();
                    }
                    ?>
                    <img src="<?php echo $im ;?>" />
                
                </div>
                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 100px; max-height: 150px; line-height: 20px;"></div>
                <div>
                    <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                    <span class="fileupload-exists">Change</span>
                        <input type="file" name='uploadimage' id="uploadimage"/>
                    </span>
                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                </div>
        </div>
            
            <input type="hidden" name='empnumber' id="empnumber" value="<?php echo $emp_number;?>"/>
            
        </div>
                            <div class="span10">
                                    <?php if ($user_role == 1 or $user_role == 2){ ?>
                                    <div class="control-group">
                                        
                                        
                                            <label for="name" class="control-label right">User Role: * </label>
                                            <div class="controls">
                                             <?php echo CHtml::dropDownList('userrole',$editddata['user_role_id'], CHtml::listData(HrmUserRole::model()->findAll(), 'id',
                                                        'display_name'),   array(
                                                            'class'=>'input-xlarge',)                                        
                                                                              ); ?>
                                            </div>
                                    </div>

                                    <?php } ?>
                                    <div class="control-group">
                                            <label for="name" class="control-label right">First Name: * </label>
                                            <div class="controls">
                                                <input type="text" id="fname" name="fname" class='input-xlarge' value="<?php  echo $editddata['emp_firstname'];?>">
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="name" class="control-label right">Middle Name:</label>
                                            <div class="controls">
                                                <input type="text" id="mname" name="mname" class='input-xlarge' value="<?php  echo $editddata['emp_middle_name'];?>">
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="name" class="control-label right">Last Name: * </label>
                                            <div class="controls">
                                                <input type="text" id="lname" name="lname" class='input-xlarge' value="<?php  echo $editddata['emp_lastname'];?>">
                                            </div>
                                    </div>
                                      <div class="control-group">
                                            <label for="pw" class="control-label right">Date of Birth:  </label>
                                            <div class="controls">
                                                <input type="text" id="emp_dob" name="emp_dob" class='input-xlarge' value="<?php  if ($editddata['emp_dob']!='0000-00-00' and $editddata['emp_dob']!='' ){echo date('m/d/Y',strtotime($editddata['emp_dob'])); }?>">
                                                    
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="phone" class="control-label right">Mobile Number:  </label>
                                            <div class="controls">
                                                <input type="text" id="mobilenumber" name="mobilenumber" class='input-xlarge' value="<?php  echo $editddata['mobile_number'];?>">
                                            </div>
                                    </div>
                                <?php 
                                    if($emp_number=="")
                                    {
                                        
                                    ?>
                                     <div class="control-group">
                                            <label for="email" class="control-label right">Gender: * </label>
                                            <div class="controls">
                                            <div style="float:left;padding:5px;">   <input type="radio" id="gender1" name="gender"  class='input-xlarge' value="M" <?php  if($editddata['emp_gender']=='M'){echo "checked=checked";}?>> </div>  <label style="padding:5px;float:left;"> Male</label> <div style="float:left;margin-left:10px;padding:5px;"><input type="radio" id="gender2" name="gender"  class='input-xlarge' value="F" <?php  if($editddata['emp_gender']=='F'){echo "checked=checked";}?>></div> <label style="padding:5px;float:left;">Female</label>
                                               <div id="emp_gender" style="padding-top:5px;padding-left:20px;"> </div>    
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="email" class="control-label right">Username: * </label>
                                            <div class="controls">
                                                <input type="text" id="uname" name="uname" data-rule-email="true" class='input-xlarge' value="<?php  echo $editddata['user_name'];?>">
                                                    
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="pw" class="control-label right">Password: * </label>
                                            <div class="controls">
                                                <input type="password" id="pswd" name="pswd" class='input-xlarge' value="">
                                                    
                                            </div>
                                    </div>
                                    <div class="control-group">
                                            <label for="pw" class="control-label right">Confirm Password: * </label>
                                            <div class="controls">
                                                <input type="password" id="cpswd" name="cpswd" class='input-xlarge' value="">
                                                    
                                            </div>
                                    </div>
                                    <?php }  
                                    if ($user_role==1 or $user_role==2){    ?>

                                    <div class="control-group">
                                            <label for="pw" class="control-label right">Employee Id:  </label>
                                            <div class="controls">
                                                <input type="text" id="employee_id" name="employee_id" class='input-xlarge' value="<?php  echo $editddata['employee_id'];?>">
                                                    
                                            </div>
                                    </div>
                                    
                                    <div class="control-group">
                                            <label for="stat" class="control-label right">Status:</label>
                                            
                                            <div class="controls">
                                                
                                                <select name="userstatus" id="userstatus" class="input-xlarge">
                                                    
                                                    
                                                    <option value="Y" <?php if($editddata['status']=='Y')echo 'selected="selected"';?>>Active</option>
                                                    <option value="N" <?php if($editddata['status']=='N')echo 'selected="selected"';?>>Inactive</option>
                                                </select>
                                                    
                                            </div>
                                    </div>

                                    <?php } ?>

                                    <div class="form-actions">
                                        <input type="button"  id="sbtn" name="sbtn" class='btn btn-primary' value="Save">
                                            <input type="reset" class='btn' value="Discard changes">
                                    </div>
                                
                                <div class="alert alert-success span8" id="profilealert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="disp_message"> Success!</span></strong>
                                </div>
                                
                                    </div>
                                </div>
                </form>
                </div>
                <div class="tab-pane" id="econtact">
                    <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Econtact" id="contact" method="POST" class="form-horizontal">
                           <div class="span10">
                            
                            <div class="control-group">
                                            <label for="name" class="control-label right">Contact Name:</label>
                                            <div class="controls">
                                                <input type="text" id="name" name="name" class='input-xlarge' value="<?php  echo $editddata['eec_name'];?>">
                                            </div>
                            </div>
                            <div class="control-group">
                                            <label for="relation" class="control-label right">Relation:</label>
                                            <div class="controls">
                                                <input type="text" id="relation" name="relation" class='input-xlarge' value="<?php  echo $editddata['eec_relationship'];?>">
                                            </div>
                            </div>
                            <div class="control-group">
                                            <label for="address" class="control-label right">Contact Address:</label>
                                            <div class="controls">
                                                <textarea cols="50" rows="4" id="address" name="address" class='input-xlarge'><?php  echo $editddata['eec_address'];?></textarea>
                                            </div>
                            </div>
                            <div class="control-group">
                                            <label for="pin" class="control-label right">Pincode/Zip:</label>
                                            <div class="controls">
                                                <input type="text" id="pincode" name="pincode" class='input-xlarge' value="<?php  echo $editddata['eec_pincode'];?>" data-rule-number="true" data-rule-minlength="6" data-rule-maxlength="6" data-rule-required="true">
                                            </div>
                            </div>
                            
                            <div class="control-group">
                                            <label for="country" class="control-label right">Country:</label>
                                            
                                            <div class="controls" id="country">
                                            
                                                    <?php 
                                                    if ($editddata['eec_country']!='')
                                                        $selected_country = $editddata['eec_country'];
                                                    else
                                                        $selected_country = 99;

                                                    echo CHtml::dropDownList('countrylist', $selected_country, 
                                                        CHtml::listData(Countries::model()->findAll(),'id','country_name'),
                                                            array(
                                                            'class'=>'input-xlarge',)
                                                            ); ?>
                                            
                                                
                                            </div>
                            </div>
                            <div class="control-group">
                                            <label for="state" class="control-label right">State:</label>
                                            <div class="controls" id="state">
                                            
                                                <?php 

                                                 if ($editddata['eec_state']!='')
                                                        $selected_state = $editddata['eec_state'];
                                                    else
                                                        $selected_state = 17;

                                                echo CHtml::dropDownList('statelist', $selected_state, 
                                                        CHtml::listData(StateList::model()->findAll(),'id','state'),
                                                        array(
                                                            'class'=>'input-xlarge',)
                                                        ); ?>
                                            </div>
                            </div>
                            <div class="control-group">
                                            <label for="city" class="control-label right">City:</label>
                                            <div class="controls">
                                                <input type="text" id="city" name="city" class='input-xlarge' value="<?php  echo $editddata['eec_city'];?>">
                                            </div>
                            </div>
                            
                            
                            
                            
                            <div class="control-group">
                                            <label for="number" class="control-label right">Home Number:</label>
                                            <div class="controls">
                                                <input type="text" id="hnumber" name="hnumber" class='input-xlarge' value="<?php  echo $editddata['eec_home_no'];?>" data-rule-number="true" data-rule-required="true">
                                            </div>
                            </div>
                             <div class="control-group">
                                            <label for="number" class="control-label right">Mobile Number:</label>
                                            <div class="controls">
                                                <input type="text" id="mnumber" name="mnumber" class='input-xlarge' value="<?php  echo $editddata['eec_mobile_no'];?>" data-rule-number="true" data-rule-minlength="10" data-rule-maxlength="10" data-rule-required="true">
                                            </div>
                            </div>
                            <div class="control-group">
                                            <label for="number" class="control-label right">Office Number:</label>
                                            <div class="controls">
                                                <input type="text" id="onumber" name="onumber" class='input-xlarge' value="<?php  echo $editddata['eec_office_no'];?>">
                                            </div>
                            </div>
                            <div class="form-actions">
                                <input type="button" id="sbutton" name="sbutton" class='btn btn-primary' value="Save">
                                <input type="reset" class='btn' value="Discard changes">
                            </div>
                               <div class="alert alert-success span8" id="contactalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="contact_message">Success!</span></strong>
                                </div>
                          </div>                                                                                               
                    </form>
                </div>
              
            <div class="tab-pane" id="dependent">
            <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Dependent" class="form-horizontal" id="dependentform" method="POST" class="form-horizontal">

                   <div class="span5">

                    <div class="control-group">
                                    <label for="name" class="control-label right">Name:</label>
                                    <div class="controls">
                                        <input type="text" id="dname" name="dname" class='input-xlarge' value="">
                                    </div>
                    </div>                                                                                                  
                    
                    <div class="control-group">
                                            <label for="relation" class="control-label right">Relationship:</label>
                                            <div class="controls">
                                                
                                                <select required="" name="relationship" id="relationship" class="input-xlarge">
                                                    <option value="">--Select--</option>                                                    
                                                    <option value="father">Father</option>
                                                    <option value="mother">Mother</option>
                                                    <option value="brother">Brother</option>
                                                    <option value="sister">Sister</option>
                                                    <option value="wife">Wife</option>
                                                    <option value="son">Son</option>
                                                    <option value="daughter">Daughter</option>
                                                    <option value="other">Other</option>
                                                </select>                                                   
                                            </div>
                                            
                    </div>
                       <div class="control-group" id="otherdep" style="display: none;">
                                    <label for="other" class="control-label right">Other Dependent:</label>
                                    <div class="controls">
                                        <input type="text" id="odependent" name="odependent" class='input-xlarge' value="">
                                    </div>
                    </div>
                    
                     
                       <div class="control-group">
                            <label for="date" class="control-label right">DOB:</label>
                            <div class="controls">
                                <?php $dated = strtotime($editddata['dependent_dob']);?>
                                <?php $de=date('m-d-Y', $dated);?>
                                
                                <input type="text" name="dateofbirth" id="dateofbirth" class="input-medium datepick input-xlarge" 
                                       value="">                                               
                            </div>
                       </div>
                       
                       
                    <div class="form-actions">
                        <input type="button" id="depbutton" name="depbutton" class='btn btn-primary' value="Save">
                        <input type="reset" class='btn' value="Discard changes" id="depreset">
                    </div>   
                    <div class="alert alert-success span12" id="dependentalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="dependency_message">Success!</span></strong>
                    </div>
                        
                  </div>    

                  <div class="span7" id="dependent_div">

                    <table class="table table-hover table-nomargin table-bordered usertable" id="dependent_table">
            <thead>
                 
                    <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 25%;">Relation</th>
                            <th style="width: 25%;">Date of Birth</th>
                            <th class='hidden-480'>Options</th>
                    </tr>
            </thead>
            <!--
            <tbody>
                    <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@johndoe.com</td>
                            <td class='hidden-350'><span class="label label-satgreen">Active</span></td>
                            <td class='hidden-1024'>03-07-2013</td>
                            <td class='hidden-480'>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/View" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
                            </td>
                    </tr>
                    
                    
                    
                        
            </tbody>
        -->                     </table>


                  </div>                                           
                                                
                </form>
                </div>
            
            <div class="tab-pane" id="job">
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Job" class="form-horizontal" id="jobform" method="POST" class="form-horizontal">
                    
                    <div class="span10">
                        
                        <div class="control-group">
                                    <label for="title" class="control-label right">Job Title:</label>
                                   <?php  if ($user_role == 1 or $user_role == 2){ ?>
                                    <div class="controls" id="jtitle">
                                        
                                         <?php  
                                                
                                                if($editddata['job_title']!="")
                                                $sele = $editddata['job_title'];
                                                else 
                                                    $sele = 'empty'; 
                                                
                                                echo CHtml::dropDownList('jobtitle', $sele,
                                                        CHtml::listData(HrmJobTitle::model()->findAll(),'id','job_title'),
                                                        array(
                                                            'class'=>'input-xlarge',
                                                            'empty' => '--Select--',
                                                            )
                                                        ); 

                                           

                                                        ?>
                                    </div>  
                                <?php     }else{ ?>
                                                    <div class="controls pd" id="jtitle">

                                                    
                                      <?php  echo $editddata['job_title_real']; ?>
                                      </div>
                                     <?php          }                                                                                                        
                                    ?>
                        </div>
                        <div class="control-group">
                                    <label for="status" class="control-label right">Employment Status:</label>
                                     <?php if ($user_role == 1 or $user_role == 2){ ?>
                                    <div class="controls">
                                   
                                        <select required="" name="estatus" id="estatus" class="input-xlarge">
                                                    <option value="">--Select--</option>
                                                    <option value="1" <?php if($editddata['job_status']=='1')echo 'selected="selected"';?>>Probation</option>
                                                    <option value="2" <?php if($editddata['job_status']=='2')echo 'selected="selected"';?>>Part time</option>
                                                    <option value="3" <?php if($editddata['job_status']=='3')echo 'selected="selected"';?>>Full time</option>
                                                    <option value="4" <?php if($editddata['job_status']=='4')echo 'selected="selected"';?>>Remote</option>
                                                    <option value="5" <?php if($editddata['job_status']=='5')echo 'selected="selected"';?>>Consultant</option>
<option value="6" <?php if($editddata['job_status']=='6')echo 'selected="selected"';?>>Trainee</option>
                                                    
                                                </select>                                                                                                
                                       
                                    </div>
                                     <?php }else{ ?>
                                    <div class="controls pd">
                                      <?php   if($editddata['job_status']=='1')echo 'Probation';
                                        elseif($editddata['job_status']=='2')echo 'Part time';
                                        elseif($editddata['job_status']=='3')echo 'Full time';
                                        elseif($editddata['job_status']=='4')echo 'Remote'; 
                                        elseif($editddata['job_status']=='5')echo 'Consultant';  ?>
                                         </div>
                                   <?php  }?>
                        </div>
                        <div class="control-group">
                                    <label for="job" class="control-label right">Team:</label>
                                     <?php 
                                          if ($user_role == 1 or $user_role == 2){?>
                                    <div class="controls" id="jcategory">
                                        
                                       <?php  if($editddata['job_category']!="")
                                             $selected = $editddata['job_category'];
                                         else 
                                             $selected = 'empty';
                                             
                                                
                                         
                                         
                                         echo CHtml::dropDownList('jobcategory', $selected,
                                                        CHtml::listData(HrmJobCategory::model()->findAll(),'id','job_category'),
                                                        array(
                                                            'class'=>'input-xlarge',
                                                             'empty'=>'--Select--',
                                                            )
                                                        ); 
                                                        ?>
                                        
                                    </div>
                                  <?php  }else{ ?>
                                    <div class="controls pd" id="jcategory">
                                                       <?php     echo $editddata['job_category_real']; ?>

                                                       </div>
                                                           
                                       <?php                  }?>   
                        </div>
                        <div class="control-group">
                            <label for="date" class="control-label right">Joining Date:</label>
                            <?php if ($user_role == 1 or $user_role == 2){ ?>
                            <div class="controls">
                                <?php 
                               
                                $dis = strtotime($editddata['join_date']);?>
                                <?php $da=date('m-d-Y', $dis);?>
                                <input type="text" name="joindate" id="joindate" class="input-medium datepick input-xlarge" value="<?php 
                                if($editddata['join_date']!="")
                                echo $da;?>">  
                                                       
                            </div>
                               <?php }else{ ?>
                               <div class="controls pd">
                               <?php 
                                    if ($editddata['join_date']!=''){
                                        $dis = strtotime($editddata['join_date']);
                                        echo  date('D, M d, Y', $dis);
                                    } ?>
                                    
                                    </div>  
                                    <?php  } ?> 
                        </div>
                                                                     
                        <?php if ($user_role == 1 or $user_role == 2){ ?>
                        
                        <div class="form-actions">
                            <input type="button" id="jobbutton" name="jobbutton" class='btn btn-primary' value="Save">
                            <input type="reset" class='btn' value="Discard changes">
                        </div>
                        <div class="alert alert-success span8" id="jobalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="job_message"></span></strong>
                        </div>

                        <?php } ?>
                        
                    </div>
                    
                    
                </form>
                
                
            </div>
            
            <div class="tab-pane" id="leavedays">
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Leavedays" class="form-horizontal" id="leavedayform" method="POST" class="form-horizontal">
                    <div class="span5">
                        <div class="control-group">
                            <label for="leave" class="control-label right">Select Week Holidays:</label>
                            <div class="controls">
                                <select required="" name="leavelistbox[]" id="leavelistbox" size=7 multiple>                                    
                                    <option value='1' <?php if(in_array("1", $getleavedata)){?> selected="selected" <?php }  ?>>Monday</option>                                    
                                    <option value='2' <?php if(in_array("2", $getleavedata)){?> selected="selected" <?php } ?>>Tuesday</option>
                                    <option value='3' <?php if(in_array("3", $getleavedata)){?> selected="selected" <?php } ?>>Wednesday</option>
                                    <option value='4' <?php if(in_array("4", $getleavedata)){?> selected="selected" <?php } ?>>Thursday</option>
                                    <option value='5' <?php if(in_array("5", $getleavedata)){?> selected="selected" <?php } ?>>Friday</option>
                                    <option value='6' <?php if(in_array("6", $getleavedata)){?> selected="selected" <?php } ?>>Saturday</option>
                                    <option value='7' <?php if(in_array("7", $getleavedata)){?> selected="selected" <?php } ?>>Sunday</option>
                                </select>                           
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="button" id="leavebtn" name="leavebtn" class='btn btn-primary' value="Save">
                            <input type="reset" class='btn' value="Unselect">
                        </div> 
                        <div class="alert alert-success span8" id="leaveformalert" style="display: none;">
                            <button data-dismiss="alert" class="close" type="button"></button>
                            <strong><span id="leaveday_message">Success!</span></strong>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane" id="report">
                 <?php if ($user_role==1 or $user_role==2){?>
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Reportto" class="form-horizontal" id="reportform" method="POST" class="form-horizontal">
                    <div class="span10">
                        <div class="control-group">
                                    <label for="name" class="control-label right">Name:</label>
                                    <div class="controls">
                                        <input type="text" id="rname" name="rname" class='input-xlarge' value="<?php  echo $editddata['name'];?>">
                                    </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                    <label class='radio'>
                                        <input type="radio" name="reportto1" id="super" value="supervisor"> Supervisor
                                    </label>
                                    <label class='radio'>
                                        <input type="radio" name="reportto1" id="sub" value="subordinate"> Subordinate
                                    </label>
                                    
                            </div>
                        </div> 
                        <div id="leave_approval_div" style="display:none;">
                         <div class="control-group">
                            <label class="control-label"></label>
                            <div class="controls">
                                    <label class=''>
                                        <input type="checkbox" name="leave_approval" id="leave_approval" value="Y"> Leave approval needed?
                                    </label>
                                   
                                    
                            </div>
                        </div> 
                         <div class="control-group" id="order_div" style="display:none;">
                            <label class="control-label right">Approval Order No:</label>
                            <div class="controls">
                                    <label class=''>
                                        <input type="text" id="order_no" name="order_no" class='span1' value="">
                                    </label>
                                   
                                    
                            </div>
                        </div> 
                        </div>

                        
                        <div class="form-actions">
                            <input type="button" id="reportbutton" name="reportbutton" class='btn btn-primary' value="Save">
                            <input type="reset" class='btn' value="Discard changes" id="report_reset">
                        </div>
                        <div class="alert alert-success span8" id="reportalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="report_message">Success!</span></strong>
                        </div>
                        
                    </div>
                    <input type="hidden" id="report_user_id" name="report_user_id">
                </form>
                <?php } ?>

                    <div class="row-fluid">
                    <div class="span12">
                        <div class="box box-color box-bordered">
                            <div class="box-title">
                                <h3>
                                    Supervisors
                                </h3>                                                                                
                            </div>
                                                        
                                                    
                                                    
<div class="box-content nopadding">
    <div style="float: right;padding-top: 9px;padding-right: 5px;"></div>
<table class="table table-hover table-nomargin table-bordered usertable" id="super_table">
            <thead>
                 
                    <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 40%;">Name</th>
                        
                            <th style="width: 20%;">Leave Approval Needed?</th>
                            <?php if ($user_role==1 or $user_role==2){?>
                            <th class='hidden-480'>Options</th>
                            <?php } ?>
                    </tr>
            </thead>
            <!--
            <tbody>
                    <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@johndoe.com</td>
                            <td class='hidden-350'><span class="label label-satgreen">Active</span></td>
                            <td class='hidden-1024'>03-07-2013</td>
                            <td class='hidden-480'>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/View" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
                            </td>
                    </tr>
                    
                    
                    
                        
            </tbody>
        -->                     </table>
                            </div>
                        </div>
                    </div>
                </div>
                


                <div class="row-fluid">
                    <div class="span12">
                        <div class="box box-color box-bordered">
                            <div class="box-title">
                                <h3>
                                    Subordinates
                                </h3>                                                                                
                            </div>
                                                        
                                                    
                                                    
<div class="box-content nopadding">
    <div style="float: right;padding-top: 9px;padding-right: 5px;"></div>
<table class="table table-hover table-nomargin table-bordered usertable" id="sub_table">
            <thead>
                 
                    <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Name</th>
                            
                         
                            <?php if ($user_role==1 or $user_role==2){?>
                            <th class='hidden-480'>Options</th>
                            <?php } ?>
                    </tr>
            </thead>
            <!--
            <tbody>
                    <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@johndoe.com</td>
                            <td class='hidden-350'><span class="label label-satgreen">Active</span></td>
                            <td class='hidden-1024'>03-07-2013</td>
                            <td class='hidden-480'>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/View" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
                            </td>
                    </tr>
                    
                    
                    
                        
            </tbody>
        -->                     </table>
                            </div>
                        </div>
                    </div>
                </div>


                
            </div>
            
            
            
            <div class="tab-pane" id="salary">
                <form action="" class="form-horizontal" id="salaryform" method="POST" class="form-horizontal">
                    <div class="span10">
                        <div class="control-group">
                                    <label for="pay" class="control-label right">Pay Grade:</label>
                                    <div class="controls">
                                        <input type="text" id="pgrade" name="pgrade" class='input-xlarge' value="">
                                    </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label right">Salary Components:</label>
                            <div class="controls">
                                    <label class='checkbox'>
                                        <input type="checkbox" id="component1" name="component1" > Basic Salary
                                    </label>
                                    <label class='checkbox'>
                                        <input type="checkbox" id="component2" name="component2"> ipsum eiusmod
                                    </label>
                                    <label class='checkbox'>
                                        <input type="checkbox" id="component3" name="component3"> Eiusmod lorem ipsum
                                    </label>
                            </div>
                        </div>
                        
                        <div class="control-group">
                                    <label for="amt" class="control-label right">Salary Amount-CTC:</label>
                                    <div class="controls">
                                        <input type="text" id="amount" name="amount" class='input-xlarge' value="">
                                    </div>
                        </div>
                        <div class="control-group">
                                    <label for="status" class="control-label right">Salary Account Types:</label>
                                    <div class="controls">
                                        <select required="" name="accounttypes" id="accounttypes" class="input-xlarge">
                                                    <option value=""></option>
                                                    <option value="1">Current Account</option>
                                                    <option value="2">Savings Account</option>
                                                    <option value="3">Recurring Account</option>
                                                    <option value="4">Fixed Account</option>
                                                </select>                                                                                                
                                        
                                    </div>
                        </div>
                        <div class="form-actions">
                            <input type="button" id="salarybutton" name="salarybutton" class='btn btn-primary' value="Save">
                            <input type="reset" class='btn' value="Discard changes">
                        </div>
                        <div class="alert alert-success span8" id="salaryalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong>          Success!</strong>
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



    
</body>
<script type="text/javascript">
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";

    var empno="<?php echo $emp_number; ?>";
    //var user_role = "<?php echo $user_role;?>";

</script>
<script src="js/profile.js"></script>
<script src="js/contact.js"></script>
<script src="js/dependency.js"></script>
<script src="js/job.js"></script>
<script src="js/salary.js"></script>
<script src="js/reportto.js"></script>
<script src="js/leavedays.js"></script>

