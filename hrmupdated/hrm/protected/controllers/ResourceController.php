<?php

class ResourceController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionEmpResource()
        {
            Yii::app()->red->redirect();
            $this->render('empresource',"",FALSE);
        }
        public function actionHardwaredetails()
        {   
            $hardware = new HrmHardware();
            $hardware->resource_name = $_REQUEST['hard_name'];
            $hardware->make = $_REQUEST['hard_make'];
            $hardware->model = $_REQUEST['hard_model'];
            $hardware->serial_no = $_REQUEST['hard_serial'];
            $hardware->remarks = $_REQUEST['hard_remarks'];
            $hardware->modification_date = date('Y:m:d H:i:s');
            $hardware->vendor_details = $_REQUEST['hard_vendor'];  
	    
            $hardware->macaddress1 = $_REQUEST['mac_address1'];
	        $hardware->macaddress2 = $_REQUEST['mac_address2'];
            $hardware->macaddress3 = $_REQUEST['mac_address3'];
            $hardware->macaddress4 = $_REQUEST['mac_address4'];
              	

            
            $purch_date = strtotime($_REQUEST['hard_pdate']);
            $nyear = $_REQUEST['hard_warranty_year'];
            $nmonth = $_REQUEST['hard_warranty_month'];
            if($_REQUEST['hard_warranty_month']=="")
                $nmonth = 0;
            if($_REQUEST['hard_warranty_year']=="")
                $nyear = 0;
            $purch_date = strtotime("+$nyear year +$nmonth month", $purch_date);            
            
            //$hardware->warranty = $exp_date;     
            //$exp_date = abs($_REQUEST['hard_pdate'] + $_REQUEST['hard_warranty_year']);            
            $hardware->warranty = date('Y-m-d',$purch_date);
            $hardware->purchase_date = date('Y-m-d',  strtotime($_REQUEST['hard_pdate']));
            
            $hardware->insert();


            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_added'); 
            
                $regmail=Yii::app()->Smtpmail;
       
                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';

                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                
                if ($mailcontents['mail_bcc']!='')
                    $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
                
                
                
                
                $subject = str_replace("#_RESOURCE_NAME_#",$_REQUEST['hard_name'].' '.$_REQUEST['hard_model'],$mailcontents['subject']);
               


                $regmail->Subject = $subject;
                
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$_REQUEST['hard_name'].' '.$_REQUEST['hard_model'],$mailcontents['mail_content']);
                      
                
                $this->layout = FALSE;
                $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //            

            
        }
        public function actionSoftwaredetails(){
            $software = new HrmSoftware();
            $software->resource_name = $_REQUEST['soft_name'];
            $software->make = $_REQUEST['soft_maker'];
            $software->model = $_REQUEST['soft_model'];
            $software->serial_no = $_REQUEST['soft_serial'];
            $software->remarks = $_REQUEST['soft_remark'];
            $software->vendor_details = $_REQUEST['soft_vendor'];
            $software->modification_date = date('Y:m:d H:i:s');
            $purch_date = strtotime($_REQUEST['soft_pdate']);
            $nyear = $_REQUEST['soft_warranty_year'];
            $nmonth = $_REQUEST['soft_warranty_month'];
            if($_REQUEST['soft_warranty_month']=="")
                $nmonth = 0;
            if($_REQUEST['soft_warranty_year']=="")
                $nyear = 0;
            $purch_date = strtotime("+$nyear year +$nmonth month", $purch_date);
            $software->warranty = date('Y-m-d',$purch_date);
            $software->purchase_date = date('Y-m-d',  strtotime($_REQUEST['soft_pdate']));
            $software->save();


            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_added'); 
            
                $regmail=Yii::app()->Smtpmail;
                
                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';

                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                if ($mailcontents['mail_bcc']!='')
                $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
                
                
                $subject = str_replace("#_RESOURCE_NAME_#",$_REQUEST['soft_name'].' '.$_REQUEST['soft_model'],$mailcontents['subject']);
               


                $regmail->Subject = $subject;
                
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$_REQUEST['soft_name'].' '.$_REQUEST['soft_model'],$mailcontents['mail_content']);
                      
                
                $this->layout = FALSE;
                $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //            



        }
        public function actionShowhardwaredetails()
        {   
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
            $display_length = 10;
            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;
            
            $alldata = HrmHardware::model()->get_hardwaredetails($column,$dir,$search,$limit,$display_length);
            $hardcount = HrmHardware::model()->hard_count();
            if($search!="")
                $hard_filer_cnt = HrmHardware::model ()->hard_search_count ($search);
            else
                $hard_filer_cnt = $hardcount;
            
            
            if(count($alldata)>0)
            {
                foreach($alldata as $hardata)
                {   $id = $hardata['id'];
                    

                    if ($hardata['resource_id']>0)
                        $hardwarelinks = '<div style="float:left;width:183px;">'.$hardata['name'].'</div><div style="float:right;padding-right;2px;width:24px;cursor:pointer;"><a class="return_hardware" rel="'.$id.'" alt="Return Hadware Resource" title="Return Hardware Resource"><img src="img/return.png" /></a></div>';
                    else        
                        $hardwarelinks = '<a href="javascript:void(0);" class="hardware_class" rel="'.$id.'"><span class="label label-satgreen">ASSIGN</span></a>';


                    $hardoptions = '<a href="javascript:void(0);" class="hardware_edit" rel="'.$id.'"><span class="label label-satblue">EDIT</span></a>   <a href="javascript:void(0);" class="hardware_history" rel="'.$id.'"><span class="label label-satblue">HISTORY</span></a>  <a href="javascript:void(0);" class="hardware_delete" rel="'.$id.'"><span class="label label-satblue">DELETE</span></a>';
                    $array = array($hardata['resource_name'],$hardata['serial_no'],$hardata['make'], date('F j, Y',  strtotime($hardata['warranty'])),$hardwarelinks,$hardoptions);
                    $newarray[]=$array;
                }
            }
            else {
                $newarray = array();
            }
            $ar = array("recordsTotal"=>$hardcount,"recordsFiltered"=>$hard_filer_cnt,"aaData"=> $newarray);
            echo json_encode($ar);
        }
        public function actionShowsoftwaredetails()
        {   
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
            $display_length = 10;
            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;
            
            
            $allsoft = HrmSoftware::model()->get_softwaredetails($column,$dir,$search,$limit,$display_length);
            
            $softcount = HrmSoftware::model()->soft_count();
            if($search!="")
                $soft_filter_cnt = HrmSoftware::model()->soft_search_count ($search);
            else
                $soft_filter_cnt =  $softcount;
            
            if(count($allsoft)>0)
            {
                foreach ($allsoft as $softdata)
                {
                    $id = $softdata['id'];
                    
                

                    if ($softdata['resource_id']>0)
                        $softwarelinks = '<div style="float:left;width:183px;">'.$softdata['name'].'</div><div style="float:right;padding-right;2px;width:24px;cursor:pointer;"><a class="return_software" rel="'.$id.'" alt="Return Software Resource" title="Return Software Resource"><img src="img/return.png" /></a></div>';
                    else        
                        $softwarelinks = '<a href="javascript:void(0);" class="software_class" rel="'.$id.'"><span class="label label-satgreen">ASSIGN</span></a>';
                    

                    $softoptions = '<a href="javascript:void(0);" class="software_edit" rel="'.$id.'"><span class="label label-satblue">EDIT</span></a>   <a href="javascript:void(0);" class="software_history" rel="'.$id.'"><span class="label label-satblue">HISTORY</span></a>   <a href="javascript:void(0);" class="software_delete" rel="'.$id.'"><span class="label label-satblue">DELETE</span></a>';
                    $array = array($softdata['resource_name'],$softdata['serial_no'],$softdata['make'], date('F j, Y',  strtotime($softdata['warranty'])),$softwarelinks,$softoptions);
                    $newarray[]=$array;
                }
            }
            else {
                $newarray = array();
            }
            $ar = array("recordsTotal"=>$softcount,"recordsFiltered"=>$soft_filter_cnt,"aaData"=> $newarray);
            echo json_encode($ar);
        }
        
        public function actionSearch_hardware_employee()
        {
            $term = $_REQUEST['term'];
            $search_emp = HrmResourceAssign::model()->search_hard_emp($term);
            //$hardcount = HrmResourceAssign::model()->get_assign_details($_REQUEST['employno']);
            echo json_encode($search_emp);
        }
        
        public function actionSearch_software_employee()
        {
            $term = $_REQUEST['term'];
            $search_emp = HrmResourceAssign::model()->search_soft_emp($term);
            echo json_encode($search_emp);
        }

        
        public function actionUsercount(){

            $empno = $_REQUEST['empno'];
            $type = $_REQUEST['type'];
            $cnt =  HrmResourceAssign::model()->get_assign_details($empno,$type);
            echo $cnt['cnt']+1;
        }

        public function actiondeleteResource()
        {
            $resource_id = $_REQUEST['resource_id'];
            $type = $_REQUEST['type'];
            $cnt =  HrmResourceAssign::model()->delete_resource_details($resource_id,$type);


            
            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_assign_return'); 
            
                $regmail=Yii::app()->Smtpmail;
                

                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';


                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                if ($mailcontents['mail_bcc']!='')
                $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
                $Details = HrmResourceAssign::model()->getresourceDetails_delete($resource_id,$type);
                $userdetails = HrmUserMaster::model()->getName($Details['emp_number']);
                



                $subject = str_replace("#_NAME_#",$userdetails['name'],$mailcontents['subject']);
                $subject = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$subject);
               


                $regmail->Subject = $subject;
                $regmsg1 = str_replace("#_NAME_#",$userdetails['name'],$mailcontents['mail_content']);
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$regmsg1);
                      
                
                $this->layout = FALSE;
                $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //            




        }


        public function actionRemoveHardware()
        {
            $hardware_id = $_REQUEST['resource_id'];
            HrmResourceAssign::model()->delete_hardware($hardware_id);


            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_removed'); 
            
                $regmail=Yii::app()->Smtpmail;
                

                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';


                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                if ($mailcontents['mail_bcc']!='')
                $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
                
                $Details = HrmResourceAssign::model()->getresourceDetails_delete($hardware_id,'h');
                
                



                
                $subject = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$mailcontents['subject']);
               


                $regmail->Subject = $subject;
                
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$mailcontents['mail_content']);
                      
                
                $this->layout = FALSE;
                $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //            



        }


        public function actionRemoveSoftware()
        {

            $software_id = $_REQUEST['resource_id'];
            HrmResourceAssign::model()->delete_software($software_id);
            
            
            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_removed'); 
            
                $regmail=Yii::app()->Smtpmail;
                

                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';

                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                if ($mailcontents['mail_bcc']!='')
                $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
                $Details = HrmResourceAssign::model()->getresourceDetails_delete($software_id,'s');
                
                
              
                $subject = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$mailcontents['subject']);
               


                $regmail->Subject = $subject;
                
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$mailcontents['mail_content']);
                      
                
                $this->layout = FALSE;
                $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //            


        }


        public function actionAssign_hardware(){
            
            //print_r($hardcount);
            $empnoo = $_REQUEST['employno'];
            $hardware_id = $_REQUEST['hardware_id'];



            parse_str($_REQUEST['params'],$_REQUEST);
            $hardassign = new HrmResourceAssign();
            $hardassign->product_slno = $empnoo;
            $hardassign->emp_number = $empnoo;
            $hardassign->resource_id = $hardware_id;
            $hardassign->resource_type = 'h';
            $hardassign->assign_date = date("Y-m-d H:i:s");
            $hardassign->save();
            

            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_assign'); 
            
                $regmail=Yii::app()->Smtpmail;
                

                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';

                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                if ($mailcontents['mail_bcc']!='')
                $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
         
                $userdetails = HrmUserMaster::model()->getName($empnoo);
              


                $Details = HrmResourceAssign::model()->getresourceDetails($hardware_id,'h');

               

                $subject = str_replace("#_NAME_#",$userdetails['name'],$mailcontents['subject']);
                $subject = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$subject);
               


                $regmail->Subject = $subject;
                $regmsg1 = str_replace("#_NAME_#",$userdetails['name'],$mailcontents['mail_content']);
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$regmsg1);
                      
                
                $this->layout = FALSE;
                 $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //



        }
        
        public function actionAssign_software()
        {
            $softempno = $_REQUEST['employno'];
            $software_id = $_REQUEST['software_id'];


            parse_str($_REQUEST['params'],$_REQUEST);
            $softassign = new HrmResourceAssign();
            $softassign->product_slno = $softempno;
            $softassign->emp_number = $softempno;
            $softassign->resource_id = $software_id;
            $softassign->resource_type = 's';
            $softassign->assign_date = date("Y-m-d H:i:s");
            $softassign->save();


            //mail send to admin

                $mailcontents = HrmUserMaster::model()->maildata('resource_assign'); 
            
                $regmail=Yii::app()->Smtpmail;
                

                $mailtos = HrmResourceAssign::model()->mailto();

                if ($mailtos[0]['company_name'])
                    $company_name = $mailtos[0]['company_name'];
                else
                    $company_name = '';


                $regmail->SetFrom($mailcontents['from_address'],$company_name);
                if ($mailcontents['mail_bcc']!='')
                $regmail->AddBCC($mailcontents['mail_bcc'],$company_name);
         
                $userdetails = HrmUserMaster::model()->getName($softempno);
                $Details = HrmResourceAssign::model()->getresourceDetails($software_id,'s');


                $subject = str_replace("#_NAME_#",$userdetails['name'],$mailcontents['subject']);
                $subject = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$subject);
               


                $regmail->Subject = $subject;
                $regmsg1 = str_replace("#_NAME_#",$userdetails['name'],$mailcontents['mail_content']);
                $regmsg1 = str_replace("#_RESOURCE_NAME_#",$Details['resource_name'].' '.$Details['model'],$regmsg1);
                      
                
                $this->layout = FALSE;
                $email_content =  $this->render('/manageuser/email',array('content'=>$regmsg1),true);

       
                $regmail->MsgHTML($email_content);
        
                if (count($mailtos)>0)
                {
                    foreach ($mailtos as $key => $value) {

                        $regmail->AddAddress($value['user_name']);


                    }
                 }
                
          
                if(!$regmail->Send()) {
                        // echo "Mailer Error: " . $regmail->ErrorInfo;             
                }else {
                    // echo "Message sent!";
                }


        //











        }
        
        public function actionEditHardwares()
        {
               $edits = HrmHardware::model()->edit_hardwares($_REQUEST['hard_id']);
               echo json_encode($edits);

        }


         public function actionEditSoftwares()
        {
            $editor = HrmSoftware::model()->edit_software($_REQUEST['soft_id']);
            echo json_encode($editor);
        }


            public function actionUpdatesoftware()
        {
            $softupdate = new HrmSoftware();
            $purch_date = strtotime($_REQUEST['softdate']);
            $nyear = $_REQUEST['softyear'];
            $nmonth = $_REQUEST['softmonth'];
            if($_REQUEST['softmonth']=="")
                $nmonth = 0;
            if($_REQUEST['softyear']=="")
                $nyear =  0;
            $purch_date = strtotime("+$nyear year +$nmonth month",$purch_date);
            $purch_date = date('Y-m-d',$purch_date);
            
            $softupdate->updateAll(array('resource_name'=>$_REQUEST['softname'],'make'=>$_REQUEST['softmaker'],'model'=>$_REQUEST['softmodel'],'remarks'=>$_REQUEST['softremark'],'vendor_details'=>$_REQUEST['softvendor'],'purchase_date'=>date('Y-m-d',strtotime($_REQUEST['softdate'])),'warranty'=>$purch_date),'id='.$_REQUEST['soft_id']);            
        }


         public function actionUpdatehardware()
        {   
            $hardupdate = new HrmHardware();
            $purch_date = strtotime($_REQUEST['harddate']);
            
            $nyear = $_REQUEST['warryear'];
            $nmonth = $_REQUEST['warrmonth'];
            if($_REQUEST['warrmonth']=="")
                $nmonth = 0;
            if($_REQUEST['warryear']=="")
                $nyear = 0;
            $purch_date = strtotime("+$nyear year +$nmonth month",$purch_date);
            $purch_date = date('Y-m-d',$purch_date);
            
            $hardupdate->updateAll(array('resource_name'=>$_REQUEST['hardname'],'make'=>$_REQUEST['hardmaker'],'model'=>$_REQUEST['hardmodel'],'remarks'=>$_REQUEST['hardremark'],'vendor_details'=>$_REQUEST['hardvendor'],'purchase_date'=>date('Y-m-d',strtotime($_REQUEST['harddate'])),'warranty'=>$purch_date,'macaddress1'=>$_REQUEST['mac_address1'],'macaddress2'=>$_REQUEST['mac_address2'],'macaddress3'=>$_REQUEST['mac_address3'],'macaddress4'=>$_REQUEST['mac_address4']),'id='.$_REQUEST['hard_id']);
        }


        public function actionshow_history()
        {

            //$resassign = new HrmResourceAssign();
            
            $resource_id = $_REQUEST['resource_id'];
            $type = $_REQUEST['type'];
            $resassign = HrmResourceAssign::model()->getallhistory($resource_id, $type);
            //$resassign->getallhistory($resource_id,$type);
            //print_r($resassign);
            
                
            
            foreach($resassign as $history_data){
                echo '<tr>';
                    //$array = array($history_data['name'],$history_data['assign_date'],$history_data['return_date']);
                    //$newarray[]=$array;
                    echo '<td>'.$history_data['name'].'</td>';
                    echo '<td>'.$history_data['assign_date'].'</td>';
                    if($history_data['status']=='Y')
                        echo '<td>'."On Hold".'</td>';
                    else
                        echo '<td>'.$history_data['return_date'].'</td>';
                
                echo '</tr>';
                echo '<br>';   
                }                        
            
        }
        
        public function actionSoftware_history()
        {
            $resource_id = $_REQUEST['resource_id'];
            $type = $_REQUEST['type'];
            $resassign = HrmResourceAssign::model()->getsoftwarehistory($resource_id, $type);
            foreach($resassign as $history_data){
                echo '<tr>';
                    //$array = array($history_data['name'],$history_data['assign_date'],$history_data['return_date']);
                    //$newarray[]=$array;
                    echo '<td>'.$history_data['name'].'</td>';
                    echo '<td>'.$history_data['assign_date'].'</td>';
                    if($history_data['status']=='Y')
                        echo '<td>'."On Hold".'</td>';
                    else
                        echo '<td>'.$history_data['return_date'].'</td>';
                
                echo '</tr>';
                echo '<br>';   
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
