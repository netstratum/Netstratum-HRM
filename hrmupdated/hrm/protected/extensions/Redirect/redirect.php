<?php

class redirect extends CApplicationComponent
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
    
    public function redirect(){
        
        $session = new CHttpSession;
        $session->open();
        if (!isset($session['memberid']))
            {

          
           // $this->redirect('Loginregister/Login');
            
          header('Location:'.Yii::app()->getBaseUrl(TRUE)."/index.php?r=Loginregister/Login");
          exit;
            
            
        }
        
        
    }

    public function ajax_redirect(){
        
        $session = new CHttpSession;
        $session->open();
        if (!isset($session['memberid']))
        {

           echo "sess_fail";
           exit;
            
        }
        
        
    }

}

?>