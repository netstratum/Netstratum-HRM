<?php

class ManageuserController extends Controller
{

        

    public function actionIndex()
    {     
        $this->render('index');
    }


        public function actionManage()
        {                      
            Yii::app()->red->redirect();  // for session redirection
            $this->render('manage',"",FALSE);
        }
        public function actionManage_app()
        {                      
           $this->layout = FALSE;
           echo  $this->render('manage_app');
           exit;
        }
        
        public function actionNotifier()
        {
            Yii::app()->red->redirect();
            $this->render('adminnotifier',"",FALSE);
        }

        public function actionshoappmenu()
        {

           $session = new CHttpSession;
           $session->open();
          $session['empnumber']=$_REQUEST['employeeno'];
          $session['role']=$_REQUEST['roleid'];
	$add['id'] = $_REQUEST['userid'];
	if(file_exists('profilepictures/thumbimg-'.$add['id'].'.jpg')){
		$img = "yes";
	}
	else{
		$img = "no";	
		}
         echo    $this->getMenu_app(0,$session['role'],'top')."|".$img;
	
        }

        public function getMenu_app($parent_id,$role_id,$type){
                        
        
        
         $obj = new HrmMenuItem(); 
         $menu =  $obj->getmenu_app($parent_id,$role_id,$type);
         $allsupervisors = HrmLeave::model()->Supervisor_check();
          

         
          if ($role_id>1)
          { ?>

               
               
                <div class="nav-item">
                  <?php if (in_array($_REQUEST['selected'],array('profile','emergency','dependency','job','reportto'))){?> 
                    <a href="#" class="submenu-deploy">Manage Profile<em class=""></em></a>

                    
                     <div class="nav-item-submenu" style="display:block;">
                     <?php }else{ ?>
                      <a href="#" class="submenu-deploy">Manage Profile<em class="dropdown-nav"></em></a>
                     
                      <div class="nav-item-submenu" >

                     <?php } ?>
                      <a class="ui-link" href="profile.html" rel="">Profile <?php if ($_REQUEST['selected'] =='profile'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="emergency.html" rel="">Emergency Contact <?php if ($_REQUEST['selected'] =='emergency'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="dependency.html" rel="">Dependency <?php if ($_REQUEST['selected'] =='dependency'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="job.html" rel="">Job <?php if ($_REQUEST['selected'] =='job'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="reportto.html" rel="">Report To <?php if ($_REQUEST['selected'] =='reportto'){?> <em class="selected-nav"></em><?php }?></a>
            
                    </div>
                </div>

                 <div class="nav-item">
                   
                      <?php if (in_array($_REQUEST['selected'],array('apply_leave','myleave_status','assign_leave','employee_status','leave_balance_all','leave_balance'))){?> 
                     <a href="#"  class="submenu-deploy">Manage Leave<em class=""></em></a>
                     <div class="nav-item-submenu" style="display:block;">
                     <?php }else{ ?>
                     
                      <a href="#"  class="submenu-deploy">Manage Leave<em class="dropdown-nav"></em></a>
                      <div class="nav-item-submenu" >

                     <?php } ?>

                     <?php if ($role_id == 2){?>
                      <a class="ui-link" href="apply_leave.html" rel="">Apply Leave <?php if ($_REQUEST['selected'] =='apply_leave'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="myleave_status.html" rel="">My Leave Status <?php if ($_REQUEST['selected'] =='myleave_status'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="assign_leave.html" rel="">Assign Leave <?php if ($_REQUEST['selected'] =='assign_leave'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="employee_status.html" rel="">Employee Leave Status <?php if ($_REQUEST['selected'] =='employee_status'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="leave_balance_all.html" rel="">Employee Leave Balance <?php if ($_REQUEST['selected'] =='leave_balance_all'){?> <em class="selected-nav"></em><?php }?></a>
                      <?php }else{ ?>
                       <a class="ui-link" href="apply_leave.html" rel="">Apply Leave <?php if ($_REQUEST['selected'] =='apply_leave'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="myleave_status.html" rel="">My Leave Status <?php if ($_REQUEST['selected'] =='myleave_status'){?> <em class="selected-nav"></em><?php }?></a>
                      <?php if ($allsupervisors>0){?>
                      <a class="ui-link" href="employee_status.html" rel="">Subordinate Leave Status <?php if ($_REQUEST['selected'] =='employee_status'){?> <em class="selected-nav"></em><?php }?></a>
                      <?php }?>
                      <a class="ui-link" href="leave_balance.html" rel="">My Leave Balance <?php if ($_REQUEST['selected'] =='leave_balance'){?> <em class="selected-nav"></em><?php }?></a>

                      <?php }?>
                    
            
                    </div>
                </div>

              
<?php
          }else{ ?>

<div class="nav-item">
            <?php if (in_array($_REQUEST['selected'],array('apply_leave','myleave_status','assign_leave','employee_status','leave_balance_all','leave_balance'))){?> 
                      <a href="#" class="submenu-deploy" >Manage Leave<em class=""></em></a>
                     <div class="nav-item-submenu" style="display:block;">
                     <?php }else{ ?>
                      <a href="#" class="submenu-deploy" >Manage Leave<em class="dropdown-nav"></em></a>
                      <div class="nav-item-submenu" >

                     <?php } ?>
                   
                    
                     
                      <a class="ui-link" href="assign_leave.html" rel="">Assign Leave  <?php if ($_REQUEST['selected'] =='assign_leave'){?> <em class="selected-nav"></em><?php }?></a>
                      <a class="ui-link" href="employee_status.html" rel="">Employee Leave Status  <?php if ($_REQUEST['selected'] =='employee_status'){?> <em class="selected-nav"></em><?php }?></a>
                     <a class="ui-link" href="leave_balance_all.html" rel="">Leave Balance  <?php if ($_REQUEST['selected'] =='leave_balance_all'){?> <em class="selected-nav"></em><?php }?></a>
                    
            
                    </div>
                </div>


       <?php    }
        
    }

        public function actionView() {
            #$this->layout=FALSE;
            Yii::app()->red->redirect();  // for session redirection
          
            $obj = new HrmUserRole();
            $session=new CHttpSession;
            $session->open();
            $leave = new HrmLeaveDays();

            
                    

            if(isset($_REQUEST['emp_number']))
            {    
               
               if($_REQUEST['emp_number']>0 and ($session['user_role']==1 or $session['user_role']==2)){ 
                    $getalldata = HrmUserMaster::model()->getalldetails($_REQUEST['emp_number']); 
                    $emp_number = $_REQUEST['emp_number'];
                    $leavedata = $leave->selectdays($emp_number);
                    foreach ($leavedata as $data){
                            $selected[] = $data['week_days'];                    
                        }
               }
               else{
                     $getalldata = HrmUserMaster::model()->getalldetails($session['empnumber']);
                     $emp_number = $session['empnumber'];
               }               
            }
            elseif ($session['user_role']!=1 and $session['user_role']!=2){
                $getalldata = HrmUserMaster::model()->getalldetails($session['empnumber']);
                $emp_number = $session['empnumber'];
                
            }else{
              $getalldata = array();
            }
            
          
           
            
            
            $this->render('viewprofile',array('model'=>$obj,'editddata'=>$getalldata,'emp_number'=>$emp_number,'user_role'=>$session['user_role'],'getleavedata'=>$selected));
                               
        }

        public function actionView_app() {
        
            $obj = new HrmUserRole();
            $session=new CHttpSession;
            $session->open();
            $leave = new HrmLeaveDays();

            $session['user_role'] = $_REQUEST['user_role'];
            $session['empnumber'] = $_REQUEST['emp_number'];       
            
            if(isset($_REQUEST['emp_number']))
            {    
               
               if($_REQUEST['emp_number']>0 and ($session['user_role']==1 or $session['user_role']==2)){ 
                    $getalldata = HrmUserMaster::model()->getalldetails($_REQUEST['emp_number']); 
                    $emp_number = $_REQUEST['emp_number'];
                    $leavedata = $leave->selectdays($emp_number);
                    foreach ($leavedata as $data){
                            $selected[] = $data['week_days'];                    
                        }
               }
               else{
                     $getalldata = HrmUserMaster::model()->getalldetails($session['empnumber']);
                     $emp_number = $session['empnumber'];
               }  

            }
            
            elseif ($session['user_role']!=1 and $session['user_role']!=2){
             
                $getalldata = HrmUserMaster::model()->getalldetails($session['empnumber']);
                $emp_number = $session['empnumber'];
                
            }else{
              $getalldata = array();
            }
            
          
           $this->layout = FALSE;
            
          echo  trim($this->render('viewprofile_app',array('model'=>$obj,'editddata'=>$getalldata,'emp_number'=>$emp_number,'user_role'=>$session['user_role'],'getleavedata'=>$selected)));
                exit;               
        }

        
        public function actionAddressbook()
        {   
            $addbook = HrmUserMaster::model()->addressbook();
            $this->layout = FALSE;
            echo $this->render('address',array('addressbook'=>$addbook),true);
        }
        
        public function actionSearchaddressbook()
        {   $term = $_REQUEST['term'];
            $searchempname = HrmUserMaster::model()->searchaddressbook($term);
            echo json_encode($searchempname);
        }
        
        public function actionShowaddressbook()
        {
            if($_REQUEST['empnumb']>0)
            $empsearch = HrmUserMaster::model()->emplyeeaddress($_REQUEST['empnumb'],$_REQUEST['searchdata']);
            else
              $empsearch =     HrmUserMaster::model()->addressbook($_REQUEST['searchdata']);
                
            $this->layout = FALSE;
            echo $this->render('address',array('addressbook'=>$empsearch),true);
        }
        public function actionEmployeenotification()
        {   $session = new CHttpSession;
            $session->open();
            $empnotices = HrmUserMaster::model()->getemployeenotifications($session['empnumber']);
          
            $this->layout = FALSE;
            echo $this->render('employeenotifications',array('notices'=>$empnotices),TRUE);
        }
        public function actionGetfooters()
        {    
            $session = new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['empno'];
            $footerdata = HrmLeave::model()->Supervisor_check();
            $userrole = $_REQUEST['emproll'];
            
            
            
            $this->layout = FALSE;
            echo $this->render('footermenu',array('superfooter'=>$footerdata,'roledata'=>$userrole),TRUE);
        }
	
	public function actionGetdashboard()
        {
            $session = new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['empno'];
            echo $footerdata = HrmLeave::model()->Supervisor_check();
                                          
            //$this->layout = FALSE;
            //echo $this->render('dashboardview',array('superfooter'=>$footerdata,'roledata'=>$userrole),TRUE);
        }
	
        public function actionUpdatenotice()
        {   $session = new CHttpSession;
            $session->open();
            $empnotices = HrmUserMaster::model()->getlastmessages($session['empnumber']);
          
           echo json_encode($empnotices);
        }
        public function actionAddnotification()
        {
          // exit();
     $notice = new HrmNotification();
            $notice->group_id=$_REQUEST['workgroup'];
            $notice->message=$_REQUEST['notificationmsg'];
            $notice->added_date=  date('Y-m-d h:i:s');
            $notice->save();
            $forpushnotice = HrmUserMaster::model()->getallteammembers($_REQUEST['workgroup']);
             $gcm = Yii::app()->gcm;
            foreach ($forpushnotice as $pushdata){
                $gcm->send($pushdata['google_push_id'], $_REQUEST['notificationmsg']);
            }
        }
        public function actionViewnotifications()
        {
            Yii::app()->red->ajax_redirect();
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
            $display_length = 10;
            
            $limit = $_REQUEST['start'];
            
            if ($limit=='')
              $limit = 0;
            
            $notice = HrmUserMaster::model()->getallnotifications($column,$dir,$search,$limit,$display_length);
            $notice_cnt = HrmUserMaster::model()->notificationcount();
            if($search!='')
                $notif_filter_cnt = HrmUserMaster::model ()->notificationsearchcount ($search);
            else
                $notif_filter_cnt = $notice_cnt;
            
            if(count($notice)>0)
            {              
                foreach ($notice as $notes){
                    $noteid = $notes['id'];
                    $no = '<a href="javascript:void(0);" class="notificationdelete" rel="'.$noteid.'" title="Delete"><i class="icon-remove"></i></a>';                    
                    if($notes['job_category']===NULL) 
                        $notes['job_category']="All";
                        
                    $array = array($notes['job_category'],$notes['message'],date('F j, Y',  strtotime($notes['added_date'])),$no);
                    $newarray[]=$array;
                    
                }
            }
        else {
            $newarray = array();
            }
            $ar = array("recordsTotal"=>$notice_cnt,"recordsFiltered"=>$notif_filter_cnt,"aaData"=> $newarray);
            echo json_encode($ar);
        }
        public function actionGrouplist()
        {   $getall = $_REQUEST['gpid'];
            if($getall=="Officials & Managers")
                $getall=1;
                elseif ($getall=="Broadview Team") 
                $getall=2;
                elseif ($getall=="Web Team")
                    $getall=3;
                else
                    $getall=0;
            
            $groups = HrmUserMaster::model()->getallteammembers($getall);
            echo json_encode($groups);
        }
        public function actionDeletenotification()
        {
            Yii::app()->red->ajax_redirect();
            extract($_REQUEST);
            $notification = HrmUserMaster::model()->deletenotification($_REQUEST['noteid']);
        }
        public function actionUservalidation(){
            Yii::app()->red->ajax_redirect();  // for session redirection
            $rs = new HrmUserMaster();
            #$set = $rs->findByAttributes(array('user_name'=>$_REQUEST['uemail']));
            $usercriteria = new CDbCriteria();
                #$usercriteria->select="id";
                $rq = $_REQUEST['uname'];
                #$usercriteria->condition="user_name=".$rq;
                $uname=HrmUserMaster::model()->findByAttributes(array("user_name"=>$rq));
                if(count($uname)>0){
                    
                    echo 'false';
                }
                else {
                    echo 'true';
                }
        }
        
        public function actionUservalidation_app(){
            //Yii::app()->red->ajax_redirect();  // for session redirection
            $rs = new HrmUserMaster();
            #$set = $rs->findByAttributes(array('user_name'=>$_REQUEST['uemail']));
            $usercriteria = new CDbCriteria();
                #$usercriteria->select="id";
                $rq = $_REQUEST['uname'];
                #$usercriteria->condition="user_name=".$rq;
                $uname=HrmUserMaster::model()->findByAttributes(array("user_name"=>$rq));
                if(count($uname)>0){
                    
                    echo 'false';
                }
                else {
                    echo 'true';
                }
        }

         public function actionMail(){

              $this->render('mailformat',"",FALSE);
          }


           public function actionAllmail(){
              

               //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];

            $mails = HrmUserMaster::model()->getmaildetails($limit,$display_length,$search,$column,$dir);

            $mails_cnt = HrmUserMaster::model()->getmaildetails_cnt();

            if ($search!='')
              $mails_search_cnt = HrmUserMaster::model()->getmaildetails_search_cnt($search);
            else
              $mails_search_cnt = $mails_cnt;



              if(count($mails)>0){
                foreach ($mails as $mdata){
                   $emailid = $mdata['id'];
                   $options = '<a href="javascript:void(0);" class="editemail" rel="'.$emailid.'" title="EDIT MAIL"><i class="icon-edit"></i>';
                  $array = array($mdata['from_address'],$mdata['mail_bcc'],$mdata['display_name'],$options);
                  $newarray[]=$array;
                }
             }
       
        $ar = array("draw"=>$k,"recordsTotal"=>$mails_cnt,"recordsFiltered"=>$mails_search_cnt,"data"=> $newarray);
        echo json_encode($ar);
           }


          public function actionEditemail()
          {
             $getmaildetails = HrmUserMaster::model()->maileditor($_REQUEST['mailid']);
             echo json_encode($getmaildetails);
         }          
    
    public function actionUpdatemail()
    {
        $updatemail = new HrmMail();
        $updatemail->updateAll(array('from_address'=>$_REQUEST['fmail'],'mail_bcc'=>$_REQUEST['bmail'],'subject'=>$_REQUEST['smail'],
            'mail_content'=>$_REQUEST['messagebody']),'id='.$_REQUEST['mailid']);
    }

	public function actionsupervisor_app(){
         //   Yii::app()->red->ajax_redirect();  // for session redirection
            
            $session=new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['emp_number'];
            $repo = new HrmReportTo();
            $session=new CHttpSession;
            $session->open();

            //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            if ($session['user_role']!='1' and $session['user_role']!='2'){

                $supervisors = $repo->getSupervisor($session['empnumber'],$limit,$display_length);
                 $supervisors_cnt = $repo->getSupervisor_cnt($session['empnumber']);
               
            }else if ($_REQUEST['emp_number']>0){
            
                $supervisors = $repo->getSupervisor($_REQUEST['emp_number'],$limit,$display_length);
                $supervisors_cnt = $repo->getSupervisor_cnt($_REQUEST['emp_number']);
              }else{

                 $supervisors = $repo->getSupervisor($session['empnumber'],$limit,$display_length);
                $supervisors_cnt = $repo->getSupervisor_cnt($session['empnumber']);
              }
             if (count($supervisors)>0){
                  $i=1;
                 foreach ($supervisors as $details)
                 {   
                     //leave_approval
                        
                        if ($details['leave_approval'] == 'Y')
                            $leave_approval = 'Yes';
                        else
                            $leave_approval = 'No';

                        $reportid = $details['reportid'];
                        $editurl = Yii::app()->request->baseUrl."/index.php?r=Manageuser/View&emp_number=".$details['emp_number'];
                       
                         $option =  '<a href="javascript:void(0);" class="btn supremove" rel="'.$reportid.'" title="Delete"><i class="icon-remove"></i></a>';
                     
                        $array = array($i,$details['name'],$leave_approval);
                    
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$supervisors_cnt,"recordsFiltered"=>$supervisors_cnt,"data"=> $newarray);
             echo json_encode($ar);

        }	
	


	public function actionsubordinate_app(){
           // Yii::app()->red->ajax_redirect();  // for session redirection
              $session=new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['emp_number'];
            //$session['user_role'] = $_REQUEST['roleid'];

             $repo = new HrmReportTo();
             $session=new CHttpSession;
             $session->open();
             
//for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
               $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

             if ($session['user_role']!='1'){
                $subordinates = $repo->getSubordinate($session['empnumber'],$limit,$display_length);
                $subordinates_cnt = $repo->getSubordinate_cnt($session['empnumber']);

             }
             elseif ($_REQUEST['emp_number']>0){
                $subordinates = $repo->getSubordinate($_REQUEST['emp_number'],$limit,$display_length);
                $subordinates_cnt = $repo->getSubordinate_cnt($_REQUEST['emp_number']);
             }else{
                $subordinates = $repo->getSubordinate($session['empnumber'],$limit,$display_length);
                $subordinates_cnt = $repo->getSubordinate_cnt($session['empnumber']);

             }

             if (count($subordinates)>0){
                  $i=1;
                 foreach ($subordinates as $details)
                 {   
                     
                    
                        $reportid = $details['reportid'];
                       
                       
                         $option =  '<a href="javascript:void(0);" class="btn subremove" rel="'.$reportid.'" title="Delete"><i class="icon-remove"></i></a>';
                      if ($session['user_role']!='1' and $session['user_role']!='2')   
                        $array = array($i,$details['name']);
                      else
                        $array = array($i,$details['name'],$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
          
            $ar = array("draw"=>$k,"recordsTotal"=>$subordinates_cnt,"recordsFiltered"=>$subordinates_cnt,"data"=> $newarray);

              echo json_encode($ar);
        }

	

        public function actionUserdisplay(){
             Yii::app()->red->ajax_redirect();  // for session redirection
            #$ar = array("aaData"=>array(array("id","day1","months1","year1","acting","name1"),array("id2","day2","months2","year2","acting2","name2")));
            #echo json_encode($ar);
             
               //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];

            $userdata1 = HrmUserMaster::model()->getuserdetails($limit,$display_length,$search,$column,$dir);
           
            $userdata1_cnt = HrmUserMaster::model()->getuserdetails_cnt();

            if ($search!='')
              $userdata1_search_cnt = HrmUserMaster::model()->getuserdetails_search_cnt($search);
            else
              $userdata1_search_cnt = $userdata1_cnt;
            
            
             
             
             if (count($userdata1)>0){
                  $i=1;
                 foreach ($userdata1 as $details)
                 {   
                      $empid = $details['emp_number']; 
                      $userid = $details['userid'];
                     if($details['status'] == 'Y'){
                     
                        $act =  '<a class="status_active" rel="'.$userid.'" href="javascript:void(0);"><span class="label label-satgreen">Active</span></a>';
                        }
                    else{
                        $act =  '<a class="status_deactive" rel="'.$userid.'" href="javascript:void(0);"><span class="label label-lightred">Inactive</span></a>';
                      
                        }
                        if($details['Jdate']!= '' and $details['Jdate']!= "0000-00-00")
                        {
                            $da = strtotime($details['Jdate']);
                            $date = date('D, M d, Y', $da);
                        }
                        else{
                            $date = "";
                        }
                       
                        $editurl = Yii::app()->request->baseUrl."/index.php?r=Manageuser/View&emp_number=".$empid;
                       if ($userid!='1'){
 
                         $option =  '<a href="'.$editurl.'" class="btn" rel="'.$empid.'" title="Edit"><i class="icon-edit"></i></a>
                                    <a href="#" class="btn empremove" rel="'.$empid.'" title="Delete"><i class="icon-remove"></i></a>';
                       }else
                       {
                         $option =  '<a href="'.$editurl.'" class="btn" rel="'.$empid.'" title="Edit"><i class="icon-edit"></i></a>';
                       }
                        
                     $array = array($details['employee_id'],$details['Name'],$details['user_role_name'],$details['Uname'],$act,$date,$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$userdata1_cnt,"recordsFiltered"=>$userdata1_search_cnt,"data"=> $newarray);
            
            
          
           
            
            
            echo json_encode($ar);
                     
            
            
        }

        public function actionUserdisplay_app()
        {
            
            #$ar = array("aaData"=>array(array("id","day1","months1","year1","acting","name1"),array("id2","day2","months2","year2","acting2","name2")));
            #echo json_encode($ar);
             
               //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];

            $userdata1 = HrmUserMaster::model()->getuserdetails($limit,$display_length,$search,$column,$dir);
           
            $userdata1_cnt = HrmUserMaster::model()->getuserdetails_cnt();

            if ($search!='')
              $userdata1_search_cnt = HrmUserMaster::model()->getuserdetails_search_cnt($search);
            else
              $userdata1_search_cnt = $userdata1_cnt;
            
            
             
             
             if (count($userdata1)>0){
                  $i=1;
                 foreach ($userdata1 as $details)
                 {   
                      $empid = $details['emp_number']; 
                      $userid = $details['userid'];
                     if($details['status'] == 'Y'){
                     
                        $act =  '<a class="status_active" rel="'.$userid.'" href="javascript:void(0);"><span class="label label-satgreen">Active</span></a>';
                        }
                    else{
                        $act =  '<a class="status_deactive" rel="'.$userid.'" href="javascript:void(0);"><span class="label label-lightred">Inactive</span></a>';
                      
                        }
                        if($details['Jdate']!= '' and $details['Jdate']!= "0000-00-00")
                        {
                            $da = strtotime($details['Jdate']);
                            $date = date('D, M d, Y', $da);
                        }
                        else{
                            $date = "";
                        }
                       
                        $editurl = Yii::app()->request->baseUrl."/index.php?r=Manageuser/View_app&emp_number=".$empid;
                       if ($userid!='1'){
 
                         $option =  '<a href="#" class="btn edit-user" rel="'.$empid.'" title="Edit" ><i class="icon-edit"></i></a>
                                    <a href="#" class="btn empremove" rel="'.$empid.'" title="Delete"><i class="icon-remove"></i></a>';
                       }else
                       {
                         $option =  '<a href="#" class="btn edit-user" rel="'.$empid.'" title="Edit"><i class="icon-edit"></i></a>';
                       }
                        
                     $array = array($details['employee_id'],$details['Name'],$details['user_role_name'],$date,$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$userdata1_cnt,"recordsFiltered"=>$userdata1_search_cnt,"data"=> $newarray);
            
            
          
           
            
            
            echo json_encode($ar);                            
            
        }

        public function actionUserdelete(){
             Yii::app()->red->ajax_redirect();  // for session redirection
             $userdata1 = HrmUserMaster::model()->deleteUser($_REQUEST['empno']);
        }

        public function actionStatusChange()
        {
          extract($_REQUEST);
            if ($status == 'Y')
              HrmUserMaster::model()->updateByPk($userid,array('status'=>'N'));
              else
              HrmUserMaster::model()->updateByPk($userid,array('status'=>'Y'));
   

        }


         public function actionLeavedays()
        {
            Yii::app()->red->ajax_redirect();
            $leave = new HrmLeaveDays();
            $leave->emp_number = $_REQUEST['empnumber'];
            
            if(isset($_REQUEST['leavelistbox'])) {
                
                $leave->deleteAll("emp_number='".$_REQUEST['empnumber']."'");
                
                $items = $_POST['leavelistbox'];
                foreach ($items as $i){
                    $leave->week_days = $i;
                    $leave->setIsNewRecord(TRUE);
                    $leave->id="";                    
                    $leave->save();
                }
            }
        }

        /* public function actionReport(){
            $find = $_REQUEST['rname'];
            $rname = HrmReportTo::model()->findAllByAttributes(array("supervisor_name"=>$find));
            
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        //'model'=>$model,
        //'attribute'=>'name',
                'id'=>'country-single',
                'name'=>'country_single',
                'source'=>$this->createUrl('request/suggestCountry'),
                'htmlOptions'=>array(
                'size'=>'40'
                       ),
                ));
            
            }

        
        */



        public function actionUserReg()
        {
         
                  
               Yii::app()->red->redirect();  // for session redirection
               $adding = new HrmEmployee();
               $vip =  new HrmUserMaster();
                $session=new CHttpSession;
              $session->open();
                #$adding->attributes=array($_POST['']); //for adding more fields as array
               if($_REQUEST['empnumber']>0)
               {


                    if ($_REQUEST['emp_dob']!=''){

                      //$dob = date('Y-m-d',strtotime($_REQUEST['emp_dob']));
                       $date = $timestamp=CDateTimeParser::parse($_REQUEST['emp_dob'],'MM/dd/yyyy');
                    
                       $dob = date('Y-m-d',$date);
                    }
                    else{
                      $dob = '';
                    }

                    if ($_REQUEST['userrole']!='')
                      $adding->updateAll(array('emp_dob'=>$dob,'employee_id' => $_REQUEST['employee_id'],'emp_gender' => $_REQUEST['gender'],'emp_firstname' => $_REQUEST['fname'],'emp_middle_name'=>$_REQUEST['mname'],'emp_lastname'=>$_REQUEST['lname']), 'emp_number='.$_REQUEST['empnumber']);
                    else
                      $adding->updateAll(array('emp_dob'=>$dob,'emp_firstname' => $_REQUEST['fname'],'emp_middle_name'=>$_REQUEST['mname'],'emp_lastname'=>$_REQUEST['lname']), 'emp_number='.$_REQUEST['empnumber']);



                    if ($_REQUEST['userrole']!='')
                      $vip->updateAll(array('user_role_id' => $_REQUEST['userrole'],'status'=>$_REQUEST['userstatus'],'date_modified'=>date('Y-m-d H:m:s'),'modified_user_id'=>$session['memberid'],'mobile_number'=>$_REQUEST['mobilenumber']),'emp_number='.$_REQUEST['empnumber']);
                    else
                      $vip->updateAll(array('date_modified'=>date('Y-m-d H:m:s'),'modified_user_id'=>$session['memberid'],'mobile_number'=>$_REQUEST['mobilenumber']),'emp_number='.$_REQUEST['empnumber']);
                    
                    $userdetails = $vip->find('emp_number=:emp_number', array(':emp_number'=>$_REQUEST['empnumber']));    
                    $pri = $userdetails['id'];
                    echo $_REQUEST['empnumber'];
               
                }else{
               
                    $adding->emp_firstname=$_REQUEST['fname'];
                    $adding->emp_middle_name=$_REQUEST['mname'];
                    $adding->emp_lastname=$_REQUEST['lname'];

                      //$vip->employee_id=$empno;
                    $array_emp_num = array("9"=>'000',"99"=>'00','999'=>'0','9999'=>'');
                    $emp_id = $adding->getMaxEmpId();
                    if ($emp_id>0 and $_REQUEST['employee_id'] == '')
                    {
                        if ($emp_id<9)
                          $empno=  $array_emp_num['9'].($emp_id+1);
                        elseif ($emp_id<99)
                          $empno=  $array_emp_num['99'].($emp_id+1);
                        elseif ($emp_id<999)
                          $empno=  $array_emp_num['999'].($emp_id+1);
                        elseif ($emp_id<999)
                          $empno=  $array_emp_num['9999'].($emp_id+1);

                    }elseif ($_REQUEST['employee_id'] == '')
                    {
                      $empno= '0001';
                    }else{

                       $empno = $_REQUEST['employee_id'];

                    }
                    

                    $adding->employee_id = $empno;
                    
                    $adding->emp_gender  = $_REQUEST['gender'];
                    
                    if ($_REQUEST['emp_dob']!=''){

                       $date = $timestamp=CDateTimeParser::parse($_REQUEST['emp_dob'],'MM/dd/yyyy');
                      $dob = date('Y-m-d',$date);
                      $adding->emp_dob = $dob;
                    }


                    //$adding->emp_number=$_REQUEST['empnumber'];
                    $adding->save();
                    $empno = $adding->getPrimaryKey();
                            
                    $vip->user_name=$_REQUEST['uname'];
                    $pass = crypt($_REQUEST['pswd'],Yii::app()->params['encrptpass']);
                    $vip->user_password=$pass;
                    $vip->user_role_id=$_REQUEST['userrole'];
                    $vip->status=$_REQUEST['userstatus'];
                    $vip->emp_number=$empno;
                    $vip->mobile_number=$_REQUEST['mobilenumber'];
                    

                    $vip->date_entered=date('Y-m-d H:m:s');
                    $vip->date_modified=date('Y-m-d H:m:s');
                    $vip->created_by= $session['memberid'];
                    $vip->modified_user_id= $session['memberid'];
                    $vip->save();
                    $pri = $vip->getPrimaryKey();

                    // addding leave to employees

                    $empLeave  =  new HrmEmployeeLeave1();
                  
                    $allLeaves = $empLeave->getAllLeaves();

                  
                    if (count($allLeaves)>0){

                        foreach ($allLeaves as $leaves){
                             $empLeave->setIsNewRecord(true);
                             $empLeave->id = "";

                            $empLeave->emp_number = $empno;
                            $empLeave->leave_type = $leaves['id'];
                             $month_passed = date('n', strtotime('-1 month'));

                              if ($month_passed ==12)
                              $month_passed = 0;

                            $current_day = date('d', strtotime("today"));
                            if ($current_day>=20)
                               $month_passed =  $month_passed+1;



                            if (in_array($leaves['id'], array(1,3))) {
                               
                               if ($leaves['id'] == 1)
                                  $empLeave->leave_number = ($leaves['leave_max_no']/12)*(12-$month_passed);
                                else
                                  $empLeave->leave_number = 0;

                            }else{
                            
                              $empLeave->leave_number = $leaves['leave_max_no'];

                            }

                             $empLeave->year = date('Y');

                                if (in_array($leaves['id'], array(4,6))) 
                                {

                                  if ($_REQUEST['gender'] == 'F' and $leaves['id']==4)
                                     $empLeave->insert();
                                  elseif ($_REQUEST['gender'] == 'M' and $leaves['id']==6)
                                     $empLeave->insert();

                                }else{

                                   $empLeave->insert();

                                }
                             

                           


                        }

                    }

                    // saturday and sunday as default 

                    $leavedaysobj = new HrmLeaveDays();
                    $leavedaysobj->emp_number = $empno;
                    $leavedaysobj->week_days  = 6;
                    $leavedaysobj->save();
                    $leavedaysobj->setIsNewRecord(TRUE);
                    $leavedaysobj->id="";       
                    $leavedaysobj->week_days  = 7;             
                    $leavedaysobj->save();
                  
                  //sending mail to emplyee after registration    
        $mailcontents = HrmUserMaster::model()->maildata('registration_mail'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        
        $subject = str_replace("#_FIRSTNAME_#",$_REQUEST['fname'],$mailcontents['subject']);
        $subject = str_replace("#_LASTNAME_#",$_REQUEST['lname'],$subject);
        $subject = str_replace("#_USERNAME_#",$_REQUEST['uname'],$subject);


        $regmail->Subject = $subject;
        $regmsg1 = str_replace("#_FIRSTNAME_#",$_REQUEST['fname'],$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LASTNAME_#",$_REQUEST['lname'],$regmsg1);
        $regmsg1 = str_replace("#_USERNAME_#",$_REQUEST['uname'],$regmsg1);
        
//        $regmsg1 = "<div>Hai ".$_REQUEST['fname']." ".$_REQUEST['lname'].",</div>";
//        $regmsg = "<br/><div>Username is  ".$_REQUEST['uname'] ."</div>";
//        $regmsg.= "<div>Your password is: ";
        $regmsg1 = str_replace("#_PASSWORD_#",$_REQUEST['pswd'],$regmsg1);
        $this->layout = FALSE;
         $email_content =  $this->render('email',array('content'=>$regmsg1),true);


       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($_REQUEST['uname']);
       

     
        if(!$regmail->Send()) {
           // echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
           // echo "Message sent!";
        }
       
                  
                  echo $empno;
                  
              
                }
                





               //$rr->attributes = array('user_name'=>$_REQUEST['uname'],'user_password'=>$_REQUEST['pswd'],'user_role_id'=>$_REQUEST['myDropdown']);
              
                
                
               
               #print_r($_FILES);
               /*
               $uploadedimage = CUploadedFile::getInstanceByName('uploadimage');
               #print_r($uploadedimage);
               $uploadedimage->saveAs(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.'.$uploadedimage->extensionName);
               chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.'.$uploadedimage->extensionName, 0777);
               
               #echo dirname(Yii::app()->request->scriptFile).'/profilepictures';
               */
            if(isset($_FILES['uploadimage'])){
                   
                   
             if(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg')
             {
                 unlink(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg');
                 unlink(dirname(Yii::app()->request->scriptFile).'/profilepictures/profile-'.$pri.'.jpg');
                 unlink(dirname(Yii::app()->request->scriptFile).'/profilepictures/thumbimg-'.$pri.'.jpg');
             }
             
               
               $img = Yii::app()->imagemod->load($_FILES['uploadimage']);
               if ($img->uploaded) {
              
                    $img->image_resize          = FALSE;
                    $img->image_ratio_y         = FALSE;
                    $img->image_convert         = 'jpg';
                    $img->file_new_name_body = 'main-'.$pri;

                    $img->process(dirname(Yii::app()->request->scriptFile).'/profilepictures/');
                    if ($img->processed) {
                        #echo 'image resized';
                      //  $img->clean(); //delete original image
                    }else {
                     #   echo 'error : ' . $img->error;
                    }
                    
                    chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg', 0777);
                    $img = Yii::app()->imagemod->load(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg');
                    $img->image_resize          = true;
                    $img->image_ratio_y         = true;
                    $img->image_x               = 150;
                    $img->image_convert         = 'jpg';
                    $img->file_new_name_body = 'profile-'.$pri;
                    $img->process(dirname(Yii::app()->request->scriptFile).'/profilepictures/');
                    if ($img->processed) {
                        #echo 'image resized';
                    } else {
                       #  echo 'error : ' . $img->error;
                    }
            
                    $img = Yii::app()->imagemod->load(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg');
                    $img->image_resize         = true;
                    $img->image_ratio_y         = true;
                    $img->image_x               = 50;
                    $img->image_convert         = 'jpg';
                    $img->file_new_name_body = 'thumbimg-'.$pri;
                    $img->process(dirname(Yii::app()->request->scriptFile).'/profilepictures/');
                    if ($img->processed) {
                       # echo 'image resized';
             
                    } else {
                        # echo 'error : ' . $img->error;
                    } 
                       
                    chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/profile-'.$pri.'.jpg', 0777);
                    chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/thumbimg-'.$pri.'.jpg', 0777);
                }
            }
            
        }

        public function actionUserReg_app()
        {
         
                  
              // Yii::app()->red->redirect();  // for session redirection
               $adding = new HrmEmployee();
               $vip =  new HrmUserMaster();
                $session=new CHttpSession;
              $session->open();
                #$adding->attributes=array($_POST['']); //for adding more fields as array
               if($_REQUEST['empnumber']>0)
               {


                    if ($_REQUEST['emp_dob']!=''){

                      //$dob = date('Y-m-d',strtotime($_REQUEST['emp_dob']));
                       $date = $timestamp=CDateTimeParser::parse($_REQUEST['emp_dob'],'MM/dd/yyyy');
                    
                       $dob = date('Y-m-d',$date);
                    }
                    else{
                      $dob = '';
                    }

                    if ($_REQUEST['userrole']!='')
                      $adding->updateAll(array('emp_dob'=>$dob,'employee_id' => $_REQUEST['employee_id'],'emp_gender' => $_REQUEST['gender'],'emp_firstname' => $_REQUEST['fname'],'emp_middle_name'=>$_REQUEST['mname'],'emp_lastname'=>$_REQUEST['lname']), 'emp_number='.$_REQUEST['empnumber']);
                    else
                      $adding->updateAll(array('emp_dob'=>$dob,'emp_firstname' => $_REQUEST['fname'],'emp_middle_name'=>$_REQUEST['mname'],'emp_lastname'=>$_REQUEST['lname']), 'emp_number='.$_REQUEST['empnumber']);



                    if ($_REQUEST['userrole']!='')
                      $vip->updateAll(array('user_role_id' => $_REQUEST['userrole'],'status'=>$_REQUEST['userstatus'],'date_modified'=>date('Y-m-d H:m:s'),'modified_user_id'=>$session['memberid'],'mobile_number'=>$_REQUEST['mobilenumber']),'emp_number='.$_REQUEST['empnumber']);
                    else
                      $vip->updateAll(array('date_modified'=>date('Y-m-d H:m:s'),'modified_user_id'=>$session['memberid'],'mobile_number'=>$_REQUEST['mobilenumber']),'emp_number='.$_REQUEST['empnumber']);
                    
                    $userdetails = $vip->find('emp_number=:emp_number', array(':emp_number'=>$_REQUEST['empnumber']));    
                    $pri = $userdetails['id'];
                    echo $_REQUEST['empnumber'];
               
                }else{
               
                    $adding->emp_firstname=$_REQUEST['fname'];
                    $adding->emp_middle_name=$_REQUEST['mname'];
                    $adding->emp_lastname=$_REQUEST['lname'];

                      //$vip->employee_id=$empno;
                    $array_emp_num = array("9"=>'000',"99"=>'00','999'=>'0','9999'=>'');
                    $emp_id = $adding->getMaxEmpId();
                    if ($emp_id>0 and $_REQUEST['employee_id'] == '')
                    {
                        if ($emp_id<9)
                          $empno=  $array_emp_num['9'].($emp_id+1);
                        elseif ($emp_id<99)
                          $empno=  $array_emp_num['99'].($emp_id+1);
                        elseif ($emp_id<999)
                          $empno=  $array_emp_num['999'].($emp_id+1);
                        elseif ($emp_id<999)
                          $empno=  $array_emp_num['9999'].($emp_id+1);

                    }elseif ($_REQUEST['employee_id'] == '')
                    {
                      $empno= '0001';
                    }else{

                       $empno = $_REQUEST['employee_id'];

                    }
                    

                    $adding->employee_id = $empno;
                    
                    $adding->emp_gender  = $_REQUEST['gender'];
                    
                    if ($_REQUEST['emp_dob']!=''){

                       $date = $timestamp=CDateTimeParser::parse($_REQUEST['emp_dob'],'MM/dd/yyyy');
                      $dob = date('Y-m-d',$date);
                      $adding->emp_dob = $dob;
                    }


                    //$adding->emp_number=$_REQUEST['empnumber'];
                    $adding->save();
                    $empno = $adding->getPrimaryKey();
                            
                    $vip->user_name=$_REQUEST['uname'];
                    $pass = crypt($_REQUEST['pswd'],Yii::app()->params['encrptpass']);
                    $vip->user_password=$pass;
                    $vip->user_role_id=$_REQUEST['userrole'];
                    $vip->status=$_REQUEST['userstatus'];
                    $vip->emp_number=$empno;
                    $vip->mobile_number=$_REQUEST['mobilenumber'];
                    

                    $vip->date_entered=date('Y-m-d H:m:s');
                    $vip->date_modified=date('Y-m-d H:m:s');
                    $vip->created_by= $session['memberid'];
                    $vip->modified_user_id= $session['memberid'];
                    $vip->save();
                    $pri = $vip->getPrimaryKey();

                    // addding leave to employees

                    $empLeave  =  new HrmEmployeeLeave1();
                  
                    $allLeaves = $empLeave->getAllLeaves();

                  
                    if (count($allLeaves)>0){

                        foreach ($allLeaves as $leaves){
                             $empLeave->setIsNewRecord(true);
                             $empLeave->id = "";

                            $empLeave->emp_number = $empno;
                            $empLeave->leave_type = $leaves['id'];
                             $month_passed = date('n', strtotime('-1 month'));

                              if ($month_passed ==12)
                              $month_passed = 0;

                            $current_day = date('d', strtotime("today"));
                            if ($current_day>=20)
                               $month_passed =  $month_passed+1;



                            if (in_array($leaves['id'], array(1,3))) {
                               
                               if ($leaves['id'] == 1)
                                  $empLeave->leave_number = ($leaves['leave_max_no']/12)*(12-$month_passed);
                                else
                                  $empLeave->leave_number = 0;

                            }else{
                            
                              $empLeave->leave_number = $leaves['leave_max_no'];

                            }

                             $empLeave->year = date('Y');

                                if (in_array($leaves['id'], array(4,6))) 
                                {

                                  if ($_REQUEST['gender'] == 'F' and $leaves['id']==4)
                                     $empLeave->insert();
                                  elseif ($_REQUEST['gender'] == 'M' and $leaves['id']==6)
                                     $empLeave->insert();

                                }else{

                                   $empLeave->insert();

                                }
                             

                           


                        }

                    }

                    // saturday and sunday as default 

                    $leavedaysobj = new HrmLeaveDays();
                    $leavedaysobj->emp_number = $empno;
                    $leavedaysobj->week_days  = 6;
                    $leavedaysobj->save();
                    $leavedaysobj->setIsNewRecord(TRUE);
                    $leavedaysobj->id="";       
                    $leavedaysobj->week_days  = 7;             
                    $leavedaysobj->save();
                  
                  //sending mail to emplyee after registration    
        $mailcontents = HrmUserMaster::model()->maildata('registration_mail'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        
        $subject = str_replace("#_FIRSTNAME_#",$_REQUEST['fname'],$mailcontents['subject']);
        $subject = str_replace("#_LASTNAME_#",$_REQUEST['lname'],$subject);
        $subject = str_replace("#_USERNAME_#",$_REQUEST['uname'],$subject);


        $regmail->Subject = $subject;
        $regmsg1 = str_replace("#_FIRSTNAME_#",$_REQUEST['fname'],$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LASTNAME_#",$_REQUEST['lname'],$regmsg1);
        $regmsg1 = str_replace("#_USERNAME_#",$_REQUEST['uname'],$regmsg1);
        
//        $regmsg1 = "<div>Hai ".$_REQUEST['fname']." ".$_REQUEST['lname'].",</div>";
//        $regmsg = "<br/><div>Username is  ".$_REQUEST['uname'] ."</div>";
//        $regmsg.= "<div>Your password is: ";
        $regmsg1 = str_replace("#_PASSWORD_#",$_REQUEST['pswd'],$regmsg1);
        $this->layout = FALSE;
         $email_content =  $this->render('email',array('content'=>$regmsg1),true);


       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($_REQUEST['uname']);
       

     
        if(!$regmail->Send()) {
           // echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
           // echo "Message sent!";
        }
       
                  
                  echo $empno;
                  
              
                }
                





               //$rr->attributes = array('user_name'=>$_REQUEST['uname'],'user_password'=>$_REQUEST['pswd'],'user_role_id'=>$_REQUEST['myDropdown']);
              
                
                
               
               #print_r($_FILES);
               /*
               $uploadedimage = CUploadedFile::getInstanceByName('uploadimage');
               #print_r($uploadedimage);
               $uploadedimage->saveAs(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.'.$uploadedimage->extensionName);
               chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.'.$uploadedimage->extensionName, 0777);
               
               #echo dirname(Yii::app()->request->scriptFile).'/profilepictures';
               */
            if(isset($_FILES['uploadimage'])){
                   
                   
             if(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg')
             {
                 unlink(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg');
                 unlink(dirname(Yii::app()->request->scriptFile).'/profilepictures/profile-'.$pri.'.jpg');
                 unlink(dirname(Yii::app()->request->scriptFile).'/profilepictures/thumbimg-'.$pri.'.jpg');
             }
             
               
               $img = Yii::app()->imagemod->load($_FILES['uploadimage']);
               if ($img->uploaded) {
              
                    $img->image_resize          = FALSE;
                    $img->image_ratio_y         = FALSE;
                    $img->image_convert         = 'jpg';
                    $img->file_new_name_body = 'main-'.$pri;

                    $img->process(dirname(Yii::app()->request->scriptFile).'/profilepictures/');
                    if ($img->processed) {
                        #echo 'image resized';
                      //  $img->clean(); //delete original image
                    }else {
                     #   echo 'error : ' . $img->error;
                    }
                    
                    chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg', 0777);
                    $img = Yii::app()->imagemod->load(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg');
                    $img->image_resize          = true;
                    $img->image_ratio_y         = true;
                    $img->image_x               = 150;
                    $img->image_convert         = 'jpg';
                    $img->file_new_name_body = 'profile-'.$pri;
                    $img->process(dirname(Yii::app()->request->scriptFile).'/profilepictures/');
                    if ($img->processed) {
                        #echo 'image resized';
                    } else {
                       #  echo 'error : ' . $img->error;
                    }
            
                    $img = Yii::app()->imagemod->load(dirname(Yii::app()->request->scriptFile).'/profilepictures/main-'.$pri.'.jpg');
                    $img->image_resize         = true;
                    $img->image_ratio_y         = true;
                    $img->image_x               = 50;
                    $img->image_convert         = 'jpg';
                    $img->file_new_name_body = 'thumbimg-'.$pri;
                    $img->process(dirname(Yii::app()->request->scriptFile).'/profilepictures/');
                    if ($img->processed) {
                       # echo 'image resized';
             
                    } else {
                        # echo 'error : ' . $img->error;
                    } 
                       
                    chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/profile-'.$pri.'.jpg', 0777);
                    chmod(dirname(Yii::app()->request->scriptFile).'/profilepictures/thumbimg-'.$pri.'.jpg', 0777);
                }
            }
            
        }
        
        public function actionUpdatePVleave()
        {
           

           $empLeave  =  new HrmUserMaster();
           $users = $empLeave->AllActiveUsers();

            foreach ($users as $key => $user_list) {
                  $leave_number = 0;
                $month_joined = date('n',strtotime($user_list['date_entered']));


                 $month_passed = date('n', strtotime('-1 month'));
              

                if ($month_joined ==12)
                   $month_joined = 0;

                if ($month_passed ==12)
                   $month_passed = 0;




                if ($month_joined == $month_passed)
                {
                     $current_day = date('d', strtotime($user_list['date_entered']));

                     
                            if ($current_day<=20){
                               
                              if ($month_passed == 11)
                               $leave_number = 2;
                              else
                               $leave_number = 1; 

                             }else{
                               $leave_number = 0;
                             }




                }else{



                     if ($month_passed == 11)
                        $leave_number = $user_list['leave_number']+2;
                     else
                        $leave_number =  $user_list['leave_number']+1;

                      echo $leave_number;

                }

                
                $empLeave->update_leave_status($leave_number,$user_list['employee_leave_id']);

            }

echo "updated";

        }

        public function actionUpdateEmpLeave()
        {

             $empLeave  =  new HrmEmployeeLeave1();
                    

                   $allLeaves = $empLeave->deleteEmpLeaveCron($_REQUEST['emp_number']);
                    $allLeaves = $empLeave->getAllLeaves();

                  
                    if (count($allLeaves)>0){

                        foreach ($allLeaves as $leaves){
                             $empLeave->setIsNewRecord(true);
                             $empLeave->id = "";

                            $empLeave->emp_number = $_REQUEST['emp_number'];
                            $empLeave->leave_type = $leaves['id'];
                              $month_passed = date('n', strtotime('-1 month',strtotime($_REQUEST['emp_date'])));
                             if ($month_passed ==12)
                              $month_passed = 0;
                             $current_day = date('d', strtotime($_REQUEST['emp_date']));

                     
                            if ($current_day>=20)
                               $month_passed =  $month_passed+1;
                           

                            if (in_array($leaves['id'], array(1,3))) {
                               if ($leaves['id'] == 1)
                                  $empLeave->leave_number = ($leaves['leave_max_no']/12)*(12-$month_passed);
                                else
                                  $empLeave->leave_number = round(($leaves['leave_max_no']/12)*(12-$month_passed));

                            }else{
                            
                              $empLeave->leave_number = $leaves['leave_max_no'];

                            }
                             //$empLeave->year = date('Y');
                             $empLeave->year = '2016';
                                if (in_array($leaves['id'], array(4,6))) 
                                {

                                  if ($_REQUEST['gender'] == 'F' and $leaves['id']==4)
                                     $empLeave->insert();
                                  elseif ($_REQUEST['gender'] == 'M' and $leaves['id']==6)
                                     $empLeave->insert();

                                }else{

                                   $empLeave->insert();

                                }
                             

                           


                        }

                    }

                    echo "Updated";


        }


        public function cronleaveupdate($empnumber,$emp_date)
        {

             $empLeave  =  new HrmEmployeeLeave1();
                    

                   // $allLeaves = $empLeave->deleteEmpLeaveCron($_REQUEST['emp_number']);
                    $allLeaves = $empLeave->getAllLeaves();

                  
                    if (count($allLeaves)>0){

                        foreach ($allLeaves as $leaves){
                             $empLeave->setIsNewRecord(true);
                             $empLeave->id = "";

                            $empLeave->emp_number = $empnumber;
                            $empLeave->leave_type = $leaves['id'];
                              $month_passed = date('n', strtotime('-1 month',strtotime($emp_date)));
                             if ($month_passed ==12)
                              $month_passed = 0;
                             $current_day = date('d', strtotime($emp_date));

                     
                            if ($current_day>=20)
                               $month_passed =  $month_passed+1;
                           

                            if (in_array($leaves['id'], array(1,3))) {
                               if ($leaves['id'] == 1)
                                  $empLeave->leave_number = $leaves['leave_max_no'];
                                else
                                  $empLeave->leave_number = $leaves['leave_max_no'];

                            }else{
                            
                              $empLeave->leave_number = $leaves['leave_max_no'];

                            }
                             //$empLeave->year = date('Y');
                             $empLeave->year = '2016';
                                if (in_array($leaves['id'], array(4,6))) 
                                {

                                  if ($_REQUEST['gender'] == 'F' and $leaves['id']==4)
                                     $empLeave->insert();
                                  elseif ($_REQUEST['gender'] == 'M' and $leaves['id']==6)
                                     $empLeave->insert();

                                }else{

                                   $empLeave->insert();

                                }
                             

                           


                        }

                    }

                    echo "Updated";


        }



        public function actionEcontact() {
            
            #$ss = array();
            #if(count($ss)==0)
                
                 Yii::app()->red->ajax_redirect();  // for session redirection
            
                $n = new HrmEmpEmergencyContacts();
                
                $contactarr = $n->find('emp_number=:emp_number', array(':emp_number'=>$_REQUEST['empnumber']));    
               
                if(count($contactarr)>0){
                    
                  $n->updateAll(array('eec_name' => $_REQUEST['name'],
                      'eec_relation'=>$_REQUEST['relation'],
                      'eec_address'=>$_REQUEST['address'],
                      'eec_pincode'=>$_REQUEST['pincode'],
                      'eec_country'=>$_REQUEST['countrylist'],
                      'eec_state'=>$_REQUEST['statelist'],'eec_city'=>$_REQUEST['city'],
                      'eec_home_no'=>$_REQUEST['hnumber'],'eec_mobile_no'=>$_REQUEST['mnumber'],
                      'eec_office_no'=>$_REQUEST['onumber']),                        
                          'emp_number='.$_REQUEST['empnumber']);  
                    
                }
        else {
                $n->eec_name=$_REQUEST['name'];
                $n->eec_relationship=$_REQUEST['relation'];
                $n->eec_address=$_REQUEST['address'];
                $n->eec_pincode=$_REQUEST['pincode'];
                $n->eec_country=$_REQUEST['countrylist'];
                $n->eec_state=$_REQUEST['statelist'];
                $n->eec_city=$_REQUEST['city'];
                $n->eec_home_no=$_REQUEST['hnumber'];
                $n->eec_mobile_no=$_REQUEST['mnumber'];
                $n->eec_office_no=$_REQUEST['onumber'];
                $n->emp_number=$_REQUEST['empnumber'];
                $n->insert();
            }
            
        }

        public function actionEcontact_app() {
            $empnumber = $_REQUEST['empnumber'];
            parse_str($_REQUEST['params'],$_REQUEST);

            #$ss = array();
            #if(count($ss)==0)
                
              //   Yii::app()->red->ajax_redirect();  // for session redirection
            
                $n = new HrmEmpEmergencyContacts();
                
                $contactarr = $n->find('emp_number=:emp_number', array(':emp_number'=>$empnumber));    
               
                if(count($contactarr)>0){
                    
                  $n->updateAll(array('eec_name' => $_REQUEST['name'],
                      'eec_relation'=>$_REQUEST['relation'],
                      'eec_address'=>$_REQUEST['address'],
                      'eec_pincode'=>$_REQUEST['pincode'],
                      'eec_country'=>$_REQUEST['countrylist'],
                      'eec_state'=>$_REQUEST['statelist'],'eec_city'=>$_REQUEST['city'],
                      'eec_home_no'=>$_REQUEST['hnumber'],'eec_mobile_no'=>$_REQUEST['mnumber'],
                      'eec_office_no'=>$_REQUEST['onumber']),                        
                          'emp_number='.$empnumber);  
                    
                }
        else {
                $n->eec_name=$_REQUEST['name'];
                $n->eec_relationship=$_REQUEST['relation'];
                $n->eec_address=$_REQUEST['address'];
                $n->eec_pincode=$_REQUEST['pincode'];
                $n->eec_country=$_REQUEST['countrylist'];
                $n->eec_state=$_REQUEST['statelist'];
                $n->eec_city=$_REQUEST['city'];
                $n->eec_home_no=$_REQUEST['hnumber'];
                $n->eec_mobile_no=$_REQUEST['mnumber'];
                $n->eec_office_no=$_REQUEST['onumber'];
                $n->emp_number=$empnumber;
                $n->insert();
            }
            
        }

        public function actionDependent(){
            Yii::app()->red->ajax_redirect();  // for session redirection
            $d = new HrmDependent();
           
                $d->emp_number=$_REQUEST['empnumber'];
                $d->dependent_name=$_REQUEST['dname'];
                if($_REQUEST['relationship']=='other'){
                    $d->dependent_relation=$_REQUEST['odependent'];
                    }
                else {
                    $d->dependent_relation=$_REQUEST['relationship'];
                    }
            
                 unset($_REQUEST['odependent'],$_REQUEST['relationship']);
          
            #$d->dependent_dob=$_REQUEST['dateofbirth'];
                    $da = $timestamp=CDateTimeParser::parse($_REQUEST['dateofbirth'],'MM/dd/yyyy');
                   
                    $d->dependent_dob=date('Y-m-d', $da);
            #$d->dependent_dob= date("y-m-d",strtotime($_REQUEST['dateofbirth']));
            #print_r($d);  
            
            #$from=DateTime::createFromFormat('Y-m-d',$this->dependent_dob);
            #$this->dependent_dob=$from->format('d/m/Y');
            
            
                    $d->save();
           
            
        }

        public function actionDependent_app(){
          $empnumber =  $_REQUEST['empnumber'];
          parse_str($_REQUEST['params'],$_REQUEST);
            $d = new HrmDependent();
           
                $d->emp_number=$empnumber;
                $d->dependent_name=$_REQUEST['dname'];
                if($_REQUEST['relationship']=='other'){
                    $d->dependent_relation=$_REQUEST['odependent'];
                    }
                else {
                    $d->dependent_relation=$_REQUEST['relationship'];
                    }
            
                 unset($_REQUEST['odependent'],$_REQUEST['relationship']);
          
         
                    $da = $timestamp=CDateTimeParser::parse($_REQUEST['dateofbirth'],'MM/dd/yyyy');
                   
                    $d->dependent_dob=date('Y-m-d', $da);
           
            
            
            $d->save();
           
            
        }

         public function actionDeleteDependent(){
            Yii::app()->red->ajax_redirect();  // for session redirection
            $dependent =  new HrmDependent();
            extract($_REQUEST);
           $dependent->DeleteDependent($dp_id);
           
            
        }

        public function actionDeleteDependent_app(){
           
            $dependent =  new HrmDependent();
            extract($_REQUEST);
            $dependent->DeleteDependent($dp_id);
           
            
        }

         public function actionDeletesupervisor(){
            Yii::app()->red->ajax_redirect();  // for session redirection
           $repo = new HrmReportTo();
            extract($_REQUEST);
           $repo->Deletesupervisor($report_id);
           
            
        }
         public function actionDeletesubordinate(){
            Yii::app()->red->ajax_redirect();  // for session redirection
           $repo = new HrmReportTo();
            extract($_REQUEST);
           $repo->Deletesubordinte($report_id);
           
            
        }

	public function actiontestmail()
	{
	
$session=new CHttpSession;
     $session->open();

	$mailUsers = HrmEmployeeLeave::model()->getAllSupervisorsAndAdmin($session['empnumber']);



		$mail=Yii::app()->Smtpmail;
       
                $mail->SetFrom('hr@netstratum.com','NETSTRATUM');

                $mail->AddBCC('','NETSTRATUM');

               
                $mail->Subject = 'test mail';
               $mailcontents = HrmUserMaster::model()->maildata('forgot_password'); 

                $this->layout = FALSE;
                $email_content =  $this->render('email',array('content'=>$mailcontents['mail_content']),true);
                $mail->MsgHTML($email_content);
                $mail->AddAddress('vipin@netstratum.com');
                   
                if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;             
                }else {
                    echo "Message sent!";
                } 

}        

        public function actionDynamicstates(){
            Yii::app()->red->ajax_redirect();  // for session redirection
            $record =  new commenmodel('state_list');
            $countryid = $_REQUEST['countryid'];
            $cid=  $record->findAllByAttributes(array("country_id"=>$countryid)); 
            $this->layout=FALSE;
           
            $this->render('statelist',array('selectarray'=>$cid),FALSE);
            
        }


        public function actionMailsendApp(){
           $getname = HrmUserMaster::model()->getusername($_REQUEST['useremail']);
           $mailcontents = HrmUserMaster::model()->maildata('forgot_password');
           if ($getname['name']!=''){
               $mail=Yii::app()->Smtpmail;
       
                $mail->SetFrom($mailcontents['from_address'],'NETSTRATUM');

                $mail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');

                $subject = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['subject']);
                $subject = str_replace("#_USERNAME_#",$_REQUEST['useremail'],$subject);
                $mail->Subject = $subject;
                $msg = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['mail_content']);
                $subject = str_replace("#_USERNAME_#",$_REQUEST['useremail'],$subject);

                $mail->Subject = $subject;       
                $msg = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['mail_content']);
                
                $msg = str_replace("#_USERNAME_#",$_REQUEST['useremail'],$msg);
                $pass = substr( "179abcstu67Z",mt_rand( 0 ,6 ) ,1 ) .substr( md5( time() ), 0,5);
                $msg = str_replace("#_PASSWORD_#",$pass,$msg);
                $this->layout = FALSE;
                $email_content =  $this->render('email',array('content'=>$msg),true);
                $mail->MsgHTML($email_content);
                $mail->AddAddress($_REQUEST['useremail']);

                if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;             
                }else {
                   // echo "Message sent!";
                } 
               $tempass = crypt($pass,Yii::app()->params['encrptpass']);               
               HrmUserMaster::model()->updatepassword($tempass, $_REQUEST['useremail']);     
               echo "success";                  
           }
           else{
                echo "Invalid";
               }
        }
        
        public function actionMailsend(){
        
//        $session=new CHttpSession;
//        $session->open(); 
        $getname = HrmUserMaster::model()->getusername($_REQUEST['loginemail']);
      
//        print_r($getname);
//        exit();
       
        $mailcontents = HrmUserMaster::model()->maildata('forgot_password'); 
//        ini_set("SMTP","ssl://smtp.gmail.com");
//        ini_set("smtp_port","465");
       
        if ($getname['name']!='')
        {

        $mail=Yii::app()->Smtpmail;
       
        $mail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        
        $mail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');

        $subject = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['subject']);
        #$msg1 = str_replace("#_USERNAME_#",$_REQUEST['loginemail'],$mailcontents['mail_content']);
        $subject = str_replace("#_USERNAME_#",$_REQUEST['loginemail'],$subject);

        $mail->Subject = $subject;
        #$msg = "<div>Hai ".$getname['name'].",</div>";
        $msg = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['mail_content']);
        #$msg1 = str_replace("#_USERNAME_#",$_REQUEST['loginemail'],$mailcontents['mail_content']);
        $msg = str_replace("#_USERNAME_#",$_REQUEST['loginemail'],$msg);
        
        
        $pass = substr( "123789abcdefgh456789stu678KZ",
                mt_rand( 0 ,25 ) ,1 ) .substr( md5( time() ), 1);
        $msg = str_replace("#_PASSWORD_#",$pass,$msg);
        
        $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$msg),true);

       
        $mail->MsgHTML($email_content);


       
        
        $mail->AddAddress($_REQUEST['loginemail']);
       
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;             
        }else {
           // echo "Message sent!";
        } 
        
         
       $tempass = crypt($pass,Yii::app()->params['encrptpass']);
       
      
       #HrmUserMaster::model()->updateByPk($session['memberid'],array('user_password'=>$tempass));
       HrmUserMaster::model()->updatepassword($tempass, $_REQUEST['loginemail']);     
       echo "success";   

     }else{


        echo "Invalid";

     }

      }
        public function actionReport(){
            
            Yii::app()->red->ajax_redirect();  // for session redirection
            $repo = new HrmReportTo();
            $term = $_REQUEST['term'];
            $suggestions = $repo->getAllSuggestions($term,$_REQUEST['emp_number']);
            echo json_encode($suggestions);            
                   
        }
        
        public function actionReportto(){
            
            Yii::app()->red->ajax_redirect();  // for session redirection
            $repo = new HrmReportTo();
            
            $repo->emp_number=$_REQUEST['empnumber'];
            $repo->user_id = $_REQUEST['report_user_id'];
            $repo->leave_approval = $_REQUEST['leave_approval'];
            $repo->user_type =$_REQUEST['reportto1'];
            //$repo->order_no =$_REQUEST['order_no'];
            
            $repo->save();

            if ($_REQUEST['reportto1']=='supervisor')
              $reportto1 = 'subordinate';
            else
              $reportto1 = 'supervisor';

            
              $repo->setIsNewRecord(TRUE);
              $repo->id="";
              $repo->emp_number=$_REQUEST['report_user_id'];
              $repo->user_id = $_REQUEST['empnumber'];
              $repo->user_type =$reportto1;

              $repo->save();
        }

        public function actionDependentlist(){
            Yii::app()->red->ajax_redirect();  // for session redirection
            $d = new HrmDependent();
            $session=new CHttpSession;
            $session->open();

            //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            if ($session['user_role']!='1' and $session['user_role']!='2'){

                $dependent_list = $d->getDepedent_list($session['empnumber'],$limit,$display_length);
                 $dependent_list_cnt = $d->getDepedent_list_cnt($session['empnumber']);
               
            }else if ($_REQUEST['emp_number']>0){
             
                $dependent_list = $d->getDepedent_list($_REQUEST['emp_number'],$limit,$display_length);
                $dependent_list_cnt = $d->getDepedent_list_cnt($_REQUEST['emp_number']);
              }else{

                 $dependent_list = $d->getDepedent_list($session['empnumber'],$limit,$display_length);
                $dependent_list_cnt = $d->getDepedent_list_cnt($session['empnumber']);
              }
             if (count($dependent_list)>0){
                  $i=1;
                 foreach ($dependent_list as $details)
                 {   
                     //leave_approval
                        
                      

                        $dependentid = $details['id'];
                        
                       
                         $option =  '<a href="javascript:void(0);" class="btn depremove" rel="'.$dependentid.'" title="Delete"><i class="icon-remove"></i></a>';
                        
                     $array = array($i,$details['dependent_name'],$details['dependent_relation'],$details['dependent_dob'],$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$dependent_list_cnt,"recordsFiltered"=>$dependent_list_cnt,"data"=> $newarray);
             echo json_encode($ar);

        }

        public function actionDependentlist_app(){
         
            $d = new HrmDependent();
            $session=new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['emp_number'];
            $session['user_role'] = $_REQUEST['roleid'];
            //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            if ($session['user_role']!='1' and $session['user_role']!='2'){

                $dependent_list = $d->getDepedent_list($session['empnumber'],$limit,$display_length);
                 $dependent_list_cnt = $d->getDepedent_list_cnt($session['empnumber']);
               
            }else if ($_REQUEST['emp_number']>0){
             
                $dependent_list = $d->getDepedent_list($_REQUEST['emp_number'],$limit,$display_length);
                $dependent_list_cnt = $d->getDepedent_list_cnt($_REQUEST['emp_number']);
              }else{

                 $dependent_list = $d->getDepedent_list($session['empnumber'],$limit,$display_length);
                $dependent_list_cnt = $d->getDepedent_list_cnt($session['empnumber']);
              }
             if (count($dependent_list)>0){
                  $i=1;
                 foreach ($dependent_list as $details)
                 {   
                     //leave_approval
                        
                      

                        $dependentid = $details['id'];
                        
                       
                         $option =  '<a href="javascript:void(0);" class="btn depremove" rel="'.$dependentid.'" title="Delete"><i class="icon-remove"></i></a>';
                        
                     $array = array($i,$details['dependent_name'],$details['dependent_relation'],$details['dependent_dob'],$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$dependent_list_cnt,"recordsFiltered"=>$dependent_list_cnt,"data"=> $newarray);
             echo json_encode($ar);

        }
        
        public function actionsupervisor(){
            Yii::app()->red->ajax_redirect();  // for session redirection
            $repo = new HrmReportTo();
            $session=new CHttpSession;
            $session->open();

            //for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
              $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

            if ($session['user_role']!='1' and $session['user_role']!='2'){

                $supervisors = $repo->getSupervisor($session['empnumber'],$limit,$display_length);
                 $supervisors_cnt = $repo->getSupervisor_cnt($session['empnumber']);
               
            }else if ($_REQUEST['emp_number']>0){
            
                $supervisors = $repo->getSupervisor($_REQUEST['emp_number'],$limit,$display_length);
                $supervisors_cnt = $repo->getSupervisor_cnt($_REQUEST['emp_number']);
              }else{

                 $supervisors = $repo->getSupervisor($session['empnumber'],$limit,$display_length);
                $supervisors_cnt = $repo->getSupervisor_cnt($session['empnumber']);
              }
             if (count($supervisors)>0){
                  $i=1;
                 foreach ($supervisors as $details)
                 {   
                     //leave_approval
                        
                        if ($details['leave_approval'] == 'Y')
                            $leave_approval = 'Yes';
                        else
                            $leave_approval = 'No';

                        $reportid = $details['reportid'];
                        $editurl = Yii::app()->request->baseUrl."/index.php?r=Manageuser/View&emp_number=".$details['emp_number'];
                       
                         $option =  '<a href="javascript:void(0);" class="btn supremove" rel="'.$reportid.'" title="Delete"><i class="icon-remove"></i></a>';
                      if ($session['user_role']!='1' and $session['user_role']!='2')  
                        $array = array($i,$details['name'],$leave_approval);
                     else
                       $array = array($i,$details['name'],$leave_approval,$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$supervisors_cnt,"recordsFiltered"=>$supervisors_cnt,"data"=> $newarray);
             echo json_encode($ar);

        }

        public function actionsubordinate(){
            Yii::app()->red->ajax_redirect();  // for session redirection
             $repo = new HrmReportTo();
             $session=new CHttpSession;
             $session->open();
             
//for data table
             $k = intval($_REQUEST['draw']);
            if ($k == 0) {
              $k++;
            };

            if ($_REQUEST['length'] > 0) {
               $display_length = $_REQUEST['length'];
            } else {

            $display_length = 10;
            }

            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;

             if ($session['user_role']!='1' and $session['user_role']!='2'){
                $subordinates = $repo->getSubordinate($session['empnumber'],$limit,$display_length);
                $subordinates_cnt = $repo->getSubordinate_cnt($session['empnumber']);

             }
             elseif ($_REQUEST['emp_number']>0){
                $subordinates = $repo->getSubordinate($_REQUEST['emp_number'],$limit,$display_length);
                $subordinates_cnt = $repo->getSubordinate_cnt($_REQUEST['emp_number']);
             }else{
                $subordinates = $repo->getSubordinate($session['empnumber'],$limit,$display_length);
                $subordinates_cnt = $repo->getSubordinate_cnt($session['empnumber']);

             }

             if (count($subordinates)>0){
                  $i=1;
                 foreach ($subordinates as $details)
                 {   
                     
                    
                        $reportid = $details['reportid'];
                       
                       
                         $option =  '<a href="javascript:void(0);" class="btn subremove" rel="'.$reportid.'" title="Delete"><i class="icon-remove"></i></a>';
                      if ($session['user_role']!='1' and $session['user_role']!='2')   
                        $array = array($i,$details['name']);
                      else
                        $array = array($i,$details['name'],$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
          
            $ar = array("draw"=>$k,"recordsTotal"=>$subordinates_cnt,"recordsFiltered"=>$subordinates_cnt,"data"=> $newarray);

              echo json_encode($ar);
        }


        /*public function actionRole(){
            $role = new HrmUserRole();
            
        }*/
     public function actionJob(){
         Yii::app()->red->ajax_redirect();  // for session redirection
         $job = new HrmCurrentJob();
         $jobarr = $job->find('emp_number=:emp_number', array(':emp_number'=>$_REQUEST['empnumber'])); 
         if(count($jobarr)>0){            
             
             $j = strtotime($_REQUEST['joindate']);
         
            $jaa=date('Y-m-d', $j);
             
             $job->updateAll(array('job_title' => $_REQUEST['jobtitle'],
                 'job_status'=>$_REQUEST['estatus'],
                 'job_category'=>$_REQUEST['jobcategory'],'join_date'=>$jaa),                        
                     'emp_number='.$_REQUEST['empnumber']);
             
         }
         else{
         
         $job->emp_number=$_REQUEST['empnumber'];
         $job->job_title=$_REQUEST['jobtitle'];
         $job->job_status=$_REQUEST['estatus'];
         $job->job_category=$_REQUEST['jobcategory'];
         
         
         
         $j = strtotime($_REQUEST['joindate']);
         #$job->join_date=date('Y-m-d', $j);
         $job->join_date=date('Y-m-d', $j);
         
         
         #$job->join_date=$_REQUEST['joindate'];
         $job->save();
         }
     }


      public function actionUpdatepassword()
      {
  
         $session=new CHttpSession;
         $session->open();
        

        $pswd = crypt($_REQUEST['newpassword'],Yii::app()->params['encrptpass']);
        HrmUserMaster::model()->updateByPk($session['memberid'],array('user_password'=>$pswd));

    }


    public function actionUpdateWFH()
    {

          $getalldata = HrmUserMaster::model()->AllActiveUsers_cron(); 

          foreach ($getalldata as $key => $userlist) {
              
              //HrmUserMaster::model()->leaveinsert($userlist['emp_number'],'26','0','Y','2015'); 

            $this->cronleaveupdate($userlist['emp_number'],$userlist['date_entered']);

          }


    } 
	
	public function actionApp_Reg_Android()
	{
      	HrmEmployee::model()->updateByPk($_REQUEST['employeeno'],array('google_push_id'=>$_REQUEST['regid']));    
    	}

	
        public function actionProfileGet()
        {
	    $getprofile =  HrmUserMaster::model()->getProfileData_iphone($_REQUEST['emp_number']);	
	    echo json_encode($getprofile);
	    exit;

        }


	public function actionSaveProfile_Iphone(){
		
		$employee_modal = new HrmEmployee();
		$employee_data=$employee_modal->findByPk($_POST['emp_number']);
		//$employee_data->loadModel($_POST['emp_number']); 
		$employee_data->emp_firstname = $_POST['firstname'];
		$employee_data->emp_lastname = $_POST['lastname'];
                $employee_data->emp_middle_name = $_POST['middlename'];
		//$employee_data->emp_mobile = $_POST['mobile'];
		$employee_data->emp_dob = date('Y-m-d',strtotime($_POST['dob']));
                //$employee_data->setIsNewRecord(TRUE);
                $employee_data->emp_number=$_POST['emp_number'];                    
                $employee_data->save(false);

		
		HrmUserMaster::model()->updateAll(array('mobile_number'=>$_POST['mobile']),'emp_number="'.$_POST['emp_number'].'"');	
		
		echo '{"msg":"success","mobile":"'.$_POST['mobile'].'"}';
		exit;
	   
	}


	


	public function actionDependent_Iphone(){
          $empnumber =  $_REQUEST['employeeno'];
          
            $d = new HrmDependent();
           
                $d->emp_number=$empnumber;
                $d->dependent_name=$_REQUEST['dname'];
                if($_REQUEST['relationship']=='other'){
                    $d->dependent_relation=$_REQUEST['odependent'];
                    }
                else {
                    $d->dependent_relation=$_REQUEST['relationship'];
                    }
            
                 unset($_REQUEST['odependent'],$_REQUEST['relationship']);
          
         
                    $da = $timestamp=CDateTimeParser::parse($_REQUEST['dateofbirth'],'MM/dd/yyyy');
                   
                    $d->dependent_dob=date('Y-m-d', $da);
           
            
            
            $d->save();
           
            
        }



	public function actionMailsendApp_Iphone(){
           $getname = HrmUserMaster::model()->getusername($_REQUEST['useremail']);
           $mailcontents = HrmUserMaster::model()->maildata('forgot_password');
           if ($getname['name']!=''){
               $mail=Yii::app()->Smtpmail;
       
                $mail->SetFrom($mailcontents['from_address'],'NETSTRATUM');

                $mail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');

                $subject = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['subject']);
                $subject = str_replace("#_USERNAME_#",$_REQUEST['useremail'],$subject);
                $mail->Subject = $subject;
                $msg = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['mail_content']);
                $subject = str_replace("#_USERNAME_#",$_REQUEST['useremail'],$subject);

                $mail->Subject = $subject;       
                $msg = str_replace("#_FIRSTNAME_#",$getname['name'],$mailcontents['mail_content']);
                
                $msg = str_replace("#_USERNAME_#",$_REQUEST['useremail'],$msg);
                $pass = substr( "179abcstu67Z",mt_rand( 0 ,6 ) ,1 ) .substr( md5( time() ), 0,5);
                $msg = str_replace("#_PASSWORD_#",$pass,$msg);
                $this->layout = FALSE;
                $email_content =  $this->render('email',array('content'=>$msg),true);
                $mail->MsgHTML($email_content);
                $mail->AddAddress($_REQUEST['useremail']);

                if(!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;             
                }else {
                   // echo "Message sent!";
                } 
               $tempass = crypt($pass,Yii::app()->params['encrptpass']);               
               HrmUserMaster::model()->updatepassword($tempass, $_REQUEST['useremail']);     
               echo '{"msg":"success"}';                  
           }
           else{
               echo '{"msg":"Invalid"}';
               }
        }







     // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
        // return the filter configuration for this controller, e.g.:
        return array(
            'inlineFilterName',
            array(
                'class'=>'path.to.FilterClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }

    public function actions()
    {
        // return external action classes, e.g.:
        return array(
            'action1'=>'path.to.ActionClass',
            'action2'=>array(
                'class'=>'path.to.AnotherActionClass',
                'propertyName'=>'propertyValue',
            ),
        );
    }
    */
}
