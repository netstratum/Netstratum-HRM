<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3>ADMIN LEAVE BALANCE REPORT</h3>
				</div>
				<?php 
 			$session = new CHttpSession;
            $session->open();
				?>
				<div class="box-content nopadding">
				<div id="display_search_myreport" class="datatable_custom"><label class="custom_label"  >Employee Name:</label> 
				 <div class="custom_label" ><input type="text" id="emp_name" name="emp_name" class='span10' value="<?php echo $empname;?>" >
				 <input type="hidden" id="emp_num" name="emp_num" value="<?php echo $session['empnumber'];?>"></div>
				 <label  class="custom_label"> Year:</label><div class="custom_label" > <select name="leave_year" id="leave_year" class="input-medium">
                        <option value="">Select All</option>
                        <?php $year = date('Y');
                        for ($i=$year; $i>=2014; $i--){ ?>
                        <option value="<?php echo $i;?>" <?php  if ($i==$year){echo 'selected=selected';} ?>><?php echo $i;?> </option>

                        <?php }?> 
                    </select></div></div>
					<table class="table table-hover table-nomargin table-bordered usertable" id="adminleavebalancetable">
					<thead>
						<tr>
							<th style="width: 20%;">EMPLOYEE NAME</th>
							<th style="width: 20%;">LEAVE TYPE</th>
							<th style="width: 10%;">LEAVE NUMBER</th>
							<th style="width: 10%;">LEAVE BALANCE</th>
							<th style="width: 10%;">View Leaves</th>
						</tr>
					</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">

var user_role = "<?php echo $session['user_role']; ?>"; 

    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>"; 
 </script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/viewleaves.js"></script>