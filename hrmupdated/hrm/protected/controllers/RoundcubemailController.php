<?php

class RoundcubemailController extends Controller
{
	public function actionIndex()
	{
            $this->render('index');
	}
        
        public function actionOfficemail()
        {   
		
            Yii::app()->red->redirect();
            $this->render('officemail',"",FALSE);
        }
        
        public function actionAddnewdata()
        {
            $radd = new HrmRoundcubeMail();
            
            $session=new CHttpSession;
            $session->open();
            $radd->username = $session['username'];
            #$radd->mail_password = $_REQUEST['roundpassword'];
            
            #$encrypted_string = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_key, $_REQUEST['roundpassword'], MCRYPT_MODE_CBC);
             $rr = HrmRoundcubeMail::model()->encrypt($_REQUEST['roundpassword']);
            $radd->mail_password = $rr;
            #echo $_REQUEST['roundpassword'];
            if($_REQUEST['rrid']>0){
                HrmRoundcubeMail::model()->updateroundpassword($rr, $session['username']);
                  $session['roundid']=$_REQUEST['rrid'];
                echo $_REQUEST['rrid'];
            }
            else{
                $radd->insert();
                 $session['roundid']=Yii::app()->db->getLastInsertId();
                echo Yii::app()->db->getLastInsertId();
            }
            
        }
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
