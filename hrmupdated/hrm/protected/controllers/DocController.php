<?php

class DocController extends Controller
{
      public function actionTest()
{

	echo $year_arr =  shell_exec("/usr/bin/php /var/www/html/hrm/docmanager/index.php create_node 1 2014");
exit;

}


      public function actionDownload(){


        $document   = $_REQUEST['file'];
        $path_parts = pathinfo($document);
          $session = new CHttpSession;
         $session->open();
         $role = $session['user_role'];
       
        if ($role>2)
          $filecnt =  HrmDoc::model()->getMyDocument($path_parts['dirname'],$path_parts['basename']);




        if ($filecnt>0 or $role<=2)
        {



        if (file_exists($document)) {
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename='.basename($document));
          header('Expires: 0');
          header('Cache-Control: must-revalidate');
          header('Pragma: public');
          header('Content-Length: ' . filesize($document));
          ob_clean();
          flush();
          readfile($document);
          exit;
        }

        }

      }

      public function actionDocList(){

            Yii::app()->red->redirect();  // for session redirection

            $AllUsers = HrmDoc::model()->getAllUsers();

           

            $this->render('doclist',array('userlist'=>$AllUsers),false);
      }


	 public function actionlist(){

            Yii::app()->red->redirect();  // for session redirection

            $AllUsers = HrmDoc::model()->getAllUsers();

           $document   = $_REQUEST['file'];

            $this->render('list',array('url'=>$document),false);
      }



      public function actionViewFolder(){

         $session = new CHttpSession;
         $session->open();
         $role = $session['user_role'];
         $realpathsplit = explode('Selected: /Home',$_REQUEST['folderpath']);
         $dir  = 'uploads'.$realpathsplit[1]."/";
         $myfolder = array();
          if ($role>2){ 

              $mydir  = 'uploads'.$realpathsplit[1];
              
              $myfiles = HrmDoc::model()->getAllMyFolderFiles($mydir);
              $myfolder = explode(',',$myfiles);

              

          }  

        $files = glob($dir . "*.*");

      //print each file name
        $htmlstring = '<div class="file-wrapper" style="overflow-y:auto;height: 480px;">';
        foreach($files as $key=>$file)
        {


          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $file_name = pathinfo($file, PATHINFO_FILENAME);

           $listfile = "'".$file_name.'.'.$ext."'";
          
          if ($role>2 and !in_array("{$listfile}", $myfolder))
            continue;


          $img = '';
          if (in_array(strtolower($ext), array('pdf'))){
            $img = 'images/pdf-icon.png';
	  $appends = '<a class="view-file" rel="'.$file.'" href="#" alt="View File" title="View File"></a>';
	  }	

          if (in_array(strtolower($ext), array('csv')))
            $img = 'images/csv-icon.png';

          if (in_array(strtolower($ext), array('xls','xlsx')))
            $img = 'images/excel-icon.png';

          if (in_array(strtolower($ext), array('doc','docx','odt')))
            $img = 'images/word-icon.png';

          if (in_array(strtolower($ext), array('ppt')))
            $img = 'images/powerpoint-icon.png';

          if (in_array(strtolower($ext), array('txt','rtf')))
            $img = 'images/notepad-icon.png';

          if (in_array(strtolower($ext), array('jpg','jpeg','gif','png')))
             $img = 'images/image-icon.png';

             if ($role == 1 or $role ==2){ 
                            $htmlstring .= '<div class="file-col"><div class="file-icon"><input alt="Check to Assign" title="Check to Assign" type="checkbox" value="'.$file.'"  name="chk[]" id="chk[]" class="check-box" /><a href="#" ><img rel="'.$file.'" class="thumb_doc_list" src="'.$img.'"><label>'.$file_name.'.'.$ext.'</label> </a><a class="download-file" rel="'.$file.'" href="#" alt="Download File" title="Download File"></a><a class="deletefile-icon" rel="'.$file.'" href="#" alt="Delete File" title="Delete File"></a> '.$appends.'</div></div>';
            }else{
              $htmlstring .= '<div class="file-col"><div class="file-icon"><a href="#" ><img   src="'.$img.'"><label>'.$file_name.'.'.$ext.'</label> </a><a class="download-file" rel="'.$file.'" href="#"></a> '.$appends.'</div></div>';
            }
        }
        
         $htmlstring .= '</div>';

       if ($role == 1 or $role ==2){ 
          $users = HrmDoc::model()->getAllFolderViewers($_REQUEST['folder_id']);
        
        if (count($users)>0)
        {
             $htmlstring .= '<div class="userdisplay">';
              $htmlstring .= '<div class="userhead" ><h3>Access Users</h3></div><div class="scrolldiv">';
            foreach ($users as $key=>$userlist)
            {

                 $htmlstring .= '<div  class="user-block"><div class="user-name" >'.$userlist['name'].'</div><div class="cls-btn"><img src="images/icon-close.png" rel="'.$userlist['emp_number'].'" style="cursor: pointer !important;" width="15px" height="15px" class="del_doc_assign" /></div></div>';


            }

             $htmlstring .= '</div></div>';
        }

       } 
        echo $htmlstring;

      }
  
