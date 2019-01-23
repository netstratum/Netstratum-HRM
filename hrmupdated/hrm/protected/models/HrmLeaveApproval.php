<?php

/**
 * This is the model class for table "hrm_leave_approval".
 *
 * The followings are the available columns in table 'hrm_leave_approval':
 * @property string $id
 * @property string $hrm_leave_id
 * @property integer $supervisor_id
 * @property string $approval
 * @property string $approval_date
 */
class HrmLeaveApproval extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_leave_approval';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('hrm_leave_id, supervisor_id, approval_date', 'required'),
			array('supervisor_id', 'numerical', 'integerOnly'=>true),
			array('hrm_leave_id', 'length', 'max'=>20),
			array('approval', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, hrm_leave_id, supervisor_id, approval, approval_date', 'safe', 'on'=>'search'),
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
			'supervisor_id' => 'Supervisor',
			'approval' => 'Approval',
			'approval_date' => 'Approval Date',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('hrm_leave_id',$this->hrm_leave_id,true);
		$criteria->compare('supervisor_id',$this->supervisor_id);
		$criteria->compare('approval',$this->approval,true);
		$criteria->compare('approval_date',$this->approval_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmLeaveApproval the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
