<?php
date_default_timezone_set('UTC');
class LeaveController extends Controller
{
    public function actionIndex()
    {
            $this->render('index');
    }
    public function actionUserleave()
    {   

        Yii::app()->red->redirect();  // for session redirection

        //check for supervisors


        //url_extras = #lreport

        $supervisor_check = HrmLeave::model()->Supervisor_check();

        $leavearray = HrmLeave::model()->getleaveid();
        $this->render('leaveform',array('leavearray'=>$leavearray,'superviser_cnt'=>$supervisor_check));

    }

    public function actionUserleave_app()
    {
        $session = new CHttpSession;
        $session->open();
        $session['empnumber']= $_REQUEST['employeeno'];
        $supervisor_check = HrmLeave::model()->Supervisor_check();
        $leavearray = HrmLeave::model()->getleaveid();

        $super = array('supervisor'=>$supervisor_check,'dropdown'=>$leavearray);
        //$meged = array_merge($super,array($leavearray));
        //print_r($meged);
        echo json_encode($super);

    }



    function actionShowmyleavebalance()
    {
         Yii::app()->red->redirect();  // for session redirection
        $this->render('leave_balance',"",FALSE);
    }

    function actionShowleavebalance()
    {
        Yii::app()->red->redirect();  // for session redirection

        $rs = new HrmUserMaster();
        $session = new CHttpSession;
        $session->open();
        $empDetails = $rs->getName($session['empnumber']);

        $this->render('admin_leave_balance',array('empname'=>$empDetails['name']));
    }


        function actionAdminbalance()
        {
             Yii::app()->red->ajax_redirect();  // for session redirection
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
            
            $emp_name  = $_REQUEST['emp_name'];
            $emp_num  = $_REQUEST['emp_num'];
            $leave_year  = $_REQUEST['leave_year'];

  


            $cusdata = HrmLeave::model()->AllLeavebalance($limit,$display_length,$search,$emp_num,$leave_year,$column,$dir);
            $cusdata_cnt = HrmLeave::model()->AllLeavebalance_cnt($emp_num,$leave_year);

              if ($search!='')
               $usdata_filter_cnt = HrmLeave::model()->AllLeavebalance_search_cnt($search,$emp_num,$leave_year);
              else
               $usdata_filter_cnt = $cusdata_cnt;



            if(count($cusdata)>0){
                foreach ($cusdata as $cdata){
                  $url = "index.php?r=Leave/Userleave&myleaveid=".$cdata['id'];
                    $array = array($cdata['username'],$cdata['name'],$cdata['leave_number'],$cdata['leave_balance'],'<a href="'.$url.'">View Leaves</a>');
                    $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$cusdata_cnt,"recordsFiltered"=>$usdata_filter_cnt,"data"=> $newarray);
            echo json_encode($ar); 

        }
	
	function actionAdminbalance_app()
        {
             //Yii::app()->red->ajax_redirect();  // for session redirection
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
            
            $emp_name  = $_REQUEST['emp_name'];
            $emp_num  = $_REQUEST['emp_num'];
            $leave_year  = $_REQUEST['leave_year'];

  


            $cusdata = HrmLeave::model()->AllLeavebalance($limit,$display_length,$search,$emp_num,$leave_year,$column,$dir);
            $cusdata_cnt = HrmLeave::model()->AllLeavebalance_cnt($emp_num,$leave_year);

              if ($search!='')
               $usdata_filter_cnt = HrmLeave::model()->AllLeavebalance_search_cnt($search,$emp_num,$leave_year);
              else
               $usdata_filter_cnt = $cusdata_cnt;



            if(count($cusdata)>0){
                foreach ($cusdata as $cdata){
                  //$url = "index.php?r=Leave/Userleave&myleaveid=".$cdata['id'];
                    $array = array($cdata['username'],$cdata['name'],$cdata['leave_number'],$cdata['leave_balance'],'<a class="balanceclass" href="#" rel="'.$cdata['id'].'">View Leaves</a>');
                    $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$cusdata_cnt,"recordsFiltered"=>$usdata_filter_cnt,"data"=> $newarray);
            echo json_encode($ar); 

        }
	

        function actionEmpbalance()
        {

          Yii::app()->red->ajax_redirect();  // for session redirection
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

            $cusdata = HrmLeave::model()->leavebalance($limit,$display_length,$search,$column,$dir);
             $cusdata_cnt = HrmLeave::model()->leavebalance_cnt();

              if ($search!='')
               $usdata_filter_cnt = HrmLeave::model()->leavebalance_search_cnt($search);
            else
               $usdata_filter_cnt = $cusdata_cnt;



            if(count($cusdata)>0){
                foreach ($cusdata as $cdata){
	//if ($cdata['name'] != 'Work From Home (WFH)'){
                    $url = "index.php?r=Leave/Userleave&myleaveid=".$cdata['id'];
                    $array = array($cdata['name'],$cdata['leave_number'],$cdata['leave_balance'],'<a href="'.$url.'">View Leaves</a>');
                    $newarray[]=$array;
		    
	/*}else{

	$cusdata_cnt = ($cusdata_cnt)-1;
		    $usdata_filter_cnt = ($usdata_filter_cnt)-1;
        }*/
           }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$cusdata_cnt,"recordsFiltered"=>$usdata_filter_cnt,"data"=> $newarray);
            echo json_encode($ar);  

        }

        function actionEmpbalance_app()
        {   
            $session = new CHttpSession;
            $session->open();            
            $session['empnumber']=$_REQUEST['empno'];

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

            $cusdata = HrmLeave::model()->leavebalance($limit,$display_length,$search,$column,$dir);
            $cusdata_cnt = HrmLeave::model()->leavebalance_cnt();

              if ($search!='')
               $usdata_filter_cnt = HrmLeave::model()->leavebalance_search_cnt($search);
            else
               $usdata_filter_cnt = $cusdata_cnt;

            if(count($cusdata)>0){
                foreach ($cusdata as $cdata){
	if ($cdata['name'] != 'Work From Home (WFH)'){
                  $url = "index.php?r=Leave/Userleave_app&myleaveid=".$cdata['id'];
                  $leavebalanceid = $cdata['id'];
                    $array = array($cdata['name'],$cdata['leave_number'],$cdata['leave_balance'],'<a rel="'.$leavebalanceid.'" href="#" class="balanceclass">View Leaves</a>');
                    $newarray[]=$array;

                }else{

		    $cusdata_cnt = ($cusdata_cnt)-1;
		    $usdata_filter_cnt = ($usdata_filter_cnt)-1;
            }
        }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$cusdata_cnt,"recordsFiltered"=>$usdata_filter_cnt,"data"=> $newarray);
            echo json_encode($ar);
        }

        public function actionLeavetype()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
            $leave = new HrmLeave();
            #$session = new CHttpSession;
            #$session->open();  
            #$session['leaveid']=$store->id;
            #$session['empno']=$store->emp_number;
            $ltype = $_REQUEST['leavetype'];
            if(isset($_REQUEST['leavetype']))
            {
                $getleaveno = $leave->getMybalanceLeave($_REQUEST['leavetype']);
                #$get = HrmEmployeeLeave::model()->getalldetails($_REQUEST['leave_number']);                
            }

            if ($getleaveno['id'] == 5)
              $leave_dates = $leave->getFestivalLeave();
            else
              $leave_dates = '';

            echo $getleaveno['pending_days']."|".$leave_dates;
            
            
           # print_r($getleaveno);
        }
        
        public function actionLeavetype_app()
        {
            $session = new CHttpSession;
            $session->open();
            $session['empnumber']= $_REQUEST['employeeno'];
            
            $leave = new HrmLeave();
            if(isset($_REQUEST['leavetype']))
            {   
                $getleaveno = $leave->getMybalanceLeave($_REQUEST['leavetype']);                
            }
            if ($getleaveno['id'] == 5)
              $leave_dates = $leave->getFestivalLeave();
            else
              $leave_dates = '';

            echo $getleaveno['pending_days']."|".$leave_dates;
        }

        public function actionAssignleave()
        {  

           Yii::app()->red->ajax_redirect();  // for session redirection
           $ass = new HrmLeave();
           $fromleave = strtotime($_REQUEST['assfromleave']);
           $ass->start_date=  date('Y-m-d',$fromleave);
           $toleave = strtotime($_REQUEST['asstoleave']);
 

            //saturday,sunday,holiday checking

              $from_chk_date = date('Y-m-d',$fromleave);
              $to_chk_date = date('Y-m-d',$toleave);

              $holidays = $ass->checkSATSUNHOL($from_chk_date,$to_chk_date,$_REQUEST['emp_id']);


            //

         


            $diff = abs($toleave-$fromleave);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
             $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));            
           






