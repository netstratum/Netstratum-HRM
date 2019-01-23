<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('zii.widgets.CMenu', true);

class ActiveMenu extends CMenu
{
    public function init()
    {
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        $criteria->condition = '`status` = 1';
        $criteria->order = '`screen_id` =1';

        $items = HrmMenuItem::model()->findAll($criteria);

        foreach ($items as $item){
            $this->items[] = array('label'=>$item->menu_title, 'url'=>$item->url_extras);
            }
        
            parent::init();
            
            
        }
}


?>