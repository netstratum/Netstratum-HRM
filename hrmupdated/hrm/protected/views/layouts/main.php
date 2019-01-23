<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />       
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css?<?php echo time()?>" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.min.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/jquery-ui/smoothness/jquery-ui.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/jquery-ui/smoothness/jquery.ui.theme.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/tagsinput/jquery.tagsinput.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/select2/select2.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/datatable/TableTools.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/chosen/chosen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/datepicker/datepicker.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/pnotify.custom.min.css" media="screen, projection" />
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/nicescroll/jquery.nicescroll.min.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/imagesLoaded/jquery.imagesloaded.min.js" type="text/javascript"></script>    
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery.ui.core.min.js" type="text/javascript"></script>    
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>    
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootbox/jquery.bootbox.js" type="text/javascript"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/form/jquery.form.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/validation/jquery.validate.min.js" type="text/javascript"></script>        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/validation/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/tagsinput/jquery.tagsinput.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/fileupload/bootstrap-fileupload.min.js" type="text/javascript"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/chosen/chosen.jquery.min.js" type="text/javascript"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/ckeditor/ckeditor.js" type="text/javascript"></script>

        
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.js" type="text/javascript"></script>
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/pnotify.custom.min.js" type="text/javascript"></script>
        
        
        
        
        
        
        
        <link rel="shortcut icon" href="img/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
        
        <title>  </title>
        
        
        
        
        
</head>

<body>
    		<div id="navigation">
			<div class="container-fluid">
				<a href="<?php echo Yii::app()->request->baseUrl; ?>" id="brand">HRM</a>
				<a href="#"  rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>

         		<ul id="yw0" class="main-nav">
				<?php 

				$session=new CHttpSession;
                                $session->open();
             
				$myInfo = Yii::app()->menu->getMenu(0, $session['user_role']); 
				

				?>
					
				

				</ul> 
                      
                                        
                      
                                
                                
                                                   
                                
                                
                                                          
                                
                                
				<div class="user">
					<ul class="icon-nav">
						<!--<li class='dropdown'>
							<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred">4</span></a>
							<ul class="dropdown-menu pull-right message-ul">
								<li>
									<a href="#">
										<img src="img/demo/user-1.jpg" alt="">
										<div class="details">
											<div class="name">Jane Doe</div>
											<div class="message">
												Lorem ipsum Commodo quis nisi ...
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/demo/user-2.jpg" alt="">
										<div class="details">
											<div class="name">John Doedoe</div>
											<div class="message">
												Ut ad laboris est anim ut ...
											</div>
										</div>
										<div class="count">
											<i class="icon-comment"></i>
											<span>3</span>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/demo/user-3.jpg" alt="">
										<div class="details">
											<div class="name">Bob Doe</div>
											<div class="message">
												Excepteur Duis magna dolor!
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
								</li>
							</ul>
						</li>-->

						<!--<li class="dropdown sett">
							<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-cog"></i></a>
							<ul class="dropdown-menu pull-right theme-settings">
								<li>
									<span>Layout-width</span>
									<div class="version-toggle">
										<a href="#" class='set-fixed'>Fixed</a>
										<a href="#" class="active set-fluid">Fluid</a>
									</div>
								</li>
								<li>
									<span>Topbar</span>
									<div class="topbar-toggle">
										<a href="#" class='set-topbar-fixed'>Fixed</a>
										<a href="#" class="active set-topbar-default">Default</a>
									</div>
								</li>
								<li>
									<span>Sidebar</span>
									<div class="sidebar-toggle">
										<a href="#" class='set-sidebar-fixed'>Fixed</a>
										<a href="#" class="active set-sidebar-default">Default</a>
									</div>
								</li>
							</ul>
						</li>-->
						
						<!--<li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="img/demo/flags/us.gif" alt=""><span>US</span></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#"><img src="img/demo/flags/br.gif" alt=""><span>Brasil</span></a>
							</li>
							<li>
								<a href="#"><img src="img/demo/flags/de.gif" alt=""><span>Deutschland</span></a>
							</li>
							<li>
								<a href="#"><img src="img/demo/flags/es.gif" alt=""><span>España</span></a>
							</li>
							<li>
								<a href="#"><img src="img/demo/flags/fr.gif" alt=""><span>France</span></a>
							</li>
						</ul>
					</li>-->
					</ul>
					<div class="dropdown">
						<?php  
                                                
                                                $dateadded = date('Y-m-d');
							$session=new CHttpSession;
                                                        $session->open();

							if(file_exists('profilepictures/thumbimg-'.$session['memberid'].'.jpg'))
							{
								$thumpimage = Yii::app()->request->baseUrl.'/profilepictures/thumbimg-'.$session['memberid'].'.jpg?'.time();
							}
							else{
								$thumpimage = Yii::app()->request->baseUrl.'/profilepictures/default.jpg?'.time();
							}
							
						?>
						<a  href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $session['name'];?> <img src="<?php echo $thumpimage;?>" alt="" width="30"></a>
						<ul class="dropdown-menu pull-right">
							<li>
							<?php if ($session['user_role'] == 1 or $session['user_role'] == 2){ ?>
								<a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=Manageuser/View&emp_number=<?php echo $session['empnumber']; ?>">Edit profile</a>
							<?php }else{ ?>
								<a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=Manageuser/View">Edit profile</a>
							<?php	} ?>
							</li>
							<li>
								<a href="javascript:void(0);" id="changepswdlink">Change Password</a>
							</li>
							<li>
								<a href="<?php echo Yii::app()->request->baseUrl;?>/index.php?r=Loginregister/Logout">Sign out</a>
							</li>
						</ul>
					</div>

					
					
				</div>
			</div>
		</div>
    
    
        <div class="container-fluid" id="content">
			
			
                        <div id="main">
                            
                             <div class="mainfooter">

                                <?php echo $content; ?>
                             
                             </div>  
                            
                            
                            
			</div>
            <div id="footer">
                        <p>
			   &copy Netstratum Technologies Pvt Ltd. 
			</p>
			<a href="#" class="gototop"><i class="icon-arrow-up"></i></a>
                     </div>
		</div>


                     
                        
    
    
</body>

 <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/Updatepassword" id="changepswdform" method="POST" class="form-horizontal">
        <div class="span6">
            <div style="display:none;" class="modal fade popup" id="changepswdmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>

                        </button>
                        <h4 class="modal-title" id="otherlabel">Change Password</h4>
                      </div>
                      <div class="modal-body">
                         <div class="control-group">
                            <label for="pswd" class="control-label right span4">New Password:</label>
                            <div class="controls span6">
                                <input type="password" id="newpassword" name="newpassword" class="input-xlarge" value="">
                            </div>
                         </div>
                         <div class="control-group">
                            <label for="pswd" class="control-label right span4">Confirm Password:</label>
                            <div class="controls span6">
                                <input type="password" id="confirmpassword" name="confirmpassword" class="input-xlarge" value="">
                            </div>
                         </div>
                      </div>
                      <div class="modal-footer">
                         <input type="button" id="passwordbtn" name="passwordbtn" class='btn btn-primary' value="Save">
                         <input type="reset" class='btn' value="Discard changes">
                         <div class="alert alert-success span4" id="passwordalert" style="display: none;">
                                <button data-dismiss="alert" class="close" type="button"></button>
                                <strong>Success!</strong>
                         </div>
                      </div>
                    </div> 
                </div>
            </div> 
        </div> 
    </form>

</html>

 <script src="js/common.js"></script>

