<?php

/**
 * This is the model class for table "hrm_resource_assign".
 *
 * The followings are the available columns in table 'hrm_resource_assign':
 * @property integer $id
 * @property string $product_slno
 * @property integer $emp_number
 * @property string $status
 */
class HrmResourceAssign extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_resource_assign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('product_slno, emp_number', 'required'),
			//array('emp_number', 'numerical', 'integerOnly'=>true),
			array('product_slno', 'length', 'max'=>20),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_slno, emp_number, status', 'safe', 'on'=>'search'),
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
			'product_slno' => 'Product Slno',
			'emp_number' => 'Emp Number',
			'status' => 'Status',
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
		$criteria->compare('product_slno',$this->product_slno,true);
		$criteria->compare('emp_number',$this->emp_number);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function search_hard_emp($term)
        {
            $employee = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_lastname) as label,emp_number,employee_id FROM hrm_employee WHERE emp_firstname LIKE '%{$term}%'")->queryAll();
            return $employee;
        }
        public function search_soft_emp($term)
        {
            $employee = Yii::app()->db->createCommand("SELECT concat(emp_firstname,' ',emp_lastname) as label,emp_number,employee_id FROM hrm_employee WHERE emp_firstname LIKE '%{$term}%'")->queryAll();
            return $employee;
        }


        public function mailto()
        {
            $toaddress = Yii::app()->db->createCommand("SELECT T1.user_name,T1.company_id,T2.company_name
             FROM hrm_user_master T1 
             Left Join hrm_company T2 on T1.company_id = T2.id
             WHERE (T1.user_role_id=4 or T1.user_role_id = 1) and T1.status = 'Y' and T1.emp_deleted = 'N' order by T1.id asc ")->queryAll();
            return $toaddress;

        }




        public function getresourceDetails($resourceid,$type){

        	if ($type == 'h'){

        		$Details = Yii::app()->db->createCommand("SELECT resource_name,model FROM hrm_hardware
        			WHERE id = '$resourceid' ")->queryRow();
          	


        	}else{

        		$Details = Yii::app()->db->createCommand("SELECT resource_name,model  FROM hrm_software WHERE 
        			id = '$resourceid'")->queryRow();
          

        	}

        	  return $Details;

        }


         public function getresourceDetails_delete($resourceid,$type){

        	if ($type == 'h'){

        		$Details = Yii::app()->db->createCommand("SELECT T1.resource_name,T1.model,T2.emp_number FROM hrm_hardware T1
        			INNER JOIN hrm_resource_assign T2 on T1.id = T2.resource_id and T2.resource_type = 'h'

        			WHERE T1.id = '$resourceid' ")->queryRow();
          	


        	}else{

        		$Details = Yii::app()->db->createCommand("SELECT T1.resource_name,T1.model,T2.emp_number  FROM hrm_software T1
        			INNER JOIN hrm_resource_assign T2 on T1.id = T2.resource_id and T2.resource_type = 's'

        			WHERE T1.id = '$resourceid' ")->queryRow();
          

        	}

        	  return $Details;

        }


        public function get_assign_details($empno,$type)
        {

            $getdata = Yii::app()->db->createCommand("SELECT COUNT(product_slno) as cnt FROM hrm_resource_assign WHERE emp_number=$empno and product_slno like '$type%' ")->queryRow();
            return $getdata;
        }
        

        public function delete_resource_details($resource_id,$type)
        {   $date = date('Y-m-d H:i:s');
			$getdata = Yii::app()->db->createCommand(" UPDATE hrm_resource_assign set status = 'N', return_date='$date' WHERE resource_id=$resource_id and resource_type = '$type' and status = 'Y' ")->query();
        	
        }


        public function getallhistory($resource_id,$type)
        {
            //echo "SELECT concat(b.emp_firstname,' ',b.emp_lastname) as name,a.assign_date,a.return_date FROM hrm_resource_assign a LEFT JOIN hrm_employee b on a.emp_number=b.emp_number WHERE a.resource_id=$resource_id AND a.resource_type='$type'";
            //exit();
            $resourcehistory = Yii::app()->db->createCommand("SELECT concat(b.emp_firstname,' ',b.emp_lastname) as name,a.assign_date,a.return_date,a.status FROM hrm_resource_assign a LEFT JOIN hrm_employee b on a.emp_number=b.emp_number WHERE a.resource_id=$resource_id AND a.resource_type='$type' order by a.assign_date desc")->queryAll();
            return $resourcehistory;
            

        }
        
        public function getsoftwarehistory($resource_id,$type)
        {
            $resourcehistory = Yii::app()->db->createCommand("SELECT concat(b.emp_firstname,' ',b.emp_lastname) as name,a.assign_date,a.return_date,a.status FROM hrm_resource_assign a LEFT JOIN hrm_employee b on a.emp_number=b.emp_number WHERE a.resource_id=$resource_id AND a.resource_type='$type' order by a.assign_date desc")->queryAll();
            return $resourcehistory;
        }

        function delete_hardware($id)
        {

        	$getdata = Yii::app()->db->createCommand(" UPDATE hrm_hardware set `delete` = '1' WHERE id=$id ")->query();

        }

        function delete_software($id)
        {

        	$getdata = Yii::app()->db->createCommand(" UPDATE hrm_software set `delete` = '1' WHERE id=$id  ")->query();
        }


        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmResourceAssign the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
