<?php

class LoginregisterController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
        
        public function actionLogin()
        {   
               $session=new CHttpSession;

               $session->open();
              if (isset($session['memberid']))
                 header('Location:'.Yii::app()->getBaseUrl(TRUE)."/index.php"); // to redirect to index if loggedin
                
              $cookieusername = Yii::app()->request->cookies['cookuname']->value;
               $cookiepassword = Yii::app()->request->cookies['cookpass']->value;

                $this->layout = '/layouts/loginlayout';
                $this->render('login',array("cookieusername"=>$cookieusername,"cookiepassword"=>$cookiepassword));
            
                                              
        }

public function actionLoginApp()
        {
           //header("Access-Control-Allow-Origin: *");
         
           $record = new HrmUserMaster();
           $pass = crypt(trim($_POST['loginpassword']),Yii::app()->params['encrptpass']);
           $store = $record->getUsercheck(trim($_POST['loginusername']),$pass); 
           if ($store['id']>0){
//               $applogindata = array('chatepno'=>$store['emp_number'],'chatname'=>$store['name'],'memberid'=>$store['id'],
//                   'uname'=>$store['user_name'],'empnumber'=>$store['emp_number'],'user_role'=>$store['user_role_id'],'username'
//                   =>$store['user_name'],'name'=>$store['name']);
           
            $add = new HrmLoginHistory();
                $add->user_id=$store['id'];
                $add->user_name=$store['user_name'];
                $add->login_time=date('Y:m:d H:i:s');                
                $add->ip_address=Yii::app()->request->getUserHostAddress();                
                $add->save();   
		$store['login_status']="success";
                echo json_encode($store);
           }

      	else{
            echo json_encode(array('login_status'=>'failed','username'=>trim($_REQUEST['loginusername']),'password'=>trim($_REQUEST['loginpassword'])));          
            }
		exit();
        }
        public function actionLoginValidation()
        {      
                $record = new HrmUserMaster();

                 $pass = crypt($_REQUEST['upw'],Yii::app()->params['encrptpass']);
                #$store = $record->findByAttributes(array('user_name'=>$_REQUEST['uemail'],'user_password'=>$pass,'status'=>'Y'));
                #print_r($store);
                
//echo Yii::app()->params['encrptpass'];

                $store = $record->getUsercheck($_REQUEST['uemail'],$pass);
/*
if ($store['user_password'] === crypt($_REQUEST['upw'], $store['user_password']))
    echo 'password is correct';
else
    echo 'password is wrong';
*/

               
//print_r($store);
                if ($store['id']>0){
                #$add = new HrmLoginHistory();
                #$add->attributes=$_POST;
                #$add->save();
                #print_r($add);
                
                session_start();
                $_SESSION['chatepno'] = $store['emp_number'];
                $_SESSION['chatname'] = $store['name'];
                $session=new CHttpSession;
                $session->open();
                
                
                $session['memberid']=$store['id'];
                
                $_SESSION['uname'] = $store['user_name'];
                $session['empnumber']=$store['emp_number'];
                $session['user_role']=$store['user_role_id'];
                $session['username']=$store['user_name'];
                $session['name']=$store['name'];
                
                
                #echo $session['id'];               
                 if($_REQUEST['cookstore'] == 1){
                    
                        Yii::app()->request->cookies['cookuname'] = new CHttpCookie('cookuname', $_REQUEST['uemail']);
                        Yii::app()->request->cookies['cookpass'] = new CHttpCookie('cookpass', $_REQUEST['upw']);
                }



                $add = new HrmLoginHistory();
                $add->user_id=$store['id'];
                $add->user_name=$store['user_name'];
                $add->login_time=date('Y:m:d H:i:s');
                
                $add->ip_address=Yii::app()->request->getUserHostAddress();
                
                $add->save();
                echo "success";
                #print_r($add);
                #header("Location: index.php");
                }else{
                    
                    echo "fail";
                }
                
//                $round = new HrmRoundcubeMail();
//                $round->user_name=$session['username'];
//                $round->emp_number=$session['empnumber'];
//                $round->save();
                
                $rmailid = HrmRoundcubeMail::model()->getroundid($_REQUEST['uemail']);
                #print_r($rmailid);
                
                $session['roundid']=$rmailid['id'];
                
                
        }
        
        
        public function actionLogout(){

            $session=new CHttpSession;
            $session->open();

            unset(Yii::app()->session['memberid'],Yii::app()->session['empnumber'],Yii::app()->session['user_role'],Yii::app()->session['username'],Yii::app()->session['name']);
             Yii::app()->session->clear();
            Yii::app()->session->destroy();
//            HrmUserMaster::model()->deletesession();
            $this->redirect(Yii::app()->getBaseUrl(TRUE)."/index.php?r=Loginregister/Login");
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
