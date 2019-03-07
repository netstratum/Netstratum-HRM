<?php

class LoginregisterController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
        
        public function actionInstall()
        {   
            $hrmUserMaster = new HrmUserMaster();
            $tempass = crypt('password',Yii::app()->params['encrptpass']); 
            $hrmUserMaster->id='1';
            $hrmUserMaster->user_role_id='1';
            $hrmUserMaster->emp_number='1';
            $hrmUserMaster->user_name='admin@example.com';
            $hrmUserMaster->user_password=$tempass;
            $hrmUserMaster->status='Y';
            $hrmUserMaster->date_entered = date('Y-m-d');
            $hrmUserMaster->date_modified = date('Y-m-d');
            $hrmUserMaster->modified_user_id='1';
            $hrmUserMaster->created_by='1';
            $hrmUserMaster->mobile_number='1';
            $hrmUserMaster->emp_deleted='N';
            $hrmUserMaster->company_id='1';
            //date('Y-m-d');
            $hrmUserMaster->insert();

            $hrmEmployee = new HrmEmployee();
            $hrmEmployee->emp_number='1';
            $hrmEmployee->employee_id='abc';
            $hrmEmployee->emp_lastname='user';
            $hrmEmployee->emp_firstname='admin';
            $hrmEmployee->emp_middle_name='root';
            $hrmEmployee->emp_nick_name='';
            $hrmEmployee->emp_primary_address = 'default';
            $hrmEmployee->emp_primary_city = 'ekm';
            $hrmEmployee->emp_primary_state='abc';
            $hrmEmployee->emp_primary_country='abc';
            $hrmEmployee->emp_primary_pincode='1';
            $hrmEmployee->emp_permanent_address='N';
            $hrmEmployee->emp_permanent_city='ekm';
            $hrmEmployee->emp_permanent_state='ekm';
            $hrmEmployee->emp_permanent_country='ekm';
            $hrmEmployee->emp_permanent_pincode='1';
            $hrmEmployee->emp_gender='M';
            $hrmEmployee->emp_dob=date('Y-m-d');
            $hrmEmployee->emp_marital_status='';
            $hrmEmployee->emp_dri_lice_num='';
            $hrmEmployee->emp_status='Y';
            $hrmEmployee->job_title_code='';
            $hrmEmployee->emp_home_phone='1';
            $hrmEmployee->emp_mobile='1';
            $hrmEmployee->joined_date=date('Y-m-d');
            $hrmEmployee->emp_additional_notes='ekm';
            $hrmEmployee->emp_deleted='N';
            $hrmEmployee->google_push_id='ekm';
            $hrmEmployee->apple_push_id='ekm';
            





            //date('Y-m-d');
            $hrmEmployee->insert();
            
            //$tempass = crypt('password',Yii::app()->params['encrptpass']); 
            header('Location:'.Yii::app()->getBaseUrl(TRUE)."/index.php?r=Loginregister/Login");                                  
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
