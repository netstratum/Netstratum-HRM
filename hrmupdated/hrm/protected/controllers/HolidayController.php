<?php

class HolidayController extends Controller
{
        public function actionHolidayForm(){

            Yii::app()->red->redirect();  // for session redirection
          $this->render('holidayform',"",false);
        }
  
       
        public function actionShowHolidays(){

            $holidays    = new holiday();
            $start_date  = $_REQUEST['start'];
            $end_date    = $_REQUEST['end'];
           

            $allholidays = $holidays->getAllHolidays_Calendar($start_date,$end_date);

            $associateLeave = $holidays->getAllAssociateLeave($start_date,$end_date);

            $allLeaves   = $holidays->getAllLeaves($start_date,$end_date,$_REQUEST['emp_number']);
            $getweekdays = $holidays->getWeekdays($_REQUEST['emp_number']);
            $empnumber = $_REQUEST['emp_number'];
            $weekarray  = array();
            $weekendarray = array();
            foreach ($getweekdays as $key => $value) {
              $weekarray[] = $value['week_days'];
            }
            $j = 0;

            for ($startday=strtotime($start_date); $startday<=strtotime($end_date); $startday=strtotime(' +1 day ',$startday))
            {
                
                if (in_array(date('N', $startday),$weekarray)){
                     $weekendarray[$j]['start'] = date('Y-m-d',$startday);
                    // $weekendarray[$j]['end'] =date('Y-m-d',$startday);
                     $weekendarray[$j]['typename'] = 'weekend';
                    // $weekendarray[$j]['title'] = 'Week End';
                  }
                
                  $j++;
             }
           


            $holiday_time_array = array();
            $json_array = array();
            if (count($allholidays)>0){

              foreach ($allholidays as $holidays)
              {

                  $array =  array('title' => $holidays['name'],"typename"=>$holidays['holiday_type'],"time"=>"00:00","start"=> $holidays['holiday_date'],"end"=> $holidays['holiday_date']);
                  $json_array[] = $array;
                  $holiday_time_array[] = strtotime($holidays['holiday_date']);
              }

           }

          $leaveArray = array();
            if (count($allLeaves)>0)
            {
            
              $i=0;
                foreach ($allLeaves as $key => $leaves) {

                   $startdate = strtotime($leaves['start_date']);
                   $enddate = strtotime($leaves['end_date']);
                   for ($startdate_inc = $startdate; $startdate_inc<=$enddate; $startdate_inc = strtotime(date('Y-m-d',strtotime('+1 day',$startdate_inc))))
                   {
                       $weekday =  date('N',$startdate_inc);

                      if (!in_array($weekday,$weekarray) and !in_array($startdate_inc, $holiday_time_array))
                      { 
                         $leaveArray[$i]['start'] = date('Y-m-d',$startdate_inc);
                         
                         $session = new CHttpSession;
                         $session->open();

                        if (($session['user_role'] == 1 or $session['user_role'] == 2) and file_exists('img/thumbimg-'.$leaves['userid'].'.jpg') ){
                          $img_tag = '<img src="profilepictures/thumbimg-'.$leaves['userid'].'.jpg">';
                        }
                        else
                          $img_tag = '';


                         //$leaveArray[$i]['end'] = date('Y-m-d',$startdate_inc);
                         if ($startdate_inc<strtotime(date('Y-m-d')) and $leaves['approval']!='reject'){

                            // $leaveArray[$i]['title'] = 'Leave Taken';
                             $leaveArray[$i]['typename'] = 'taken';
                            // $leaveArray[$i]['img'] = $img_tag;

                          }elseif ($leaves['approval']!='reject'){
                           // $leaveArray[$i]['title'] = 'Leave Scheduled';
                            $leaveArray[$i]['typename'] = $leaves['approval'];
                           //  $leaveArray[$i]['img'] = $img_tag;
                         }else{

                            //$leaveArray[$i]['title'] =  'Leave Pending';
                            $leaveArray[$i]['typename'] = $leaves['approval'];
                            // $leaveArray[$i]['img'] = $img_tag;


                         }
                         $i++;
                      }

                  }


                }

            }
 
          

            

        

        $json_array = array_merge($leaveArray,$json_array,$weekendarray);
         
        echo json_encode($json_array);

         // echo '[{"title":"All Day Event","start":"2014-12-01"},{"id":"999","typename":"Holiday","title":"HOLIDAY","start":"2014-11-09T16:00:00-05:00","color": "#ED1317"},{"id":"999","title":"Repeating Event","start":"2014-11-16T16:00:00-05:00"},{"title":"Conference","start":"2014-11-11","end":"2014-11-13"},{"title":"Meeting","start":"2014-11-12T10:30:00-05:00","end":"2014-11-12T12:30:00-05:00"},{"title":"Lunch","start":"2014-11-12T12:00:00-05:00"},{"title":"Meeting","start":"2014-11-12T14:30:00-05:00"},{"title":"Happy Hour","start":"2014-11-12T17:30:00-05:00"},{"title":"Dinner","start":"2014-11-12T20:00:00+00:00"},{"title":"Birthday Party","start":"2014-11-13T07:00:00-05:00"},{"url":"http:\/\/google.com\/","title":"Click for Google","start":"2014-11-28"}]';

        }
        
