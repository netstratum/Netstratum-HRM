<link rel="stylesheet" href="upload_js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/multi-select.css" type="text/css" media="screen" />
<!-- production -->
<script type="text/javascript" src="upload_js/plupload.full.min.js"></script>
<script type="text/javascript" src="js/quicksearch.js"></script>

<script type="text/javascript" src="js/jquery.multi-select.js"></script>
<script type="text/javascript" src="upload_js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<?php 
   $session=new CHttpSession;
   $session->open();
?>
 <div class="container">
	<div class="box box-color box-bordered">
                                       <div class="box-title">
                                       <?php if ($session['user_role'] == 1 or $session['user_role'] == 2){?>
                                            <h3>Manage Documents</h3>     <input type="button" id="custombtn" name="custombtn" class='btn btn-success' value="Upload" style="margin-left:15px;">  <input type="button" id="assignbtn" name="assignbtn" class='btn btn-success' value="Assign" style="margin-left:15px;">                                                                                                              
                                    <?php    }else{ ?>
                                       <h3>View Documents</h3>    
                                        <?php    } ?> 
                                       </div>
       <div class="box-content nopadding">
       <div style="clear:both"></div>
            
            <iframe id="docview" src="" style="height:100%;width:100%; min-height:480px;overflow:scroll;" frameborder="0" ></iframe>                             
                                      
                                          
       </div>
    </div>

</div>
<div style="clear:both"></div>
 <div class="container" style="visibility:hidden;">
                                    <div  class="modal fade popup" id="otherModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                    
                                                </button>
                                                <h4 class="modal-title" id="otherlabel">Upload Documents</h4>
                                              </div>
                                              <div class="modal-body">
                                                
                                                <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="box box-color box-bordered">
				<div >
	 	
		<div id="html5_uploader" style="width: 100%; height: 330px;"></div>
	</div>
				
			</div>
		</div>
	</div>
</div>
                                                 
                                                
                                              </div>
                                              <div class="modal-footer">
                                               
                                                  <div class="alert alert-success span8" id="assign_custom" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="assign_custom_message"> Success!</span></strong>
                                    </div>
                                              </div>
                                             
                                            </div> 
                                        </div>
                                    </div> 
                                </div> 





                              <div class="span6" style="visibility:hidden;">
                                    <div  class="modal fade popup" id="assignModal" tabindex="-1" role="dialog" style="width:40%;" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" >
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                    
                                                </button>
                                                <h4 class="modal-title" id="otherlabel">Assign Users</h4>
                                              </div>
                                              <div class="modal-body">
                                                
                                                <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="box box-color box-bordered">
				<div >
	 	
		
					<select id='assignusers' multiple='multiple' class="searchable">
 						
 						<?php foreach ($userlist as $key=>$list)
 						{ ?>

 						<option value="<?php echo $list['emp_number'];?>"><?php echo $list['name'];?></option>

 						<?php } ?>


					</select>


	</div>
				
			</div>
		</div>
	</div>
</div>
<div class="clear">&nbsp;</div>
<div role="alert" id="message_disp" class="alert alert-success" style="display:none;">
      Successfully Assigned the Users.
    </div>
                                                 
                                                
                                              </div>
                                              <div class="modal-footer">
                                                <input type="button" id="assignUserbtn" name="assignUserbtn" class='btn btn-success' value="Assign" style="margin-left:15px;">
                                                  <div class="alert alert-success span8" id="assign_custom" style="display: none;">
                                        <button data-dismiss="alert" class="close" type="button"></button>
                                        <strong> <span id="assign_custom_message"> Success!</span></strong>
                                    </div>
                                              </div>
                                             
                                            </div> 
                                        </div>
                                    </div> 
                                </div> 





