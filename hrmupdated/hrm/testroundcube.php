<?php

    $ctn=mysqli_connect("localhost","root","!+@_qpal") or die("ERR: Connection");
    $databa=mysqli_select_db($ctn,"netstrat_hrm") or die("ERR: Database");
    
    $pswd = "sujith";
    $unam = "sujith";
    
    $sqlins = "INSERT INTO hrm_roundcube_mail(username,mail_password) VALUES ('$unam','$pswd')";
    $exe = mysqli_query($ctn, $sqlins);
    
    $rdata = mysqli_fetch_array($exe);
   
    mysqli_close($ctn);
    
    ?>