          public function actionDashcalendar(){

            $holidays    = new holiday();
            $start_date  = $_REQUEST['start'];
            $end_date    = $_REQUEST['end'];
           

           // $allholidays = $holidays->getAllHolidays_Calendar($start_date,$end_date);

            $associateLeave = $holidays->getAllAssociateLeave($start_date,$end_date);

           // $allLeaves   = $holidays->getAllLeaves($start_date,$end_date,$_REQUEST['emp_number']);
          //  $getweekdays = $holidays->getWeekdays($_REQUEST['emp_number']);
            //$empnumber = $_REQUEST['emp_number'];
            $weekarray  = array();
            $weekendarray = array();
            foreach ($getweekdays as $key => $value) {
              $weekarray[] = $value['week_days'];
            }
            $j = 0;

            for ($startday=strtotime($start_date); $startday<=strtotime($end_date); $startday=strtotime(' +1 day ',$startday))
            {
                
                if (in_array(date('N', $startday),$weekarray)){
                     $weekendarray[$j]['start'] = date('Y-m-d',$startday);
                    // $weekendarray[$j]['end'] =date('Y-m-d',$startday);
                     $weekendarray[$j]['typename'] = 'weekend';
                    // $weekendarray[$j]['title'] = 'Week End';
                  }
                
                  $j++;
             }
           


            $holiday_time_array = array();
            $json_array = array();
            if (count($allholidays)>0){

              foreach ($allholidays as $holidays)
              {

                  $array =  array('title' => $holidays['name'],"typename"=>$holidays['holiday_type'],"time"=>"00:00","start"=> $holidays['holiday_date'],"end"=> $holidays['holiday_date']);
                  $json_array[] = $array;
                  $holiday_time_array[] = strtotime($holidays['holiday_date']);
              }

           }

          $leaveArray = array();
            if (count($allLeaves)>0)
            {
            
              $i=0;
                foreach ($allLeaves as $key => $leaves) {

                   $startdate = strtotime($leaves['start_date']);
                   $enddate = strtotime($leaves['end_date']);
                   for ($startdate_inc = $startdate; $startdate_inc<=$enddate; $startdate_inc = strtotime(date('Y-m-d',strtotime('+1 day',$startdate_inc))))
                   {
                       $weekday =  date('N',$startdate_inc);

                      if (!in_array($weekday,$weekarray) and !in_array($startdate_inc, $holiday_time_array))
                      { 
                         $leaveArray[$i]['start'] = date('Y-m-d',$startdate_inc);
                         
                         $session = new CHttpSession;
                         $session->open();

                        if (($session['user_role'] == 1 or $session['user_role'] == 2) and file_exists('img/thumbimg-'.$leaves['userid'].'.jpg') ){
                          $img_tag = '<img src="profilepictures/thumbimg-'.$leaves['userid'].'.jpg">';
                        }
                        else
                          $img_tag = '<img src="profilepictures/default.jpg">';


                         //$leaveArray[$i]['end'] = date('Y-m-d',$startdate_inc);
                         if ($startdate_inc<strtotime(date('Y-m-d')) and $leaves['approval']!='reject'){

                            // $leaveArray[$i]['title'] = 'Leave Taken';
                             $leaveArray[$i]['typename'] = 'taken';
                            // $leaveArray[$i]['img'] = $img_tag;

                          }elseif ($leaves['approval']!='reject'){
                           // $leaveArray[$i]['title'] = 'Leave Scheduled';
                            $leaveArray[$i]['typename'] = $leaves['approval'];
                           //  $leaveArray[$i]['img'] = $img_tag;
                         }else{

                            //$leaveArray[$i]['title'] =  'Leave Pending';
                            $leaveArray[$i]['typename'] = $leaves['approval'];
                            // $leaveArray[$i]['img'] = $img_tag;


                         }
                         $i++;
                      }

                  }


                }

            }
 
            $associativeArray = array();

            if (count($associateLeave)>0)
            { 
                

                $mand_holidays = holiday::model()->getHolidays();

                $t = 0;
		$j=0;

                foreach($associateLeave as $associate_value) {
                  

                  $startdate = strtotime($associate_value['start_date']);
                  $enddate = strtotime($associate_value['end_date']);


                   $emp_weekdays = holiday::model()->getWeekdays_employee($associate_value['emp_number']);
                   $emp_weekdays_arr = explode(',',$emp_weekdays);

			 
                   for ($startdate_inc = $startdate; $startdate_inc<=$enddate; $startdate_inc = strtotime(date('Y-m-d',strtotime('+1 day',$startdate_inc))))
                   {

                      if(!in_array(date('Y-m-d',$startdate_inc), $mand_holidays) and in_array(date('N',$startdate_inc), $emp_weekdays_arr)!=1)
                      {
                        $associativeArray[$j]['typename'] = 'leave_scheduler';
                        $associativeArray[$j]['start'] = date('Y-m-d',$startdate_inc);
                       // $associativeArray[$t]['end']   = date('Y-m-d',$startdate_inc);
                        $associativeArray[$j]['title'] = $associate_value['emp_firstname'];
                        $associativeArray[$j]['description'] = $associate_value['emp_firstname']." ".$associate_value['emp_lastname'];
                        
                        $associativeArray[$j]['backgroundColor'] = '#D10A02';
                        $associativeArray[$j]['textColor'] = '#aaaa';
                        if(file_exists('profilepictures/thumbimg-'.$associate_value['userid'].'.jpg') and $associate_value['userid']>0){
                        $img_tag = '<img src="profilepictures/thumbimg-'.$associate_value['userid'].'.jpg">';
                        }
                        else{
                            $img_tag = '<img src="profilepictures/default.jpg">';
                        }
                        $associativeArray[$j]['profileimg'] = $img_tag;


                        
                       $j++;

                      }

                      $t++;

                  }
                
                 
                }

            }

        

      //  $json_array = array_merge($leaveArray,$json_array,$weekendarray,$associativeArray);
         $json_array = $associativeArray;
        echo json_encode($json_array);

         // echo '[{"title":"All Day Event","start":"2014-12-01"},{"id":"999","typename":"Holiday","title":"HOLIDAY","start":"2014-11-09T16:00:00-05:00","color": "#ED1317"},{"id":"999","title":"Repeating Event","start":"2014-11-16T16:00:00-05:00"},{"title":"Conference","start":"2014-11-11","end":"2014-11-13"},{"title":"Meeting","start":"2014-11-12T10:30:00-05:00","end":"2014-11-12T12:30:00-05:00"},{"title":"Lunch","start":"2014-11-12T12:00:00-05:00"},{"title":"Meeting","start":"2014-11-12T14:30:00-05:00"},{"title":"Happy Hour","start":"2014-11-12T17:30:00-05:00"},{"title":"Dinner","start":"2014-11-12T20:00:00+00:00"},{"title":"Birthday Party","start":"2014-11-13T07:00:00-05:00"},{"url":"http:\/\/google.com\/","title":"Click for Google","start":"2014-11-28"}]';
//        $this->layout = FALSE;
//        echo $this->render('dashboardcalendar',array('dashcalendar'=>$associativeArray),true);
        }
        public function actionAddholiday(){
             $holidays = new holiday();
            
            $holidays->name=$_REQUEST['holidayname'];
            $holidays->holiday_date = date('Y-m-d',strtotime($_REQUEST['holidaydate']));
            $holidays->holiday_type = $_REQUEST['holidaytype'];
           
            
            $holidays->save();



        }

