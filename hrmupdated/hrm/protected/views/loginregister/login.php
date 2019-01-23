<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">

<body class='login'>
	<div class="wrapper">
		<h1><a href="index.php"><img src="img/Logo.png" alt="" class='retina-ready' > HRM</a></h1>
		<div class="login-body">
			<div id="loginform" >   
			<h2>SIGN IN</h2>
                        
                        <div  class="alert alert-error logerror" id="error_msg">
			
                     
                    </div>
                        
                     
			<form  method='post' class='form-validate' id="test">
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='uemail' id="uemail" placeholder="Email address" class='input-block-level' data-rule-required="true" data-rule-email="true"  value="<?php echo $cookieusername;?>">
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
                                            <input type="password" name="upw" id="upw" placeholder="Password" class='input-block-level' data-rule-required="true"  value="<?php echo $cookiepassword;?>">
					</div>
				</div>
				<div class="submit">
					<div class="remember">
                                            <input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember" value="1"> <label for="remember">Remember me</label>
					</div>
                                    <input type="button" id="btnsubmit" value="Sign me in" class='btn btn-primary'>
				</div>
                               
			</form>
			<div class="forget">
				<a href="#" id="forgotpass"><span>Forgot password?</span></a>
			</div>
			</div>
			<div id="forgotpassform" style="display:none;">
			<h2>FORGOT PASSWORD</h2>
                        
                           <div class="alert alert-error logerror" id="forgetalert" >
                                        
                                </div>
                                 <div class="alert alert-success logerror" id="forgetsuccess" >
                                        
                                </div>
                        
                        <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Mailsend" 
                              method='POST' class='form-validate' id="forgotpswdform" name="forgotpswdform" >
                            <div class="control-group">
                                <div class="email controls">
                                    <input type="text" name='loginemail' id="loginemail" placeholder="Email address" 
                                           class='input-block-level' data-rule-required="true" data-rule-email="true">                                    
                                </div>
                                <div class="form-actions">
                                <input type="button" id="forgotbtn" value="SUBMIT" class='btn btn-primary'>
                                
                                </div>
                             
                            </div>
                        </form>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";
</script>
<script src="js/login.js?<?php echo time();?>"></script>
    