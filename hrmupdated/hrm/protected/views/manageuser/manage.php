<body>
<div class="container-fluid">
							
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									Manage Users
								</h3>                                                                                
							</div>
                                                        
                                                    
                                                    
<div class="box-content nopadding" id="userlist">
    <div style="float: right;padding-top: 9px;padding-right: 5px;"><button class="btn btn-success" id="addnew" name="addnew">ADD USER</button></div>
<table class="table table-hover table-nomargin table-bordered usertable" id="example">
            <thead>
                 
                    <tr>
                            <th style="width: 5%;">Employee ID</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 25%;">User Role</th>
                            <th style="width: 25%;">Email</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;">Member since</th>
                            <th class='hidden-480'>Options</th>
                    </tr>
            </thead>
            <!--
            <tbody>
                    <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@johndoe.com</td>
                            <td class='hidden-350'><span class="label label-satgreen">Active</span></td>
                            <td class='hidden-1024'>03-07-2013</td>
                            <td class='hidden-480'>
                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Manageuser/View" class="btn" rel="tooltip" title="View"><i class="icon-search"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Edit"><i class="icon-edit"></i></a>
                                    <a href="#" class="btn" rel="tooltip" title="Delete"><i class="icon-remove"></i></a>
                            </td>
                    </tr>
                    
                    
                    
                        
            </tbody>
		-->						</table>
							</div>
						</div>
					</div>
				</div>
			
				
				
			</div>

    </body>
    
    <script type="text/javascript">
    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";
    
    </script>
    <script src="js/manageuser.js"></script>