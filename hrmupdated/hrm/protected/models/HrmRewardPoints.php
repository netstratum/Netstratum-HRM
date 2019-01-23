<?php
/**
 * This is the model class for table "hrm_user_master".
 *
 * The followings are the available columns in table 'hrm_user_master':
 * @property integer $id
 * @property integer $emp_number
 * @property string  $supervisor_id
 * @property string  $reward_points
 * @property integer $recognized_for
 * @property string  $message
 * @property string  $updated_date
 * @property string  $redeem
 */
class HrmRewardPoints extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_reward_points';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('reward_points', 'numerical', 'integerOnly'=>true),
			
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

	//to get remaining points for a subordinate
	public function getUsedPoints($emp_id)
	{
		$session = new CHttpSession;
		$session->open();

		$rowlist = Yii::app()->db->createCommand("SELECT sum(reward_points) as sum,supervisor_id from hrm_reward_points
			Where supervisor_id = '{$session['empnumber']}' and emp_number = '{$emp_id}' and YEAR(now()) = YEAR(updated_date) group by supervisor_id
		 ")->queryRow();
		return $rowlist['sum'];

	}


	//update reward points
	public function redeemRewardPoints($points)
	{
		$session = new CHttpSession;
		$session->open();
		$updated_date = date("Y-m-d H:i:s");
		$rowlist = Yii::app()->db->createCommand("update hrm_reward_points set redeem='Y' where emp_number=".$session['empnumber'])->query();
		Yii::app()->db->createCommand("insert into hrm_reward_taken (emp_number,points,updated_date) values ('{$session['empnumber']}','{$points}','".$updated_date."')")->query();
		
	}


	public function getAllEmails($emp_id)
	{
		$session = new CHttpSession;
		$session->open();

		$rowlist = Yii::app()->db->createCommand("SELECT T1.user_name from hrm_user_master T1
		 	inner join hrm_employee T2 on T1.emp_number = T2.emp_number		  
			Where T1.status = 'Y' and T1.emp_deleted = 'N' and T2.emp_deleted='N' and T2.emp_status = 'Y'
			and T1.user_role_id>1")->queryAll();


	}


	//to get the mail details for supervisor and employee
	public function getMailDetailsForRewardMail($emp_id)
	{
		$session = new CHttpSession;
		$session->open();

		$rowlist = Yii::app()->db->createCommand("SELECT concat(T2.emp_firstname,' ',T2.emp_middle_name,' ',T2.emp_lastname) 
		as empname, concat(T4.emp_firstname,' ',T4.emp_middle_name,' ',T4.emp_lastname) 
		as supervisorname, T3.user_name, T5.user_name as supervisor_user_name from hrm_report_to T1 inner join 
        hrm_employee T2 on T1.emp_number = T2.emp_number inner join
        hrm_employee T4 on T1.user_id = T4.emp_number inner join
		hrm_user_master T3 on T1.emp_number = T3.emp_number inner join
		hrm_user_master T5 on T1.user_id = T5.emp_number where T1.emp_number = ".$emp_id." 
		and T1.user_id = ".$session['empnumber']." and T1.user_type = 'supervisor'
		")->queryRow();
		return $rowlist;

	}

	public function ShowallRewards($limit,$display_length,$search,$emp_num,$start_date,$end_date,$column,$dir,$supervisor) {

		$session = new CHttpSession;
        $session->open();
        
        $columns = array(0=>"T1.updated_date",1=>"concat(T2.emp_firstname,' ',T2.emp_middle_name,' ',T2.emp_lastname)",2=>"T1.recognized_for",
                3=>"T1.reward_points",4=>"");

               if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
               else
				$orderby = " order by T1.updated_date desc " ;
		$append = '';
		if (!in_array($session['user_role'],array(1,2))){
			
			if ($supervisor == true){
				$append .= " and T1.supervisor_id = ".$session['empnumber'];
			}else{
				$append .= "  and T1.emp_number = ".$session['empnumber'];
			}

		}

		if ($emp_num>0)
		{
			$append .= "  and T1.emp_number = ".$emp_num;
		}

		if ($start_date!='' and $end_date!='')
		{	
			$from = date('Y-m-d',strtotime($start_date));
			$to = date('Y-m-d',strtotime($end_date));
			
			$append .= "  and DATE(T1.updated_date) between '".$from."' and '".$to."'";

		}else if ($start_date!='') {

			$from = date('Y-m-d',strtotime($start_date));
			 $append .= "  and DATE(T1.updated_date) >= '".$from."'";

		}elseif ($end_date!='') {

			$to = date('Y-m-d',strtotime($end_date));
			$append .= "  and DATE(T1.updated_date) <= '".$to."'";
		}
		

		$result =Yii::app()->db->createCommand("Select T1.updated_date, T1.recognized_for, T1.message, concat(T2.emp_firstname,' ',T2.emp_middle_name,' ',T2.emp_lastname) 
		as empname,T1.reward_points,T1.redeem,T1.emp_number from hrm_reward_points T1
		inner join hrm_employee T2 on T1.supervisor_id = T2.emp_number
		inner join hrm_user_master T3 on T1.supervisor_id = T3.emp_number where  T3.status = 'Y' and T2.emp_deleted = 'N' ".$append."
		
		".$orderby." limit ".$limit.",".$display_length)->queryAll();

	
		return $result;

	}

	public function ShowallRewards_cnt($supervisor) {
		$session = new CHttpSession;
        $session->open();
		$append = '';
		if (!in_array($session['user_role'],array(1,2))){
			
			if ($supervisor == true){
				$append .= " and T1.supervisor_id = ".$session['empnumber'];
			}else{
				$append .= "  and T1.emp_number = ".$session['empnumber'];
			}

		}


		

		

		$result =Yii::app()->db->createCommand("Select  count(T1.id) as total_count from hrm_reward_points T1
		inner join hrm_employee T2 on T1.supervisor_id = T2.emp_number
		inner join hrm_user_master T3 on T1.supervisor_id = T3.emp_number where  T3.status = 'Y' and T2.emp_deleted = 'N' ".$append
		)->queryRow();

	
		return $result['total_count'];


	}

	public function ShowallRewards_search_cnt($emp_num,$start_date,$end_date,$supervisor) {
		$session = new CHttpSession;
        $session->open();
		$append = '';
		if (!in_array($session['user_role'],array(1,2))){
			
			if ($supervisor == true){
				$append .= " and T1.supervisor_id = ".$session['empnumber'];
			}else{
				$append .= "  and T1.emp_number = ".$session['empnumber'];
			}

		}

		if ($emp_num>0)
		{
			$append .= "  and T1.emp_number = ".$emp_num;
		}

		if ($start_date!='' and $end_date!='')
		{	
			$from = date('Y-m-d',strtotime($start_date));
			$to = date('Y-m-d',strtotime($end_date));
			
			$append .= "  and DATE(T1.updated_date) between '".$from."' and '".$to."'";

		}else if ($start_date!='') {

			$from = date('Y-m-d',strtotime($start_date));
			 $append .= "  and DATE(T1.updated_date) >= '".$from."'";

		}elseif ($end_date!='') {

			$to = date('Y-m-d',strtotime($end_date));
			$append .= "  and DATE(T1.updated_date) <= '".$to."'";
		}
		

		$result =Yii::app()->db->createCommand("Select count(T1.id) as total_count from hrm_reward_points T1
		inner join hrm_employee T2 on T1.supervisor_id = T2.emp_number
		inner join hrm_user_master T3 on T1.supervisor_id = T3.emp_number where  T3.status = 'Y' and T2.emp_deleted = 'N' ".$append
		)->queryRow();

	
		return $result['total_count'];

		
	}

	//// to get subordinate suggestions
	public function getAllSuggestionsPeer($term)
    {
		  $session = new CHttpSession;
		  $session->open();
		  
				$getall = Yii::app()->db->createCommand("SELECT concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname) 
			as label, T1.emp_number as id from hrm_employee T1
				
				inner join hrm_user_master T3 on T1.emp_number = T3.emp_number
				"                
					. "WHERE T3.status = 'Y' and T1.emp_deleted = 'N' and concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname) 
					like '%{$term}%' and T1.emp_number != '{$session['empnumber']}'  group by T1.emp_number")->queryAll();
		   
            return $getall;         
    }


	//// to get subordinate suggestions
	public function getAllSuggestions($term)
    {
		  $session = new CHttpSession;
		  $session->open();
		   if ($session['user_role'] == 1)
		   {
				$getall = Yii::app()->db->createCommand("SELECT concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname) 
				as label, T1.emp_number as id from hrm_employee T1
				inner join hrm_report_to T2 on T1.emp_number = T2.emp_number 
				inner join hrm_user_master T3 on T1.emp_number = T3.emp_number 
				"                
					. "WHERE T3.status = 'Y' and T1.emp_deleted = 'N' and concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname)
					 like '%{$term}%' and T2.user_type='supervisor' and T3.user_role_id>=1 group by T1.emp_number")->queryAll();
		   }elseif ($session['user_role'] == 2)
			 {
				 $getall = Yii::app()->db->createCommand("SELECT concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname) 
						  as label, T1.emp_number as id from hrm_employee T1
						  inner join hrm_report_to T2 on T1.emp_number = T2.emp_number 
						  inner join hrm_user_master T3 on T1.emp_number = T3.emp_number 
						  "                
							  . "WHERE T3.status = 'Y' and T1.emp_deleted = 'N' and concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname)
							   like '%{$term}%' and T2.user_type='supervisor' and T3.user_role_id>=2 group by T1.emp_number")->queryAll();
		  
					
		   } else {
				$getall = Yii::app()->db->createCommand("SELECT concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname) 
			as label, T1.emp_number as id from hrm_employee T1
				inner join hrm_report_to T2 on T1.emp_number = T2.emp_number 
				inner join hrm_user_master T3 on T1.emp_number = T3.emp_number
				"                
					. "WHERE T3.status = 'Y' and T1.emp_deleted = 'N' and concat(T1.emp_firstname,' ',T1.emp_middle_name,' ',T1.emp_lastname) 
					like '%{$term}%' and T2.user_id = '{$session['empnumber']}' and T2.user_type='supervisor' group by T1.emp_number")->queryAll();
		   }
           
            return $getall;         
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
      
		return array(
			'id' => 'ID',
			'emp_number' => 'Emp Number',
			'user_supervisor_id' => 'Supervisor Id',
			'reward_points' => 'Reward Points',
			'recognized_for' => 'Recongnized for',
			'message' => 'Message',
			'updated_date' => 'Updated Date',
			'redeem' => 'Redeem'
		);
	}
        
        public function maileditor($id)
        {
            $mailedit = Yii::app()->db->createCommand("SELECT from_address,mail_bcc,subject,dynamic_variable,mail_content FROM hrm_mail WHERE id=".$id)->queryRow();
            return $mailedit;
        }

		public function getAllAccountant()
		{
			$mailedit = Yii::app()->db->createCommand("SELECT user_name FROM hrm_user_master WHERE user_role_id='5' and status='Y' and emp_deleted='N' ")->queryAll();
            return $mailedit;
		}
        

        public function update_leave_status($leave_number,$employee_leave_id)
        {

            $mailedit = Yii::app()->db->createCommand("Update hrm_employee_leave set leave_number = '$leave_number' Where id = ".$employee_leave_id)->query();
            return $mailedit;

        }

		public function getSumofpoints(){

			$session = new CHttpSession;
		    $session->open();

		    $rowlist = Yii::app()->db->createCommand("SELECT sum(reward_points) as sum from hrm_reward_points
			Where emp_number = '{$session['empnumber']}' and redeem = 'N'  group by emp_number")->queryRow();
		return $rowlist['sum'];

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