        public function actionInsertHoliday(){
            
            $holidays = new holiday();
            
            $repo->emp_number=$_REQUEST['empnumber'];
            $repo->user_id = $_REQUEST['report_user_id'];
            $repo->leave_approval = $_REQUEST['leave_approval'];
            $repo->user_type =$_REQUEST['reportto1'];
            $repo->order_no =$_REQUEST['order_no'];
            
            $repo->save();
        }

        public function actionDeleteHoliday()
        {

          extract($_REQUEST);
          $holidays = new holiday();
          $holidays->deleteHoliday($hol_id);



        }

       public function actionListHoliday()
       {
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

           $holidaylist = holiday::model()->getAllHolidays($limit,$display_length,$search,$column,$dir);
           $holidaylist_cnt = holiday::model()->getAllHolidays_cnt();
          

           if ($search!='')
               $holidaylist_filter_cnt = holiday::model()->getAllHolidays_search_cnt($search);
            else
               $holidaylist_filter_cnt = $holidaylist_cnt;

             if (count($holidaylist)>0){
                  $i=1;
                 foreach ($holidaylist as $details)
                 {   
                   
                        if($details['holiday_date']!= '' and $details['holiday_date']!= "0000-00-00")
                        {
                            $da = strtotime($details['holiday_date']);
                            $date = date('D, M d, Y', $da);
                        }
                        else{
                            $date = "";
                        }
                         $holid = $details['id'];
                       // $editurl = Yii::app()->request->baseUrl."/index.php?r=Manageuser/View&emp_number=".$empid;
                       
                         $option =  '
                                
                                    <a href="javascript:void(0);" class="btn holidayemove" rel="'.$holid.'" title="Delete"><i class="icon-remove"></i></a>';
                      
                      if ($details['holiday_type']=='optional')
                        $holiday_type = 'Optional Holiday';
                      else
                        $holiday_type = 'Holiday';

                     $array = array($details['name'],$date,$holiday_type,$option);
                     $newarray[] = $array;
                     $i++;
                 }
             }else{
                $newarray = array();
             }
            $ar = array("draw"=>$k,"recordsTotal"=>$holidaylist_cnt,"recordsFiltered"=>$holidaylist_filter_cnt,"data"=> $newarray);
            
            
            #$emp1 = HrmEmployee::model()->findByAttributes();
           
            
            
            echo json_encode($ar);


       }

