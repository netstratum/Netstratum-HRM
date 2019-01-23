  
    
    <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/UserReg" id="profileform" method="POST" class="form-horizontal" 
          enctype="multipart/form-data">
       



           <div class="row">
          
          <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              
              
              <div class="panel-body">


        
            
            <input type="hidden" name='empnumber' id="empnumber" value="<?php echo $emp_number;?>"/>
            
      

               





        
                                    <?php if ($user_role == 1){ ?>
                                    <div class="form-group">
                                        
                                        
                                            <label for="name" class="col-sm-3 control-label">User Role: * </label>
                                             <div class="col-sm-5"> 
                                             <?php echo CHtml::dropDownList('userrole',$editddata['user_role_id'], CHtml::listData(HrmUserRole::model()->findAll(), 'id',
                                                        'display_name'),   array(
                                                            'class'=>'contactField',)                                        
                                                                              ); ?>
                                            </div>
                                    </div>

                                    <?php } ?>
                                    <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">First Name: * </label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="fname" name="fname" class='contactField' value="<?php  echo $editddata['emp_firstname'];?>">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Middle Name:</label>
                                             <div class="col-sm-5"> 
                                                <input type="text" id="mname" name="mname" class='contactField' value="<?php  echo $editddata['emp_middle_name'];?>">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Last Name: * </label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="lname" name="lname" class='contactField' value="<?php  echo $editddata['emp_lastname'];?>">
                                            </div>
                                    </div>
                                      <div class="form-group">
                                            <label for="pw" class="col-sm-3 control-label">Date of Birth:  </label>
                                             <div class="col-sm-5"> 
                                                <input type="text" id="emp_dob" name="emp_dob" class='contactField' value="<?php  if ($editddata['emp_dob']!='0000-00-00' and $editddata['emp_dob']!='' ){echo date('m/d/Y',strtotime($editddata['emp_dob'])); }?>">
                                                    
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="phone" class="col-sm-3 control-label">Mobile Number:  </label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="mobilenumber" name="mobilenumber" class='contactField' value="<?php  echo $editddata['mobile_number'];?>">
                                            </div>
                                    </div>
                                <?php 
                                    if($emp_number=="")
                                    {
                                        
                                    ?>
                                     <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Gender: * </label>
                                             <div class="col-sm-5"> 
                                            <div style="float:left;padding:5px;">   <input type="radio" id="gender1" name="gender"  class='contactField' value="M" <?php  if($editddata['emp_gender']=='M'){echo "checked=checked";}?>> </div>  <label style="padding:5px;float:left;"> Male</label> <div style="float:left;margin-left:10px;padding:5px;"><input type="radio" id="gender2" name="gender"  class='contactField' value="F" <?php  if($editddata['emp_gender']=='F'){echo "checked=checked";}?>></div> <label style="padding:5px;float:left;">Female</label>
                                               <div id="emp_gender" style="padding-top:5px;padding-left:20px;"> </div>    
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Username: * </label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="uname" name="uname" data-rule-email="true" class='contactField' value="<?php  echo $editddata['user_name'];?>">
                                                    
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="pw" class="col-sm-3 control-label">Password: * </label>
                                              <div class="col-sm-5"> 
                                                <input type="password" id="pswd" name="pswd" class='contactField' value="">
                                                    
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="pw" class="col-sm-3 control-label">Confirm Password: * </label>
                                              <div class="col-sm-5"> 
                                                <input type="password" id="cpswd" name="cpswd" class='contactField' value="">
                                                    
                                            </div>
                                    </div>
                                    <?php }  
                                    if ($user_role==1 or $user_role==2){    ?>

                                    <div class="form-group">
                                            <label for="pw" class="col-sm-3 control-label">Employee Id:  </label>
                                             <div class="col-sm-5"> 
                                                <input type="text" id="employee_id" name="employee_id" class='contactField' value="<?php  echo $editddata['employee_id'];?>">
                                                    
                                            </div>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label for="stat" class="col-sm-3 control-label">Status:</label>
                                            
                                              <div class="col-sm-5"> 
                                                
                                                <select name="userstatus" id="userstatus" class="contactField">
                                                    
                                                    
                                                    <option value="Y" <?php if($editddata['status']=='Y')echo 'selected="selected"';?>>Active</option>
                                                    <option value="N" <?php if($editddata['status']=='N')echo 'selected="selected"';?>>Inactive</option>
                                                </select>
                                                    
                                            </div>
                                    </div>

                                    <?php } ?>
  <div class="form-group">
                    
                    <div class="col-sm-offset-3 col-sm-5">
                      
                      <button type="submit" class="btn btn-default buttonWrap button button-green contactSubmitButton" id="sbtn" name="sbtn" value="Save">
                        Save
                      </button>
                      
                    </div>
                    
                  </div>
                                    
                                
                                <div class="alert alert-success span8" id="profilealert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="disp_message"> Success!</span></strong>
                                </div>
                                
                                    </div>
                                </div>
                                </div></div>
                </form><script src="js/profile.js"></script>|
                    <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Econtact" id="contact" method="POST" class="form-horizontal">
                           


           <div class="row">
          
          <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              <div class="panel-heading">
                
                <div class="panel-title">
                 
                </div>                                
                
              </div>
              
              <div class="panel-body">
                            
                            <div class="form-group">
                                            <label for="name" class="col-sm-3 control-label">Contact Name:</label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="name" name="name" class='contactField' value="<?php  echo $editddata['eec_name'];?>">
                                            </div>
                            </div>
                            <div class="form-group">
                                            <label for="relation" class="col-sm-3 control-label">Relation:</label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="relation" name="relation" class='contactField' value="<?php  echo $editddata['eec_relationship'];?>">
                                            </div>
                            </div>
                            <div class="form-group">
                                            <label for="address" class="col-sm-3 control-label">Contact Address:</label>
                                              <div class="col-sm-5"> 
                                                <textarea cols="50" rows="4" id="address" name="address" class='contactField'><?php  echo $editddata['eec_address'];?></textarea>
                                            </div>
                            </div>
                            <div class="form-group">
                                            <label for="pin" class="col-sm-3 control-label">Pincode/Zip:</label>
                                              <div class="col-sm-5"> 
                                                <input type="text" id="pincode" name="pincode" class='contactField' value="<?php  echo $editddata['eec_pincode'];?>" data-rule-number="true" data-rule-minlength="6" data-rule-maxlength="6" data-rule-required="true">
                                            </div>
                            </div>
                            
                            <div class="form-group">
                                            <label for="country" class="col-sm-3 control-label">Country:</label>
                                            
                                            <div class="col-sm-5" id="country">
                                            
                                                    <?php 
                                                    if ($editddata['eec_country']!='')
                                                        $selected_country = $editddata['eec_country'];
                                                    else
                                                        $selected_country = 99;

                                                    echo CHtml::dropDownList('countrylist', $selected_country, 
                                                        CHtml::listData(Countries::model()->findAll(),'id','country_name'),
                                                            array(
                                                            'class'=>'contactField',)
                                                            ); ?>
                                            
                                                
                                            </div>
                            </div>
                            <div class="form-group">
                                            <label for="state" class="col-sm-3 control-label">State:</label>
                                            <div class="col-sm-5" id="state">
                                            
                                                <?php 

                                                 if ($editddata['eec_state']!='')
                                                        $selected_state = $editddata['eec_state'];
                                                    else
                                                        $selected_state = 17;

                                                echo CHtml::dropDownList('statelist', $selected_state, 
                                                        CHtml::listData(StateList::model()->findAll(),'id','state'),
                                                        array(
                                                            'class'=>'contactField',)
                                                        ); ?>
                                            </div>
                            </div>
                            <div class="form-group">
                                            <label for="city" class="col-sm-3 control-label">City:</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="city" name="city" class='contactField' value="<?php  echo $editddata['eec_city'];?>">
                                            </div>
                            </div>
                            
                            
                            
                            
                            <div class="form-group">
                                            <label for="number" class="col-sm-3 control-label">Home Number:</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="hnumber" name="hnumber" class='contactField' value="<?php  echo $editddata['eec_home_no'];?>" data-rule-number="true" data-rule-required="true">
                                            </div>
                            </div>
                             <div class="form-group">
                                            <label for="number" class="col-sm-3 control-label">Mobile Number:</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="mnumber" name="mnumber" class='contactField' value="<?php  echo $editddata['eec_mobile_no'];?>" data-rule-number="true" data-rule-minlength="10" data-rule-maxlength="10" data-rule-required="true">
                                            </div>
                            </div>
                            <div class="form-group">
                                            <label for="number" class="col-sm-3 control-label">Office Number:</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="onumber" name="onumber" class='contactField' value="<?php  echo $editddata['eec_office_no'];?>">
                                            </div>
                            </div>

                       <div class="form-group">
                    
                    <div class="col-sm-offset-3 col-sm-5">
                      
                      <button type="submit" class="btn btn-default buttonWrap button button-green contactSubmitButton" id="sbutton" name="sbutton" value="Save">
                        Save
                      </button>
                      
                    </div>
                    
                  </div>


                          
                               <div class="alert alert-success span8" id="contactalert" style="display: none;">
                                    <button data-dismiss="alert" class="close" type="button"></button>
                                    <strong><span id="contact_message">Contact details updated!</span></strong>
                               </div>
                          </div>  
                          </div>
                          </div>
                          </div>                                                                                             
                    </form><script src="js/contact.js"></script>|
                




              
           
            <form action="#" class="form-horizontal" id="dependentform" method="POST" >

                  <div class="row">
          
          <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              <div class="panel-heading">
                
                <div class="panel-title">
                  
                </div>                                
                
              </div>
              
              <div class="panel-body">

                    <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Name:</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="dname" name="dname" class='contactField' value="">
                                    </div>
                    </div>                                                                                                  
                    
                    <div class="form-group">
                                            <label for="relation" class="col-sm-3 control-label">Relationship:</label>
                                            <div class="col-sm-5">
                                                
                                                <select required="" name="relationship" id="relationship" class="contactField">
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
                       <div class="form-group" id="otherdep" style="display: none;">
                                    <label for="other" class="col-sm-3 control-label">Other Dependent:</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="odependent" name="odependent" class='contactField' value="">
                                    </div>
                    </div>
                    
                     
                       <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">DOB:</label>
                            <div class="col-sm-5">
                                <?php $dated = strtotime($editddata['dependent_dob']);?>
                                <?php $de=date('m-d-Y', $dated);?>
                                
                                <input type="text" name="dateofbirth" id="dateofbirth" class="input-medium datepick contactField" 
                                       value="">                                               
                            </div>
                       </div>
                   <div class="form-group">
                    
                    <div class="col-sm-offset-3 col-sm-5">
                      
                      <button type="submit" class="btn btn-default buttonWrap button button-green contactSubmitButton" id="depbutton" name="depbutton" value="Save">
                       Save
                      </button>
                      
                    </div>
                    
                  </div>
 
                       
                   
                    <div class="alert alert-success span12" id="dependentalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="dependency_message">Success!</span></strong>
                    </div>
                        
                  </div>   


                  <div class="span7" id="dependent_div">

                    <table class="display no-wrap dataTable dtr-inline" cellspacing="0" width="100%" role="grid" style="width: 100%;" id="dependent_table">
            <thead>
                 
                    <tr>
                            <th >ID</th>
                            <th >Name</th>
                            <th >Relation</th>
                            <th >Date of Birth</th>
                            <th >Options</th>
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
                </form><script src="js/dependency.js"></script>|
                
            


















            
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Job" class="form-horizontal" id="jobform" method="POST" class="form-horizontal">
                    
                      <div class="row">
          
          <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              <div class="panel-heading">
                
                <div class="panel-title">
                 
                </div>                                
                
              </div>
              
              <div class="panel-body">
                        
                        <div class="form-group">
                        <?php  if ($user_role == 1){ ?>
                                    <label for="title" class="col-sm-3 control-label">Job Title:</label>
                                   
                                    <div class="col-sm-5" id="jtitle">
                                        
                                         <?php  
                                                
                                                if($editddata['job_title']!="")
                                                $sele = $editddata['job_title'];
                                                else 
                                                    $sele = 'empty'; 
                                                
                                                echo CHtml::dropDownList('jobtitle', $sele,
                                                        CHtml::listData(HrmJobTitle::model()->findAll(),'id','job_title'),
                                                        array(
                                                            'class'=>'contactField',
                                                            'empty' => '--Select--',
                                                            )
                                                        ); 

                                           

                                                        ?>
                                    </div>  
                                <?php     }else{ ?>


                                <table cellspacing="0" class="table">
                    <tbody>
                    <tr>
                        <td class="table-sub-title"> Job Title:</td>
                        <td style="text-align:left;"><?php  echo $editddata['job_title_real']; ?></td>
                       
                    </tr>
                   
               

                             
                                     <?php          }                                                                                                        
                                    ?>
                        </div>
                        <div class="form-group">
                         <?php if ($user_role == 1){ ?>
                                    <label for="status" class="col-sm-3 control-label">Employment Status:</label>
                                    
                                    <div class="col-sm-5">
                                   
                                        <select required="" name="estatus" id="estatus" class="contactField">
                                            <option value="">--Select--</option>
                                            <option value="1" <?php if($editddata['job_status']=='1')echo 'selected="selected"';?>>Probation</option>
                                            <option value="2" <?php if($editddata['job_status']=='2')echo 'selected="selected"';?>>Part time</option>
                                            <option value="3" <?php if($editddata['job_status']=='3')echo 'selected="selected"';?>>Full time</option>
                                            <option value="4" <?php if($editddata['job_status']=='4')echo 'selected="selected"';?>>Remote</option>
                                            <option value="5" <?php if($editddata['job_status']=='5')echo 'selected="selected"';?>>Consultant</option>
                                        </select>                                                                                                
                                       
                                    </div>
                                     <?php }else{ ?>
                                   
 <tr>
                        <td class="table-sub-title"> Employment Status:</td>
                        <td style="text-align:left;">  <?php   if($editddata['job_status']=='1')echo 'Probation';
                                        elseif($editddata['job_status']=='2')echo 'Part time';
                                        elseif($editddata['job_status']=='3')echo 'Full time';
                                        elseif($editddata['job_status']=='4')echo 'Remote'; 
                                        elseif($editddata['job_status']=='5')echo 'Consultant';  ?></td>
                       
                    </tr>

                                         




                                   <?php  }?>
                        </div>
                        <div class="form-group">
                         <?php 
                                          if ($user_role == 1){?>
                                    <label for="job" class="col-sm-3 control-label">Team:</label>
                                    
                                    <div class="col-sm-5" id="jcategory">
                                        
                                       <?php  if($editddata['job_category']!="")
                                             $selected = $editddata['job_category'];
                                         else 
                                             $selected = 'empty';
                                             
                                                
                                         
                                         
                                         echo CHtml::dropDownList('jobcategory', $selected,
                                                        CHtml::listData(HrmJobCategory::model()->findAll(),'id','job_category'),
                                                        array(
                                                            'class'=>'contactField',
                                                             'empty'=>'--Select--',
                                                            )
                                                        ); 
                                                        ?>
                                        
                                    </div>
                                  <?php  }else{ ?>
                                   
 <tr>
                        <td class="table-sub-title">Team:</td>
                        <td style="text-align:left;">    <?php     echo $editddata['job_category_real']; ?></td>
                       
                    </tr>
                                  


                                                           
                                       <?php                  }?>   
                        </div>
                        <div class="form-group">
                        <?php if ($user_role == 1){ ?>
                            <label for="date" class="col-sm-3 control-label">Joining Date:</label>
                            
                            <div class="col-sm-5">
                                <?php 
                               
                                $dis = strtotime($editddata['join_date']);?>
                                <?php $da=date('m-d-Y', $dis);?>
                                <input type="text" name="joindate" id="joindate" class="input-medium datepick contactField" value="<?php 
                                if($editddata['join_date']!="")
                                echo $da;?>">  
                                                       
                            </div>
                               <?php }else{ ?>
                             
<tr>
                        <td class="table-sub-title">Joining Date:</td>
                        <td style="text-align:left;">     <?php 
                                    if ($editddata['join_date']!=''){
                                        $dis = strtotime($editddata['join_date']);
                                        echo  date('D, M d, Y', $dis);
                                    } ?></td>
                       
                    </tr>
  
                                    
                                    
                                    <?php  } ?> 
                        </div>
                                                                     
                        <?php if ($user_role == 1){ ?>
                        
                        <div class="form-actions">
                            <input type="button" id="jobbutton" name="jobbutton" class='btn btn-primary buttonWrap button button-green contactSubmitButton' value="Save">
                            
                        </div>
                        <div class="alert alert-success span8" id="jobalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong><span id="job_message">Success!</span></strong>
                        </div>

                        <?php } ?>
                        
                    </div>
                    </div>
                    </div>
                    </div>
                    
                </form><script src="js/job.js"></script>|
                
                
           





            
           
                <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Leavedays" class="form-horizontal" id="leavedayform" method="POST" class="form-horizontal">
                     <div class="row">
          
          <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              <div class="panel-heading">
                
                <div class="panel-title">
                  Holiday Form
                </div>                                
                
              </div>
              
              <div class="panel-body">
                        <div class="form-group">
                            <label for="leave" class="col-sm-3 control-label">Select Week Holidays:</label>
                            <div class="col-sm-5">
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

                          <div class="form-group">
                    
                    <div class="col-sm-offset-3 col-sm-5">
                      
                      <button type="submit" class="btn btn-default buttonWrap button button-green contactSubmitButton" id="leavebtn" name="leavebtn" value="Save">
                        Save
                      </button>
                      
                    </div>
                    
                  </div>

                      
                        <div class="alert alert-success span8" id="leaveformalert" style="display: none;">
                            <button data-dismiss="alert" class="close" type="button"></button>
                            <strong><span id="leaveday_message">Success!</span></strong>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>

                </form>|
            







 <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              <div class="panel-heading">
                
                                           
                
              </div>
              
              <div class="panel-body">
           
                 <?php if ($user_role==1 or $user_role==2){?>

                
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
<table class="display no-wrap dataTable dtr-inline" cellspacing="0" width="100%" role="grid" style="width: 100%;" id="super_table">
            <thead>
                 
                    <tr>
                            <th >ID</th>
                            <th >Name</th>
                        
                            <th >Leave Approval Needed?</th>
                            
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
                


                <div class="row-fluid" style="margin-top:6px;">
                    <div class="span12">
                        <div class="box box-color box-bordered">
                            <div class="box-title">
                                <h3>
                                    Subordinates
                                </h3>                                                                                
                            </div>
                                                        
                                                    
                                                    
<div class="box-content nopadding">
    <div style="float: right;padding-top: 9px;padding-right: 5px;"></div>
<table class="display no-wrap dataTable dtr-inline" cellspacing="0" width="100%" role="grid" style="width: 100%;" id="sub_table">
            <thead>
                 
                    <tr>
                            <th >ID</th>
                            <th >Name</th>
                            
                         
                            
                           
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
                </div><script src="js/reportto.js"></script>|

                </div>
                </div>
                </div>

                
           
            
            
            
            
                <form action="" class="form-horizontal" id="salaryform" method="POST" class="form-horizontal">
                      <div class="row">
          
          <div class="col-md-12">
            
            <div class="panel panel-primary" data-collapsed="0">
              
              <div class="panel-heading">
                
                <div class="panel-title">
                  Salary Details
                </div>                                
                
              </div>
              
              <div class="panel-body">
                        <div class="form-group">
                                    <label for="pay" class="col-sm-3 control-label">Pay Grade:</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="pgrade" name="pgrade" class='contactField' value="">
                                    </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Salary Components:</label>
                            <div class="col-sm-5">
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
                        
                        <div class="form-group">
                                    <label for="amt" class="col-sm-3 control-label">Salary Amount-CTC:</label>
                                    <div class="col-sm-5">
                                        <input type="text" id="amount" name="amount" class='contactField' value="">
                                    </div>
                        </div>
                        <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Salary Account Types:</label>
                                    <div class="col-sm-5">
                                        <select required="" name="accounttypes" id="accounttypes" class="contactField">
                                                    <option value=""></option>
                                                    <option value="1">Current Account</option>
                                                    <option value="2">Savings Account</option>
                                                    <option value="3">Recurring Account</option>
                                                    <option value="4">Fixed Account</option>
                                                </select>                                                                                                
                                        
                                    </div>
                        </div>
                       

                         <div class="form-group">
                    
                    <div class="col-sm-offset-3 col-sm-5">
                      
                      <button type="submit" class="btn btn-default buttonWrap button button-green contactSubmitButton" id="salarybutton" name="salarybutton" value="Save">
                        Save
                      </button>
                      
                    </div>
                    
                  </div>
                        
                        <div class="alert alert-success span8" id="salaryalert" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong>          Success!</strong>
                        </div>
                        
                    </div>
                    </div>
                    </div>
                    </div>

                </form>
                
                
            
            
                     

    
</body>
<script type="text/javascript">
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";

    var empno="<?php echo $emp_number; ?>";
    //var user_role = "<?php echo $user_role;?>";

</script>






<script src="js/leavedays.js"></script>