      public function actiondeleteDoc()
      {

           $current_file = $_REQUEST['current_file'];
           $file   = pathinfo("{$current_file}");

           if (file_exists($file['dirname']."/".$file['basename']))
              unlink($file['dirname']."/".$file['basename']);

           $users = HrmDoc::model()->deleteFile( $file['dirname'],$file['basename']);


      }


      public function delTree($dir) {
      
          $files = array_diff(scandir($dir), array('.','..'));
          foreach ($files as $file) {

            if (is_dir("$dir/$file")){

              $this->delTree("$dir/$file"); 

            }else{

              unlink("$dir/$file");
            } 
          

          }
        return rmdir($dir);
      
      } 


      function recurse_copy($src,$dst) {
        
        $handle = opendir($src);
      
        
        
        while(false !== ( $file = readdir($handle)) ) {
       
          if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . $file) ) {

                mkdir($dst . $file,0777);
                chmod($dst . $file,0777);
                echo $src . $file.'/';
                echo $dst . $file.'/';

                $this->recurse_copy($src . $file.'/',$dst . $file.'/');
            }
            else {

                copy($src . $file,$dst . $file);
            }
          }
       }
        closedir($handle);
      } 


     // shell_exec("mv sourcedirectory path_to_destination");

      
      public function actionCreate_folder()
      {   
          if (  $_REQUEST['folderpath'] == 'Selected: //Home')
          {

                 $dir  = 'uploads/'.$_REQUEST['foldername']."/";
          
          }else{
             
             

              $actual_path = explode('Selected: /Home',$_REQUEST['folderpath']);
                
                if (count($actual_path)<=1)
                {
                     $actual_path = explode('Selected: //Home',$_REQUEST['folderpath']);

                }



               $dir  = 'uploads'.$actual_path[1]."/".$_REQUEST['foldername']."/";
             //$file   = pathinfo("{$dir}");
          }
          mkdir($dir,0777,true);
          chmod ($dir,0777);


      }



      public function actionRename_folder()
      {
           
          //need to update hrm_doc path

            if (  $_REQUEST['folderpath'] == 'Selected: //Home')
          {

                 $dir  = 'uploads/'.$_REQUEST['foldername']."/";
                 $newpath  = 'uploads/'.$_REQUEST['position'];
          
          }else{ 

            
                $actual_path = explode('Selected: /Home',$_REQUEST['folderpath']);
                
                if (count($actual_path)<=1)
                {
                     $actual_path = explode('Selected: //Home',$_REQUEST['folderpath']);

                }

           
             
                 $dir  = 'uploads'.$actual_path[1]."/";
                $update_dir = 'uploads'.$actual_path[1];
              $file   = pathinfo("{$dir}");
                  $newpath     = $file['dirname'].'/'.$_REQUEST['position'].'/';
                  $update_new_path     = $file['dirname'].'/'.$_REQUEST['position'];

            //$file['dirname'],$file['basename']
            }
           

          

          rename("{$dir}", "{$newpath}");
          chmod("{$newpath}",0777);

          HrmDoc::model()->UpdateDirFile($update_dir,$update_new_path);


      }

      public function actionpasteAll()
      {

          $id = $_REQUEST['id'];

           $json_content = shell_exec("/usr/bin/php /var/www/html/hrm/docmanager/index.php get_content {$id}");
        
          $json_decrypt = json_decode($json_content);

       
          $src = $json_decrypt->content;
       

       
          $realpathsplit = explode('Selected: /Home',$src);


          if (count($realpathsplit)<=1)
           {
               $realpathsplit = explode('Selected: //Home',$src);

           }


           $src_dir  = 'uploads'.$realpathsplit[1]."/";

          $dst = $_REQUEST['folderpath'];
          $dstsplit = explode('Selected: /Home',$dst);

           if (count($dstsplit)<=1)
           {
                $dstsplit = explode('Selected: //Home',$dst);

           }

          $dst_dir  = 'uploads'.$dstsplit[1]."/";
        


           $file   = pathinfo("{$src_dir}");
          
           if (!file_exists($dst_dir.$file['basename']))
              {
                  mkdir($dst_dir.$file['basename'],0777,true);
                  chmod($dst_dir.$file['basename'],0777);

              }

      
     

          HrmDoc::model()->CopyandDeleteFile('uploads'.$realpathsplit[1],$dst_dir.$file['basename'],0);



         $this->recurse_copy($src_dir,$dst_dir.$file['basename'].'/');


        shell_exec("rm -rf {$src_dir}");

         

      }


      public function actioncopyAll()
      {
        
           $id = $_REQUEST['id'];

           $json_content = shell_exec("/usr/bin/php /var/www/html/hrm/docmanager/index.php get_content {$id}");
        
          $json_decrypt = json_decode($json_content);

       
          $src = $json_decrypt->content;
       

       
          $realpathsplit = explode('Selected: /Home',$src);


          if (count($realpathsplit)<=1)
           {
               $realpathsplit = explode('Selected: //Home',$src);

           }


           $src_dir  = 'uploads'.$realpathsplit[1]."/";

          $dst = $_REQUEST['folderpath'];
          $dstsplit = explode('Selected: /Home',$dst);

           if (count($dstsplit)<=1)
           {
                $dstsplit = explode('Selected: //Home',$dst);

           }

          $dst_dir  = 'uploads'.$dstsplit[1]."/";
        


           $file   = pathinfo("{$src_dir}");
          
           if (!file_exists($dst_dir.$file['basename']))
              {
                  mkdir($dst_dir.$file['basename'],0777,true);
                  chmod($dst_dir.$file['basename'],0777);

              }

         HrmDoc::model()->CopyandDeleteFile('uploads'.$realpathsplit[1],$dst_dir.$file['basename'],1);

         $this->recurse_copy($src_dir,$dst_dir.$file['basename'].'/');




      }


      public function actionDeleteAll()
      {

          $folderpath = $_REQUEST['folderpath'];
          $id         = $_REQUEST['id'];
          $position   = $_REQUEST['position'];

           $realpathsplit = explode('Selected: /Home',$_REQUEST['folderpath']);
           $dir  = 'uploads'.$realpathsplit[1]."/";
            HrmDoc::model()->deleteFolder('uploads'.$realpathsplit[1]);
          $this->delTree($dir);


      
      }



      public function actionViewAssignUsers(){

           $current_file = $_REQUEST['current_file'];
           $file   = pathinfo("{$current_file}");

           $users = HrmDoc::model()->getAllAssignUsers( $file['dirname'],$file['basename']);

           foreach ($users as $key => $value) {
           
             echo $htmlstring = '<div  class="user-block" ><div class="user-name" >'.$value['name'].'</div><div class="cls-btn"><img src="images/icon-close.png" rel="'.$value['emp_number'].'" style="cursor: pointer !important;" width="15px" height="15px" class="del_doc_assign" /></div></div>';
           
           }


      } 


      public function actiondeletePermission()
      {

         $current_file = $_REQUEST['current_file'];
         $file   = pathinfo("{$current_file}");
         $userid       = $_REQUEST['userid'];

         $directory = $file['dirname'];
         $filename = $file['basename'];
         $ext = $file['extension'];
        
        if ($ext!='')
        {
            HrmDoc::model()->removeFileAssignUsers($userid,$directory,$filename);

        }else{

            $realpathsplit = explode('Selected: /Home',$_REQUEST['current_file']);
            $targetDir  = 'uploads'.$realpathsplit[1]."/";

            HrmDoc::model()->removeFolderAssignUsers($userid,$targetDir,$filename);

        }


        





      }


      public function actionAssignDocumentUsers()
      {


          $userlist = $_REQUEST['users'];
          $doclist  = $_REQUEST['doclist'];
          $folderid = $_REQUEST['folderid'];

          if (count($userlist)>0){
            
            foreach ($userlist as $key => $value) {
            
              if (count($doclist)>0){

                  foreach ($doclist as $keys => $docvalues) {
                      
                      HrmDoc::model()->recurUpdation($value,$folderid);

                      $users = HrmDoc::model()->insertAssignDoc($value,$docvalues);


                  }

              }
            
            }
          }



      }

       
      public function actionDocUpload(){
      
        //usleep(3000);
        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Settings
        //$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Get a file name
        if (isset($_REQUEST["name"])) {
          $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
          $fileName = $_FILES["file"]["name"];
        } else {
          $fileName = uniqid("file_");
        }


        //getting folder structure

          $folder_split = explode('_',$fileName);

          $file_type = trim(strtolower($folder_split[1]));
          
          if ($file_type == 'payslip' or $file_type == 'taxsheet'){
            
            $employee_id = $folder_split[0]; 
            $month  = strtolower($folder_split[2]); 
            $year   = pathinfo("{$folder_split[3]}", PATHINFO_FILENAME);
            $targetDir = 'uploads'.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.'payslip_taxsheet'.DIRECTORY_SEPARATOR.$month;

             $emp_number = HrmDoc::model()->getEmployeeNumber($employee_id);

             if (!file_exists('uploads'.DIRECTORY_SEPARATOR.$year))
             {

             // shell_exec("/usr/bin/php /var/www/html/callblast/convert_audio.php {$member_id} {$browser} {$astriskpath} > /dev/null &");
                $year_arr =  shell_exec("/usr/bin/php /var/www/html/hrm/docmanager/index.php create_node 1 {$year}");
                $year_arr = json_decode($year_arr);
                $year_parent_id = $year_arr->id;
                
             
             

             }else{

                $year_parent_id = HrmDoc::model()->getFolderId($year,1);

                //echo "yearparent".$year_parent_id;

             }

              if (!file_exists('uploads'.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.'payslip_taxsheet'))
              {

                  $payslip_arr =  shell_exec("/usr/bin/php /var/www/html/hrm/docmanager/index.php create_node {$year_parent_id} payslip_taxsheet"); 
                  $payslip_arr =  json_decode($payslip_arr);
                  $payslip_parent_id = $payslip_arr->id;
                 

              }else{

                $payslip_parent_id = HrmDoc::model()->getFolderId('payslip_taxsheet',$year_parent_id);

              }


              if (!file_exists('uploads'.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.'payslip_taxsheet'.DIRECTORY_SEPARATOR.$month)){

                  $month_arr =  shell_exec("/usr/bin/php /var/www/html/hrm/docmanager/index.php create_node {$payslip_parent_id} {$month}");  
                  $month_arr =  json_decode($month_arr);
                  $month_parent_id = $month_arr->id;
                 
               

              }else{

                  $month_parent_id = HrmDoc::model()->getFolderId($month,$payslip_parent_id);

              }

               HrmDoc::model()->update_folder($emp_number,$year,1);
               HrmDoc::model()->update_folder($emp_number,'payslip_taxsheet',$year_parent_id);  
               HrmDoc::model()->update_folder($emp_number,$month,$payslip_parent_id);

                $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

               HrmDoc::model()->UpdateFilePath($emp_number,$targetDir,$fileName,$employee_id);


          }else{

            //$targetDir = 'uploads'.DIRECTORY_SEPARATOR.$_REQUEST['folder_path'];

             $realpathsplit = explode('Selected: /Home',$_REQUEST['folderpath']);
             $targetDir  = 'uploads'.$realpathsplit[1]."/";

             $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
              HrmDoc::model()->UpdateFilePath($emp_number,'uploads'.$realpathsplit[1],$fileName);

          }
          
          
       if (!file_exists($targetDir)){
              mkdir($targetDir, 0777,true);
              chmod($targetDir, 0777);
        }
        
        

        

        //



        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files  
        if ($cleanupTargetDir)
        {
          if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
          }

          while (($file = readdir($dir)) !== false) {
            $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

            // If temp file is current file proceed to the next
            if ($tmpfilePath == "{$filePath}.part") {
              continue;
            }

            // Remove temp file if it is older than the max age and is not the current file
            if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
              @unlink($tmpfilePath);
            }
          }
          closedir($dir);
        } 


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
          die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
          if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
          }

          // Read binary input stream and append it to temp file
          if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
          }
        } else {  
          if (!$in = @fopen("php://input", "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
          }
        }

        while ($buff = fread($in, 4096)) {
          fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
        // Strip the temp .part suffix off 
        rename("{$filePath}.part", $filePath);
        }

        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
            
      }





}
