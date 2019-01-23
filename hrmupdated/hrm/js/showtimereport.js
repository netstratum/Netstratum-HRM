var mytimetable  = "";
var total = 0;
var projurl = "";
var taskurl ="";
$(document).ready(function(){       

    mytimetable = $('#mytimesheettable').dataTable({
        
        ajax:{"url":baseurl+"/index.php?r=Timesheet/Showmytimesheet",
        data: function (d) {
                                   
            d.fromdate = $('#datefrom_mytimesheet').val();
            d.todate = $('#dateto_mytimesheet').val();
            d.project = $('#searchproject_mytimesheet').val();
            d.task = $('#searchtask_mytimesheet').val();
            d.projid = projurl;
            d.taskid = taskurl;
            
        }
    }, 
    fnRowCallback:function(nrow,adata,index,indexfull){
              
               if(index===0)
               {
                   total = 0;
                   $('#totalid').html(0);
               }
                total+= parseFloat(adata[3]);
               $('#totalid').html(total);
            },
   
        "serverSide": true,
        "lengthChange": true,
        "searching": false,
        "bPaginate": false,
        "bInfo": false
//        "iDisplayLength": "All"
        
        
    });
    $('#searchproject_mytimesheet').autocomplete({
        source:baseurl+"/index.php?r=Timesheet/Searchproject",
        minLength: 2,
        select:function(event, ui){
            projurl = ui.item.id;
        }        
    });
   
    $('#searchtask_mytimesheet').autocomplete({
        source:baseurl+"/index.php?r=Timesheet/Searchtask",
        minLength: 2,
        select:function(event, ui){
            taskurl = ui.item.id;
            
            //mytimetable.fnDraw();
        }
    });
    
  
      
            
    
    $('#datefrom_mytimesheet,#dateto_mytimesheet,#searchproject_mytimesheet,#searchtask_mytimesheet').change(function()
    {
        if ($('#searchproject_mytimesheet').val()==='')
            projurl = "";
        if ($('#searchtask_mytimesheet').val()==='')
            taskurl = "";
        
        mytimetable.fnDraw();
        
       
        
    });
    $('#datefrom_mytimesheet').datepicker({ });
    $('#dateto_mytimesheet').datepicker({ });
});
