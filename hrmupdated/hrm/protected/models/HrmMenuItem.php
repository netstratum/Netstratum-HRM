<?php

/**
 * This is the model class for table "hrm_menu_item".
 *
 * The followings are the available columns in table 'hrm_menu_item':
 * @property integer $id
 * @property string $menu_title
 * @property integer $screen_id
 * @property integer $parent_id
 * @property integer $level
 * @property integer $order_hint
 * @property string $url_extras
 * @property integer $status
 */
class HrmMenuItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hrm_menu_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_title, screen_id, parent_id, level, order_hint, url_extras, status', 'required'),
			array('screen_id, parent_id, level, order_hint, status', 'numerical', 'integerOnly'=>true),
			array('menu_title', 'length', 'max'=>250),
			array('url_extras', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, menu_title, screen_id, parent_id, level, order_hint, url_extras, status', 'safe', 'on'=>'search'),
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
			'menu_title' => 'Menu Title',
			'screen_id' => 'Screen',
			'parent_id' => 'Parent',
			'level' => 'Level',
			'order_hint' => 'Order Hint',
			'url_extras' => 'Url Extras',
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
		$criteria->compare('menu_title',$this->menu_title,true);
		$criteria->compare('screen_id',$this->screen_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('level',$this->level);
		$criteria->compare('order_hint',$this->order_hint);
		$criteria->compare('url_extras',$this->url_extras,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HrmMenuItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getmenu($parent_id,$role_id,$top)
	{

		$getall = Yii::app()->db->createCommand("SELECT id,parent_id,menu_title,url_extras from hrm_menu_item
       		Where FIND_IN_SET('$role_id',role_id )>0 and parent_id = $parent_id  and status = '1' and menu_type = '$top' order by order_hint asc ")->queryAll();
 
		


        return $getall;
           

    }
	
	 public function getmenu_app($parent_id,$role_id,$top)
	{

		$getall = Yii::app()->db->createCommand("SELECT id,parent_id,menu_title,url_extras,children from hrm_menu_item
       		Where FIND_IN_SET('$role_id',role_id )>0 and parent_id = $parent_id  and status = '1' and mobile='Y' and menu_type = '$top' order by order_hint asc ")->queryAll();		
        return $getall;
    }

}
