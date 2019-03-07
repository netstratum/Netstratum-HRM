<?php

/**
 * This is the model class for table "hrm_user_master".
 *
 * The followings are the available columns in table 'hrm_user_master':
 * @property integer $id
 * @property integer $user_role_id
 * @property integer $emp_number
 * @property string $user_name
 * @property string $user_password
 * @property integer $deleted
 * @property string $status
 * @property string $date_entered
 * @property string $date_modified
 * @property integer $modified_user_id
 * @property integer $created_by
 */
class HrmUserMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_user_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('user_role_id, emp_number, user_name, user_password, deleted, status, date_entered, date_modified, modified_user_id, created_by', 'required'),
			#array('user_role_id, emp_number, deleted, modified_user_id, created_by', 'numerical', 'integerOnly'=>true),
			array('user_name, user_password', 'length', 'max'=>200),
			#array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			#array('id, user_role_id, emp_number, user_name, user_password, deleted, status, date_entered, date_modified, modified_user_id, created_by', 'safe', 'on'=>'search'),
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
			'user_role_id' => 'User Role',
			'emp_number' => 'Emp Number',
			'user_name' => 'User Name',
			'user_password' => 'User Password',
			'deleted' => 'Deleted',
			'status' => 'Status',
			'date_entered' => 'Date Entered',
			'date_modified' => 'Date Modified',
			'modified_user_id' => 'Modified User',
			'created_by' => 'Created By',
                        'mobile_number' =>  'Mobile Number',
                        'emp_deleted' => 'Emp Deleted',
		);
	}
        
        public function getuserdetails($limit,$display_length,$search,$column,$dir)
        {

         $columns = array(0=>"a.employee_id",1=>"concat(a.emp_firstname,' ',a.emp_lastname)",2=>"e.display_name",
         	3=>"b.user_name",4=>"b.status",5=>"c.join_date");
         
         if ($columns !='')
         	$orderby = "order by ".$columns[$column]." ".$dir;

          $session=new CHttpSession;
          $session->open();

          if ($session['user_role'] != 1)
            $append  = ' and b.user_role_id !=1 ';

        $query = "SELECT e.display_name as user_role_name,b.id as userid,a.employee_id,concat(a.emp_firstname,' ',a.emp_lastname) as Name,"
        . "a.emp_number,b.user_name as Uname,b.status,c.join_date as Jdate,d.job_title FROM hrm_employee a "
                . "INNER JOIN hrm_user_master b ON "
                 . "a.emp_number = b.emp_number  
                 INNER JOIN hrm_user_role e on e.id = b.user_role_id 
                 LEFT JOIN hrm_current_job c ON a.emp_number=c.emp_number 
                 LEFT JOIN hrm_job_title d ON d.id = c.job_title ";

            if ($search!='')
            {

            	$query_where  = " WHERE (concat(a.emp_firstname,' ',a.emp_lastname) like '%$search%' 
            					 or b.user_name like '%$search%' or d.job_title like '%$search%' or
            					 a.employee_id like '%$search%' or e.display_name like '%$search%') and 
            					 a.emp_deleted != 'Y' $append $orderby limit $limit,$display_length ";

            }else{
            	  $query_where = "    WHERE a.emp_deleted != 'Y' $append $orderby limit $limit,$display_length";
            }

          


         $rawData=Yii::app()->db->createCommand($query.$query_where)->queryAll();		 
        return $rawData;
        }


        public function getuserdetails_search_cnt($search)
        {
             $session=new CHttpSession;
             $session->open();
        	 $query = "SELECT b.id as userid,a.employee_id,concat(a.emp_firstname,' ',a.emp_lastname) as Name,"
        . "a.emp_number,b.user_name as Uname,b.status,c.join_date as Jdate,d.job_title FROM hrm_employee a "
                . "INNER JOIN hrm_user_master b ON "
                 . "a.emp_number = b.emp_number 
                 INNER JOIN hrm_user_role e on e.id = b.user_role_id 
                 LEFT JOIN hrm_current_job c ON a.emp_number=c.emp_number 
                 LEFT JOIN hrm_job_title d ON d.id = c.job_title ";
        	
             if ($session['user_role'] != 1)
            $append  = ' and b.user_role_id !=1 ';

        	 $query_where  = " WHERE (concat(a.emp_firstname,' ',a.emp_lastname) like '%$search%' 
            					 or b.user_name like '%$search%' or d.job_title like '%search%' or
            					 a.employee_id like '%$search%' or e.display_name like '%$search%') $append and 
            					 a.emp_deleted != 'Y'";
        	 $rawData=Yii::app()->db->createCommand($query.$query_where)->queryAll();
        	 return count($rawData);

        }

         public function getmaildetails($limit,$display_length,$search,$column,$dir){
         	 $columns = array(0=>"from_address",1=>"mail_bcc",2=>"display_name");
         
         if ($columns !='')
         	$orderby = " order by ".$columns[$column]." ".$dir;

          if ($search!='')
                    $append  = " Where from_address like '%$search%' or  mail_bcc like '%$search%' or display_name like '%$search%' ";

            $maildata = Yii::app()->db->createCommand("SELECT id,from_address,mail_bcc,subject,display_name FROM hrm_mail $append $orderby limit $limit,$display_length")->queryAll();
            return $maildata;
        }
        public function getmaildetails_cnt(){
            $maildata = Yii::app()->db->createCommand("SELECT id,from_address,mail_bcc,display_name FROM hrm_mail")->queryAll();
            return count($maildata);
        }

        public function getmaildetails_search_cnt($search){

        	  if ($search!='')
                    $append  = " Where from_address like '%$search%' or  mail_bcc like '%$search%' or display_name like '%$search%' ";
            $maildata = Yii::app()->db->createCommand("SELECT id,from_address,mail_bcc,display_name FROM hrm_mail $append ")->queryAll();
            return count($maildata);
        }

        public function maileditor($id)
        {
            $mailedit = Yii::app()->db->createCommand("SELECT from_address,mail_bcc,subject,dynamic_variable,mail_content FROM hrm_mail WHERE id=".$id)->queryRow();
            return $mailedit;
        }

        public function AllActiveUsers()
        {
            $year  = date('Y');
             $mailedit = Yii::app()->db->createCommand("SELECT T1.*,T2.leave_number,T2.id as employee_leave_id FROM hrm_user_master T1
               inner join hrm_employee_leave T2 on T1.emp_number = T2.emp_number
               inner join hrm_leave_types T3 on T3.id = T2.leave_type
              WHERE T1.status = 'Y' and T1.emp_deleted = 'N' and T3.id = 3 and T2.year = '$year'")->queryAll();
            return $mailedit;


        }

        public function update_leave_status($leave_number,$employee_leave_id)
        {

            $mailedit = Yii::app()->db->createCommand("Update hrm_employee_leave set leave_number = '$leave_number' Where id = ".$employee_leave_id)->query();
            return $mailedit;

        }


        public function getuserdetails_cnt()
        {
            $session=new CHttpSession;
             $session->open();
              if ($session['user_role'] != 1)
                $append  = ' and b.user_role_id !=1 ';

        $rawData=Yii::app()->db->createCommand("SELECT a.emp_number FROM hrm_employee a "
                . "LEFT JOIN hrm_user_master b ON "
                 . "a.emp_number = b.emp_number LEFT JOIN hrm_current_job c ON a.emp_number=c.emp_number WHERE a.emp_deleted != 'Y' $append ")->queryAll();
         
        return count($rawData);
        }

         public function maildata($templatename)
        {
            $mdata = Yii::app()->db->createCommand("SELECT from_address,mail_bcc,template_name,subject,mail_content FROM hrm_mail WHERE template_name='".$templatename."'")->queryRow();
            return $mdata;
        }
        
        public function getusername($username)
        {
            $user = Yii::app()->db->createCommand("SELECT concat(a.emp_firstname,' ',a.emp_middle_name,' ',a.emp_lastname) as name,"
              . "b.user_name as Uname FROM hrm_employee a LEFT JOIN hrm_user_master b ON a.emp_number=b.emp_number "
                    . "WHERE b.user_name='".$username."'")->queryRow();
            return $user;
        }

        public function getName($empid)
        {
            $user = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_lastname) as name, emp_firstname as first_name, emp_lastname as last_name"
              . " FROM hrm_employee  "
                    . "WHERE emp_number='".$empid."'")->queryRow();
            return $user;
        }

        public function mdbcheck()
        {
            $mdbdata = Yii::app()->db->createCommand("SELECT * from hrm_user_master")->queryRow();
            return $mdbdata;
        }
        
        public function getalldetails($empnumber)
        {
            $getall = Yii::app()->db->createCommand("SELECT a.emp_firstname,a.emp_middle_name,a.emp_lastname,"
                    . "b.id as userid,b.user_role_id,b.user_name,b.mobile_number,b.status,a.emp_dob,a.employee_id,a.emp_gender,"
                    . "c.dependent_name,c.dependent_relation,c.dependent_dob,"
                    . "d.job_title,d.job_status,d.job_category,d.join_date,"
                    . "f.eec_name,f.eec_address,f.eec_city,f.eec_state,f.eec_pincode,f.eec_country,f.eec_relationship,"
                    . "f.eec_home_no,f.eec_mobile_no,f.eec_office_no,h.job_title as job_title_real,g.job_category as job_category_real "
                    . "FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number "
                    . " LEFT JOIN hrm_dependent c ON a.emp_number=c.emp_number "
                    . " LEFT JOIN hrm_current_job d ON a.emp_number=d.emp_number "
                    . " LEFT JOIN hrm_job_category g ON g.id = d.job_category"
                    . " LEFT JOIN hrm_job_title h ON h.id =  d.job_title"
                    . " LEFT JOIN hrm_emp_emergency_contacts f ON a.emp_number=f.emp_number WHERE a.emp_number=".$empnumber )->queryRow();
            return $getall;
        }
        
        
        public function deleteUser($empno)
        {
            
              Yii::app()->db->createCommand("UPDATE hrm_employee SET emp_deleted='Y' WHERE emp_number=".$empno)->query();
              
              Yii::app()->db->createCommand("UPDATE hrm_user_master SET emp_deleted='Y' WHERE emp_number=".$empno)->query();
        }

        public function getUsercheck($uname,$pswd)
        {
        	$user = Yii::app()->db->createCommand("select concat(T2.emp_firstname,' ',T2.emp_lastname) as name,T1.id,T1.user_role_id,T1.emp_number,T1.user_name,T1.user_password from hrm_user_master T1 inner join hrm_employee T2 on T1.emp_number = T2.emp_number where T1.user_name ='".$uname."' and T1.user_password ='".$pswd."' and T1.status='Y'")->queryRow();
    
        	return $user;
        }

         public function updatepassword($newpsw,$uname)
        {
            Yii::app()->db->createCommand("UPDATE hrm_user_master SET user_password='".$newpsw."'"." WHERE user_name='".$uname."'")->query();
        }
        public function addressbook($searchdata)
        {   
            //echo "SELECT a.emp_firstname,a.emp_lastname,b.user_name,b.mobile_number FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number";
            $append =  $searchdata!='' ? " and ( a.emp_firstname LIKE '%{$searchdata}%' or a.emp_lastname LIKE '%{$searchdata}%' ) " : "";
            $addressdata = Yii::app()->db->createCommand("SELECT a.emp_firstname,a.emp_lastname,b.user_name,b.mobile_number,b.id FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number WHERE a.emp_number NOT IN(1,81) $append and b.emp_deleted = 'N' and b.status = 'Y' ORDER BY a.emp_firstname ASC")->queryAll();
            return $addressdata;
        }
        public function searchaddressbook($term)
        {   
            $searchbook = Yii::app()->db->createCommand("SELECT concat(a.emp_firstname,' ',a.emp_lastname) as label,a.emp_number FROM hrm_employee a INNER JOIN hrm_user_master b ON  a.emp_number=b.emp_number WHERE (a.emp_firstname LIKE '%{$term}%' OR a.emp_lastname LIKE '%{$term}%') and b.status = 'Y' and b.emp_deleted = 'N' ")->queryAll();
            return $searchbook;
        }
        
        public function emplyeeaddress($empnum)
        {   //echo "SELECT a.emp_firstname,a.emp_lastname,b.user_name,b.mobile_number,b.id FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number WHERE a.emp_number=".$empnum;
   //exit();
            $append =  "a.emp_number=".$empnum;
            $searchaddress = Yii::app()->db->createCommand("SELECT a.emp_firstname,a.emp_lastname,b.user_name,b.mobile_number,b.id FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number WHERE $append and b.status = 'Y' and b.emp_deleted = 'N'")->queryAll();
            return $searchaddress;
        }
        public function deletesession()
        {
            session_start();
            Yii::app()->db->createCommand("DELETE FROM ajax_chat_online WHERE userID=".$_SESSION['UserID'])->query();
        }
        
        public function getallnotificationgroups()
        {
            $groups = Yii::app()->db->createCommand("SELECT id,job_category FROM hrm_job_category WHERE status='active'")->queryAll();
            return $groups;
        }
        
        public function getallnotifications($column,$dir,$search,$limit,$display_length)
        {   $columns = array(0=>"a.job_category",1=>"b.message",2=>"b.added_date");
            if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
            else
                $orderby = " order by a.id desc " ;
            
            if($search!='')
                $search_append .=" WHERE (b.message) like '%$search%'";
//            echo "SELECT a.job_category,b.id,b.message,b.added_date FROM hrm_job_category a RIGHT JOIN hrm_notification b ON a.id=b.group_id $search_append $orderby limit $limit,$display_length";
//            exit();
            $notifications = Yii::app()->db->createCommand("SELECT a.job_category,b.id,b.message,b.added_date FROM hrm_job_category a RIGHT JOIN hrm_notification b ON a.id=b.group_id $search_append $orderby limit $limit,$display_length")->queryAll();
            return $notifications;
        }
        public function notificationcount()
        {
            $notcount = Yii::app()->db->createCommand("SELECT a.job_category,b.id,b.message,b.added_date FROM hrm_job_category a RIGHT JOIN hrm_notification b ON a.id=b.group_id")->queryAll();
            return count($notcount);
        }
        public function notificationsearchcount($search)
        {   if ($search!='')
                $search_append .=" WHERE (b.message) like '%$search%'";
            
            $notsearchcount = Yii::app()->db->createCommand("SELECT a.job_category,b.id,b.message,b.added_date FROM hrm_job_category a RIGHT JOIN hrm_notification b ON a.id=b.group_id $search_append")->queryAll();
            return count($notsearchcount);
        }
        public function deletenotification($notid)
        {
            Yii::app()->db->createCommand("DELETE FROM hrm_notification WHERE id=".$notid)->query();
        }
        public function getemployeenotifications($employee)
        {   $z = 0;
            
//            $getnotice = Yii::app()->db->createCommand("SELECT a.message,a.added_date FROM hrm_notification a LEFT JOIN hrm_current_job b ON a.group_id=b.job_category WHERE (b.emp_number=$employee OR a.group_id=$z) ORDER BY a.added_date DESC LIMIT 10")->queryAll();
        
        $getnotice = Yii::app()->db->createCommand("SELECT 'notification' AS
                TYPE , a.message, a.added_date, '' AS name
                FROM hrm_notification a
                LEFT JOIN hrm_current_job b ON a.group_id = b.job_category
                WHERE (
                b.emp_number =$employee
                OR a.group_id =$z
                )
                UNION
                SELECT 'dob' AS
                TYPE , '' AS message, CONCAT( DATE_FORMAT( curdate( ) , '%Y' ) , '-', DATE_FORMAT( emp_dob, '%m-%d' ) ) AS added_date, concat( emp_firstname, ' ', emp_lastname ) AS name
                FROM hrm_employee
                WHERE DATE_FORMAT( emp_dob, '%b %d' ) = DATE_FORMAT( NOW( ) , '%b %d' )
                ORDER BY added_date DESC
                LIMIT 0 , 10")->queryAll();
            return $getnotice;
        }
        public function getlastmessages($employee)
        {$z = 0;
		Yii::app()->db->createCommand("SET time_zone = '+5:30'")->query();
		//$timesoze= Yii::app()->db->createCommand("SELECT curtime()")->queryRow();
		//print_r($timesoze);
		
			
            $getlast = Yii::app()->db->createCommand("SELECT a.id as noticeid,'notification' AS
                TYPE , a.message, a.added_date, '' AS name
                FROM hrm_notification a
                LEFT JOIN hrm_current_job b ON a.group_id = b.job_category
                WHERE (
                b.emp_number =$employee
                OR a.group_id =$z
                )
                UNION
                SELECT emp_number as noticeid,'dob' AS
                TYPE , '' AS message, CONCAT( DATE_FORMAT( curdate( ) , '%Y' ) , '-', DATE_FORMAT( emp_dob, '%m-%d' ) ) AS added_date, concat( emp_firstname, ' ', emp_lastname ) AS name
                FROM hrm_employee
                WHERE DATE_FORMAT( emp_dob, '%b %d' ) = DATE_FORMAT( NOW( ) , '%b %d' )
                ORDER BY added_date DESC
                LIMIT 0 , 10")->queryAll();
            return $getlast;
                    
        }

        public function getdesktops()
        {
            $getdesk = Yii::app()->db->createCommand("SELECT desknotice FROM hrm_notification")->queryAll();
            return $getdesk;
        }
        
                public function getallteammembers($groupid)
        {   
            
            $getteam = Yii::app()->db->createCommand("SELECT concat( a.emp_firstname, ' ', a.emp_lastname ) AS name
            FROM hrm_employee a
            INNER JOIN hrm_current_job b ON a.emp_number = b.emp_number
            WHERE b.job_category =".$groupid)->queryAll();
            return $getteam;
        }
	
	public function AllActiveUsers_cron()
        {
              $year  = date('Y');
             $mailedit = Yii::app()->db->createCommand("SELECT T1.date_entered,T1.emp_number,T2.google_push_id,T2.apple_push_id FROM hrm_user_master T1
             INNER JOIN hrm_employee T2 on T1.emp_number = T2.emp_number            
              WHERE T1.status = 'Y' and T1.emp_deleted = 'N' ")->queryAll();
            return $mailedit;


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
		$criteria->compare('user_role_id',$this->user_role_id);
		$criteria->compare('emp_number',$this->emp_number);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('date_entered',$this->date_entered,true);
		$criteria->compare('date_modified',$this->date_modified,true);
		$criteria->compare('modified_user_id',$this->modified_user_id);
		$criteria->compare('created_by',$this->created_by);
                $criteria->compare('emp_deleted',$this->emp_deleted);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function leaveinsert($emp_number,$type_id,$balance,$active,$year)
    	{

        $getteam = Yii::app()->db->createCommand(" insert into hrm_employee_leave
 (emp_number,leave_type,leave_number,active,year) values('$emp_number','$type_id','$balance','$active','$year') ")->query();


    } 

        //for iphone app
	
	 public function getProfileData_iphone($emp_number){
		
		$profile_data = Yii::app()->db->createCommand("SELECT T1.emp_firstname as firstname,DATE_FORMAT(T1.emp_dob,'%m/%d/%Y') as dob,T1.emp_lastname as lastname,T1.emp_middle_name as middlename,T2.mobile_number as mobile from hrm_employee T1
 inner join hrm_user_master T2 on T1.emp_number = T2.emp_number where T1.emp_number = '$emp_number'")->queryRow();

		return $profile_data;

	 
         }


	public function getDependency_iphone($emp_number){


	}


       //

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmUserMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
