<?php

class TimesheetController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
        
        public function actionAddproject()
        {
            Yii::app()->red->redirect();
            $this->render('newproject',"",FALSE);
        }
        public function actionAddtimesheet()
        {
            Yii::app()->red->redirect();
            $this->render('newtimesheet',"",FALSE);
        }
        public function actionShowmyreport()
        {
            Yii::app()->red->redirect();
            $this->render('showmyreport',"",FALSE);
        }
        public function actionSuperreport()
        {
            Yii::app()->red->redirect();
            $this->render('supervisorreport',"",FALSE);
        }

        public function actionNewtimesheet()
        {
            Yii::app()->red->ajax_redirect();
            $tasks = HrmProjects::model()->listtasks($_REQUEST['projvalue']);
           // $tasklists.='<select id="tasklist" name="tasklist">';
            $stri = "--Select--";
            $va = "";
            $tasklists .='<option value="'.$va.'">'.$stri.'</option>';
            foreach ($tasks as $tlist){
                $tname = $tlist['taskname'];
                $tid = $tlist['id'];
                
                
                $tasklists .= '<option value="'.$tid.'">'.$tname.'</option>';
            }
         // $tasklists.='</select>';
            
            echo $tasklists;
           // echo json_encode($array);
            
        }
        
        public function actionWeekrange()
        {
            Yii::app()->red->ajax_redirect();
            $tdate = HrmProjects::model()->gettaskdate($_REQUEST['tasksident']);
            $conv = strtotime($tdate['created_date']);
            $day = date("D",strtotime($tdate['created_date']));
            if($day=="Sun")
               $startday = date('m/d/Y',  $conv);
            else
                $startday = date('m/d/Y',  strtotime('last Sunday',$conv));
            if($day=="Sat")
                $enday = date('m/d/Y', $conv);
            else
                 $enday = date('m/d/Y',  strtotime('next saturday',$conv));
          
            $today = date('m/d/Y', strtotime(date("d.m.Y")));
            $diff = strtotime($today,0) - strtotime($startday,0);
            $weekno= floor($diff / 604800);
            
            $stri = "--Select--";
            $va = "";
            $weeks ='<option value="'.$va.'">'.$stri.'</option>';
                        
            $weeks .='<option value="'.$startday.'">'.$startday.'to'.$enday.'</option>';
            
            while (strtotime($today) > strtotime($enday) ){
            
             $startday = date('m/d/Y',  strtotime('next Sunday',  strtotime($startday)));
              $enday = date('m/d/Y',  strtotime('next saturday',strtotime($startday)));
              $weeks .='<option value="'.$startday.'">'.$startday.'to'.$enday.'</option>';
            }
            echo $weeks;
        }
        
        public function actionWeekdata()
        {
            Yii::app()->red->ajax_redirect();          
            
            $weekstartdate = $_REQUEST['weekdays'];
            $this->layout = FALSE;
            echo $this->render('weeks',array('weekstart'=>$weekstartdate),true);
           
        }
        public function actionCreatetimesheet()
        {
            Yii::app()->red->ajax_redirect();
            
            $addweeks = new HrmTaskHours();
            parse_str($_POST['tid'], $searcharray);
            unset($searcharray['weekstable_length']);
            foreach ($searcharray as $key=>$weekdata){
                
                if(!in_array($key, array('projectlist','tasklist','weeklist')) and $weekdata!=""){
                    $session = new CHttpSession;
                    $session->open();
                    $addweeks->setIsNewRecord(TRUE);
                    $addweeks->id="";
                    $addweeks->emp_number=$session['empnumber'];
                    $addweeks->task_id=$searcharray['tasklist'];
                    $date = str_replace("_","-",$key);
                      
                    $addweeks->task_date=$date;
                    $addweeks->task_hour=$weekdata;
                  
                                        
                    $addweeks->save();
                }
            }                                    
            
        }

        public function actionNewtask()
        {   
            $newtask = new HrmProjectTasks();            
            $newtask->project_id=$_REQUEST['pedit'];            
            $newtask->taskname=$_REQUEST['projtaskname'];            
            $session = new CHttpSession;
            $session->open();
            $newtask->createdby=$session['empnumber'];
            $newtask->created_date=date('Y:m:d');
            #print_r($newtask);
            $newtask->save();
        }

        public function actionUpdateprojectdata()
        {
            $updateproject = new HrmProjects();
            $updateproject->updateAll(array('project_name'=>$_REQUEST['pname'],'status'=>$_REQUEST['pstatus'],'active'=>$_REQUEST['pactive']),'id='.$_REQUEST['pedit']);
        }
        
        public function actionUpdatetaskdata()
        {
            $taskupdate = new HrmProjectTasks();
            $taskupdate->updateAll(array('taskname'=>$_REQUEST['tname']),'id='.$_REQUEST['taskid']);
        }

        public function actionNewproject()
        {
            $newproject = new HrmProjects();
            $newproject->project_name=$_REQUEST['projectname'];
            $newproject->status=$_REQUEST['projectstatus'];
            $newproject->active=$_REQUEST['projectactivate'];
            $session = new CHttpSession;
            $session->open();
            $newproject->createdby=$session['empnumber'];            
            $newproject->save();
        }
        public function actionEditproject()
        {            
            $getprojectdetails = HrmProjects::model()->getprojectdata($_REQUEST['pedit']);
            echo json_encode($getprojectdetails);
        }
        public function actionEdittask()
        {
            $gettaskdetails = HrmProjects::model()->gettaskdata($_REQUEST['taskid']);
            echo json_encode($gettaskdetails);
        }
        public function actionEmployeeprojectsearch()
        {
            Yii::app()->red->ajax_redirect();

            $term = $_REQUEST['term'];
            
            $searchempproj = HrmProjects::model()->empprojectautolist($term);
            echo json_encode($searchempproj);
        }
        public function actionEmployeetasksearch()
        {
            $term = $_REQUEST['term'];
            $searchtask = HrmProjects::model()->emptaskautolist($term);
            echo json_encode($searchtask);
        }
        public function actionEmployeesearch()
        {
            $term = $_REQUEST['term'];
            $searchemployee = HrmProjects::model()->employeesearch($term);
            echo json_encode($searchemployee);
        }
        
        public function actionShowemptimesheet()
        {
            Yii::app()->red->redirect();
            if($_REQUEST['fromdate']=='')
                $from = date('Y-m-01');
            else 
                $from = date('Y-m-d',strtotime($_REQUEST['fromdate']));
            
            
            if($_REQUEST['todate']=='')
                $to = date('Y-m-d');
            else
                $to = date ('Y-m-d',strtotime($_REQUEST['todate']));
            
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            
            $empid = $_REQUEST['empno'];
            $projid = $_REQUEST['projectid'];
            $taskid = $_REQUEST['taskid'];
            
            $checkboxval = $_REQUEST['checkedbox'];
            
            
            $session = new CHttpSession;
            $session->open();                        
            $fullreport = HrmProjects::model()->employeetimesheetreport($from,$to,$empid,$projid,$taskid,$checkboxval,$column,$dir,$session['empnumber']);
            if(count($fullreport)>0){
                foreach ($fullreport as $freport){
                    if($checkboxval=="checked")
                        $array= array($freport['project_name'],$freport['taskname'],$freport['username'],$freport['TOTAL']);
                    else
                        $array= array($freport['project_name'],$freport['taskname'],$freport['username'],$freport['task_date'],$freport['task_hour']);
                        $newarray[]=$array;                    
                }
            }
            else{
                $newarray = array();
            }
            $ar = array("aaData"=> $newarray);
            echo json_encode($ar);
        }
        
        public function actionShowmytimesheet()
        {
            Yii::app()->red->redirect();
                          
                        
            if($_REQUEST['fromdate']=='')
                $from = date('Y-m-01');
            else 
                $from = date('Y-m-d',strtotime($_REQUEST['fromdate']));
            
            if($_REQUEST['todate']=='')
                $to = date('Y-m-d');
            else
                $to = date ('Y-m-d',strtotime($_REQUEST['todate']));
                             
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
                        
            
            $projectid = $_REQUEST['projid'];
            $taskid = $_REQUEST['taskid'];
            
            $session = new CHttpSession;
            $session->open();
            $myreport = HrmProjects::model()->mytimesheetreport($from,$to,$projectid,$taskid,$column,$dir,$session['empnumber']);
            
            if(count($myreport)>0)
            {
                foreach ($myreport as $report){
                    $array = array($report['project_name'],$report['taskname'],$report['task_date'],$report['task_hour']);
                    $newarray[]=$array;
                }  
            }
            else{
                $newarray = array();
            }
            $ar = array("aaData"=> $newarray);
            echo json_encode($ar);
        }
        
        public function actionSearchproject()
        {
            Yii::app()->red->ajax_redirect();
            $session = new CHttpSession;
            $session->open();
            $term = $_REQUEST['term'];
            $searchproj = HrmProjects::model()->projectautolist($session['empnumber'],$term);
            echo json_encode($searchproj);
        }
        public function actionSearchtask()
        {
            Yii::app()->red->ajax_redirect();
            $term = $_REQUEST['term'];
            $searchtask = HrmProjects::model()->taskautolist($term);
            echo json_encode($searchtask);           
        }
                        
        
        public function actionViewtimesheets()
        {
            Yii::app()->red->ajax_redirect();
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
            $display_length = 5;
            $limit = $_REQUEST['start'];
            
            if ($limit=='')
              $limit = 0;
            
            $timedata = HrmProjects::model()->gettimesheetdetails($_REQUEST['taid'],$column,$dir,$search,$limit,$display_length);
            $time_cnt = HrmProjects::model()->timecount($_REQUEST['taid']);
            if($search!='')
                $time_filter_cnt = HrmProjects::model ()->timesearchcount ($_REQUEST['taid'], $search);
            else
                $time_filter_cnt = $time_cnt;
            
            if(count($timedata)>0){
                foreach ($timedata as $tdatas){
                    $id = $tdatas['id'];
                    //$timesheet= '<a class="timesheetedit" href="javascript:void(0);" rel="'.$id.'" title="Edit"><i class="icon-edit"></i></a>';
                    $timesheet = '<a href="javascript:void(0);" class="timesheetdelete" rel="'.$id.'" title="Delete"><i class="icon-remove"></i></a>';
                    $array = array($tdatas['taskname'],  date('F j, Y',  strtotime($tdatas['task_date'])),$tdatas['task_hour'],$timesheet);
                        $newarray[]=$array;
                }
            }
            else{
                $newarray = array();
            }
            $ar = array("recordsTotal"=>$time_cnt,"recordsFiltered"=>$time_filter_cnt,"aaData"=> $newarray);
            echo json_encode($ar);
        }

        public function actionViewtasks()
        {
            Yii::app()->red->ajax_redirect();
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
            $display_length = 10;
            $limit = $_REQUEST['start'];
            if ($limit=='')
              $limit = 0;
            
            $taskdetails = HrmProjects::model()->gettaskdetails($_REQUEST['pedit'],$column,$dir,$search,$limit,$display_length);
            $task_cnt = HrmProjects::model()->taskcount($_REQUEST['pedit']);
            if($search!='')
                $task_filter_cnt = HrmProjects::model ()->tasksearchcount ($_REQUEST['pedit'], $search);
            else
                $task_filter_cnt = $task_cnt;
            
            if(count($taskdetails)>0){
                foreach ($taskdetails as $tdata){
                    $tid = $tdata['id'];
                    if($tdata['status']=='active')
                        $active = 'Active';
                    else                                                
                        $active = 'Inactive';
                    $tasks = '<a class="taskedit" href="javascript:void(0);" rel="'.$tid.'" title="Edit"><i class="icon-edit"></i></a>'
                            . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="taskdelete" rel="'.$tid.'" title="Delete"><i class="icon-remove"></i></a>';
                    
                    $array = array($tdata['taskname'],$tdata['created_date'],$tasks);
                    $newarray[]=$array;
                    
                }
            }
            else{
                $newarray = array();
            }
            $ar = array("recordsTotal"=>$task_cnt,"recordsFiltered"=>$task_filter_cnt,"aaData"=> $newarray);
            echo json_encode($ar);
        }
        
        public function actionDeletetimesheet()
        {   extract($_REQUEST);
            Yii::app()->red->ajax_redirect();
            $timeedit = HrmProjects::model()->deletetimesheetdata($_REQUEST['timesid']);
            
        }
        
        public function actionDeletetask()
        {
            extract($_REQUEST);
            Yii::app()->red->ajax_redirect();
            $tasks = new HrmProjects();            
            $tasks->deleteprojecttasks($taskid);
        }

        public function actionViewproject()
        {
            Yii::app()->red->ajax_redirect();
            
            $column = $_REQUEST['order']['0']['column'];
            $dir    = $_REQUEST['order']['0']['dir'];
            $search = $_REQUEST['search']['value'];
                           
            $display_length = 10;
            
            $limit = $_REQUEST['start'];
            
            if ($limit=='')
              $limit = 0;
            
            $profdetails = HrmProjects::model()->getprojectdetails($column,$dir,$search,$limit,$display_length);
            
            $project_cnt = HrmProjects::model()->projectcount();            
            if($search!='')
                $project_filter_cnt = HrmProjects::model ()->projectsearchcount ($search);
            else
                $project_filter_cnt = $project_cnt;
            
            if(count($profdetails)>0){
                foreach ($profdetails as $pdata){
                    $pid = $pdata['id'];
                    //$editurl = Yii::app()->request->baseUrl."/index.php?r=Timesheet/Editproject&proj_id=".$pid;
                    if($pdata['active']=='Y')
                        $active = 'Active';
                    else
                        $active = 'Inactive';
                        $project = '<a class = "projstatus" href="javascript:void(0);" rel="'.$pid.'_'.$pdata['active'].'"><img src="img/Active'.$pdata['active'].'.png" alt="'.$active.'" title="'.$active.'"></a>'
                                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="projedit" href="javascript:void(0);" rel="'.$pid.'" title="Edit"><i class="icon-edit"></i></a>';
                        $array = array($pdata['project_name'],$pdata['status'],$project);
                        $newarray[]=$array;
                                      
                }                
            }
            $ar = array("recordsTotal"=>$project_cnt,"recordsFiltered"=>$project_filter_cnt,"aaData"=> $newarray);
            echo json_encode($ar);
        }
        
        public function actionStatus()
        {
            extract($_REQUEST);
            if ($projstatus == 'Y')
                HrmProjects::model()->updateByPk($projid,array('active'=>'N'));
            else
                HrmProjects::model()->updateByPk($projid,array('active'=>'Y'));
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