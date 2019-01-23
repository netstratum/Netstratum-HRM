<?php
require_once(dirname(__FILE__) . '/class.db.php');
require_once(dirname(__FILE__) . '/class.tree.php');

if(isset($_GET['operation'])) {
	$fs = new tree(db::get('mysqli://root@127.0.0.1/netstratum_hrm'), array('structure_table' => 'tree_struct', 'data_table' => 'tree_data', 'data' => array('nm')));
	try {
		$rslt = null;
		switch($_GET['operation']) {
			case 'analyze':
				var_dump($fs->analyze(true));
				die();
				break;
			case 'get_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$temp = $fs->get_children($node);
				$rslt = array();
				foreach($temp as $v) {
					$rslt[] = array('id' => $v['id'], 'text' => $v['nm'], 'children' => ($v['rgt'] - $v['lft'] > 1));
				}
				break;
			case "get_content":
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : 0;
				$node = explode(':', $node);
				if(count($node) > 1) {
					$rslt = array('content' => 'Multiple selected');
				}
				else {
					$temp = $fs->get_node((int)$node[0], array('with_path' => true));
					$rslt = array('content' => 'Selected: /' . implode('/',array_map(function ($v) { return $v['nm']; }, $temp['path'])). '/'.$temp['nm']);
				}
				break;
			case 'create_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$temp = $fs->mk($node, isset($_GET['position']) ? (int)$_GET['position'] : 0, array('nm' => isset($_GET['text']) ? $_GET['text'] : 'New node'));
				$rslt = array('id' => $temp);
				break;
			case 'rename_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$rslt = $fs->rn($node, array('nm' => isset($_GET['text']) ? $_GET['text'] : 'Renamed node'));
				break;
			case 'delete_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$rslt = $fs->rm($node);
				break;
			case 'move_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$parn = isset($_GET['parent']) && $_GET['parent'] !== '#' ? (int)$_GET['parent'] : 0;
				$rslt = $fs->mv($node, $parn, isset($_GET['position']) ? (int)$_GET['position'] : 0);
				break;
			case 'copy_node':
				$node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
				$parn = isset($_GET['parent']) && $_GET['parent'] !== '#' ? (int)$_GET['parent'] : 0;
				$rslt = $fs->cp($node, $parn, isset($_GET['position']) ? (int)$_GET['position'] : 0);
				break;
			default:
				throw new Exception('Unsupported operation: ' . $_GET['operation']);
				break;
		}
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($rslt);
	}
	catch (Exception $e) {
		header($_SERVER["SERVER_PROTOCOL"] . ' 500 Server Error');
		header('Status:  500 Server Error');
		echo $e->getMessage();
	}
	die();
}

