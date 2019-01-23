<?php

/**
 * This is the model class for table "hrm_employee".
 *
 * The followings are the available columns in table 'hrm_employee':
 * @property integer $emp_number
 * @property string $employee_id
 * @property string $emp_lastname
 * @property string $emp_firstname
 * @property string $emp_middle_name
 * @property string $emp_nick_name
 * @property string $emp_primary_address
 * @property string $emp_primary_city
 * @property string $emp_primary_state
 * @property string $emp_primary_country
 * @property integer $emp_primary_pincode
 * @property string $emp_permanent_address
 * @property string $emp_permanent_city
 * @property string $emp_permanent_state
 * @property string $emp_permanent_country
 * @property integer $emp_permanent_pincode
 * @property string $emp_gender
 * @property string $emp_dob
 * @property string $emp_marital_status
 * @property string $emp_dri_lice_num
 * @property integer $emp_status
 * @property integer $job_title_code
 * @property integer $emp_home_phone
 * @property integer $emp_mobile
 * @property string $joined_date
 * @property string $emp_additional_notes
 */
class HrmEmployee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			#array('emp_number, emp_primary_address, emp_primary_city, emp_primary_state, emp_primary_country, emp_primary_pincode, emp_permanent_address, emp_permanent_city, emp_permanent_state, emp_permanent_country, emp_permanent_pincode, emp_dob, emp_home_phone, emp_mobile, emp_additional_notes', 'required'),
			#array('emp_number, emp_primary_pincode, emp_permanent_pincode, emp_status, job_title_code, emp_home_phone, emp_mobile', 'numerical', 'integerOnly'=>true),
			#array('employee_id', 'length', 'max'=>50),
			array('emp_lastname, emp_firstname, emp_middle_name', 'length', 'max'=>250),
			#array('emp_nick_name, emp_dri_lice_num', 'length', 'max'=>100),
			#array('emp_primary_city, emp_primary_state, emp_primary_country, emp_permanent_city, emp_permanent_state, emp_permanent_country', 'length', 'max'=>200),
			#array('emp_gender', 'length', 'max'=>1),
			#array('emp_marital_status', 'length', 'max'=>20),
			#array('joined_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			#array('emp_number, employee_id, emp_lastname, emp_firstname, emp_middle_name, emp_nick_name, emp_primary_address, emp_primary_city, emp_primary_state, emp_primary_country, emp_primary_pincode, emp_permanent_address, emp_permanent_city, emp_permanent_state, emp_permanent_country, emp_permanent_pincode, emp_gender, emp_dob, emp_marital_status, emp_dri_lice_num, emp_status, job_title_code, emp_home_phone, emp_mobile, joined_date, emp_additional_notes', 'safe', 'on'=>'search'),
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
			'employee_id' => 'Employee',
			'emp_lastname' => 'Emp Lastname',
			'emp_firstname' => 'Emp Firstname',
			'emp_middle_name' => 'Emp Middle Name',
			'emp_nick_name' => 'Emp Nick Name',
			'emp_primary_address' => 'Emp Primary Address',
			'emp_primary_city' => 'Emp Primary City',
			'emp_primary_state' => 'Emp Primary State',
			'emp_primary_country' => 'Emp Primary Country',
			'emp_primary_pincode' => 'Emp Primary Pincode',
			'emp_permanent_address' => 'Emp Permanent Address',
			'emp_permanent_city' => 'Emp Permanent City',
			'emp_permanent_state' => 'Emp Permanent State',
			'emp_permanent_country' => 'Emp Permanent Country',
			'emp_permanent_pincode' => 'Emp Permanent Pincode',
			'emp_gender' => 'Emp Gender',
			'emp_dob' => 'Emp Dob',
			'emp_marital_status' => 'Emp Marital Status',
			'emp_dri_lice_num' => 'Emp Dri Lice Num',
			'emp_status' => 'Emp Status',
			'job_title_code' => 'Job Title Code',
			'emp_home_phone' => 'Emp Home Phone',
			'emp_mobile' => 'Emp Mobile',
			'joined_date' => 'Joined Date',
			'emp_additional_notes' => 'Emp Additional Notes',
                        'emp_deleted' => 'Emp Deleted',
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
		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('emp_lastname',$this->emp_lastname,true);
		$criteria->compare('emp_firstname',$this->emp_firstname,true);
		$criteria->compare('emp_middle_name',$this->emp_middle_name,true);
		$criteria->compare('emp_nick_name',$this->emp_nick_name,true);
		$criteria->compare('emp_primary_address',$this->emp_primary_address,true);
		$criteria->compare('emp_primary_city',$this->emp_primary_city,true);
		$criteria->compare('emp_primary_state',$this->emp_primary_state,true);
		$criteria->compare('emp_primary_country',$this->emp_primary_country,true);
		$criteria->compare('emp_primary_pincode',$this->emp_primary_pincode);
		$criteria->compare('emp_permanent_address',$this->emp_permanent_address,true);
		$criteria->compare('emp_permanent_city',$this->emp_permanent_city,true);
		$criteria->compare('emp_permanent_state',$this->emp_permanent_state,true);
		$criteria->compare('emp_permanent_country',$this->emp_permanent_country,true);
		$criteria->compare('emp_permanent_pincode',$this->emp_permanent_pincode);
		$criteria->compare('emp_gender',$this->emp_gender,true);
		$criteria->compare('emp_dob',$this->emp_dob,true);
		$criteria->compare('emp_marital_status',$this->emp_marital_status,true);
		$criteria->compare('emp_dri_lice_num',$this->emp_dri_lice_num,true);
		$criteria->compare('emp_status',$this->emp_status);
		$criteria->compare('job_title_code',$this->job_title_code);
		$criteria->compare('emp_home_phone',$this->emp_home_phone);
		$criteria->compare('emp_mobile',$this->emp_mobile);
		$criteria->compare('joined_date',$this->joined_date,true);
		$criteria->compare('emp_additional_notes',$this->emp_additional_notes,true);             
                $criteria->compare('emp_deleted',$this->emp_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getMaxEmpId(){

		  $maxdata = Yii::app()->db->createCommand("SELECT max(employee_id) as emp_id FROM hrm_employee ")->queryRow();
            return $maxdata['emp_id'];
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmEmployee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