<script type="text/javascript">
var user_role = "<?php  echo $session[user_role];?>"; 
var baseurl="<?php echo Yii::app()->request->baseUrl; ?>"; 
var uploader = '';
var urldisp = 'http://hrm.netstratum.com/hrm';
var current_folder = '';
var folderid = '';
var selected_user_node = '';
var uploadbtn = '';
$(function() {

$('#assignUserbtn').click(function(){

	if ($('#assignusers').val()==null)
		alert("Please Select User(s)");
    else{


    	docarray = [];

    	$('#docview').contents().find("input[name='chk[]']:checked").each(function() {

    		docarray.push($(this).val());
    	});

    	$(this).prop('value', 'Saving...');

    	$.ajax({

         		type:"POST",
         		url:baseurl+"/index.php?r=Doc/AssignDocumentUsers",
         		data:{users:$('#assignusers').val(),doclist:docarray,folderid:folderid}
       	   
       	}).done(function(html)
       	{
          		
				
				$(".searchable").multiSelect( 'deselect_all' );
				$('#assignUserbtn').prop('value', 'Assign');
				$('#message_disp').show('slow');
				setTimeout(function(){
					$('#message_disp').hide('slow');
				$('#assignModal').modal('hide');},3000);
				

                             
       	}); 

    }




		  


});

$('#assignbtn').click(function(){

if($('#docview').contents().find("input[name='chk[]']:checked").length == 0)
{

	alert("Please Select any Document(s)");

}else{

	$('#assignModal').css('visibility','visible');
	$('#assignModal').modal();

}
	



});

$('.searchable').multiSelect({
  selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search'>",
  selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
});

	// Setup html5 version
 uploader = $("#html5_uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : 'index.php?r=Doc/DocUpload',
		chunk_size : '1mb',
		//unique_names : true,
		
		filters : {
			max_file_size : '10mb',
			mime_types: [
				{title : "doc files", extensions : "doc,docx,txt,odt,pdf,ppt,pptx,xlsx,xls,csv,rtf,png,jpeg,gif,psd,xml,jpg,bmp,html,mp3,wav,gsm,mp4,ogg"},
				//{title : "Zip files", extensions : "zip"}
			]
		},

		 preinit : {
            
	BeforeUpload: function(up, file) {
            
 	if ((current_folder == '' || current_folder =='Selected: /home' || current_folder =='Selected: //home') && uploadbtn!=1)
 	{
 		uploadbtn = 1;
 		if (!confirm("Do you want to continue process without selecting a folder which is only applicable for Taxsheet or Pay Slip?"))
 			{
 		up.stop();
 	   }else{
 	   	up.start();
 	   }

 	}else{
 		//return true;
 	}
      		   
            },

 
            UploadFile: function(up, file) {
                //log('[UploadFile]', file);
 			 up.setOption('multipart_params', {folderpath : current_folder});
                // You can override settings before the file is uploaded
                // up.setOption('url', 'upload.php?id=' + file.id);
                // up.setOption('multipart_params', {param1 : 'value1', param2 : 'value2'});
            }
        },

		  init : {

		
		FileUploaded: function(up, file, info) {

                // Called when file has finished uploading
                $('#docview').attr('src','http://hrm.netstratum.com'+baseurl+'/docmanager/docview.php?user_role='+user_role);
            },
        },

 
        
		// Resize images on clientside if we can
		//resize : {width : 320, height : 240, quality : 90}
	});
	
	$('#custombtn').click(function(){
		uploadbtn = '';
		$('#otherModal').css('visibility','visible');
		$('#otherModal').modal();

	});
	
//baseurl
	$('#docview').attr('src','http://hrm.netstratum.com'+baseurl+'/docmanager/docview.php?user_role='+user_role);

   
var $button = $("<button>Clear List</button>").button({icons: {primary: "ui-icon-trash"}}).button("disable").appendTo('.plupload_buttons');

// Clear Button Action
$button.click(function(){
    $uploader.splice();
    $(".plupload_filelist_content").html('');
    $button.button("disable");
    return true;
});

// Clear Button Toggle Enabled
uploader.bind('QueueChanged', function () {
    if(uploader.files.length > 0) {
        $button.button("enable");
    } else {
        $button.button("disable");
    }
});

// Clear Button Toggle Hidden
uploader.bind('StateChanged', function () {
    if(uploader.state == plupload.STARTED) {
        $button.hide();
    } else {
        $button.show();
    }
});

	
});
</script>


