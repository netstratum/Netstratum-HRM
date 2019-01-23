<?php

/**
 * This is the model class for table "hrm_leave_days".
 *
 * The followings are the available columns in table 'hrm_leave_days':
 * @property integer $id
 * @property integer $emp_number
 * @property integer $week_days
 */
class HrmLeaveDays extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_leave_days';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_number, week_days', 'required'),
			array('emp_number, week_days', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, week_days', 'safe', 'on'=>'search'),
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
			'week_days' => 'Week Days',
		);
	}
        
        public function deleteleavedays($empno)
        {
            Yii::app()->db->createCommand("DELETE * from hrm_leave_days WHERE emp_number=".$empno)->queryRow();
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
		$criteria->compare('week_days',$this->week_days);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	 public function selectdays($empno)
        {
            $select = Yii::app()->db->createCommand("SELECT week_days FROM hrm_leave_days WHERE emp_number=".$empno)->query();
            return $select;
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmLeaveDays the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
