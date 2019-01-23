<?php

/**
 * This is the model class for table "hrm_report_to".
 *
 * The followings are the available columns in table 'hrm_report_to':
 * @property integer $id
 * @property integer $emp_number
 * @property string $name
 * @property string $user_type
 */
class HrmReportTo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_report_to';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_number, user_id, user_type', 'required'),
			array('emp_number', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('user_type', 'length', 'max'=>11),
			array('order_no', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, user_id, user_type', 'safe', 'on'=>'search'),
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
			'user_id' => 'user_id',
			'user_type' => 'User Type',
			'order_no' => 'Order No'
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('user_type',$this->user_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function getSupervisor($empnumber,$start,$display_length)
        {
        	
            $getall = Yii::app()->db->createCommand("SELECT concat(a.emp_firstname,' ',a.emp_middle_name,' ',a.emp_lastname) as name,"
                    . "b.id as userid,b.user_role_id,c.leave_approval,c.order_no,c.id as reportid "
                    . "FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number "
                    . "INNER JOIN hrm_report_to c ON a.emp_number=c.user_id "
                    . "WHERE c.user_type = 'supervisor' and c.emp_number=".$empnumber." order by order_no desc limit ".$start.",".$display_length )->queryAll();
            return $getall;
        }

        public function getSupervisor_cnt($empnumber)
        {
        	
            $getall = Yii::app()->db->createCommand("SELECT c.id "
                    . "FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number "
                    . "INNER JOIN hrm_report_to c ON a.emp_number=c.user_id "
                    . "WHERE c.user_type = 'supervisor' and c.emp_number=".$empnumber)->queryAll();
            return count($getall);
        }



      public function getSubordinate($empnumber,$start,$display_length)
        {
            $getall = Yii::app()->db->createCommand("SELECT concat(a.emp_firstname,' ',a.emp_middle_name,' ',a.emp_lastname) as name,"
                    . "b.id as userid,b.user_role_id,c.id as reportid "
                    . "FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number "
                    . "INNER JOIN hrm_report_to c ON a.emp_number=c.user_id "
                    . "WHERE c.user_type = 'subordinate' and c.emp_number=".$empnumber." order by order_no desc limit ".$start.",".$display_length )->queryAll();
            return $getall;
        }

        public function getSubordinate_cnt($empnumber)
        {
            $getall = Yii::app()->db->createCommand("SELECT c.id "
                    . "FROM hrm_employee a INNER JOIN hrm_user_master b ON a.emp_number=b.emp_number "
                    . "INNER JOIN hrm_report_to c ON a.emp_number=c.user_id "
                    . "WHERE c.user_type = 'subordinate' and c.emp_number=".$empnumber )->queryAll();
            return count($getall);
        }


       public function getAllSuggestions($term,$empnumber)
       {

       		$session=new CHttpSession;
            $session->open();
            if ($empnumber=='')
            	$empnumber = $session['empnumber'];
       		$getall = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_middle_name,' ',emp_lastname) as label, emp_number as id from hrm_employee "
                 // emp_status = 'Y' and  emp_deleted = 'N' and
                    . "WHERE emp_number !={$empnumber} and emp_number not in (select user_id from hrm_report_to where emp_number = {$empnumber}) and  concat(emp_firstname,' ',emp_middle_name,' ',emp_lastname) like '%{$term}%'")->queryAll();
            return $getall;


       }

         public function Deletesubordinte($report_id)
        {
        	
        	$geRow  = Yii::app()->db->createCommand(" select emp_number,user_id from hrm_report_to WHERE id=".$report_id)->queryRow();
        	Yii::app()->db->createCommand(" Delete from hrm_report_to WHERE id=".$report_id)->query();
            Yii::app()->db->createCommand(" Delete from hrm_report_to WHERE user_id = '{$geRow['emp_number']}' and emp_number =  '{$geRow['user_id']}'")->query();
           // Yii::app()->db->createCommand(" Delete from hrm_leave_approval WHERE supervisor_id = '{$geRow['emp_number']}' and user_id =  '{$geRow['user_id']}'".$report_id)->query();
        }

        public function Deletesupervisor($report_id)
        {
        	
           $geRow  = Yii::app()->db->createCommand(" select emp_number,user_id from hrm_report_to WHERE id=".$report_id)->queryRow();
        	Yii::app()->db->createCommand(" Delete from hrm_report_to WHERE id=".$report_id)->query();
            Yii::app()->db->createCommand(" Delete from hrm_report_to WHERE user_id = '{$geRow['emp_number']}' and emp_number =  '{$geRow['user_id']}'")->query();
            
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmReportTo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
