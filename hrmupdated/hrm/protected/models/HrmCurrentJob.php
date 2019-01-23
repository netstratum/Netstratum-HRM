<?php

/**
 * This is the model class for table "hrm_current_job".
 *
 * The followings are the available columns in table 'hrm_current_job':
 * @property integer $id
 * @property integer $emp_number
 * @property string $job_title
 * @property string $job_status
 * @property string $job_category
 * @property string $join_date
 */
class HrmCurrentJob extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_current_job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_number, job_title, job_status, job_category, join_date', 'required'),
			array('emp_number', 'numerical', 'integerOnly'=>true),
			array('job_title, job_status, job_category', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, job_title, job_status, job_category, join_date', 'safe', 'on'=>'search'),
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
			'job_title' => 'Job Title',
			'job_status' => 'Job Status',
			'job_category' => 'Job Category',
			'join_date' => 'Join Date',
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
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('job_status',$this->job_status,true);
		$criteria->compare('job_category',$this->job_category,true);
		$criteria->compare('join_date',$this->join_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmCurrentJob the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
