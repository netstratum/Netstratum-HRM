<?php
/**
 * This is the model class for table "hrm_user_master".
 *
 * The followings are the available columns in table 'hrm_user_master':
 * @property integer $id
 * @property integer $emp_number
 * @property string  $peer_id
  * @property integer $recognized_for
 * @property string  $message
 * @property string  $updated_date
 */
class HrmPeerRecognition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_peer_recognition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('peer_id', 'numerical', 'integerOnly'=>true),
			
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
			'emp_number' => 'Emp Number',
			'peer_id' => 'peer_id',
			'recognized_for' => 'Recongnized for',
			'message' => 'Message',
			'updated_date' => 'Updated Date'
			
		);
	}
        
        public function maileditor($id)
        {
            $mailedit = Yii::app()->db->createCommand("SELECT from_address,mail_bcc,subject,dynamic_variable,mail_content FROM hrm_mail WHERE id=".$id)->queryRow();
            return $mailedit;
        }

        public function getMailDetailsForPeerMail($empid)
        {   
            $mailedit = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_middle_name,' ',emp_lastname) 
            as empname FROM hrm_employee WHERE emp_number=".$empid)->queryRow();
            return $mailedit;

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


        public function update_leave_status($leave_number,$employee_leave_id)
        {

            $mailedit = Yii::app()->db->createCommand("Update hrm_employee_leave set leave_number = '$leave_number' Where id = ".$employee_leave_id)->query();
            return $mailedit;

        }

        public function ShowallPeersRecognition($limit,$display_length,$search,$emp_num,$start_date,$end_date,$column,$dir)
        {
            $session = new CHttpSession;
            $session->open();
            
            $columns = array(0=>"T1.updated_date",1=>"concat(T3.emp_firstname,' ',T3.emp_middle_name,' ',T3.emp_lastname)",2=>"T1.recognized_for");
    
                   if ($columns !='')
                    $orderby = "order by ".$columns[$column]." ".$dir;
                   else
                    $orderby = " order by T1.updated_date desc " ;
            
            $append = '';
		    if (!in_array($session['user_role'],array(1,2))){			
			    
				$append .= "  and T1.peer_id = ".$session['empnumber'];
			
		    }
            
		if ($emp_num>0)
		{
			$append .= "  and T1.peer_id = ".$emp_num;
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
      

        $mailedit = Yii::app()->db->createCommand("
                Select T1.recognized_for, T1.message, T1.updated_date,concat(T3.emp_firstname,' ',T3.emp_middle_name,' ',T3.emp_lastname) 
                as empname from hrm_peer_recognition T1
                inner join hrm_user_master T2 on T1.emp_number = T2.emp_number 
                inner join hrm_employee T3 on T1.emp_number = T3.emp_number
                where  T2.status = 'Y' and T2.emp_deleted = 'N' ".$append."		
                ".$orderby." limit ".$limit.",".$display_length)->queryAll();

        return $mailedit;

        }

        public function ShowallPeersRecognition_search_cnt($emp_num,$start_date,$end_date)
        {
            $session = new CHttpSession;
            $session->open();
            $append = '';
		    if (!in_array($session['user_role'],array(1,2))){			
			    
				$append .= "  and T1.peer_id = ".$session['empnumber'];
			
		    }

		if ($emp_num>0)
		{
			$append .= "  and T1.peer_id = ".$emp_num;
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
           
         
            $mailedit = Yii::app()->db->createCommand("
            Select count(T1.id) as count from hrm_peer_recognition T1
            inner join hrm_user_master T2 on T1.emp_number = T2.emp_number
            where  T2.status = 'Y' and T2.emp_deleted = 'N' ".$append)->queryRow();
            return $mailedit['count'];
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