            if($_REQUEST['asspdays']=="")
              $days=$days+1;
            else if($_REQUEST['asspdays']!=3)
                {
               if($_REQUEST['assistartday']!=3 and $_REQUEST['assendday']!=3)
                {
                  $sdays= '.5';   
                }
                else{
                    
                    if($_REQUEST['assistartday']==3)
                        $dur = $_REQUEST['asstotime']-$_REQUEST['assfromtime'];
                    else
                        $dur = $_REQUEST['assendto']-$_REQUEST['assendfrom'];

                    if($dur<=5){
                        $sdays= '.5';
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
               
                if($diff>0){
                   $days=$days+$sdays;
                }
                else{
                   $days=$sdays;
                }
                        
                    
                }else {
                
                if($_REQUEST['assistartday']!=3)
                {
               $sdays= '.5';   
                }else{
                    
                    if($_REQUEST['assistartday']==3)
                        $dur = $_REQUEST['asstotime']-$_REQUEST['assfromtime'];
                   
                    if($dur<=5){
                        $sdays='.5';
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
                if($_REQUEST['assendday']!=3)
                {
                  $edays='.5';   
                }
                else{
                    
                    if($_REQUEST['assendday']==3)
                        $dur = $_REQUEST['assendto']-$_REQUEST['assendfrom'];
                   
                    if($dur<=5){
                        $edays= '.5';
                    }
                    else{
                        $edays = 1;
                    }
                }
                 if($diff>0){
                   $days=($days-1)+$sdays+$edays;
                }
                else{
                   $days=$sdays;
                }
                
                
                
            }                                              
          
            //holiday validation
           
               $days = $days-$holidays;
            
            if ($days<=0)
            {
                echo 'holiday_error';
                exit;

            }
            //



           $ass->end_date=  date('Y-m-d',$toleave);
           $ass->apply_date=date('Y:m:d H:i:s');
           $ass->leave_comments=$_REQUEST['asscomments'];
           $ass->leave_days=$days;
           $session = new CHttpSession;
           $session->open();
           $ass->createdby=$session['empnumber'];
           $ass->emp_number=$_REQUEST['emp_id'];
           $ass->emp_leave_id=$_REQUEST['assileavetype'];
           $ass->approval = 'approve';

           
           $ass->save();
           $leave = $ass->id;

            $reqtime = new HrmLeaveTime();
            $reqtime->hrm_leave_id=$leave;
            $reqtime->start_day_time=$_REQUEST['assfromtime'];
            $reqtime->start_day_time=$_REQUEST['assendfrom'];
            $reqtime->end_day_time=$_REQUEST['asstotime'];
            $reqtime->end_day_time=$_REQUEST['assendto'];
            $reqtime->save();
            
            $supervisor = new HrmLeaveApproval();
            $super = HrmLeave::model()->getapproval($_REQUEST['emp_id']);
           #print_r($super);
            
           // $leave = $reqtime->id;
            
            if (count($super)>0){
                foreach ($super as $sup){
                      $supervisor->setIsNewRecord(TRUE);
                      $supervisor->id="";
                      $supervisor->hrm_leave_id=$leave;
                      $supervisor->supervisor_id=$sup['user_id'];
                      $supervisor->approval='approve';
                      $supervisor->approval_date=date('Y-m-d H:m:s');
                      $supervisor->save();
                }
            }     


        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leave);
        $employee_name = $leave_details['first_name'];
        $emp_last_name = $leave_details['last_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);


        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }
	
	$gcm = Yii::app()->gcm;
        
	if($leave_details['google_push_id']!="")
        	$gcm->send($leave_details['google_push_id'], 'Leave Approved For '.$leave_date);
	
        $mailcontents = HrmUserMaster::model()->maildata('leave_approve'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LASTNAME_#",$emp_last_name,$subject);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$leave_details['user_name'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$leave_details['user_name'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($leave_details['user_name']);
         
        if(!$regmail->Send()) {
         //   echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }
        }
	
	public function actionShowLeaveStatus_app()
        {
            $session = new CHttpSession;
            $session->open();                 
            $session['empnumber']= $_REQUEST['employeeno'];
            $session['user_role'] = $_REQUEST['user_role'];
             $this->layout = FALSE;
            echo  $email_content =  $this->render('employee_status_app','',true);
            exit;
        }

        public function actionAssignleave_app()
        {   
            $session = new CHttpSession;
            $session->open();                 
            $session['empnumber']= $_REQUEST['emp_id'];
            $text_empno = $_REQUEST['emplno'];
            
            parse_str($_REQUEST['params'],$_REQUEST);
            
            
            
           $ass = new HrmLeave();
                      
           $fromleave = strtotime($_REQUEST['assfromleave']);
           
           $ass->start_date=  date('Y-m-d',$fromleave);
           $toleave = strtotime($_REQUEST['asstoleave']);
           
           
           
            //saturday,sunday,holiday checking

              $from_chk_date = date('Y-m-d',$fromleave);
              $to_chk_date = date('Y-m-d',$toleave);
                            
              
            $holidays = $ass->checkSATSUNHOL($from_chk_date,$to_chk_date,$session['empnumber']);              
              
            $diff = abs($toleave-$fromleave);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
             $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));            
           

            if($_REQUEST['asspdays']=="")
              $days=$days+1;
            else if($_REQUEST['asspdays']!=3)
                {
               if($_REQUEST['assistartday']!=3 and $_REQUEST['assendday']!=3)
                {
                  $sdays= '.5';   
                }
                else{
                    
                    if($_REQUEST['assistartday']==3)
                        $dur = $_REQUEST['asstotime']-$_REQUEST['assfromtime'];
                    else
                        $dur = $_REQUEST['assendto']-$_REQUEST['assendfrom'];

                    if($dur<=5){
                        $sdays= '.5';
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
               
                if($diff>0){
                   $days=$days+$sdays;
                }
                else{
                   $days=$sdays;
                }
                        
                    
                }else {
                
                if($_REQUEST['assistartday']!=3)
                {
               $sdays= '.5';   
                }else{
                    
                    if($_REQUEST['assistartday']==3)
                        $dur = $_REQUEST['asstotime']-$_REQUEST['assfromtime'];
                   
                    if($dur<=5){
                        $sdays='.5';
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
                if($_REQUEST['assendday']!=3)
                {
                  $edays='.5';   
                }
                else{
                    
                    if($_REQUEST['assendday']==3)
                        $dur = $_REQUEST['assendto']-$_REQUEST['assendfrom'];
                   
                    if($dur<=5){
                        $edays= '.5';
                    }
                    else{
                        $edays = 1;
                    }
                }
                 if($diff>0){
                   $days=($days-1)+$sdays+$edays;
                }
                else{
                   $days=$sdays;
                }
                
                
                
            }                                              
          
            //holiday validation
//           echo "days".$days;
//            echo "holidy".$holidays;
//            exit();
               $days = $days-$holidays;
            
            if ($days<=0)
            {
                echo 'holiday_error';
                exit;

            }
           
           
           $ass->end_date=  date('Y-m-d',$toleave);
           $ass->apply_date=date('Y:m:d H:i:s');
           $ass->leave_comments=$_REQUEST['asscomments'];
           $ass->leave_days=$days;               
           $ass->createdby=$text_empno;
           $ass->emp_number=$session['empnumber'];
           $ass->emp_leave_id=$_REQUEST['leavelist'];
           $ass->approval = 'approve';

           
           $ass->save();
           $leave = $ass->id;           
            $reqtime = new HrmLeaveTime();
            $reqtime->hrm_leave_id=$leave;
            $reqtime->start_day_time=$_REQUEST['assfromtime'];
            $reqtime->start_day_time=$_REQUEST['assendfrom'];
            $reqtime->end_day_time=$_REQUEST['asstotime'];
            $reqtime->end_day_time=$_REQUEST['assendto'];
            $reqtime->save();
            
            $supervisor = new HrmLeaveApproval();
            $super = HrmLeave::model()->getapproval_app($session['empnumber'],$text_empno);
           
            if (count($super)>0){
                foreach ($super as $sup){
                      $supervisor->setIsNewRecord(TRUE);
                      $supervisor->id="";
                      $supervisor->hrm_leave_id=$leave;
                      $supervisor->supervisor_id=$sup['user_id'];
                      $supervisor->approval='approve';
                      $supervisor->approval_date=date('Y-m-d H:m:s');
                      $supervisor->save();
                }
            }     


        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leave);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);


        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }
        
        $gcm = Yii::app()->gcm;
        
	if($leave_details['google_push_id']!="")
        	$gcm->send($leave_details['google_push_id'], 'Leave Approved For '.$leave_date);

        $mailcontents = HrmUserMaster::model()->maildata('leave_approve'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$leave_details['user_name'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$leave_details['user_name'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
        
         $regmail->Subject = $subject;
        
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($leave_details['user_name']);
         
        if(!$regmail->Send()) {
         //   echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }





        }

        public function actionReqleave()
        {   
             
             Yii::app()->red->ajax_redirect();  // for session redirection
             $session = new CHttpSession;
            $session->open();
            $fromdate = trim($_REQUEST['fromleave']);
            $todate = trim($_REQUEST['toleave']);

//echo "from".strtotime($fromdate);
//echo "to".strtotime($todate);     
       $diff = abs(strtotime($todate)-  strtotime($fromdate));
    
             $days = floor(($diff/ (60*60*24)));            
            $req = new HrmLeave();
            //saturday,sunday,holiday checking

              $from_chk_date = date('Y-m-d',strtotime($fromdate));
              $to_chk_date = date('Y-m-d',strtotime($todate));

	      $checkforexpiryDate = $req->checkExpiryDate($_REQUEST['leavetype']);
	     
	      if ($checkforexpiryDate['custom_leave_type'] == 'Y'){
		
		if ($checkforexpiryDate['expiry_date']<$from_chk_date || $checkforexpiryDate['expiry_date']<$from_chk_date){
		    
		   echo "expiry_error";
                   exit;
	          				
		}	

			
	      
              }	

              $holidays = $req->checkSATSUNHOL($from_chk_date,$to_chk_date,$session['empnumber']);


            //



            if($_REQUEST['pdays']=="")
              $days=$days+1;
            else if($_REQUEST['pdays']!=3)
                {
               if($_REQUEST['startday']!=3 && $_REQUEST['endday']!=3)
                {
               $sdays=.5;   
                }
                else{
                    
                    if($_REQUEST['startday']==3)
                        $dur = $_REQUEST['totime']-$_REQUEST['fromtime'];
                    else
                        $dur = $_REQUEST['endto']-$_REQUEST['endfrom'];
                    if($dur<=5){
                        $sdays=.5;
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
               
                if($diff>0){
                   $days=$days+$sdays;
                }
                else{
                   $days=$sdays;
                }
                        
                    
                }
            else {
                
                if($_REQUEST['startday']!=3)
                {
               $sdays=.5;   
                }
                else{
                    
                    if($_REQUEST['startday']==3)
                        $dur = $_REQUEST['totime']-$_REQUEST['fromtime'];
                   
                    if($dur<=5){
                        $sdays=.5;
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
                if($_REQUEST['endday']!=3)
                {
               $edays=.5;   
                }
                else{
                    
                    if($_REQUEST['endday']==3)
                        $dur = $_REQUEST['endto']-$_REQUEST['endfrom'];
                   
                    if($dur<=5){
                        $edays=.5;
                    }
                    else{
                        $edays = 1;
                    }
                }
                 if($diff>0){
                   $days=($days-1)+$sdays+$edays;
                }
                else{
                   $days=$sdays;
                }
                


                
                
            }                                              
            



           //holiday validation
             $days =  $days-$holidays;

//if($session['empnumber'] == 81)
//{

//echo $days;
//exit;


//}        

   if ($days>$_REQUEST['leave_balance'] and ($_REQUEST['balance_expt']==0))
              {
                echo 'balance_error';
                exit;

            }
            
            if ($days<=0)
            {
                echo 'holiday_error';
                exit;

            }
            //


        //Request Leave Confirmation to Employee    
        //$mailcontents = HrmUserMaster::model()->maildata('leave_request_confirm'); 
            
       // $regmail=Yii::app()->Smtpmail;
       
       
        $getuerdetails = HrmUserMaster::model()->getName($session['empnumber']);
        $employee_name = $getuerdetails['first_name'];
        $employee_last_name = $getuerdetails['last_name'];

        if ($_REQUEST['startday'] == '')
          $starttype = '';
        elseif ($_REQUEST['startday'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($_REQUEST['startday'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($_REQUEST['endday'] == 'fullday')
          $endtype = '';
        elseif ($_REQUEST['endday'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($_REQUEST['endday'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($fromdate)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($fromdate)).$starttype.' - '.date('F j, Y',strtotime($todate)).$endtype;

        }




        $leave_type = HrmEmployeeLeave::model()->getLeaveType($_REQUEST['leavetype']);
      

      
        // End of mail sending


         //Request Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_request_admin_confirm'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
	$subject = str_replace("#_LASTNAME_#",$employee_last_name,$subject);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$_REQUEST['comments'],$subject);
        
        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$_REQUEST['comments'],$regmsg1);
        
        $regmail->Subject = $subject;

        $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);


        //$regmail->MsgHTML($regmsg1);
      
        $mailUsers = HrmEmployeeLeave::model()->getAllSupervisorsAndAdmin($session['empnumber']);

        if (count($mailUsers)>0)
        {
		$gcm = Yii::app()->gcm;
          foreach ($mailUsers as $key => $users) {
               $regmail->AddAddress($users['user_name']);
		if($users['google_push_id']!="")
		    	$gcm->send($users['google_push_id'], $employee_name.' Applied Leave For '.$leave_date,array("redid"=>"employee_status.html"));
          }


        }

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
           // echo "Message sent!";
        }
        
        // End of mail sending
	
	if($session['empnumber'] == 81)
	{
	//echo $days;
	//exit;
	}  

            $start = strtotime($_REQUEST['fromleave']);
            $req->start_date=  date('Y-m-d',$start);
            $end = strtotime($_REQUEST['toleave']);
            $req->end_date= date('Y-m-d',$end);            
            $req->start_type=$_REQUEST['startday'];
            $req->end_type=$_REQUEST['endday'];
            $req->apply_date=date('Y:m:d H:i:s');
            $req->leave_comments=$_REQUEST['comments'];
            $req->leave_days=$days;
           
            $req->emp_number=$session['empnumber'];
            $req->createdby=$session['empnumber'];
            $req->emp_leave_id=$_REQUEST['leavetype'];
            #$req->emp_leave_id=$_REQUEST['leaveid'];
            $req->save();
            $leave = $req->id;
            $reqtime = new HrmLeaveTime();
            $reqtime->hrm_leave_id=$leave;
            $reqtime->start_day_time=$_REQUEST['fromtime'];
            $reqtime->start_day_time=$_REQUEST['endfrom'];
            $reqtime->end_day_time=$_REQUEST['totime'];
            $reqtime->end_day_time=$_REQUEST['endto'];
            $reqtime->save();
            
            $supervisor = new HrmLeaveApproval();
            $super = HrmLeave::model()->getapproval();
           #print_r($super);
            
            //$leave = $reqtime->id;
            
            if (count($super)>0){
                foreach ($super as $sup){
                      $supervisor->setIsNewRecord(TRUE);
                      $supervisor->id="";
                      $supervisor->hrm_leave_id=$leave;
                      $supervisor->supervisor_id=$sup['user_id'];
                      $supervisor->approval_date=date('Y-m-d');
                      $supervisor->save();
                }
            }                                                      
            
        }


        public function actionReqleave_app()
        {   
            $session = new CHttpSession;
            $session->open();            
            $session['empnumber']= $_REQUEST['employeeno'];
            $session['username'] = $_REQUEST['username'];            
            parse_str($_REQUEST['params'],$_REQUEST);
            $fromdate = $_REQUEST['fromleave'];            
			            
		 
            $todate = $_REQUEST['toleave'];
            $diff = abs(strtotime($todate)-  strtotime($fromdate));
           
            $days = floor(($diff/ (60*60*24)));              
            $req = new HrmLeave();
           
	
              $from_chk_date = date('Y-m-d',strtotime($fromdate));
              $to_chk_date = date('Y-m-d',strtotime($todate));
	
		
              $holidays = $req->checkSATSUNHOL($from_chk_date,$to_chk_date,$session['empnumber']);
              //echo "first h".$holidays;
              
                
            if($_REQUEST['pdays']=="")
              $days=$days+1;         
            else if($_REQUEST['pdays']!=3)
                {
               if($_REQUEST['startday']!=3 && $_REQUEST['endday']!=3)
                {
               $sdays=.5;   
                }
                else{
                    
                    if($_REQUEST['startday']==3)
                        $dur = $_REQUEST['totime']-$_REQUEST['fromtime'];
                    else
                        $dur = $_REQUEST['endto']-$_REQUEST['endfrom'];
                    if($dur<=5){
                        $sdays=.5;
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
               
                if($diff>0){
                   $days=$days+$sdays;
                }
                else{
                   $days=$sdays;
                }
                        
                    
                }
            else {
                
                if($_REQUEST['startday']!=3)
                {
               $sdays=.5;   
                }
                else{
                    
                    if($_REQUEST['startday']==3)
                        $dur = $_REQUEST['totime']-$_REQUEST['fromtime'];
                   
                    if($dur<=5){
                        $sdays=.5;
                    }
                    else{
                        $sdays = 1;
                    }
                }
                
                if($_REQUEST['endday']!=3)
                {
               $edays=.5;   
                }
                else{
                    
                    if($_REQUEST['endday']==3)
                        $dur = $_REQUEST['endto']-$_REQUEST['endfrom'];
                   
                    if($dur<=5){
                        $edays=.5;
                    }
                    else{
                        $edays = 1;
                    }
                }
                 if($diff>0){
                   $days=($days-1)+$sdays+$edays;
                }
                else{
                   $days=$sdays;
                }                                
                
            }   
            
            //print_r($_REQUEST);            
            
           //holiday validation
            
          
             $days =  $days-$holidays;
             
     if ($days>trim($_REQUEST['lbalance']) and ($_REQUEST['balance_expt']==0))
              {
                echo 'balance_error';
                exit;

            }
            
            if ($days<=0)
            {
                echo 'holiday_error';
                exit;
            }        

       
	
        $getuerdetails = HrmUserMaster::model()->getName($session['empnumber']);
        $employee_name = $getuerdetails['first_name'];
        $employee_last_name = $getuerdetails['last_name'];

        if ($_REQUEST['startday'] == '')
          $starttype = '';
        elseif ($_REQUEST['startday'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($_REQUEST['startday'] == 'halfday_evening')
          $starttype = ' Half day evening';

	
         if ($_REQUEST['endday'] == 'fullday')
          $endtype = '';
        elseif ($_REQUEST['endday'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($_REQUEST['endday'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($fromdate)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($fromdate)).$starttype.' - '.date('F j, Y',strtotime($todate)).$endtype;

        }
  
            $leave_type = HrmEmployeeLeave::model()->getLeaveType($_REQUEST['leavetype']);
            $mailcontents = HrmUserMaster::model()->maildata('leave_request_admin_confirm'); 
            //print_r($mailcontents);
            
            
            $regmail=Yii::app()->Smtpmail;
            $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
            $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
            
            $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
	    $subject = str_replace("#_LASTNAME_#",$employee_last_name,$subject);
		
            $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
            $subject = str_replace("#_DAYS_#",$days,$subject);
            $subject = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$subject);
            $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
            $subject = str_replace("#_REASON_#",$_REQUEST['comments'],$subject);
            
            
            $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
            $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
            $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
            $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$regmsg1);
            $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
            $regmsg1 = str_replace("#_REASON_#",$_REQUEST['comments'],$regmsg1);
            
            $regmail->Subject = $subject;
            
            $this->layout = FALSE;
            $email_content =  $this->render('email',array('content'=>$regmsg1),true);
            
            $regmail->MsgHTML($email_content);
            
            $mailUsers = HrmEmployeeLeave::model()->getAllSupervisorsAndAdmin($session['empnumber']);
		
            if (count($mailUsers)>0)
            {
		
              $gcm = Yii::app()->gcm;
		
                foreach ($mailUsers as $key => $users) {
	
		
                    $regmail->AddAddress($users['user_name']);
                    if($users['google_push_id']!="")
		    	$gcm->send($users['google_push_id'], $employee_name.' Applied Leave For '.$leave_date,array("redid"=>"employee_status.html"));
               

}
	
            }
           
            if(!$regmail->Send()) {
                echo "Mailer Error: " . $regmail->ErrorInfo;             
            }
            else {
           // echo "Message sent!";
            }
            
            
            $start = strtotime($_REQUEST['fromleave']);
            $req->start_date=  date('Y-m-d',$start);
            $end = strtotime($_REQUEST['toleave']);
            $req->end_date= date('Y-m-d',$end);            
            $req->start_type=$_REQUEST['startday'];
            $req->end_type=$_REQUEST['endday'];
            $req->apply_date=date('Y:m:d H:i:s');
            $req->leave_comments=$_REQUEST['comments'];
            $req->leave_days=$days;           
            $req->emp_number=$session['empnumber'];
            $req->createdby=$session['empnumber'];
            $req->emp_leave_id=$_REQUEST['leavetype'];
            #$req->emp_leave_id=$_REQUEST['leaveid'];
            $req->save();
            $leave = $req->id;
            
            $reqtime = new HrmLeaveTime();
            $reqtime->hrm_leave_id=$leave;
            $reqtime->start_day_time=$_REQUEST['fromtime'];
            $reqtime->start_day_time=$_REQUEST['endfrom'];
            $reqtime->end_day_time=$_REQUEST['totime'];
            $reqtime->end_day_time=$_REQUEST['endto'];
            $reqtime->save();
            
            $supervisor = new HrmLeaveApproval();
            $super = HrmLeave::model()->getapproval();          
            if (count($super)>0){
                foreach ($super as $sup){
                      $supervisor->setIsNewRecord(TRUE);
                      $supervisor->id="";
                      $supervisor->hrm_leave_id=$leave;
                      $supervisor->supervisor_id=$sup['user_id'];
                      $supervisor->approval_date=date('Y-m-d');
                      $supervisor->save();
                }
            }
        }



        
        public function actionEmployeelist()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
           $emp = new HrmLeave();
           $term = $_REQUEST['term'];
           $suggest = $emp->getAllSuggestions($term);
           
           echo json_encode($suggest);
        }

        public function actionEmployeelist_app()
        {   
          
           $emp = new HrmLeave();

           $term = $_REQUEST['term'];

           $suggest = $emp->getAllSuggestions($term);
           
           echo json_encode($suggest);
        }
        
        public function actionAssLeavetype()
        {

             //Yii::app()->red->ajax_redirect();  // for session redirection
           $leave = new HrmLeave();

            if(isset ($_REQUEST['assiempleave']))
            {
            
                $emp_leaves = $leave->getEmpLeaves($_REQUEST['assiempleave']);
                if (count($emp_leaves)>0){
                     $option_values .="<select class='form-control' id='assileavetype' name='assileavetype'>";
			$option_values .="<option value='' selected='selected'>Select a leave category</option>";
                    foreach ($emp_leaves as $leaves){
                       $option_values .="<option value='{$leaves['id']}'>{$leaves['name']}</option>";
                    }
                    $option_values .="</select>";
                }

                $this->layout=FALSE;
            }
            echo  $option_values;    
            
            #$this->render('assileavetype',array('selectarray'=>$leid),FALSE);
            
        }

        public function actionAssignleavetype()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
            $assleave = new HrmEmployeeLeave();
                       
            #$ltype = $_REQUEST['leavetype'];
            if(isset($_REQUEST['assleavetype']))
            {
                $getleaveno = $assleave->find("leave_type=".$_REQUEST['assleavetype']);                
            }    
            
            echo $getleaveno->leave_number;
            
           # print_r($getleaveno);
        }

        public function actionAssignleavetype_app()
        {               
            $assleave = new HrmEmployeeLeave();                                   
            if(isset($_REQUEST['assleavetype']))
            {
                $getleaveno = $assleave->find("leave_type=".$_REQUEST['assleavetype']);                
            }                
            echo $getleaveno->leave_number;                       
        }

        public function actionAssignleavebalance_app()
        {               
            $leave = new HrmLeave();
            
            if(isset($_REQUEST['assleavetype']))
            {
                $getleaveno = $leave->assignbalanceLeave($_REQUEST['assleavetype'],$_REQUEST['empnum']);                
            }
            if($getleaveno['id'] == 5)
              $leave_dates = $leave->getFestivalLeave();
            else
              $leave_dates = '';
             echo $getleaveno['pending_days']."|".$leave_dates;
        }
        public function actionAssignforbalance()
        {  
            $leave = new HrmLeave();            
            if(isset($_REQUEST['assleavetype']))
            {
                $getleaveno = $leave->assignbalanceLeave($_REQUEST['assleavetype'],$_REQUEST['empnum']);                
            }
            if($getleaveno['id'] == 5)
              $leave_dates = $leave->getFestivalLeave();
            else
              $leave_dates = '';
             echo $getleaveno['pending_days']."|".$leave_dates;
        }
        public function actionEditleave()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection                        
            $getleaves = HrmLeaveTypes::model()->editleave($_REQUEST['leaveid']);
            $getleaves['expiry_date'] = date('m-d-Y',strtotime($getleaves['expiry_date']));
            echo json_encode($getleaves);                           
        }
        
        public function actionUpdateleave()
        {     
             Yii::app()->red->ajax_redirect();  // for session redirection                      
            $update = new HrmLeaveTypes();

            if ($_REQUEST['lexpdate']!='')
              $expiry_date = date('Y-m-d',strtotime($_REQUEST['lexpdate']));
            else
              $expiry_date = date('Y').'-12-31'; 

            $update->updateAll(array('name' => $_REQUEST['lname'],'leave_max_no'=>$_REQUEST['lmaxno'],'expiry_date'=>$expiry_date,
                'probation_period'=>$_REQUEST['lprob']),'id='.$_REQUEST['leaveid']);                                              
        }
        
        public function actionCustomviewleaves()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
           
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

            $cusdata = HrmLeaveTypes::model()->customleaves($limit,$display_length,$search,$column,$dir);
            $cusdata_cnt = HrmLeaveTypes::model()->customleaves_cnt();

              if ($search!='')
               $usdata_filter_cnt = HrmLeaveTypes::model()->customleaves_search_cnt($search);
            else
               $usdata_filter_cnt = $cusdata_cnt;



            if(count($cusdata)>0){
                foreach ($cusdata as $cdata){
                    $array = array($cdata['name'],$cdata['leave_max_no'],date('F j, Y',strtotime($cdata['expiry_date'])),'<button type="button" class="btn btn-success assign" rel="'.$cdata['name'].'" id="'.$cdata['id'].'~'.$cdata['leave_max_no'].'"  >ASSIGN</button>');
                    $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$cusdata_cnt,"recordsFiltered"=>$usdata_filter_cnt,"data"=> $newarray);
            echo json_encode($ar);            
        }

        public function actionCustomUpdateleave()
        {

            extract($_REQUEST);
            $leave = new HrmLeaveTypes(); 
            
           
            $leave->saveCustomLeave($employid,$customleaveid,$custom_leave_no);
            
            $employee_details = HrmUserMaster::model()->getName($employid);
            $leave_details = $leave->editleave($customleaveid);

            //send mail to employee


                $mailcontents = HrmUserMaster::model()->maildata('leave_assign'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_details['name'],$mailcontents['subject']);
        $subject = str_replace("#_EXPIRE_DATE_#",date('F j, Y',strtotime($leave_details['expiry_date'])),$subject);
        $subject = str_replace("#_DAYS_#",$custom_leave_no,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$employee_details['user_name'],$subject);
      

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_details['name'],$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_EXPIRE_DATE_#",date('F j, Y',strtotime($leave_details['expiry_date'])),$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$custom_leave_no,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$employee_details['user_name'],$regmsg1);
        
        
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($employee_details['user_name']);
         
        if(!$regmail->Send()) {
         //   echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }




            //




        }

        public function actionViewleaves()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
            
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

            $leavedata = HrmLeaveTypes::model()->getleavedetails($limit,$display_length,$search,$column,$dir);
            $leavedata_cnt = HrmLeaveTypes::model()->getleavedetails_cnt();
            
             if ($search!='')
               $leavedata_filter_cnt = HrmLeaveTypes::model()->getleavedetails_search_cnt($search);
            else
               $leavedata_filter_cnt = $leavedata_cnt;

            if(count($leavedata)>0){
                
                foreach ($leavedata as $ldata)
                { 
                  $leaveid = $ldata['id'];


                  $option  = '<a href="javascript:void(0);" class=" editleave" rel="'.$leaveid.'" title="EDIT LEAVE"><i class="icon-edit"></i></a>';
                  if ($ldata['custom_leave_type'] == 'Y'){
                    $option .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class=" customleave_remove" rel="'.$leaveid.'" title="Delete"><i class="icon-remove"></i></a>';
                    $leave_type = 'Custom Leave';
                  }else{

                    $leave_type = 'System Leave';

                  }
                  
                  $array = array($ldata['name'],$ldata['leave_max_no'],$ldata['probation_period'],$leave_type,$option);  
                  $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            
             $ar = array("draw"=>$k,"recordsTotal"=>$leavedata_cnt,"recordsFiltered"=>$leavedata_filter_cnt,"data"=> $newarray);
            echo json_encode($ar);
        }


         public function actionMyreport()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
            
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
            $myleaveid = $_REQUEST['myleaveid'];

             if ($_REQUEST['from']!='')
              $from = date('Y-m-d',strtotime($_REQUEST['from']));
            if ($_REQUEST['to']!='')
              $to = date('Y-m-d',strtotime($_REQUEST['to']));
             $leave_status = $_REQUEST['leave_status'];

            $leavedata = HrmLeave::model()->getMyleaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir);
            $leavedata_cnt = HrmLeave::model()->getMyleaveReport_cnt();
            $leavedata_search_cnt = HrmLeave::model()->getMyleaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status);

            
            if(count($leavedata)>0){
                
                foreach ($leavedata as $ldata)
                { 
                  $leaveid = $ldata['id'];
                  
                  if ($ldata['approval'] == 'pending')
                   $option = '<select  class="cancel span3" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="cancel">Cancel</option></select>';
                  elseif ($ldata['approval'] == 'reject') 
                    $option = "Rejected";
                  elseif ($ldata['approval'] == 'approve') {
                    
                    if (strtotime($ldata['end_date'])<strtotime(date('Y-m-d')))
                      $option = "Taken";
                    else{
                         if (strtotime($ldata['start_date'])<=strtotime(date('Y-m-d')))
                            $option = 'Scheduled';
                        else
                            $option = 'Scheduled <select  class="cancel span3" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="cancel">Cancel</option></select>';

                    }

                  }elseif ($ldata['approval'] == 'cancel') 
                    $option = "Cancelled";


                  $array = array($ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$option);  
                  $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$leavedata_cnt,"recordsFiltered"=>$leavedata_cnt,"data"=> $newarray);
            
            echo json_encode($ar);
        }

        public function actionMyreport_app()
        {   
            $session = new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['empno'];
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
            $myleaveid = $_REQUEST['myleaveid'];

             if ($_REQUEST['from']!='')
              $from = date('Y-m-d',strtotime($_REQUEST['from']));
            if ($_REQUEST['to']!='')
              $to = date('Y-m-d',strtotime($_REQUEST['to']));
             $leave_status = $_REQUEST['leave_status'];

            $leavedata = HrmLeave::model()->getMyleaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir);
            $leavedata_cnt = HrmLeave::model()->getMyleaveReport_cnt();
            $leavedata_search_cnt = HrmLeave::model()->getMyleaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status);

            
            if(count($leavedata)>0){
                
                foreach ($leavedata as $ldata)
                { 
                  $leaveid = $ldata['id'];
                  
                  if ($ldata['approval'] == 'pending')
                   $option = '<select  class="cancel span3" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="cancel">Cancel</option></select>';
                  elseif ($ldata['approval'] == 'reject') 
                    $option = "Rejected";
                  elseif ($ldata['approval'] == 'approve') {
                    
                    if (strtotime($ldata['end_date'])<strtotime(date('Y-m-d')))
                      $option = "Taken";
                    else{
                         if (strtotime($ldata['start_date'])<=strtotime(date('Y-m-d')))
                            $option = 'Scheduled';
                        else
                            $option = 'Scheduled <select  class="cancel span3" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="cancel">Cancel</option></select>';

                    }

                  }elseif ($ldata['approval'] == 'cancel') 
                    $option = "Cancelled";


                  $array = array($ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$option);  
                  $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$leavedata_cnt,"recordsFiltered"=>$leavedata_cnt,"data"=> $newarray);
            
            echo json_encode($ar);
        }

	//iphone my leave status

	public function actionMyreport_iphone()
        {   
            $session = new CHttpSession;
            $session->open();
            $session['empnumber'] = $_REQUEST['emp_number'];
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
            $myleaveid = $_REQUEST['myleaveid'];

             if ($_REQUEST['from']!='')
              $from = date('Y-m-d',strtotime($_REQUEST['from']));
            if ($_REQUEST['to']!='')
              $to = date('Y-m-d',strtotime($_REQUEST['to']));
             $leave_status = $_REQUEST['leave_status'];

            $leavedata = HrmLeave::model()->getMyleaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir);
            $leavedata_cnt = HrmLeave::model()->getMyleaveReport_cnt();
            $leavedata_search_cnt = HrmLeave::model()->getMyleaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status);

            
            if(count($leavedata)>0){
                
                foreach ($leavedata as $ldata)
                { 
                  $leaveid = $ldata['id'];
                  
                  if ($ldata['approval'] == 'pending')
                   $option = 'pending_cancel';
                  elseif ($ldata['approval'] == 'reject') 
                    $option = "Rejected";
                  elseif ($ldata['approval'] == 'approve') {
                    
                    if (strtotime($ldata['end_date'])<strtotime(date('Y-m-d')))
                      $option = "Taken";
                    else{
                         if (strtotime($ldata['start_date'])<=strtotime(date('Y-m-d')))
                            $option = 'Scheduled';
                        else
                            $option = 'scheduled_cancel';

                    }

                  }elseif ($ldata['approval'] == 'cancel') 
                    $option = "Cancelled";


                  $array = array($ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$option);  
                  $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$leavedata_cnt,"recordsFiltered"=>$leavedata_cnt,"data"=> $newarray);
            
            echo json_encode($ar);
        }






        public function actionDeleteleave()
        {
          extract($_REQUEST);
          Yii::app()->red->ajax_redirect();  // for session redirection
          $leaveobj = new HrmLeaveTypes();
          $leaveobj->DeleteLeaveType($leaveid);

        }


        public function actionCancel_show()
        {

           $leaveinfo =   HrmLeave::model()->GetLeaveInfo($_REQUEST['leaveid']);
           $leaveinfo['start_date'] = date('F j, Y',strtotime($leaveinfo['start_date']));
           $leaveinfo['end_date'] = date('F j, Y',strtotime($leaveinfo['end_date']));
           
           echo json_encode($leaveinfo);

        }

        public function actionApprove_show()
        {

           $leaveinfo =   HrmLeave::model()->GetLeaveInfo($_REQUEST['leaveid']);
           $leaveinfo['start_date'] = date('F j, Y',strtotime($leaveinfo['start_date']));
           $leaveinfo['end_date'] = date('F j, Y',strtotime($leaveinfo['end_date']));
           
           echo json_encode($leaveinfo);

        }

        


         public function actionAllreport()
        {   
             Yii::app()->red->ajax_redirect();  // for session redirection
            $session = new CHttpSession;
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

            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
            if ($_REQUEST['from']!='')
              $from = date('Y-m-d',strtotime($_REQUEST['from']));
            if ($_REQUEST['to']!='')
              $to = date('Y-m-d',strtotime($_REQUEST['to']));
            $leave_status = $_REQUEST['leave_status'];
            $myleaveid = $_REQUEST['myleaveid'];
             $leavedata = HrmLeave::model()->getAllLeaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir);
             $leavedata_cnt = HrmLeave::model()->getAllLeaveReport_cnt();

              if ($search!='' or $from!='' or $to!='' or $leave_status!='')
                $leavedata_filter_cnt = HrmLeave::model()->getAllLeaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status);
              else
                $leavedata_filter_cnt = $leavedata_cnt;
           

            if(count($leavedata)>0){
                
                foreach ($leavedata as $ldata)
                { 

                  if ($ldata['approval'] == 'pending' and ($ldata['myapproval'] != 'approve' or $session['user_role'] == 1 or $session['user_role'] == 2)){

                     if ($ldata['leave_approval'] != 'Y' and $session['user_role'] != 1 and $session['user_role'] != 2)
                      $option = 'Pending';
                    else{
                      if ($ldata['myapproval'] == 'reject')
                       $option = 'Rejected by you (Pending approval for other supervisor(s)/HR)'; 
                      else
                      $option =  '<select class="approve span10" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="approve">Approve</option><option value="reject">Reject</option></select>';
                    }
                  }
                  elseif ($ldata['approval'] == 'pending'){
                    $option = "Pending approval for other supervisor(s)/HR";
                  }
                  elseif ($ldata['approval'] == 'reject'){
                    $option = "Rejected";
                     if (strtotime($ldata['end_date'])>=strtotime(date('Y-m-d')) and  ($session['user_role'] == 1 or $session['user_role'] == 2)){
                      $option = "Rejected".' <br /><select class="approve span10" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="approve">Approve</option><option value="reject">Reject</option></select>';

                     }
                  }
                  elseif ($ldata['approval'] == 'approve') {
                
                    if (strtotime($ldata['end_date'])<strtotime(date('Y-m-d')))
                      $option = "Taken";
                    else
                      $option = "Scheduled";

                  }elseif ($ldata['approval'] == 'cancel') 
                    $option = "Cancelled";
                  $leaveid = $ldata['id'];
                 
                  $leavedata_supervisor = HrmLeave::model()->getSupervisorData($ldata["leave_id"]);
		$super_status = "";
                  if (count($leavedata_supervisor)>0){
                    $super_status = '';
                      foreach ($leavedata_supervisor as $leavedata)
                      {
                          $status_img = "img/".$leavedata['approval'].".png";
                          $alt = ucfirst($leavedata['approval']);
                          $super_status .= '<a href="javascript:void(0);" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="top" data-toggle="popover" title="" class="approve_popover"><img alt="'.$alt.'" title="'.$alt.'" src="'.$status_img.'"> </a>&nbsp;&nbsp;';

                      }

                  }


                  if ($session['user_role'] == 1 or $session['user_role'] ==2){
                    $array = array($ldata['emp_name'],$ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$ldata['leave_days'],$option,$super_status);  
                  }
                  else{
                   

                    $array = array($ldata['emp_name'],$ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$ldata['leave_days'],$option);  
                  }
                  
                  $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            
             $ar = array("draw"=>$k,"recordsTotal"=>$leavedata_cnt,"recordsFiltered"=>$leavedata_filter_cnt,"data"=> $newarray);
             echo json_encode($ar);
        }

        public function actionAllreport_app()
        {
            $session = new CHttpSession;
            $session->open();
            $session['user_role'] = $_REQUEST['user_role'];
            $session['empnumber'] = $_REQUEST['emponoall'];
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
            if ($_REQUEST['from']!='')
              $from = date('Y-m-d',strtotime($_REQUEST['from']));
            if ($_REQUEST['to']!='')
              $to = date('Y-m-d',strtotime($_REQUEST['to']));
            $leave_status = $_REQUEST['leave_status'];
            $myleaveid = $_REQUEST['myleaveid'];
             $leavedata = HrmLeave::model()->getAllLeaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir);
             $leavedata_cnt = HrmLeave::model()->getAllLeaveReport_cnt();

              if ($search!='' or $from!='' or $to!='' or $leave_status!='')
                $leavedata_filter_cnt = HrmLeave::model()->getAllLeaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status);
              else
                $leavedata_filter_cnt = $leavedata_cnt;
           

            if(count($leavedata)>0){
                
                foreach ($leavedata as $ldata)
                { 

                  if ($ldata['approval'] == 'pending' and ($ldata['myapproval'] != 'approve' or $session['user_role'] == 1 or $session['user_role'] == 2)){

                     if ($ldata['leave_approval'] != 'Y' and $session['user_role'] != 1 and $session['user_role'] != 2)
                      $option = 'Pending';
                    else{
                      if ($ldata['myapproval'] == 'reject')
                       $option = 'Rejected by you (Pending approval for other supervisor(s)/HR)'; 
                      else
                      $option =  '<select class="approve span10" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="approve">Approve</option><option value="reject">Reject</option></select>';
                    }
                  }
                  elseif ($ldata['approval'] == 'pending'){
                    $option = "Pending approval for other supervisor(s)/HR";
                  }
                  elseif ($ldata['approval'] == 'reject'){
                    $option = "Rejected";
                     if (strtotime($ldata['end_date'])>=strtotime(date('Y-m-d')) and  ($session['user_role'] == 1 or $session['user_role'] == 2)){
                      $option = "Rejected".' <br /><select class="approve span10" id="'.$ldata["leave_id"].'"><option>Select---</option><option value="approve">Approve</option><option value="reject">Reject</option></select>';

                     }
                  }
                  elseif ($ldata['approval'] == 'approve') {
                
                    if (strtotime($ldata['end_date'])<strtotime(date('Y-m-d')))
                      $option = "Taken";
                    else
                      $option = "Scheduled";

                  }elseif ($ldata['approval'] == 'cancel') 
                    $option = "Cancelled";
                  $leaveid = $ldata['id'];
                 
                  $leavedata_supervisor = HrmLeave::model()->getSupervisorData($ldata["leave_id"]);
			$super_status = "";
                  if (count($leavedata_supervisor)>0){
                    $super_status = '';
                      foreach ($leavedata_supervisor as $leavedata)
                      {
                          $status_img = "img/".$leavedata['approval'].".png";
                          $alt = ucfirst($leavedata['approval']);
                          $super_status .= '<a href="javascript:void(0);" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="top" data-toggle="popover" title="" class="approve_popover"><img alt="'.$alt.'" title="'.$alt.'" src="'.$status_img.'"> </a>&nbsp;&nbsp;';

                      }
                  }


                  if ($session['user_role'] == 1 or $session['user_role'] ==2){
                    $array = array($ldata['emp_name'],$ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$ldata['leave_days'],$option,$super_status);  
                  }
                  else{
                   

                    $array = array($ldata['emp_name'],$ldata['name'],date('F j, Y',strtotime($ldata['start_date'])),date('F j, Y',strtotime($ldata['end_date'])),$ldata['leave_comments'],$ldata['leave_days'],$option);  
                  }
                  
                  $newarray[]=$array;
                }
            }else{
                $newarray = array();
             }
            
             $ar = array("draw"=>$k,"recordsTotal"=>$leavedata_cnt,"recordsFiltered"=>$leavedata_filter_cnt,"data"=> $newarray);
             echo json_encode($ar);
        }

        public function actionAddleaves()
        {   
            Yii::app()->red->ajax_redirect();  // for session redirection

             if ($_REQUEST['expiry_date']!='')
              $expiry_date = date('Y-m-d',strtotime($_REQUEST['expiry_date']));
            else
              $expiry_date = date('Y').'-12-31'; 

            $add = new HrmLeaveTypes();
            $add->name=$_REQUEST['leavename'];
            $add->leave_max_no=$_REQUEST['leavemax'];
            $add->expiry_date=$expiry_date;
            $add->probation_period=$_REQUEST['leaveprobation'];
            $add->custom_leave_type='Y';
            $add->year=date('Y');
            $add->save();            
        }

        public function actionApprove()
        {
            $session = new CHttpSession;
            $session->open();
           extract($_REQUEST);
           HrmLeave::model()->ApproveLeave($leaveid,$approve_type,$leave_approve_text);


           if ($session['user_role'] == 1 or $session['user_role'] == 2)
           {

                 //approved to employee
                
        if ($approve_type == 'approve')
        {
        

        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leaveid);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }

        
      
        
        // End of mail sending


         //Cancel Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_approve'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($leave_details['user_name']);
         

       
      
        if(!$regmail->Send()) {
         //   echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }
         $gcm = Yii::app()->gcm;
        if($leave_details['google_push_id']!="")
		$gcm->send($leave_details['google_push_id'], 'Leave Approved For '.$leave_date,array("redid"=>"myleave_status.html"));
      }else{



        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leaveid);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }

        
      
        
        // End of mail sending


         //Cancel Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_reject'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($leave_details['user_name']);
         

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }

	$gcm = Yii::app()->gcm;
        if($leave_details['google_push_id']!="")
		$gcm->send($leave_details['google_push_id'], 'Leave Rejected For '.$leave_date,array("redid"=>"myleave_status.html"));

      }

                //rejected to employee


           }else{


           //rejected to hr


            if ($approve_type != 'approve')
            {

         $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leaveid);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }

        
      
        
        // End of mail sending

   
        $mailcontents = HrmUserMaster::model()->maildata('leave_reject_super'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
         $regmail->Subject = $subject;
  
       // $regmail->MsgHTML($regmsg1);

        $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);

       $mailUsers = HrmEmployeeLeave::model()->getAllHRAdmin();
		

        if (count($mailUsers)>0)
        {
		$gcm = Yii::app()->gcm;
          foreach ($mailUsers as $key => $users) {
               $regmail->AddAddress($users['user_name']);
		if($users['google_push_id']!="")
			$gcm->send($users['google_push_id'], $employee_name."'s Leave Rejected For ".$leave_date,array("redid"=>"myleave_status.html"));
          }


        }
        
       
         

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }

      }

           }

          

        }


        public function actionApprove_app()        
        {
            $session = new CHttpSession;
            $session->open();
            $session['user_role'] = $_REQUEST['user_role'];
            $session['empnumber'] = $_REQUEST['emponoall'];
            $session['username'] = $_REQUEST['username'];
            extract($_REQUEST);
            parse_str($_REQUEST['params'],$_REQUEST);
            
                      
           HrmLeave::model()->ApproveLeave($leaveid,$approve_type,$leave_approve_text);

           if ($session['user_role'] == 1 or $session['user_role'] == 2)
           {

                 //approved to employee
                
        if ($approve_type == 'approve')
        {
        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leaveid);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';

         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }
              
        
        // End of mail sending


         //Cancel Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_approve'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($leave_details['user_name']);
         

       
      
        if(!$regmail->Send()) {
         //   echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }
        $gcm = Yii::app()->gcm;
        if($leave_details['google_push_id']!="")
		$gcm->send($leave_details['google_push_id'], 'Leave Approved For '.$leave_date,array("redid"=>"myleave_status.html"));
	
      }else{



        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leaveid);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }             
        
        // End of mail sending


         //Cancel Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_reject'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        
        $regmail->AddAddress($leave_details['user_name']);
         

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }

        $gcm = Yii::app()->gcm;
        if($leave_details['google_push_id']!="")
		$gcm->send($leave_details['google_push_id'], 'Leave Rejected For '.$leave_date,array("redid"=>"myleave_status.html"));
      }

                //rejected to employee


           }else{


           //rejected to hr


            if ($approve_type != 'approve')
            {

         $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($leaveid);
        $employee_name = $leave_details['first_name'];
        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }

        
      
        
        // End of mail sending

   
        $mailcontents = HrmUserMaster::model()->maildata('leave_reject_super'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$leave_details['leave_comments'],$subject);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$subject);

        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_details['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$leave_details['leave_comments'],$regmsg1);
        $regmsg1 = str_replace("#_REMARKS_#",$leave_details['remarks'],$regmsg1);
        
         $regmail->Subject = $subject;
  
       // $regmail->MsgHTML($regmsg1);

        $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);