	public function actionLeaveToAllMembers()
        {

            $holidays    = new holiday();
            $start_date  = date('Y-m-d');
            $end_date    = date('Y-m-d');
            $userMaster = new HrmUserMaster();
            $session = new CHttpSession;
            $session->open();
            

            $users = $userMaster->AllActiveUsers_cron();

             $gcm = Yii::app()->gcm;


            foreach ($users as $keylist => $userlist) {
            
              $session['user_role'] = $userlist['user_role_id'];
              $session['empnumber'] = $userlist['emp_number'];

              $associateLeave = $holidays->getAllAssociateLeave($start_date,$end_date);

              $getweekdays = $holidays->getWeekdays($session['empnumber']);
              $empnumber = $session['empnumber'];
              $weekarray  = array();
            
              $weekendarray = array();
            
              $j = 0;

           
 
              $associativeArray = array();

              if (count($associateLeave)>0)
              { 
                

                $mand_holidays = holiday::model()->getHolidays();

                $t = 0;


                foreach($associateLeave as $associate_value) {
                  

                  $startdate = strtotime($associate_value['start_date']);
                  $enddate = strtotime($associate_value['end_date']);


                   $emp_weekdays = holiday::model()->getWeekdays_employee($associate_value['emp_number']);
                   


                   for ($startdate_inc = $startdate; $startdate_inc<=$enddate; $startdate_inc = strtotime(date('Y-m-d',strtotime('+1 day',$startdate_inc))))
                   {

                      if(!in_array(date('Y-m-d',$startdate_inc), $mand_holidays) and !in_array(date('N',$startdate_inc), $emp_weekdays))
                      {
                        
                        $associativeArray[$t]['title'] = $associate_value['emp_firstname'];
                        $associativeArray[$t]['description'] = $associate_value['emp_firstname']." ".$associate_value['emp_lastname'];
                        
                       
                        $gcm->send(array($userlist['google_push_id']), $associate_value['emp_firstname'].' is on Leave Today');

                      }

                      $t++;

                  }
                
                 
                }

              }

     
            
          }


        }

}
