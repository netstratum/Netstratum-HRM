<?php

/**
 * This is the model class for table "hrm_projects".
 *
 * The followings are the available columns in table 'hrm_projects':
 * @property integer $id
 * @property string $project_name
 * @property string $status
 * @property string $active
 * @property string $createdby
 */
class HrmProjects extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_projects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_name, createdby', 'required'),
			array('project_name', 'length', 'max'=>300),
			array('status', 'length', 'max'=>9),
			array('active', 'length', 'max'=>1),
			array('createdby', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_name, status, active, createdby', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_name' => 'Project Name',
			'status' => 'Status',
			'active' => 'Active',
			'createdby' => 'Createdby',
		);
	}
        
        
        public function getprojectdetails($column,$dir,$search,$limit,$display_length)
        {   $columns = array(0=>"project_name",1=>"status");
            if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
            else
                $orderby = " order by id desc " ;
            
            if($search!='')
                $search_append .=" AND (project_name) like '%$search%'";
            $session = new CHttpSession;
            $session->open();

            $projdata = Yii::app()->db->createCommand("SELECT id,project_name,status,active,createdby FROM hrm_projects WHERE createdby='$session[empnumber]' $search_append $orderby limit $limit,$display_length")->queryAll();
            return $projdata;
        }
        
        public function projectcount()
        {   $session = new CHttpSession;
            $session->open();
            $projcount = Yii::app()->db->createCommand("SELECT id,project_name,status,active FROM hrm_projects where createdby='$session[empnumber]'")->queryAll();
            return count($projcount);
        }
        public function projectsearchcount($search)
        {
            if ($search!='')
                $search_append .=" AND (project_name) like '%$search%'";
            $session = new CHttpSession;
            $session->open();
            $searchcount = Yii::app()->db->createCommand("SELECT id,project_name,status,active FROM hrm_projects where createdby='$session[empnumber]' $search_append")->queryAll();
            return count($searchcount);
        }
        
        public function taskcount($projectid)
        {
            $taskcount = Yii::app()->db->createCommand("SELECT id,project_id,taskname,status,created_date FROM hrm_project_tasks WHERE project_id='$projectid'")->queryAll();
            return count($taskcount);
        }
        public function tasksearchcount($projectid,$search)
        {
            if($search!='')
                $search_append .=" AND (taskname) like '%$search%'";
            
            $tasksearchcnt = Yii::app()->db->createCommand("SELECT id,project_id,taskname,status,created_date FROM hrm_project_tasks WHERE project_id='$projectid' $search_append")->queryAll();
            return count($tasksearchcnt);
        }

        public function gettaskdetails($projectid,$column,$dir,$search,$limit,$display_length)
        {   $columns = array(0=>"taskname",1=>"created_date");
            if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
            else
                $orderby = " order by id desc " ;
            
            if($search!='')
                $search_append .=" AND (taskname) like '%$search%'";
            $taskdata = Yii::app()->db->createCommand("SELECT id,project_id,taskname,status,created_date FROM hrm_project_tasks WHERE project_id='$projectid' $search_append $orderby limit $limit,$display_length")->queryAll();
            return $taskdata;
        }
        public function timecount($taid)
        {
            $timecount = Yii::app()->db->createCommand("SELECT a.id,a.task_date,a.task_hour,b.taskname FROM hrm_task_hours a INNER JOIN hrm_project_tasks b ON a.task_id=b.id AND b.status='active' WHERE a.task_id='$taid'")->queryAll();
            return count($timecount);
            
        }
        public function timesearchcount($taid,$search)
        {
            if($search!='')
                $search_append .=" and (a.task_date) like '%$search%'";
            $timesearchcount = Yii::app()->db->createCommand("SELECT a.id,a.task_date,a.task_hour,b.taskname FROM hrm_task_hours a INNER JOIN hrm_project_tasks b ON a.task_id=b.id AND b.status='active' WHERE a.task_id='$taid' $search_append")->queryAll();
            return count($timesearchcount);
        }
        public function gettimesheetdetails($taid,$column,$dir,$search,$limit,$display_length)
        {   $columns = array(0=>"b.taskname",1=>"a.task_date",2=>"a.task_hour");
            $session = new CHttpSession;
            $session->open();
            if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
            else
                $orderby = " order by a.id desc " ;
            
            if($search!='')
                $search_append .=" and (a.task_date) like '%$search%'";
            
            $timedata = Yii::app()->db->createCommand("SELECT a.id,a.task_date,a.task_hour,b.taskname FROM hrm_task_hours a INNER JOIN hrm_project_tasks b ON a.task_id=b.id $search_append AND b.status='active' WHERE a.task_id='$taid' and a.emp_number= {$session['empnumber']} $orderby limit $limit,$display_length")->queryAll();
            return $timedata;
        }

        public function gettaskdata($tid)
        {
            $taskdata = Yii::app()->db->createCommand("SELECT taskname FROM hrm_project_tasks WHERE id=".$tid)->queryRow();
            return $taskdata;
        }

        public function getprojectdata($id)
        {           
            $project = Yii::app()->db->createCommand("SELECT project_name,status,active FROM hrm_projects WHERE id=".$id)->queryRow();
            return $project;
        }
        
        public function deletetimesheetdata($tid)
        {
            Yii::app()->db->createCommand("DELETE FROM hrm_task_hours WHERE id=".$tid)->query();
            
        }

        public function deleteprojecttasks($taskis)
        {   
            Yii::app()->db->createCommand("DELETE from hrm_project_tasks WHERE id=".$taskis)->query();
            
        }
        
        public function getallprojectname($empno)
        {  // SELECT a.project_name,a.id,b.user_id FROM hrm_projects a INNER JOIN hrm_report_to b ON a.createdby=b.emp_number WHERE (b.user_type= 'subordinate' AND b.user_id=84) OR  (b.emp_number=84 AND b.user_type='supervisor') GROUP BY a.id
            $getprojectnames = Yii::app()->db->createCommand("SELECT a.project_name,a.id,b.user_id FROM hrm_projects a "
                    . "INNER JOIN hrm_report_to b ON a.createdby=b.emp_number WHERE a.active='Y' AND ((b.user_type= 'subordinate' "
                    . "AND b.user_id='$empno') OR  (b.emp_number='$empno' AND b.user_type='supervisor')OR 
                        (b.emp_number = '$empno' AND b.user_type = 'subordinate')) GROUP BY a.id")->queryAll();
            return $getprojectnames;
        }
        
        public function listtasks($pid)
        {
            $tdata = Yii::app()->db->createCommand("SELECT id,taskname FROM hrm_project_tasks WHERE project_id=".$pid)->queryAll();
            return $tdata;
        }
        
        public function gettaskdate($taskid)
        {
            $taskdate = Yii::app()->db->createCommand("SELECT created_date FROM hrm_project_tasks WHERE id=".$taskid)->queryRow();
            return $taskdate;
        }
        
        public function mytimesheetreport($from,$to,$projectid,$taskid,$column,$dir,$empno)
        {   if($from!='' and $to!='')
                $appendate .=" (c.task_date between '$from' and '$to')";
            
            $columns = array(0=>"a.project_name",1=>"b.taskname",2=>"c.task_date",3=>"c.task_hour");
               if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
               else
                $orderby = " order by c.task_date desc " ;
               
            
            if($taskid > 0)
                $append .= " AND (b.id='$taskid')";
            
            if($projectid > 0)
                $append .= " AND (a.id = '$projectid')";
            
            
            $getmyproject = Yii::app()->db->createCommand("SELECT a.project_name,b.taskname,c.task_date,c.task_hour FROM "
                    . "hrm_task_hours c INNER JOIN hrm_project_tasks b ON c.task_id=b.id INNER JOIN hrm_projects a "
                    . "ON b.project_id=a.id WHERE  $appendate $append AND c.emp_number='$empno' $orderby")->queryAll();
            return $getmyproject;
        }
        
        public function employeetimesheetreport($from,$to,$empid,$projid,$taskid,$checkboxval,$column,$dir,$empnumb)
        {   
            if($from!='' and $to!='')
                $appendate .=" (c.task_date between '$from' and '$to')";
            
            if($checkboxval!="")
                $appendtotal .=" sum(c.task_hour) AS TOTAL,";
                
            
            $columns = array(0=>"a.project_name",1=>"b.taskname",2=>"concat(d.emp_firstname,' ',d.emp_lastname)",3=>"c.task_date",4=>"c.task_hour");
               if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
               else
                $orderby = " order by c.task_date desc " ;
            
            if($empid > 0)
                $appends .= " AND (d.emp_number='$empid')";
            if($projid > 0)
                $appends .= " AND (a.id = '$projid')";
            if($taskid > 0)
                $appends .= " AND (b.id = '$taskid')";
            
            
            
            if($checkboxval=="checked")
                $gptotal .= " GROUP BY c.task_id ";
            
//            echo "SELECT concat(d.emp_firstname,' ',d.emp_lastname) as username,"
//                    . "a.project_name,b.taskname,"
//                    . "c.task_date,$appendtotal c.task_hour "
//                    . "FROM hrm_task_hours c INNER JOIN hrm_project_tasks b ON c.task_id=b.id INNER JOIN hrm_projects a ON "
//                    . "b.project_id=a.id INNER JOIN hrm_employee d ON d.emp_number = c.emp_number "
//                    . "WHERE $appendate $appends and a.createdby='$empnumb' $gptotal $orderby";
//                    exit();
              $session = new CHttpSession;
            $session->open();     
           
            if ($session['user_role'] == 5)
            {
                $getempreport = Yii::app()->db->createCommand("SELECT concat(d.emp_firstname,' ',d.emp_lastname) as username,"
                    . "a.project_name,b.taskname,"
                    . "c.task_date,$appendtotal c.task_hour "
                    . "FROM hrm_task_hours c INNER JOIN hrm_project_tasks b ON c.task_id=b.id INNER JOIN hrm_projects a ON "
                    . "b.project_id=a.id INNER JOIN hrm_employee d ON d.emp_number = c.emp_number "
                    . "WHERE $appendate $appends  $gptotal $orderby")->queryAll();

            }else{
            $getempreport = Yii::app()->db->createCommand("SELECT concat(d.emp_firstname,' ',d.emp_lastname) as username,"
                    . "a.project_name,b.taskname,"
                    . "c.task_date,$appendtotal c.task_hour "
                    . "FROM hrm_task_hours c INNER JOIN hrm_project_tasks b ON c.task_id=b.id INNER JOIN hrm_projects a ON "
                    . "b.project_id=a.id INNER JOIN hrm_employee d ON d.emp_number = c.emp_number "
                    . "WHERE $appendate $appends and a.createdby='$empnumb' $gptotal $orderby")->queryAll();
           
             }
            return $getempreport;
        }
        public function empprojectautolist($term)
        {   
            $session = new CHttpSession;
            $session->open();            
            $pro = Yii::app()->db->createCommand("SELECT id,project_name as label FROM hrm_projects WHERE createdby='{$session['empnumber']}' AND project_name LIKE '%{$term}%'")->queryAll();
            return $pro;
        }
        public function emptaskautolist($term)
        {
            $session = new CHttpSession;
            $session->open();
            $task = Yii::app()->db->createCommand("SELECT id,taskname as label FROM hrm_project_tasks WHERE createdby='{$session['empnumber']}' AND taskname LIKE '%{$term}%'")->queryAll();
            return $task;
        }
        public function employeesearch($term)
        {
            $session = new CHttpSession;
            $session->open();     
           
            if ($session['user_role'] == 5)
            {
              
                $empployee = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_lastname) as label,emp_number "
                    . "FROM hrm_employee "
                    . "Where concat(emp_firstname,' ',emp_lastname) LIKE '%{$term}%' GROUP BY emp_number")->queryAll();


            }else{


                $empployee = Yii::app()->db->createCommand("SELECT concat(d.emp_firstname,' ',d.emp_lastname) as label,d.emp_number "
                    . "FROM hrm_employee d INNER JOIN hrm_report_to c ON (d.emp_number=c.emp_number AND user_type='supervisor') "
                    . "OR (d.emp_number=c.user_id AND user_type='subordinate') WHERE (c.emp_number='{$session['empnumber']}' "
                    . "OR c.user_id='{$session['empnumber']}')  AND c.user_type='supervisor' AND "
                    . "concat(d.emp_firstname,' ',d.emp_lastname) LIKE '%{$term}%' GROUP BY d.emp_number")->queryAll();
            
            }

            return $empployee;
        }

        public function projectautolist($empnum,$term)
        {   
            $pojlist = Yii::app()->db->createCommand("SELECT a.id AS id, a.project_name AS label
                FROM hrm_projects a
                INNER JOIN hrm_report_to b ON a.createdby = b.emp_number
                WHERE (
                (
                b.user_type = 'subordinate'
                AND b.user_id = '$empnum'
                )
                OR (
                b.emp_number = '$empnum'
                AND b.user_type = 'supervisor'
                )
                )
                AND a.active = 'Y'
                AND a.project_name LIKE '%{$term}%'
                GROUP BY a.id")->queryAll();
                            return $pojlist;
        }
        
        
        public function taskautolist($term)
        {
            $tlist = Yii::app()->db->createCommand("SELECT id,taskname as label FROM hrm_project_tasks WHERE status='active' AND taskname LIKE '%{$term}%'")->queryAll();
            return $tlist;
        }

        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('createdby',$this->createdby,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmProjects the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
