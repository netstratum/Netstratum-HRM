<?php
 set_time_limit(0);
 ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
ob_implicit_flush(true); 
/* connect to gmail */
$hostname = '{imap.server3.imanservers.com:993/ssl/novalidate-cert}';
$username = 'jobs@netstratum.com';
$password = 'redf123';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
//$emails = imap_search($inbox, 'FROM "xxx@gmail.com"');

$date = date ( "d M Y", strtotime( "-90 days" ) );


$emails1 = imap_search ( $inbox, 'SUBJECT "resume" SINCE "'.$date.'"');
$emails2 = imap_search ( $inbox, 'SUBJECT "curriculum vitae" SINCE "'.$date.'"');
$emails3 = imap_search ( $inbox, 'SUBJECT "job" SINCE "'.$date.'"');
$emails4 = imap_search ( $inbox, 'SUBJECT "application" SINCE "'.$date.'"');
$emails5 = imap_search ( $inbox, 'SUBJECT "post" SINCE "'.$date.'"');
$emails6 = imap_search ( $inbox, 'SUBJECT "position" SINCE "'.$date.'"');
$emails7 = imap_search ( $inbox, 'SUBJECT "experience" SINCE "'.$date.'"');
$emails8 = imap_search ( $inbox, 'SUBJECT "looking" SINCE "'.$date.'"');
$emails9 = imap_search ( $inbox, 'SUBJECT "candidate" SINCE "'.$date.'"');
$emails10 = imap_search ( $inbox, 'SUBJECT "programmer" SINCE "'.$date.'"');
$emails11 = imap_search ( $inbox, 'SUBJECT "developer" SINCE "'.$date.'"');
$emails12 = imap_search ( $inbox, 'BODY "resume" SINCE "'.$date.'"');
$emails13 = imap_search ( $inbox, 'BODY "curriculum vitae" SINCE "'.$date.'"');
$emails14 = imap_search ( $inbox, 'BODY "job" SINCE "'.$date.'"');
$emails15 = imap_search ( $inbox, 'BODY "application" SINCE "'.$date.'"');
$emails16= imap_search ( $inbox, 'BODY "post" SINCE "'.$date.'"');
$emails17 = imap_search ( $inbox, 'BODY "position" SINCE "'.$date.'"');
$emails18 = imap_search ( $inbox, 'BODY "experience" SINCE "'.$date.'"');
$emails19 = imap_search ( $inbox, 'BODY "looking" SINCE "'.$date.'"');
$emails20 = imap_search ( $inbox, 'BODY "candidate" SINCE "'.$date.'"');
$emails21 = imap_search ( $inbox, 'BODY "programmer" SINCE "'.$date.'"');
$emails22 = imap_search ( $inbox, 'BODY "developer" SINCE "'.$date.'"');


$emails1  = (is_array($emails1)) ? $emails1 : array();
$emails2  = (is_array($emails2)) ? $emails2 : array();
$emails3 = (is_array($emails3)) ? $emails3 : array();
$emails4 = (is_array($emails4)) ? $emails4 : array();
$emails5 = (is_array($emails5)) ? $emails5 : array();
$emails6 = (is_array($emails6)) ? $emails6 : array();
$emails7 = (is_array($emails7)) ? $emails7 : array();
$emails8 = (is_array($emails8)) ? $emails8 : array();
$emails9 = (is_array($emails9)) ? $emails9 : array();
$emails10 = (is_array($emails10)) ? $emails10 : array();
$emails11 = (is_array($emails11)) ? $emails11 : array();
$emails12 = (is_array($emails12)) ? $emails12 : array();
$emails13 = (is_array($emails13)) ? $emails13 : array();
$emails14 = (is_array($emails14)) ? $emails14 : array();
$emails15 = (is_array($emails15)) ? $emails15 : array();
$emails16 = (is_array($emails16)) ? $emails16 : array();
$emails17 = (is_array($emails17)) ? $emails17 : array();
$emails18 = (is_array($emails18)) ? $emails18 : array();
$emails19 = (is_array($emails19)) ? $emails19 : array();
$emails20 = (is_array($emails20)) ? $emails20 : array();
$emails21 = (is_array($emails21)) ? $emails21 : array();
$emails22 = (is_array($emails22)) ? $emails22 : array();



$emails = array_merge($emails1,$emails2,$emails3,$emails4,$emails5,$emails6,$emails7,$emails8,$emails9,$emails10,$emails11,$emails12,$emails13,$emails14,$emails15,$emails16,$emails17,$emails18,$emails19,$emails20,$emails21,$emails22);
$emails = array_unique($emails);


 //SUBJECT "CV" SUBJECT "curriculum vitae" SUBJECT "job" SUBJECT "application" SUBJECT "post" SUBJECT "position" SUBJECT "experience" 
// SUBJECT "looking" SUBJECT "candidate" SUBJECT "programmer" SUBJECT "developer" BODY "resume" BODY "CV" BODY "curriculum vitae" BODY "job" BODY "application" BODY "post" BODY "position" BODY "experience" BODY "looking" BODY "candidate" BODY "programmer" BODY "developer"

/* if emails are returned, cycle through each... */
if($emails) {

  /* begin output var */
  $output = '';

  /* put the newest emails on top */
  rsort($emails);




    foreach($emails as $email_number) {

    /* get information specific to this email */
    //$overview = imap_fetch_overview($inbox,$email_number,0);
    $message = imap_fetchbody($inbox,$email_number,2);
    $structure = imap_fetchstructure($inbox,$email_number);


    //pre($overview);


     $attachments = array();
       if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
         	
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['filename'] = $object->value;
               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }             
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))
       
       
       print_r($attachments);




    if(count($attachments)!=0){


        foreach($attachments as $at){

            if($at['is_attachment']==1){

                file_put_contents("upload/".$at['filename'], $at['attachment']);
                chmod("upload/".$at['filename'],0777);

                }
            }

        }

  }


 // echo $output;


}






?>
