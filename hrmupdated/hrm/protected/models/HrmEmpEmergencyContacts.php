<?php

/**
 * This is the model class for table "hrm_emp_emergency_contacts".
 *
 * The followings are the available columns in table 'hrm_emp_emergency_contacts':
 * @property integer $emp_number
 * @property string $eec_seqno
 * @property string $eec_name
 * @property string $eec_address
 * @property string $eec_city
 * @property string $eec_state
 * @property integer $eec_pincode
 * @property string $eec_country
 * @property string $eec_relationship
 * @property string $eec_home_no
 * @property string $eec_mobile_no
 * @property string $eec_office_no
 */
class HrmEmpEmergencyContacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_emp_emergency_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eec_address, eec_city, eec_state, eec_pincode, eec_country', 'required'),
			array('emp_number, eec_pincode', 'numerical', 'integerOnly'=>true),
			array('eec_seqno', 'length', 'max'=>2),
			array('eec_name, eec_relationship, eec_home_no, eec_mobile_no, eec_office_no', 'length', 'max'=>200),
			array('eec_city, eec_state, eec_country', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_number, eec_seqno, eec_name, eec_address, eec_city, eec_state, eec_pincode, eec_country, eec_relationship, eec_home_no, eec_mobile_no, eec_office_no', 'safe', 'on'=>'search'),
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
			'emp_number' => 'Emp Number',
			'eec_seqno' => 'Eec Seqno',
			'eec_name' => 'Eec Name',
			'eec_address' => 'Eec Address',
			'eec_city' => 'Eec City',
			'eec_state' => 'Eec State',
			'eec_pincode' => 'Eec Pincode',
			'eec_country' => 'Eec Country',
			'eec_relationship' => 'Eec Relationship',
			'eec_home_no' => 'Eec Home No',
			'eec_mobile_no' => 'Eec Mobile No',
			'eec_office_no' => 'Eec Office No',
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

		$criteria->compare('emp_number',$this->emp_number);
		$criteria->compare('eec_seqno',$this->eec_seqno,true);
		$criteria->compare('eec_name',$this->eec_name,true);
		$criteria->compare('eec_address',$this->eec_address,true);
		$criteria->compare('eec_city',$this->eec_city,true);
		$criteria->compare('eec_state',$this->eec_state,true);
		$criteria->compare('eec_pincode',$this->eec_pincode);
		$criteria->compare('eec_country',$this->eec_country,true);
		$criteria->compare('eec_relationship',$this->eec_relationship,true);
		$criteria->compare('eec_home_no',$this->eec_home_no,true);
		$criteria->compare('eec_mobile_no',$this->eec_mobile_no,true);
		$criteria->compare('eec_office_no',$this->eec_office_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmEmpEmergencyContacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
