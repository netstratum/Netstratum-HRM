<?php

/**
 * This is the model class for table "hrm_software".
 *
 * The followings are the available columns in table 'hrm_software':
 * @property integer $id
 * @property string $resource_name
 * @property string $make
 * @property string $model
 * @property string $remarks
 * @property string $modification_date
 * @property string $vendor_details
 * @property string $warranty
 * @property string $purcase_date
 */
class HrmSoftware extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_software';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('resource_name, make,purchase_date', 'required'),
			array('resource_name, make, model', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, resource_name, serial_no, make, model, remarks, modification_date, vendor_details, warranty, purchase_date', 'safe', 'on'=>'search'),
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
			'resource_name' => 'Resource Name',
			'serial_no' => 'Serial Number',
			'make' => 'Make',
			'model' => 'Model',
			'remarks' => 'Remarks',
			'modification_date' => 'Modification Date',
			'vendor_details' => 'Vendor Details',
			'warranty' => 'Warranty',
			'purchase_date' => 'Purchase Date',
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
		$criteria->compare('resource_name',$this->resource_name,true);
		$criteria->compare('make',$this->make,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('modification_date',$this->modification_date,true);
		$criteria->compare('vendor_details',$this->vendor_details,true);
		$criteria->compare('warranty',$this->warranty,true);
		$criteria->compare('purchase_date',$this->purchase_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function get_softwaredetails($column,$dir,$search,$limit,$display_length)
        {   $columns = array(0=>"T1.resource_name",1=>"T1.serial_no",2=>"T1.make",3=>"T1.warranty");
            if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
            else
                $orderby = " order by T1.id desc " ;
            
             $search_append = " Where T1.`delete` != '1' ";

            if($search!='')
                $search_append .=" and  (T1.serial_no) like '%$search%' or (T1.resource_name) like '%$search%' or CONCAT(T3.emp_firstname,' ',T3.emp_lastname) like '%$search%'";
            
            $getdata = Yii::app()->db->createCommand("SELECT T1.id,T1.resource_name,T1.make,T1.serial_no,T1.warranty,T2.resource_id,CONCAT(T3.emp_firstname,' ',T3.emp_lastname) as name FROM hrm_software T1
            	 left join 
             hrm_resource_assign T2 on T1.id = T2.resource_id and T2.resource_type = 's' and T2.status = 'Y'
             left join hrm_employee T3 on T3.emp_number = T2.emp_number
             $search_append $orderby limit $limit,$display_length")->queryAll();
            return $getdata;
        }
        public function soft_count()
        {
            $softcount = Yii::app()->db->createCommand("SELECT id FROM hrm_software where `delete` !='1' ")->queryAll();
            return count($softcount);
        }
        public function soft_search_count($search)
        {
            
        	 $search_append = " Where T1.`delete` != '1' ";
            if ($search!='')
                $search_append .="  and (T1.serial_no) like '%$search%' or (T1.resource_name) like '%$search%' or CONCAT(T3.emp_firstname,' ',T3.emp_lastname) like '%$search%'";
            $searchcount = Yii::app()->db->createCommand("SELECT T1.id FROM hrm_software T1
            	 left join 
             hrm_resource_assign T2 on T1.id = T2.resource_id and T2.resource_type = 's' and T2.status = 'Y'
             left join hrm_employee T3 on T3.emp_number = T2.emp_number $search_append")->queryAll();
            return count($searchcount);
        }


        public function edit_software($softid)
        {
            $software = Yii::app()->db->createCommand("SELECT id,resource_name,make,serial_no,model,remarks,modification_date,vendor_details,purchase_date FROM hrm_software WHERE id=$softid")->queryRow();
            return $software;
        }

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmSoftware the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
