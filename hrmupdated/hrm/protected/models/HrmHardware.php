<?php

/**
 * This is the model class for table "hrm_hardware".
 *
 * The followings are the available columns in table 'hrm_hardware':
 * @property integer $id
 * @property string $resource_name
 * @property string $make
 * @property string $model
 * @property string $remarks
 * @property string $modification_date
 * @property string $vendor_details
 * @property integer $warranty
 * @property string $purchase_date
 */
class HrmHardware extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_hardware';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('resource_name,purchase_date', 'required'),
			array('warranty', 'numerical', 'integerOnly'=>true),
			array('resource_name', 'length', 'max'=>50),
			array('make, model', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, resource_name, serial_no, make, model, remarks, modification_date, vendor_details, warranty, purchase_date','macaddress1','macaddress2','macaddress3','macaddress4','safe', 'on'=>'search'),
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
			'macaddress1' => 'MAC Address1',
			'macaddress2'=> 'MAC Address2',
			'macaddress3'=> 'MAC Address3',
			'macaddress4'=> 'MAC Address4'
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
		$criteria->compare('warranty',$this->warranty);
		$criteria->compare('purchase_date',$this->purchase_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function get_hardwaredetails($column,$dir,$search,$limit,$display_length)
        {   
            $columns = array(0=>"T1.resource_name",1=>"T1.serial_no",2=>"T1.make",3=>"T1.warranty");
            if ($columns !='')
                $orderby = "order by ".$columns[$column]." ".$dir;
            else
                $orderby = " order by T1.id desc " ;
            
            $search_append = " Where T1.`delete` != '1' ";

            if($search!='')
                $search_append .="  and (T1.serial_no) like '%$search%' or (T1.resource_name) like '%$search%' or CONCAT(T3.emp_firstname,' ',T3.emp_lastname) like '%$search%'";
            
            $alldata = Yii::app()->db->createCommand("SELECT T1.id,T1.resource_name,T1.serial_no,T1.make,T1.warranty,T2.resource_id,CONCAT(T3.emp_firstname,' ',T3.emp_lastname) as name,T1.macaddress1,T1.macaddress2,macaddress3,macaddress4 FROM
             hrm_hardware T1
             left join 
             hrm_resource_assign T2 on T1.id = T2.resource_id and T2.resource_type = 'h' and T2.status = 'Y'
             left join hrm_employee T3 on T3.emp_number = T2.emp_number

               $search_append $orderby limit $limit,$display_length")->queryAll();
            return $alldata;
        }
        public function hard_count()
        {
            $hardcount = Yii::app()->db->createCommand("SELECT id FROM hrm_hardware where `delete` != '1' ")->queryAll();
            return count($hardcount);
        }
        
        public function hard_search_count($search)
        {
            
        	 $search_append = " Where T1.`delete` != '1' ";
            if ($search!='')
                $search_append .=" and (T1.serial_no) like '%$search%' or (T1.resource_name) like '%$search%' or CONCAT(T3.emp_firstname,' ',T3.emp_lastname) like '%$search%'";
            
           // echo "SELECT a.id,a.resource_name,a.make,a.warranty FROM hrm_hardware a left join hrm_resource_assign b on a.id=b.resource_id left join hrm_employee c on b.emp_number=c.emp_number $search_append";
           // exit();
            $searchcount = Yii::app()->db->createCommand("SELECT T1.id FROM
             hrm_hardware T1
             left join 
             hrm_resource_assign T2 on T1.id = T2.resource_id and T2.resource_type = 'h' and T2.status = 'Y'
             left join hrm_employee T3 on T3.emp_number = T2.emp_number $search_append")->queryAll();
            return count($searchcount);
        }
        
       public function edit_hardwares($hardid)
        {
            $hardware = Yii::app()->db->createCommand("SELECT id,resource_name,make,serial_no,model,remarks,modification_date,vendor_details,purchase_date,macaddress1,macaddress2,macaddress3,macaddress4 FROM hrm_hardware WHERE id=$hardid")->queryRow();
            return $hardware;
        }

        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmHardware the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