//create folder  = mkdir($dir . DIRECTORY_SEPARATOR . $name);
//rename folder = rename($dir, $new);
//remove folder = unlink($dir);
//copy folder =  rename($dir, $new);
//cut and move folder  = move

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Title</title>
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" href="css/style.min.css?34343" />
		<style>
		html, body { background:#ebebeb; font-size:10px; font-family:Verdana; margin:0; padding:0; }
		#container { min-width:320px; margin:0px auto 0 auto; background:white; border-radius:0px; padding:0px; overflow:hidden; }
		#tree { float:left; min-width:319px; border-right:1px solid silver; overflow:auto; padding:0px 0; }
		#data { margin-left:320px; }
		#data textarea { margin:0; padding:0; height:100%; width:100%; border:0; background:white; display:block; line-height:18px; }
		#data, #code { font: normal normal normal 12px/18px 'Consolas', monospace !important; }
		</style>
	</head>
	<body>
		<div id="container" role="main">
			<div id="tree"></div>
			<div id="data">
				<div class="content code" style="display:none;"><textarea id="code" readonly="readonly"></textarea></div>
				<div class="content folder" style="display:none;"></div>
				<div class="content image" style="display:none; position:relative;"><img src="" alt="" style="display:block; position:absolute; left:50%; top:50%; padding:0; max-height:90%; max-width:90%;" /></div>
				<div class="content default" style="text-align:center;">Select a node from the tree.</div>
			</div>

		</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="js/jstree.min.js"></script>
		<script>
		 parent.current_folder = '';
		 parent.folderid = '';
		 parent.selected_user_node = '';
                 
		 var clickedobj = '';
		var baseurl = 'http://hrm.netstratum.com/hrm';
		$(function () {

				

		   $('#data').on('click','.del_doc_assign',function(){
		   
		   		if (!confirm("Do you want to remove the user permission from the Folder/File?"))
						return false;



				var rel = $(this).attr('rel');
					$.ajax({
         				type:"POST",
         				url:baseurl+"/index.php?r=Doc/deletePermission",
         				data:{current_file:parent.selected_user_node,userid:rel}
       				}).done(function(html)
       				{
       					clickedobj.trigger('click');

          				//$('.jstree-wholerow-clicked').trigger('click');
          				
                             
       				});



		   });		

			$('#data').on('click','.deletefile-icon',function(){

					if (!confirm("Do you want to delete the file?"))
						return false;

					var rel = $(this).attr('rel');
					$.ajax({
         				type:"POST",
         				url:baseurl+"/index.php?r=Doc/deleteDoc",
         				data:{current_file:rel}
       				}).done(function(html)
       				{
          				$('.jstree-wholerow-clicked').trigger('click');
          				
                             
       				}); 



			});

			$('#data').on('click','.thumb_doc_list',function(){

					$('.thumb_doc_list').parent().parent('.file-icon').removeClass('selected_thumb');
					$(this).parent().parent('.file-icon').addClass('selected_thumb');

					clickedobj = $(this);
					var rel = $(this).attr('rel');

				parent.selected_user_node = rel;
				

					$.ajax({
         				type:"POST",
         				url:baseurl+"/index.php?r=Doc/ViewAssignUsers",
         				data:{current_file:rel}
       				}).done(function(html)
       				{
          				
          				$('.scrolldiv').html(html);
                             
       				}); 

			});


			$('#data').on('click','.download-file',function(){


					var rel = $(this).attr('rel');
					
					parent.location.href=baseurl+'/index.php?r=Doc/Download&file='+rel;


			});


			$('#data').on('click','.view-file',function(){


			var rel = $(this).attr('rel');		

parent.window.open(
  baseurl+'/index.php?r=Doc/list&file='+rel,
  '_blank' 
);


					//parent.location.href=baseurl+'/index.php?r=Doc/list&file='+rel;


			});


			$(window).resize(function () {
				var h = Math.max($(window).height() - 0, 420);
				$('#container, #data, #tree, #data .content').height(h).filter('.default').css('lineHeight', h + 'px');
			}).resize();

			$('#tree')
				.jstree({
					'core' : {



						'data' : {
							'url' : '?operation=get_node',
							'data' : function (node) {

								 parent.folderid = node.id;


								return { 'id' : node.id }; 
							}
						},
						'check_callback' : function (operation, node, node_parent, node_position, more) {
            // operation can be 'create_node', 'rename_node', 'delete_node', 'move_node' or 'copy_node'
            // in case of 'rename_node' node_position is filled with the new node name


            
            if (operation == 'delete_node'){

            if (node.id == '1'){
             	alert("You can not delete root folder! Please consult the Administrator.");
             	return false;
             }

            	if (!confirm("Do you want to delete the folder and its contents?")) {return false;} 


            	$.ajax({
         			type:"POST",
         			url:baseurl+"/index.php?r=Doc/DeleteAll",
         			data:{folderpath:parent.current_folder,id:node.id,position:node_position}
       			}).done(function(html)
       			{
          			// 	alert(html);
          			//$('#data').html(html);
          			location.reload(); 
                             
       			}); 



            }

            if (operation == 'create_node'){
            		

            	$.ajax({
         			type:"POST",
         			url:baseurl+"/index.php?r=Doc/Create_folder",
         			data:{folderpath:parent.current_folder,foldername:node.text,position:node_position}
       			}).done(function(html)
       			{
          			parent.current_folder = parent.current_folder+'/'+node.text;
                             
       			}); 



            }


            if (operation == 'rename_node'){
            if (node.id == '1'){
             	alert("You can not rename root folder! Please consult the Administrator.");
             	return false;
             } 	 

            		$.ajax({
         			type:"POST",
         			url:baseurl+"/index.php?r=Doc/Rename_folder",
         			data:{folderpath:parent.current_folder,foldername:node.text,position:node_position}
       			}).done(function(html)
       			{
          			// 	alert(html);
          			//$('#data').html(html);
          			location.reload(); 
                             
       			}); 



            }

            if (operation == 'move_node'){
            if (node.id == '1'){
             	alert("You can not move root folder! Please consult the Administrator.");
             	return false;
             } 
            	
            	if ((operation === "move_node" ) && more && more.core && !confirm('Do you want to move the folder and its contents?')) {
        			return false;
    			}


    				$.ajax({
         				
         				type:"POST",
         				url:baseurl+"/index.php?r=Doc/pasteAll",
         				data:{folderpath:parent.current_folder,id:node.id,position:node_position}
       				
       				}).done(function(html)
       				{
          				// 	alert(html);
          				//$('#data').html(html);
          				location.reload(); 
                             
       				}); 


            }

            if (operation == 'copy_node'){
              if (node.id == '1'){
             	alert("You can not past root folder! Please consult the Administrator.");
             	return false;
             }

            		$.ajax({
         		
         				type:"POST",
         				url:baseurl+"/index.php?r=Doc/copyAll",
         				data:{folderpath:parent.current_folder,id:node.id,position:node_position}
       			
       			}).done(function(html)
       			{
          			// 	alert(html);
          			//$('#data').html(html);
          			location.reload(); 
                             
       			}); 


            } 	 


         
        },
						'themes' : {
							'responsive' : false
						}
					},
					<?php if ($_REQUEST['user_role'] == 1 or $_REQUEST['user_role'] == 2){?>
					'plugins' : ['state','dnd','contextmenu','wholerow']
					<?php }else{?>
					'plugins' : ['state','dnd','','wholerow']
						<?php } ?>
					//'plugins' : ['','','','wholerow']
				})
				.on('delete_node.jstree', function (e, data) {

					
					$.get('?operation=delete_node', { 'id' : data.node.id })
						.fail(function () {
							data.instance.refresh();
						});

				})
				.on('create_node.jstree', function (e, data) {
					$.get('?operation=create_node', { 'id' : data.node.parent, 'position' : data.position, 'text' : data.node.text })
						.done(function (d) {
							data.instance.set_id(data.node, d.id);
						})
						.fail(function () {
							data.instance.refresh();
						});
				})
				.on('rename_node.jstree', function (e, data) {
					$.get('?operation=rename_node', { 'id' : data.node.id, 'text' : data.text },function(d){

						parent.current_folder = data.text;
						parent.selected_user_node = data.text;

					}).fail(function () {
							data.instance.refresh();

						});
				})
				.on('move_node.jstree', function (e, data) {
					$.get('?operation=move_node', { 'id' : data.node.id, 'parent' : data.parent, 'position' : data.position })
						.fail(function () {
							data.instance.refresh();
						});
				})
				.on('copy_node.jstree', function (e, data) {
					$.get('?operation=copy_node', { 'id' : data.original.id, 'parent' : data.parent, 'position' : data.position })
						.always(function () {
							data.instance.refresh();
						});
				})
				.on('changed.jstree', function (e, data) {
					if(data && data.selected && data.selected.length) {
						$.get('?operation=get_content&id=' + data.selected.join(':'), function (d) {
								parent.current_folder = d.content;
								parent.folderid = data.selected.join(':');
								parent.selected_user_node = d.content;



  $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Doc/ViewFolder",
         data:{folderpath:parent.current_folder,folder_id:data.selected.join(':')}
       }).done(function(html)
       {
          // 	alert(html);
          $('#data').html(html);
                             
       }); 
						//window.parent.location.host;
 //id="data"
						
							//$('#data .default').html(d.content).show();
						});
					}
					else {
						$('#data .content').hide();
						$('#data .default').html('Select a folder from the tree.').show();
					}
				});
		});


		$('#tree').on('click','.jstree-anchor',function(){

			clickedobj = $(this);

		});

	
		</script>
	</body>
</html>
