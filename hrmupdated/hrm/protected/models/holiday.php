<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class holiday extends CActiveRecord
{
	public $name;
	public $holiday_date;
	public $holiday_type;
	public $active;

	public function tableName()
	{
		return 'hrm_holidays';
	}

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// name and holiday_date are required
			array('name, holiday_date', 'required'),
			// rememberMe needs to be a boolean
			array('active', 'boolean'),
			
			
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAllHolidays($limit,$display_length,$search,$column,$dir)
       {
       		
       		 $columns = array(0=>"name",1=>"holiday_date",2=>"holiday_type");
         
         if ($columns !='')
         	$orderby = "order by ".$columns[$column]." ".$dir;

       		if ($search!='')
       			$append = " and (name like '%$search%' or holiday_type like '%$search%')";
       		else
       			$append = '';

        //  $start_date = date('Y-01-01');
        //  $end_date = date('Y-12-31');
	//and holiday_date between '$start_date' and '$end_date'
       		$getall = Yii::app()->db->createCommand("SELECT id,name,holiday_date,holiday_type from hrm_holidays where active = 'Y'  $append    $orderby limit $limit,$display_length ")->queryAll();
            return $getall;


       }


        public function getHolidays()
        {
          $start_date = date('Y-01-01');
          $end_date = date('Y-12-31');

            $getall = Yii::app()->db->createCommand("SELECT group_concat('\'', date(holiday_date), '\'') as holidays from hrm_holidays where holiday_type = 'holiday' and holiday_date between '$start_date' and '$end_date'  ")->queryRow();

            return $getall['holidays'];
            

        }


        public function getWeekdays_employee($empnumber)
        {
  
    
          $getall = Yii::app()->db->createCommand("SELECT group_concat(week_days) as weekdays from 
              hrm_leave_days where emp_number = '$empnumber' ")->queryRow();
          return $getall['weekdays'];


        }

        public function getAllHolidays_Calendar($start_date,$end_date)
         {
          
      	   $getall = Yii::app()->db->createCommand("SELECT id,name,holiday_date,holiday_type from hrm_holidays where active = 'Y' 
                     and holiday_date between '$start_date' and '$end_date' ")->queryAll();
           return $getall;
      	
        }

        public function getAllLeaves($start_date,$end_date,$empnumber)
        {

           $session = new CHttpSession;
           $session->open();

           if (($session['user_role'] == 1 or $session['user_role'] == 2) and $empnumber>0)
             $append = " and a.emp_number  = '$empnumber' ";
          elseif ($session['user_role'] != 1)
             $append = " and a.emp_number  = ".$session['empnumber'];
           else
             $append = " and a.emp_number = '0' " ;


            $getall = Yii::app()->db->createCommand("SELECT b.id as userid,a.id,a.emp_number,a.start_date,a.end_date,a.approval from hrm_leave a 
              inner join hrm_user_master b on a.emp_number = b.emp_number where 
                      ((a.start_date between '$start_date' and '$end_date') or (a.end_date between '$start_date' and '$end_date'))  
                        $append  and a.approval !='reject' and a.approval !='cancel' ")->queryAll();

           
            return $getall;
            
        }


        public function getAllAssociateLeave($start_date,$end_date)
        {

             $session = new CHttpSession;
             $session->open();
             $approval = "approve";
             if (strtotime($start_date)<strtotime(date('Y-m-d')))
              $start_date = date('Y-m-d');
            
             $memberid  = $session['empnumber'];
             if ($session['user_role'] == 1 or $session['user_role'] == 2)
             {
                   $getall = Yii::app()->db->createCommand("SELECT d.id as userid,b.emp_number,b.emp_firstname,b.emp_lastname,a.start_date,a.end_date from hrm_leave a 
              inner join hrm_employee b on a.emp_number = b.emp_number 
              inner join hrm_user_master d on d.emp_number = a.emp_number     where 
                      ((a.start_date between '$start_date' and '$end_date') or (a.end_date between '$start_date' and '$end_date'))  
                         and a.approval ='approve' ")->queryAll();
          
             }else{
                 
                 
                 $getall = Yii::app()->db->createCommand("SELECT a.emp_firstname,a.emp_lastname,a.emp_number, b.start_date, b.end_date, e.id as userid
                    FROM hrm_employee a
                    INNER JOIN hrm_leave b ON a.emp_number = b.emp_number
                    INNER JOIN hrm_current_job c ON c.emp_number = b.emp_number
                    INNER JOIN hrm_current_job d ON d.job_category = c.job_category
                    AND d.emp_number =$memberid inner join hrm_user_master e on e.emp_number = b.emp_number
                    WHERE b.approval = '$approval' AND ((b.start_date between '$start_date' and '$end_date') or "
                         . "(b.end_date between '$start_date' and '$end_date'))")->queryAll();

                 
                 
             }

              return $getall;

        }



        public function getWeekdays($empnumber)
        {
           $session = new CHttpSession;
           $session->open();

           if ($empnumber=='')
            $empnumber = $session["empnumber"];
          
             $getall = Yii::app()->db->createCommand("SELECT  week_days from hrm_leave_days Where
              emp_number = '$empnumber' ")->queryAll();
            return $getall;


        }

       public function getAllHolidays_cnt()
      {
      	$getall = Yii::app()->db->createCommand("SELECT id from hrm_holidays where active = 'Y' ")->queryAll();
            return count($getall);
      	
      }

      public function getAllHolidays_search_cnt($search)
      {
      	$getall = Yii::app()->db->createCommand("SELECT id from hrm_holidays where active = 'Y'
      		and (name like '%$search%' or holiday_type like '%$search%')")->queryAll();
            return count($getall);
      	
      }

      
 	
 	public function deleteHoliday($id)
      {
      	$getall = Yii::app()->db->createCommand("DELETE from hrm_holidays WHERE id = ".$id)->query();
            return count($getall);
      	
      }
       

	
}