       $mailUsers = HrmEmployeeLeave::model()->getAllHRAdmin();

        if (count($mailUsers)>0)
        {
          $gcm = Yii::app()->gcm;
          foreach ($mailUsers as $key => $users) {
               $regmail->AddAddress($users['user_name']);               
               if($users['google_push_id']!="")
			$gcm->send($users['google_push_id'], $employee_name."'s Leave Rejected For ".$leave_date,array("redid"=>"myleave_status.html"));
          }


        }
        
       
         

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
            }

            }

           }

          

        }


        public function actionCancel()
        { 
          
           extract($_REQUEST);

          $session = new CHttpSession;
          $session->open(); 

           //Cancel Leave Confirmation to Employee    
       
       
        $getuerdetails = HrmUserMaster::model()->getName($session['empnumber']);
        $employee_name = $getuerdetails['first_name'];

        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($cancel_leave_id);

        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }

        
      
        
        // End of mail sending


         //Cancel Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_cancel_admin'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$_REQUEST['comments'],$subject);
        
        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$_REQUEST['comments'],$regmsg1);
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        $mailUsers = HrmEmployeeLeave::model()->getAllSupervisorsAndAdmin($session['empnumber']);

        if (count($mailUsers)>0)
        {
	$gcm = Yii::app()->gcm;
          foreach ($mailUsers as $key => $users) {
               $regmail->AddAddress($users['user_name']);
		if($users['google_push_id']!="")
			$gcm->send($users['google_push_id'], $employee_name.' Cancelled Leave For '.$leave_date,array("redid"=>"employee_status.html"));
          }


        }

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }
        
        // End of mail sending


           HrmLeave::model()->CancelLeave($cancel_leave_id,$leave_cancel);
          
        }


        public function actionCancel_app()
        { 
          
           extract($_REQUEST);
           
          $session = new CHttpSession;
          $session->open(); 
          $session['empnumber'] = $_REQUEST['canempono'];
          $session['username'] = $_REQUEST['canempname'];
           //Cancel Leave Confirmation to Employee    
          parse_str($_REQUEST['params'],$_REQUEST);
      
        $getuerdetails = HrmUserMaster::model()->getName($session['empnumber']);
        $employee_name = $getuerdetails['first_name'];
        
        $leave_details = HrmEmployeeLeave::model()->getmyleaveDetails($_REQUEST['cancel_leave_id']);

        $start_date = $leave_details['start_date'];
        $end_date = $leave_details['end_date'];
        $diff = strtotime($end_date) - strtotime($start_date);

        if ($leave_details['start_type'] == 'fullday')
          $starttype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $starttype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $starttype = ' Half day evening';


         if ($leave_details['end_type'] == 'fullday')
          $endtype = '';
        elseif ($leave_details['start_type'] == 'halfday_morning')
          $endtype = ' Half day morning';
        elseif ($leave_details['start_type'] == 'halfday_evening')
          $endtype = ' Half day evening';


        if ($diff == 0)
        {
            
            $leave_date = date('F j, Y',strtotime($start_date)).$starttype;


        }else{

            $leave_date = date('F j, Y',strtotime($start_date)).$starttype.' - '.date('F j, Y',strtotime($end_date)).$endtype;

        }

        
      
        
        // End of mail sending


         //Cancel Leave  to Admin/HR/Supervisor
             
        $mailcontents = HrmUserMaster::model()->maildata('leave_cancel_admin'); 
            
        $regmail=Yii::app()->Smtpmail;
       
        $regmail->SetFrom($mailcontents['from_address'],'NETSTRATUM');
        $regmail->AddBCC($mailcontents['mail_bcc'],'NETSTRATUM');
        

        $subject = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['subject']);
        $subject = str_replace("#_LEAVE_DATE_#",$leave_date,$subject);
        $subject = str_replace("#_DAYS_#",$days,$subject);
        $subject = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$subject);
        $subject = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$subject);
        $subject = str_replace("#_REASON_#",$_REQUEST['comments'],$subject);
        
        $regmsg1 = str_replace("#_FIRSTNAME_#",$employee_name,$mailcontents['mail_content']);
        $regmsg1 = str_replace("#_LEAVE_DATE_#",$leave_date,$regmsg1);
        $regmsg1 = str_replace("#_DAYS_#",$days,$regmsg1);
        $regmsg1 = str_replace("#_LEAVE_TYPE_#",$leave_type['name'],$regmsg1);
        $regmsg1 = str_replace("#_EMPLOYEE_EMAIL_#",$session['username'],$regmsg1);
        $regmsg1 = str_replace("#_REASON_#",$_REQUEST['comments'],$regmsg1);
        
         $regmail->Subject = $subject;
        //$regmail->MsgHTML($regmsg1);
       $this->layout = FALSE;
        $email_content =  $this->render('email',array('content'=>$regmsg1),true);

       
        $regmail->MsgHTML($email_content);
        $mailUsers = HrmEmployeeLeave::model()->getAllSupervisorsAndAdmin($session['empnumber']);

        if (count($mailUsers)>0)
        {
          $gcm = Yii::app()->gcm;
          foreach ($mailUsers as $key => $users) {
               $regmail->AddAddress($users['user_name']);
               if($users['google_push_id']!="")
			$gcm->send($users['google_push_id'], $employee_name.' Cancelled Leave For '.$leave_date,array("redid"=>"employee_status.html"));
          }
        }

       
      
        if(!$regmail->Send()) {
            echo "Mailer Error: " . $regmail->ErrorInfo;             
        }else {
          //  echo "Message sent!";
        }
        
        // End of mail sending


           HrmLeave::model()->CancelLeave($_REQUEST['cancel_leave_id'],$leave_cancel);
          
        }

        
}
