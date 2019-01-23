<?php

/**
 * This is the model class for table "hrm_leave_types".
 *
 * The followings are the available columns in table 'hrm_leave_types':
 * @property integer $id
 * @property string $name
 * @property string $leave_max_no
 * @property string $emp_appliable
 * @property integer $probation_period
 * @property string $custom_leave_type
 * @property string $active
 */
class HrmLeaveTypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_leave_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, leave_max_no, probation_period', 'required'),
			array('probation_period', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('leave_max_no', 'length', 'max'=>10),
			array('emp_appliable, custom_leave_type, active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, leave_max_no, emp_appliable, probation_period, custom_leave_type, active', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'leave_max_no' => 'Leave Max No',
			'emp_appliable' => 'Emp Appliable',
			'probation_period' => 'Probation Period',
			'custom_leave_type' => 'Custom Leave Type',
			'active' => 'Active',
		);
	}
        
        public function getleavedetails($limit,$display_length,$search,$column,$dir)
        {
            
        	 $columns = array(0=>"name",1=>"leave_max_no",2=>"probation_period",3=>"custom_leave_type");
        	
        	if ($columns !='')
         		$orderby = "order by ".$columns[$column]." ".$dir;
            else
           		$orderby = "order by id asc";

           	if ($search!='')
       			$append = " Where (name like '%$search%' or custom_leave_type like '%$search%')";
       		else
       			$append = '';

            $leavedetails = Yii::app()->db->createCommand("SELECT id,name,leave_max_no,probation_period,custom_leave_type 
            	FROM hrm_leave_types $append  $orderby limit $limit,$display_length")->queryAll();
            return $leavedetails;
        }

         public function getleavedetails_cnt()
        {
            $leavedetails = Yii::app()->db->createCommand("SELECT id FROM hrm_leave_types")->queryAll();
            return count($leavedetails);
        }

        public function getleavedetails_search_cnt($search)
        {	
        	 	if ($search!='')
       			$append = " Where (name like '%$search%' or custom_leave_type like '%$search%')";
       		else
       			$append = '';
        	 $leavedetails = Yii::app()->db->createCommand("SELECT id FROM hrm_leave_types $append ")->queryAll();
            return count($leavedetails);


        }

        public function editleave($id)
        {   
            $editleave = Yii::app()->db->createCommand("SELECT name,leave_max_no,probation_period,expiry_date FROM hrm_leave_types WHERE id = ".$id)->queryRow();
           # print_r($editleave);
            return $editleave;
        }
        
        public function customleaves($limit,$display_length,$search,$column,$dir)
        {
            
        	 $columns = array(0=>"name");
        	  if ($columns !='')
         			$orderby = "order by ".$columns[$column]." ".$dir;

         		if ($search!='')
       			$append = " and (name like '%$search%')";
       		else
       			$append = '';	

            $custom = Yii::app()->db->createCommand("SELECT id,name,leave_max_no,expiry_date FROM  
            	hrm_leave_types WHERE active='Y' and custom_leave_type = 'Y' $append $orderby limit $limit,$display_length ")->query();
            return $custom;
        }

        public function customleaves_cnt()
        {
            $custom = Yii::app()->db->createCommand("SELECT id FROM  hrm_leave_types WHERE active='Y' and custom_leave_type = 'Y' ")->query();
            return count($custom);
        }
         public function customleaves_search_cnt($search)
        {
            $custom = Yii::app()->db->createCommand("SELECT id FROM  hrm_leave_types 
            	WHERE active='Y' and custom_leave_type = 'Y' and (name like '%$search%') ")->query();
            return count($custom);
        }

        

        public function saveCustomLeave($employid,$customleaveid,$custom_leave_no){
        	$year = date('Y');
        	Yii::app()->db->createCommand("INSERT INTO hrm_employee_leave (emp_number,leave_type,leave_number,year) 
        		VALUES ('$employid','$customleaveid','$custom_leave_no','$year')")->query();
        	
        }

        public function DeleteLeaveType($leaveid){

        	Yii::app()->db->createCommand("DELETE from hrm_leave_types WHERE id=".$leaveid." and custom_leave_type = 'Y'")->query();
        }


//        public function updateleave($id)
//        {   
            #extract($_REQUEST);
           # $name = $_REQUEST['editleavename'];
            #$max = $_REQUEST['editleavemax'];
           # $prob = $_REQUEST['editleaveprobation'];
           # $updateleave = Yii::app()->db->createCommand("UPDATE hrm_leave_types SET name='$name', leave_max_no='$max', probation_period='$prob' WHERE id=".$id)->queryRow();
            #return $updateleave;
//        }

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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('leave_max_no',$this->leave_max_no,true);
		$criteria->compare('emp_appliable',$this->emp_appliable,true);
		$criteria->compare('probation_period',$this->probation_period);
		$criteria->compare('custom_leave_type',$this->custom_leave_type,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	 

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmLeaveTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
