<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="box box-color box-bordered">
				<div class="box-title">
					<h3> LEAVE BALANCE REPORT</h3>
				</div>
				<div class="box-content nopadding">
					<table class="table table-hover table-nomargin table-bordered usertable" id="leavebalancetable">
					<thead>
						<tr>
							
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
<?php 
   $session=new CHttpSession;
                        $session->open();
                        ?>
<script type="text/javascript">
var user_role = "<?php  echo $session[user_role];?>"; 

    var baseurl="<?php echo Yii::app()->request->baseUrl; ?>"; 
 </script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/viewleaves.js"></script>