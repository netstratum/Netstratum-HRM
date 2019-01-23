<?php

/**
 * This is the model class for table "hrm_leave".
 *
 * The followings are the available columns in table 'hrm_leave':
 * @property string $id
 * @property integer $emp_number
 * @property integer $emp_leave_id
 * @property string $start_date
 * @property string $end_date
 * @property string $start_type
 * @property string $end_type
 * @property string $leave_days
 * @property string $apply_date
 * @property string $createdby
 * @property string $leave_comments
 */
class HrmLeave extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_leave';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('emp_number, emp_leave_id, start_date, end_date, leave_days, apply_date, createdby, leave_comments', 'required'),
			array('emp_number, emp_leave_id', 'numerical', 'integerOnly'=>true),
			array('start_type, end_type', 'length', 'max'=>15),
			array('leave_days', 'length', 'max'=>10),
			array('createdby', 'length', 'max'=>200),
			array('leave_comments', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, emp_leave_id, start_date, end_date, start_type, end_type, leave_days, apply_date, createdby, leave_comments', 'safe', 'on'=>'search'),
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
			'emp_leave_id' => 'Emp Leave',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'start_type' => 'Start Type',
			'end_type' => 'End Type',
			'leave_days' => 'Leave Days',
			'apply_date' => 'Apply Date',
			'createdby' => 'Createdby',
			'leave_comments' => 'Leave Comments',
		);
	}
        
        public function getleaveid()
        {
            $session = new CHttpSession;
            $session->open();
            $leavearr=Yii::app()->db->createCommand("SELECT a.name,b.id FROM hrm_leave_types a INNER JOIN hrm_employee_leave b ON a.id=b.leave_type WHERE a.active='Y' AND a.emp_appliable='Y' AND b.active='Y' AND b.emp_number='{$session['empnumber']}'")->queryAll();    
            return $leavearr;        
        }

        public function getMybalanceLeave($leave_type)
        {
        	$session = new CHttpSession;
            $session->open();
        	
      

        	$leavearr=Yii::app()->db->createCommand("select c.id,if (b.leave_days>0,(a.leave_number-sum(b.leave_days)),a.leave_number) as pending_days from hrm_employee_leave a 
                inner join hrm_leave_types c on c.id = a.leave_type
        	left join hrm_leave b on a.id = b.emp_leave_id and a.emp_number='{$session['empnumber']}' and b.approval not in ('cancel','reject') where a.id = '$leave_type'  group by a.leave_type")->queryRow();    
            return $leavearr;        


        }

        public function getFestivalLeave()
        {
            $year = date('Y');
            $leavearr=Yii::app()->db->createCommand("select group_concat(DATE_FORMAT(holiday_date,'%d-%m-%Y')) as festival_dates from hrm_holidays Where holiday_type = 'optional'  group by holiday_type")->queryRow();    
            return $leavearr['festival_dates'];    


        }


        public function Supervisor_check()
        {

            $session = new CHttpSession;
            $session->open();
            
      

            $leavearr=Yii::app()->db->createCommand("select count(*) as supervisor_cnt  from hrm_report_to 
                Where user_id  = '{$session['empnumber']}'  and user_type = 'supervisor' ")->queryRow();    
            return $leavearr['supervisor_cnt'];     



        }



        public function AllLeavebalance($limit,$display_length,$search,$emp_num,$leave_year,$column,$dir)
        {

            $session = new CHttpSession;
            $session->open();

             $columns = array(0=>"concat(d.emp_firstname,' ',d.emp_lastname)",1=>"a.name",2=>"b.leave_number",3=>"if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number)");

             
             if ($search!='')
                    $append  .= " and a.name like '%$search%'  ";

            if ($emp_num>0)
                    $append  .= " and b.emp_number='{$emp_num}'  ";

            if ($leave_year!='')
                    $append  .= " and b.year = '{$leave_year}'  ";




//and b.emp_number='{$session['empnumber']}'
            $leavearr=Yii::app()->db->createCommand("select concat(d.emp_firstname,' ',d.emp_lastname) as username,b.id,a.name,b.leave_number,if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number) as leave_balance from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type 
                 inner join hrm_employee d on d.emp_number = b.emp_number
                left join hrm_leave c on b.id =  c.emp_leave_id and (c.approval != 'reject' and c.approval != 'cancel')
                where a.emp_appliable = 'Y' $append  group by b.leave_type   $orderby limit $limit,$display_length")->queryAll();
                
    

            // }  
            return $leavearr;   


        }


        public function AllLeavebalance_cnt($emp_num,$leave_year)
        {
               $session = new CHttpSession;
            $session->open();



             if ($emp_num>0)
                    $append  .= " and b.emp_number='{$emp_num}'  ";

            if ($leave_year!='')
                    $append  .= " and b.year = '{$leave_year}'  ";


             $leavearr=Yii::app()->db->createCommand("select a.id,if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number) as leave_balance from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type 

                left join hrm_leave c on c.emp_leave_id = b.id
                where a.emp_appliable = 'Y'  $append    group by b.leave_type   ")->queryAll();
            return count($leavearr);    
            
        }

         public function AllLeavebalance_search_cnt($search,$emp_num,$leave_year)
        {
              $session = new CHttpSession;
            $session->open();

             if ($search!='')
                    $append  .= " and a.name like '%$search%'  ";

            if ($emp_num>0)
                    $append  .= " and b.emp_number='{$emp_num}'  ";

            if ($leave_year!='')
                    $append  .= " and b.year = '{$leave_year}'  ";

             $leavearr=Yii::app()->db->createCommand("select a.id,if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number) as leave_balance from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type 
                left join hrm_leave c on c.emp_leave_id = b.id
                where a.emp_appliable = 'Y'   $append  group by b.leave_type   ")->queryAll();

            return count($leavearr);    
        }



        public function leavebalance($limit,$display_length,$search,$column,$dir)
        {

            $session = new CHttpSession;
            $session->open();

             $columns = array(0=>"a.name",1=>"b.leave_number",2=>"if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number)");

               if ($columns !='')
            $orderby = "order by ".$columns[$column]." ".$dir;
        else
            $orderby = " order by a.name asc " ;

         if ($search!='')
                    $append  .= " and a.name like '%$search%'  ";


            $leavearr=Yii::app()->db->createCommand("select b.id,a.name,b.leave_number,if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number) as leave_balance from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type 
                left join hrm_leave c on b.id =  c.emp_leave_id and (c.approval != 'reject' and c.approval != 'cancel')
                where a.emp_appliable = 'Y' and b.emp_number='{$session['empnumber']}'  $append  group by b.leave_type   $orderby limit $limit,$display_length")->queryAll();
                
    

            // }  
            return $leavearr;   


        }


        public function leavebalance_cnt()
        {
               $session = new CHttpSession;
            $session->open();
             if ($search!='')
                    $append  .= " and a.name like '%$search%' ) ";
             $leavearr=Yii::app()->db->createCommand("select a.id,if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number) as leave_balance from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type 
                left join hrm_leave c on c.emp_leave_id = b.id
                where a.emp_appliable = 'Y' and b.emp_number='{$session['empnumber']}'    group by b.leave_type   ")->queryAll();
            return count($leavearr);    
            
        }

         public function leavebalance_search_cnt($search)
        {
              $session = new CHttpSession;
            $session->open();

             if ($search!='')
                    $append  .= " and a.name like '%$search%'  ";

             $leavearr=Yii::app()->db->createCommand("select a.id,if (c.leave_days>0,(b.leave_number-sum(c.leave_days)),b.leave_number) as leave_balance from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type 
                left join hrm_leave c on c.emp_leave_id = b.id
                where a.emp_appliable = 'Y' and b.emp_number='{$session['empnumber']}'   $append  group by b.leave_type   ")->queryAll();

            return count($leavearr);    
        }

        public function getMyleaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir)
        {	
        	$session = new CHttpSession;
            $session->open();



            $columns = array(0=>"a.name",1=>"c.start_date",2=>"c.end_date",
                3=>"c.leave_comments",4=>"c.approval");

               if ($columns !='')
             $orderby = "order by ".$columns[$column]." ".$dir;
        else
            $orderby = " order by c.end_date desc " ;
            //if ($session['user_role'] == 1)
            //{
/*
              $leavearr=Yii::app()->db->createCommand("select concat(e.emp_firstname,' ',e.emp_lastname) as created_name,c.id as leave_id,c.approval,a.name,c.start_date,c.end_date,c.start_type,c.end_type,
                c.leave_comments,c.leave_days,c.apply_date,d.start_day_time,d.end_day_time
                from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
                inner join hrm_leave c on b.id = c.emp_leave_id
                left join hrm_leave_time d on c.id = d.hrm_leave_id
                left join hrm_employee e on c.createdby = e.emp_number
               order by c.end_date desc limit $limit,$display_length")->queryAll();  
            */
            // }else{
            
                if ($from!='' and $to!='')
                     $append  .= " and ((c.start_date between '$from' and '$to') or (c.end_date between '$from' and '$to')) ";
                elseif($from!='')
                    $append  .= " and c.start_date>='$from' ";
                elseif($to!='')
                    $append  .= " and c.end_date<='$to' ";

                 if ($search!='')
                    $search_append  .= " and (a.name like '%$search%' or c.leave_comments like '%search%') ";

                if ($leave_status!=''){

                    if ($leave_status!='taken' and $leave_status!='approve')
                        $append   .= " and c.approval='$leave_status' ";
                   elseif ($leave_status!='taken')
                        $append   .= " and (c.approval='approve' and date(c.end_date)>curdate()) ";  
                    else 
                        $append   .= " and (c.approval='approve' and date(c.end_date)<=curdate()) ";    
                }

            if ($myleaveid>0)
                $append .= ' and b.id = '.$myleaveid;

           

          	$leavearr=Yii::app()->db->createCommand("select concat(e.emp_firstname,' ',e.emp_lastname) as created_name,c.approval,a.name,c.id as leave_id,c.start_date,c.end_date,c.start_type,c.end_type,
        		c.leave_comments,c.leave_days,c.apply_date,d.start_day_time,d.end_day_time
        		from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
        		inner join hrm_leave c on b.id = c.emp_leave_id
        		left join hrm_leave_time d on c.id = d.hrm_leave_id
        		left join hrm_employee e on c.createdby = e.emp_number
        	 where  c.emp_number='{$session['empnumber']}' $search_append $append group by c.id $orderby limit $limit,$display_length")->queryAll();    
            return $leavearr;    


        }

        public function getMyleaveReport_cnt()
        {   
            $session = new CHttpSession;
            $session->open();

           

            $leavearr=Yii::app()->db->createCommand("select c.id
                from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
                inner join hrm_leave c on b.id = c.emp_leave_id
                left join hrm_leave_time d on c.id = d.hrm_leave_id
                left join hrm_employee e on c.createdby = e.emp_number
             where  c.emp_number='{$session['empnumber']}' group by c.id order by c.end_date desc")->queryAll();    
            return count($leavearr);    


        }

          public function getMyleaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status)
        {   
            $session = new CHttpSession;
            $session->open();

            

              if ($from!='' and $to!='')
                     $append  .= " and ((c.start_date between '$from' and '$to') or (c.end_date between '$from' and '$to')) ";
                elseif($from!='')
                    $append  .= " and c.start_date>='$from' ";
                elseif($to!='')
                    $append  .= " and c.end_date<='$to' ";


                 if ($search!='')
                    $search_append  .= " and (a.name like '%$search%' or c.leave_comments like '%search%') ";

                if ($leave_status!=''){

                    if ($leave_status!='taken' and $leave_status!='approve')
                        $append   .= " and c.approval='$leave_status' ";
                   elseif ($leave_status!='taken')
                        $append   .= " and (c.approval='approve' and date(c.end_date)>curdate()) ";  
                    else 
                        $append   .= " and (c.approval='approve' and date(c.end_date)<=curdate()) ";  
                }

                if ($myleaveid>0)
                $append .= ' and b.id = '.$myleaveid;

            $leavearr=Yii::app()->db->createCommand("select c.id
                from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
                inner join hrm_leave c on b.id = c.emp_leave_id
                left join hrm_leave_time d on c.id = d.hrm_leave_id
                left join hrm_employee e on c.createdby = e.emp_number
             where  c.emp_number='{$session['empnumber']}' $search_append  $append group by c.id order by c.end_date desc")->queryAll();    
            return count($leavearr);    


        }


         public function getAllLeaveReport($limit,$display_length,$search,$myleaveid,$from,$to,$leave_status,$column,$dir)
        {
        	$session = new CHttpSession;
            $session->open();

             $columns = array(0=>"concat(h.emp_firstname,' ',h.emp_lastname)",1=>"a.name",2=>"c.start_date",
                3=>"c.end_date",4=>"c.leave_comments",5=>"c.leave_days",6=>"c.approval");

               if ($columns !='')
            $orderby = "order by ".$columns[$column]." ".$dir;
        else
            $orderby = " order by c.end_date desc " ;
            //if ($session['user_role'] == 1)
            //{
/*
        	  $leavearr=Yii::app()->db->createCommand("select concat(e.emp_firstname,' ',e.emp_lastname) as created_name,c.id as leave_id,c.approval,a.name,c.start_date,c.end_date,c.start_type,c.end_type,
        		c.leave_comments,c.leave_days,c.apply_date,d.start_day_time,d.end_day_time
        		from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
        		inner join hrm_leave c on b.id = c.emp_leave_id
        		left join hrm_leave_time d on c.id = d.hrm_leave_id
        		left join hrm_employee e on c.createdby = e.emp_number
        	   order by c.end_date desc limit $limit,$display_length")->queryAll();  
        	*/
        	// }else{
            
                if ($from!='' and $to!='')
                     $search_append  = " and ((c.start_date between '$from' and '$to') or (c.end_date between '$from' and '$to')) ";
                elseif($from!='')
                    $search_append  = " and c.start_date>='$from' ";
                elseif($to!='')
                    $search_append  = " and c.end_date<='$to' ";


                

                if ($search!='')
                    $search_append  .= " and (concat(h.emp_firstname,' ',h.emp_lastname) like '%$search%' or 
                    a.name like '%$search%' or c.leave_comments like '%search%') ";
                
                 if ($leave_status!=''){

                    if ($leave_status!='taken' and $leave_status!='approve')
                        $search_append   .= " and (c.approval='$leave_status' ) ";
                    elseif ($leave_status!='taken')
                        $search_append   .= " and (c.approval='approve' and date(c.end_date)>curdate()) ";  
                    else 
                        $search_append   .= " and (c.approval='approve' and date(c.end_date)<=curdate()) ";    
                }
                

                
                if ($myleaveid>0)
                $search_append .= ' and b.id = '.$myleaveid;

                if ($session['user_role'] == 1 ){
                    $append = "Where e.emp_status = 'Y' $search_append ";
                }
                elseif ( $session['user_role'] ==2)
                {
                     $append = "Where e.emp_status = 'Y' and g.user_role_id !=1 and g.user_role_id !=2 $search_append ";
                }else{
                    $append = " where (f.supervisor_id = {$session['empnumber']} or k.user_id = {$session['empnumber']}) $search_append ";
                }


        	 	$leavearr=Yii::app()->db->createCommand("select k.leave_approval,c.id as leave_id,concat(h.emp_firstname,' ',h.emp_lastname) as emp_name,c.approval,f.approval as myapproval,concat(e.emp_firstname,' ',e.emp_lastname) as created_name,a.name,c.start_date,c.end_date,c.start_type,c.end_type,
        		c.leave_comments,c.leave_days,c.apply_date,d.start_day_time,d.end_day_time
        		from hrm_leave_types a 
                inner join hrm_employee_leave b on a.id = b.leave_type
        		inner join hrm_leave c on b.id = c.emp_leave_id
                inner join hrm_employee h on h.emp_number = c.emp_number
                inner join hrm_user_master g on g.emp_number = c.emp_number
        		left join hrm_leave_approval f on c.id = f.hrm_leave_id and f.supervisor_id = {$session['empnumber']}
                left join hrm_report_to k on k.emp_number = c.emp_number and k.user_type = 'supervisor'
               	left join hrm_leave_time d on c.id = d.hrm_leave_id
        		inner join hrm_employee e on c.createdby = e.emp_number

        	  $append  group by c.id   $orderby limit $limit,$display_length")->queryAll();

               
                
    

        	// }  
            return $leavearr;   

        	
        }

         public function getAllLeaveReport_cnt()
        {
            $session = new CHttpSession;
            $session->open();

                 if ($session['user_role'] == 1 ){
                    $append = '';
                }elseif ( $session['user_role'] ==2)
                {
                     $append = "Where e.emp_status = 'Y' and g.user_role_id !=1 and g.user_role_id !=2   ";
                }
                else
                    $append = " where f.supervisor_id = {$session['empnumber']} or k.user_id = {$session['empnumber']} ";

                $leavearr=Yii::app()->db->createCommand("select c.id
                from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
                inner join hrm_leave c on b.id = c.emp_leave_id

                 inner join hrm_user_master g on g.emp_number = c.emp_number
                left join hrm_leave_approval f on c.id = f.hrm_leave_id
                left join hrm_report_to k on k.emp_number = c.emp_number and k.user_type = 'supervisor'
                left join hrm_leave_time d on c.id = d.hrm_leave_id
                left join hrm_employee e on c.createdby = e.emp_number

             $append  group by c.id  order by c.end_date  desc ")->queryAll();


            return count($leavearr);   

            
        }

        public function getAllLeaveReport_search_cnt($search,$myleaveid,$from,$to,$leave_status)
        {
              $session = new CHttpSession;
            $session->open();
            if ($from!='' and $to!='')
                     $search_append  = " and ((c.start_date between '$from' and '$to') or (c.end_date between '$from' and '$to')) ";
                elseif($from!='')
                    $search_append  = " and c.start_date>='$from' ";
                elseif($to!='')
                    $search_append  = " and c.end_date<='$to' ";


                if ($leave_status!=''){

                    if ($leave_status!='taken' and $leave_status!='approve')
                        $search_append   .= " and c.approval='$leave_status' ";
                    elseif ($leave_status!='taken')
                        $search_append   .= " and (c.approval='approve' and date(c.end_date)>curdate()) ";  
                    else 
                        $search_append   .= " and (c.approval='approve' and date(c.end_date)<=curdate()) ";      
                }

                if ($search!='')
                    $search_append  .= " and (concat(h.emp_firstname,' ',h.emp_lastname) like '%$search%' or 
                    a.name like '%$search%' or c.leave_comments like '%search%') ";

                
                if ($myleaveid>0)
                $search_append .= ' and b.id = '.$myleaveid;

                if ($session['user_role'] == 1 ){
                    $append = "Where e.emp_status = 'Y' $search_append ";
                }
                elseif ( $session['user_role'] ==2)
                {
                     $append = "Where e.emp_status = 'Y' and g.user_role_id !=1 and g.user_role_id !=2 $search_append ";
                }else{
                    $append = " where (f.supervisor_id = {$session['empnumber']} or k.user_id = {$session['empnumber']}) $search_append ";
                }

                 $leavearr=Yii::app()->db->createCommand("select c.id
                from hrm_leave_types a inner join hrm_employee_leave b on a.id = b.leave_type
                inner join hrm_leave c on b.id = c.emp_leave_id
                 inner join hrm_user_master g on g.emp_number = c.emp_number
                left join hrm_leave_approval f on c.id = f.hrm_leave_id
                 left join hrm_report_to k on k.emp_number = c.emp_number and k.user_type = 'supervisor'
               inner join hrm_employee h on h.emp_number = c.emp_number
                left join hrm_leave_time d on c.id = d.hrm_leave_id
                left join hrm_employee e on c.createdby = e.emp_number

             $append group by c.id order by c.end_date desc ")->queryAll();

                    return count($leavearr); 

        }
        
       /* public function assignleaveid()
        {            
            $assignarr=Yii::app()->db->createCommand("SELECT a.name,b.id FROM hrm_leave_types a INNER JOIN hrm_employee_leave b ON a.id=b.leave_type WHERE a.active='Y' AND a.emp_appliable='Y' AND b.active='Y' AND b.emp_number='{$_REQUEST['assiemp']}'")->query();
                return $assignarr;        
        }
        * 
        */
        
        public function getapproval($empnumber)
        {               
            $session = new CHttpSession;
            $session->open();
            if ($empnumber=='')
            	$empnumber = $session['empnumber'];
            #echo "SELECT user_id FROM hrm_report_to WHERE user_type='supervisor' AND emp_number='{$session['empnumber']}' AND leave_approval='Y' ORDER BY order_number";
            $leaveapprove=Yii::app()->db->createCommand("SELECT user_id FROM hrm_report_to WHERE user_type='supervisor' AND emp_number='{$empnumber}' AND leave_approval='Y' ORDER BY order_no")->queryAll();
          // echo "SELECT user_id FROM hrm_report_to WHERE user_type='supervisor' AND emp_number='{$session['empnumber']}' AND leave_approval='Y' ORDER BY order_number";
            #print_r($leaveapprove);
            return $leaveapprove;                        
        }

        public function getEmpLeaves($empid)
       {

       		$getall = Yii::app()->db->createCommand("SELECT T2.id,T1.name from hrm_leave_types T1 
       		inner join hrm_employee_leave T2 on T1.id = T2.leave_type Where T1.active = 'Y' and T2.emp_number = '$empid' ")->queryAll();
       		
            return $getall;


       }

       public function checkSATSUNHOL($start_date,$end_date,$empnumber)
       {

             $holidays = 0;
             $i=1;
            $getall = Yii::app()->db->createCommand("SELECT  id from hrm_holidays "
                  
                    . "WHERE holiday_type = 'holiday' and active = 'Y' and holiday_date between '$start_date' and '$end_date'")->queryAll();
            

           if (count($getall)>0)
              $holidays = count($getall);

             $getweekdays = Yii::app()->db->createCommand("SELECT  week_days from hrm_leave_days where emp_number = '$empnumber' " )->queryAll();
            
             if (count($getweekdays)>0){

                    foreach ($getweekdays as $weekdays)
                    {

                        $weekdays_arr[] = $weekdays['week_days'];

                    }

             }          
  
			

		 $session = new CHttpSession;
           $session->open();


		



            for ($i=1; $i<100; $i++)
            {
                
                if (in_array(date('N', strtotime($start_date)),$weekdays_arr))
                    $holidays += 1;
                if ($start_date == $end_date)
                    $i=100;
                else
                   $start_date =  date('Y-m-d', strtotime(' + 1 day',strtotime($start_date) ));

             }


             return $holidays;

       }
        
        public function getAllSuggestions($term)
        {
            $getall = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_middle_name,' ',emp_lastname) as label, emp_number as id from hrm_employee "
                  
                    . "WHERE emp_status = 'Y' and emp_deleted = 'N' and concat(emp_firstname,' ',emp_middle_name,' ',emp_lastname) like '%{$term}%'")->queryAll();
            return $getall;         
        }

        public function ApproveLeave($leaveid,$approve_type,$leave_approve_text)
        {
           $session = new CHttpSession;
           $session->open();
           $date = date('Y-m-d H:m:s');
           if ($session['user_role'] == 1 or $session['user_role'] == 2)
           {
                  
                $getall = Yii::app()->db->createCommand("UPDATE hrm_leave set approval = '$approve_type',remarks = '$leave_approve_text' 
                WHERE id = '$leaveid'")->query();

            }else{


                  $getall = Yii::app()->db->createCommand("UPDATE hrm_leave_approval set approval = '$approve_type',remarks = '$leave_approve_text',approval_date = '$date'
                          WHERE hrm_leave_id = '$leaveid' and supervisor_id = {$session['empnumber']}")->query();

            }



        }

        public function CancelLeave($leaveid,$leave_comments)
        {
        	
           $session = new CHttpSession;
           $session->open();
         $leave_data = Yii::app()->db->createCommand("SELECT leave_comments from hrm_leave      WHERE id = '$leaveid'")->queryRow();
         $leave_comments = $leave_comments.' <br /> Leave Applied Reason: '.$leave_data['leave_comments'];
            	$getall = Yii::app()->db->createCommand("UPDATE hrm_leave set approval = 'cancel',leave_comments = '$leave_comments'
            	WHERE id = '$leaveid'")->query();


        }

        public function GetLeaveInfo($leavid)
        {   


               $getall = Yii::app()->db->createCommand("SELECT a.name,c.start_date,c.end_date from hrm_leave_types a
               inner join hrm_employee_leave b on a.id = b.leave_type
               inner join hrm_leave c on c.emp_leave_id = b.id WHERE c.id = '{$leavid}'")->queryRow();
                  
                   
            return $getall;         


        }

        public function getSupervisorData($leaveid)
        {               
           
         
            $leaveapprove=Yii::app()->db->createCommand("SELECT approval FROM hrm_leave_approval WHERE hrm_leave_id = '$leaveid' ")->queryAll();
           return $leaveapprove;                        
        }


        /*public function getlid()
        {
            $session = new CHttpSession;
            $session->open();
            $leave = Yii::app()->db->createCommand("SELECT emp_leave_id FROM hrm_leave WHERE emp_number='{$session['empnumber']}'")->query();
            return $leave;
        }
         * 
         */

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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('emp_number',$this->emp_number);
		$criteria->compare('emp_leave_id',$this->emp_leave_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('start_type',$this->start_type,true);
		$criteria->compare('end_type',$this->end_type,true);
		$criteria->compare('leave_days',$this->leave_days,true);
		$criteria->compare('apply_date',$this->apply_date,true);
		$criteria->compare('createdby',$this->createdby,true);
		$criteria->compare('leave_comments',$this->leave_comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmLeave the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
