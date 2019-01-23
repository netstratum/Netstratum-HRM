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
class HrmEmployeeLeave1 extends CActiveRecord
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

		$getall = Yii::app()->db->createCommand("SELECT * from hrm_leave_types where active = 'Y' and custom_leave_type!='Y'" )->queryAll();
            return $getall;
        

	}
    

	public function deleteEmpLeaveCron($empid){

		$getall = Yii::app()->db->createCommand("delete from hrm_employee_leave where emp_number = '{$empid}' " )->query();
           

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
