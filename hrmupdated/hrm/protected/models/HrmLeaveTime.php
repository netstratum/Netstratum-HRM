<?php

/**
 * This is the model class for table "hrm_leave_time".
 *
 * The followings are the available columns in table 'hrm_leave_time':
 * @property integer $id
 * @property integer $hrm_leave_id
 * @property string $start_day_time
 * @property string $end_day_time
 */
class HrmLeaveTime extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_leave_time';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('hrm_leave_id, start_day_time, end_day_time', 'required'),
			#array('hrm_leave_id', 'numerical', 'integerOnly'=>true),
			#array('start_day_time, end_day_time', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hrm_leave_id, start_day_time, end_day_time', 'safe', 'on'=>'search'),
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
			'hrm_leave_id' => 'Hrm Leave',
			'start_day_time' => 'Start Day Time',
			'end_day_time' => 'End Day Time',
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
		$criteria->compare('hrm_leave_id',$this->hrm_leave_id);
		$criteria->compare('start_day_time',$this->start_day_time,true);
		$criteria->compare('end_day_time',$this->end_day_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmLeaveTime the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
