<?php

class menu extends CApplicationComponent
{
    private $_language;
    
    public function init()
    {
        parent::init();
        if(empty($this->_language))
            $this->setLanguage(Yii::app()->language);
        
        $dir = dirname(__FILE__);
        $alias = md5($dir);
        Yii::setPathOfAlias($alias,$dir);
        #Yii::import($alias.'.upload');
    }
    public function setLanguage($lang)
    {
        $this->_language = $lang;
    }
    
    public function getMenu($parent_id,$role_id){
                        
        
         $obj = new HrmMenuItem(); 

         $menu =  $obj->getmenu($parent_id,$role_id,'top');
           $allsupervisors = HrmLeave::model()->Supervisor_check();
          
         if (count($menu)>0){ 
          
          foreach ($menu as $key => $value) { 
           $parent_id = $value['id'];
           $main_id = $value['parent_id'];
           
           if(($role_id == 5 and $value['url_extras']=='index.php?r=Timesheet/Superreport') or ($allsupervisors>0 and ($value['url_extras']=='index.php?r=Timesheet/Addproject' or $value['url_extras']=='index.php?r=Timesheet/Superreport')) or ($value['url_extras']!='index.php?r=Timesheet/Addproject' and $value['url_extras']!='index.php?r=Timesheet/Superreport'))
           {
               
          
            if ($main_id == 0 and $value['url_extras'] == '#'){
           ?>
            <li class="dropdown user"><a href="<?php echo $value['url_extras'];?>" data-toggle="dropdown" class="dropdown-toggle"><span class="username"><?php echo $value['menu_title'];?></span> <i class="icon-angle-down"></i></a>
            <?php }else{ ?>
            <li><a href="<?php echo $value['url_extras'];?>"><?php echo $value['menu_title'];?></a></li>
            <?php }}    ?>
            <ul class="dropdown-menu">
              <?php  $this->getmenu($parent_id,$role_id);  ?>
                </ul>
                </li>
            <?php 
            }

         }  

        
    }


    public function getOtherMenu($parent_id,$role_id,$menu_type,$superviser_cnt){
       
        $obj = new HrmMenuItem(); 
        $menu =  $obj->getmenu($parent_id,$role_id,$menu_type);
         if (count($menu)>0){ ?>
           <ul class="tabs tabs-inline tabs-top">
          <?php  foreach ($menu as $key => $value) {  

            if (($superviser_cnt==0 and $value['url_extras'] == '#lreport' and $role_id!=1 and $role_id!=2)){

            }else{
            ?>
              
              <li <?php if ($key==0){?>class="active"<?php }?>>
                 <a data-toggle="tab" href="<?php echo $value['url_extras'];?>"> <?php echo $value['menu_title'];?></a>
              </li>
                            
            
        <?php }    } ?>
            </ul>
        <?php }  

        
    }

   

}

?>

