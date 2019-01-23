<?php

/**
 * This is the model class for table "hrm_employee_leave".
 *
 * The followings are the available columns in table 'hrm_employee_leave':
 * @property integer $id
 * @property integer $emp_number
 * @property integer $leave_type
 * @property string $leave_number
 * @property string $active
 */ 
class HrmEmployeeLeave extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_employee_leave';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_number, leave_type, leave_number', 'required'),
			array('emp_number, leave_type', 'numerical', 'integerOnly'=>true),
			array('leave_number', 'length', 'max'=>10),
			array('active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, leave_type, leave_number, active', 'safe', 'on'=>'search'),
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
			'leave_type' => 'Leave Type',
			'leave_number' => 'Leave Number',
			'active' => 'Active',
		);
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
		$criteria->compare('emp_number',$this->emp_number);
		$criteria->compare('leave_type',$this->leave_type);
		$criteria->compare('leave_number',$this->leave_number,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAllLeaves(){

		$getall = Yii::app()->db->createCommand("SELECT * from hrm_leave_types where active = 'Y'" )->queryAll();
            return $getall;
        

	}
    


	public function getLeaveType($leave_type_id)
	{

		$getall = Yii::app()->db->createCommand("SELECT T1.* from hrm_leave_types T1
		inner join hrm_employee_leave T2 on T1.id = T2.leave_type  Where T2.id = '$leave_type_id'" )->queryRow();
            return $getall;

	}


	public function getAllSupervisorsAndAdmin($empid)
	{
	

	$getall = Yii::app()->db->createCommand("SELECT T1 . *,T3.google_push_id,T3.apple_push_id FROM hrm_user_master T1 
			INNER JOIN hrm_employee T3 on T3.emp_number = T1.emp_number
			LEFT JOIN hrm_report_to T2 
			ON T1.emp_number = T2.user_id and T2.emp_number = '$empid' 
			 AND T2.user_type = 'supervisor' WHERE (T2.emp_number = '$empid'
            OR T1.user_role_id <'3') and T3.emp_deleted!='Y' and T1.emp_deleted!='Y' and T1.status = 'Y' GROUP BY T1.id" )->queryAll();
            return $getall;


	}

		public function getAllHRAdmin($empid)
	{

		$getall = Yii::app()->db->createCommand("SELECT T1 . * FROM hrm_user_master T1 
			
           where T1.user_role_id <'3' GROUP BY T1.id" )->queryAll();
            return $getall;


	}



	public function getmyleaveDetails($leave_id)
	{	
		$getall = Yii::app()->db->createCommand("SELECT T4.emp_number,T5.user_name,T4.emp_firstname as first_name,T4.emp_lastname as last_name,T3.name,T2.start_date,T2.end_date,T2.start_type,T2.end_type,T2.leave_days,T2.leave_comments,T2.remarks,T4.google_push_id,T4.apple_push_id 
			from hrm_employee_leave T1
		inner join hrm_leave T2 on T2.emp_leave_id = T1.id
		inner join hrm_leave_types T3 on T3.id = T1.leave_type
		inner join hrm_employee T4 on T4.emp_number = T2.emp_number
		inner join hrm_user_master T5 on T5.emp_number = T4.emp_number
		  Where T2.id = '$leave_id'" )->queryRow();
            return $getall;


	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmEmployeeLeave the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
