<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class HrmDoc extends CActiveRecord
{
	public $name;
	public $folder_name;
	public $file_name;
	public $active;

	public function tableName()
	{
		return 'hrm_docs';
	}

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// name and holiday_date are required
			array('name, folder_name','file_name','required'),
			// rememberMe needs to be a boolean
			array('active', 'boolean'),
			
			
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAllDocs()
  {
       		
       	 $columns = array(0=>"name",1=>"holiday_date",2=>"holiday_type");
         
         if ($columns !='')
         	$orderby = "order by ".$columns[$column]." ".$dir;

       		if ($search!='')
       			$append = " and (name like '%$search%' or holiday_type like '%$search%')";
       		else
       			$append = '';

       		$getall = Yii::app()->db->createCommand("SELECT id,name,holiday_date,holiday_type from hrm_holidays where active = 'Y' $append $orderby limit $limit,$display_length ")->queryAll();
          return $getall;

 }


public function getHolidays()
 {
      $getall = Yii::app()->db->createCommand("SELECT group_concat('\'', date(holiday_date), '\'') as holidays from hrm_holidays where holiday_type = 'holiday' ")->queryRow();
      return $getall['holidays'];
    
 }


 public function getEmployeeNumber($employeeid)
 {

    $getall = Yii::app()->db->createCommand("SELECT emp_number from hrm_employee where employee_id = '$employeeid' ")->queryRow();
   
    return $getall['emp_number'];


 }

 public function update_folder($emp_number,$folder,$parent)
 {

     $mailedit = Yii::app()->db->createCommand("Select T2.employee_ids from tree_data T1 inner join tree_struct T2

    on T1.id = T2.id   where T1.nm = '$folder' and T2.pid = '$parent' ")->queryRow();
    if ($mailedit['employee_ids']!='')
    { 
        $values = array_filter(json_decode($mailedit['employee_ids']));

         if (count($values)==0)
                $values = array('0');


        if (!in_array($emp_number, $values))
        {
            
              $values = array_merge($values,array($emp_number));
           

            $values = json_encode($values);

            $mailedit = Yii::app()->db->createCommand("Update tree_data T1 inner join tree_struct T2

    on T1.id = T2.id set T2.employee_ids = '$values'  where T1.nm = '$folder' and T2.pid = '$parent' "   )->query();


        }



    }else{


         $values = array($emp_number);  
         $values = json_encode($values);
         //echo "Update tree_data T1 inner join tree_struct T2  on T1.id = T2.id set T2.employee_ids = '$values'  where T1.nm = '$folder' and T2.pid = '$parent' ";
            $mailedit = Yii::app()->db->createCommand("Update tree_data T1 inner join tree_struct T2

    on T1.id = T2.id set T2.employee_ids = '$values'  where T1.nm = '$folder' and T2.pid = '$parent' "   )->query();

    }

 }



 function getFolderId($text,$parent_id)
 {

    $mailedit = Yii::app()->db->createCommand("Select T1.id from tree_data T1 inner join tree_struct T2

    on T1.id = T2.id   where T1.nm = '$text' and T2.pid = '$parent_id' ")->queryRow();
    return $mailedit['id'];

 }


 function UpdateFilePath($empnumber,$filepath,$filename,$employee_id)
 {

   $session = new CHttpSession;
   $session->open();
 
    $mailedit = Yii::app()->db->createCommand("Select id  from hrm_docs where folder_name = '$filepath' and file_name = '$filename' and active ='Y' ")->queryRow();
    if ($mailedit['id'] > 0)
    {

       $docid = $mailedit['id'];

    }else{

          $mailedit = Yii::app()->db->createCommand("insert into hrm_docs (name,created_by,folder_name,file_name,active) 
          values('','{$session['empnumber']}','$filepath','$filename','Y')  ")->query();

        $docid = Yii::app()->db->getLastInsertID();


    }

     if ($employee_id!='')
     {
        $docview = Yii::app()->db->createCommand("Select count(id) as cnt from hrm_doc_view where doc_id = '$docid' and employee_id  = '$empnumber'  ")->queryRow();
       if ($docview['cnt']==0)
       {  

        $mailedit = Yii::app()->db->createCommand("insert into hrm_doc_view (doc_id,employee_id,active) 
          values('$docid','$empnumber','Y')  ")->query();


       }

     }




 }


 function getAllFolderViewers($folderid){

    $getrow = Yii::app()->db->createCommand("SELECT employee_ids from tree_struct where id = ".$folderid)->queryRow(); 

     $employeeids = array_filter(json_decode($getrow['employee_ids']));

     if (count($employeeids)==0)
      $employeeids = '0';


    $employeeids = implode(',',$employeeids);
    if (count($employeeids)>0){
      $getall = Yii::app()->db->createCommand("SELECT CONCAT(emp_firstname,' ',emp_lastname) as name,emp_number from hrm_employee 
      where emp_number in ($employeeids) and emp_status = 'Y'  and emp_deleted = 'N' ")->queryAll();
    }

   
    return $getall;
 
 }


 function removeFileAssignUsers($userid,$directory,$filename)
 {
    $getrow = Yii::app()->db->createCommand("Delete T1 from hrm_doc_view T1 inner join
     hrm_docs T2 on T1.doc_id = T2.id  where T2.folder_name = '{$directory}' and T2.file_name = '{$filename}' and
     T1.employee_id = '$userid'    ")->query(); 


 }

 function removeFolderAssignUsers($userid,$targetDir,$currentdir)
 {
    //tree_struct
  //tree_data
    $getrow = Yii::app()->db->createCommand("Delete T1 from hrm_doc_view T1 inner join
     hrm_docs T2 on T1.doc_id = T2.id  where T2.folder_name = '{$targetDir}' and 
     T1.employee_id = '$userid'    ")->query(); 
    
    
    $json_arr = '"'.$userid.'"';


    $getAll = Yii::app()->db->createCommand("Select T2.id as child_id,T3.nm from tree_data T1
      inner join tree_struct T2 on T1.id = T2.pid 
      inner join tree_data T3 on T3.id = T2.id 
       where T1.nm = '$currentdir' and T2.employee_ids like '%$json_arr%' ")->queryAll(); 



     $getrow = Yii::app()->db->createCommand("Update tree_data T1
      inner join tree_struct T2 on T1.id = T2.id set T2.employee_ids = replace(T2.employee_ids,$json_arr,'')
    
       where T1.nm = '$currentdir' and T2.employee_ids like '%$json_arr%' ")->query(); 


    if (count($getAll)>0){

        foreach ($getAll as $key => $value) {
            $this->removeFolderAssignUsers($userid,$targetDir."/".$value['nm'],$value['nm']);
        }

    }

      

 }


 function getAllMyFolderFiles($folder)
 {
    $session = new CHttpSession;
    $session->open();
    $empno = $session['empnumber'];

    $getrow = Yii::app()->db->createCommand("SELECT GROUP_CONCAT('''',T1.file_name,'''') as files from hrm_docs T1 
      inner join hrm_doc_view T2 on T1.id = T2.doc_id where T1.folder_name = '$folder' and T2.employee_id = '$empno'")->queryRow(); 
    $files = $getrow['files'];
    return $files;


 }


 function getAllAssignUsers($folder,$file)
 {
    $session = new CHttpSession;
    $session->open();
  
 

    $getall = Yii::app()->db->createCommand("SELECT CONCAT(T3.emp_firstname,' ',T3.emp_lastname) as name,T3.emp_number from hrm_docs T1 
      inner join hrm_doc_view T2 on T1.id = T2.doc_id 
      inner join hrm_employee T3 on T2.employee_id = T3.emp_number and T3.emp_status = 'Y' 
      where T1.folder_name = '$folder' and T1.file_name = '$file'  order by T3.emp_firstname asc 
      ")->queryAll(); 
  
    return $getall;


 }


 function insertAssignDoc($userid,$file){


    $file_parts   = pathinfo("{$file}");
    $folder_name = $file_parts['dirname'];
    $filename = $file_parts['basename'];
    $sql3 = "Select count(T2.id) as cnt from hrm_docs T1 left join hrm_doc_view T2 on T1.id = T2.doc_id   where T1.folder_name = '$folder_name' and T1.file_name = '$filename' and T2.employee_id = '$userid'  ";
     $mailedit = Yii::app()->db->createCommand($sql3)->queryRow();
   

    
     if ($mailedit['cnt']==0)
     {
          $sql2 = "Select id from hrm_docs where folder_name = '$folder_name' and file_name = '$filename'  ";
          $doclistids = Yii::app()->db->createCommand($sql2)->queryRow();
           $docid = $doclistids['id'];


          $sql = "insert into hrm_doc_view (doc_id,employee_id,active) values (:doc_id,:employee_id,:active)";

         $parameters = array(":doc_id"=>$docid,":employee_id"=>$userid,":active"=>"Y");


      
         Yii::app()->db->createCommand($sql)->execute($parameters);
        $sql = '';


     }

    

 }


 function getMyDocument($folder,$file)
 {
    $session = new CHttpSession;
    $session->open();
    $empno = $session['empnumber'];
   
    $getrow = Yii::app()->db->createCommand("SELECT count(T1.id) as cnt from hrm_docs T1
    inner join hrm_doc_view T2 on T1.id = T2.doc_id where T1.folder_name  = '$folder' 
      and T1.file_name = '$file' and T2.employee_id = '$empno'")->queryRow(); 
    $files = $getrow['cnt'];
    return $files;

 }


 function getAllUsers(){

     $getall = Yii::app()->db->createCommand("SELECT T1.emp_number,concat(T1.emp_firstname,' ',T1.emp_lastname) as name from hrm_employee T1
      inner join hrm_user_master T2 on T1.emp_number = T2.emp_number
     where T1.emp_status = 'Y' and T1.emp_deleted = 'N' and T2.user_role_id>2  ")->queryAll();
     return $getall;

 }


 function deleteFile($folder,$file)
 {


      Yii::app()->db->createCommand("Delete T1.* from hrm_doc_view T1 
    inner join hrm_docs T2 on T2.id = T1.doc_id where T2.folder_name  = '$folder' 
      and T2.file_name = '$file' ")->query(); 

      Yii::app()->db->createCommand("Delete from hrm_docs where folder_name  = '$folder' and file_name = '$file' ")->query(); 


 }


 function deleteFolder($folder)
 {


      Yii::app()->db->createCommand("Delete from hrm_docs where folder_name  like '%$folder%'   ")->query(); 


 }


 function UpdateDirFile($delete_file,$new_file){

  

     Yii::app()->db->createCommand(" Update hrm_docs set folder_name = replace(`folder_name`,'{$delete_file}','{$new_file}') 
      where folder_name like '%$delete_file%' ")->query(); 

 }


  function CopyandDeleteFile($delete_file,$new_file,$copy){

    $session = new CHttpSession;
    $session->open();
    $empno = $session['empnumber'];

    if ($copy==1)
    {
      
      $allfiles = Yii::app()->db->createCommand(" Select * from hrm_docs where folder_name like '%$delete_file%' ")->queryAll(); 

      if (count($allfiles)>0)
      {

          foreach ($allfiles as $files)
          {

              $sql = "insert into hrm_docs (created_by,folder_name,file_name,active) values (:created_by,:folder_name,:file_name,:active)";

              $parameters = array(":created_by"=>$empno,":folder_name"=>$new_file,":file_name"=>$files['file_name'],":active"=>$files['active']);
     
              Yii::app()->db->createCommand($sql)->execute($parameters);

          }

      }
   }else{

          $this->UpdateDirFile($delete_file,$new_file);


   }







 }


 function recurUpdation($employee_id,$folderid){

  
    
    $getrow = Yii::app()->db->createCommand("SELECT pid,employee_ids from tree_struct where id = '$folderid'   ")->queryRow(); 
    $parentid = $getrow['pid'];

    if ($parentid>0)
    {

      if ($getrow["employee_ids"]!='')
      {

          $jsonemployee_ids = $getrow["employee_ids"];
          $json_encode_ids = array_filter(json_decode($jsonemployee_ids));

               if (count($json_encode_ids)==0)
                $json_encode_ids = array('0');

          if (!in_array(array($employee_id), $json_encode_ids))
          {
              $employee_id_array = array_merge($json_encode_ids,array($employee_id));
              $employee_id_json = json_encode($employee_id_array);
              $getrow = Yii::app()->db->createCommand(" Update  tree_struct set employee_ids = '$employee_id_json'  where id = '$folderid' 
       ")->query();

          }


      }else{

          $employee_id_json = json_encode(array($employee_id));
          $getrow = Yii::app()->db->createCommand(" Update  tree_struct set employee_ids = '$employee_id_json'  where id = '$folderid' 
       ")->query();

      }

      

      if ($parentid!=1)
      {

        $this->recurUpdation($employee_id,$parentid);

      }

    }

         

  


 }


	
}
