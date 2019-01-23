var emptimetable="";
var total = 0;
var projid = "";
var taskid = "";
var empid = "";
var emptasktable = "";
var timetotal=0;
$(document).ready(function(){
    
    emptimetable = $('#emptimesheettable').dataTable({
        ajax:{"url":baseurl+"/index.php?r=Timesheet/Showemptimesheet",
            data: function (da) {
                da.fromdate = $('#empdatefrom_mytimesheet').val();                
                da.todate = $('#empdateto_mytimesheet').val();
                da.ename = $('#empname_mytimesheet').val();
                da.projectname = $('#empsearchproject_mytimesheet').val();
                da.taskname = $('#empsearchtask_mytimesheet').val();
                da.empno = empid;
                da.projectid = projid;
                da.taskid = taskid;
            }
            
           
            
        },
        fnRowCallback:function(nrow,adata,index,indexfull){
            
            if(index===0){
                timetotal= 0;
                $('#emptotalid').html(0);
            }
               timetotal+= parseFloat(adata[4]);
               
               $('#emptotalid').html(timetotal);
            },
        "serverSide": true,
        "lengthChange": true,
        "searching": false,
        "bPaginate": false,
        "bInfo": false,
         
    });
   
    
    $('#empsearchproject_mytimesheet').autocomplete({
       source:baseurl+"/index.php?r=Timesheet/Employeeprojectsearch",
       minLength: 2,
       select:function(event, ui){
            projid = ui.item.id;                       
        }
    });
    $('#empsearchtask_mytimesheet').autocomplete({
        source:baseurl+"/index.php?r=Timesheet/Employeetasksearch",
        minLength: 2,
        select:function(event, ui){
            taskid = ui.item.id;                
        }
    });
    $('#empname_mytimesheet').autocomplete({
        source:baseurl+"/index.php?r=Timesheet/Employeesearch",
        minLength: 2,
        select:function(event, ui){
            empid = ui.item.emp_number;  
             emptimetable.fnDraw();           
        }
    });
    
    $('#empdatefrom_mytimesheet,#empdateto_mytimesheet,#empname_mytimesheet,#empsearchproject_mytimesheet,#empsearchtask_mytimesheet').change(function()
    {   if($('#empname_mytimesheet').val()=='')
            empid = "";
        if($('#empsearchproject_mytimesheet').val()=='')
            projid = "";
        if($('#empsearchtask_mytimesheet').val()=='')
            taskid = "";
        if($('#checktask_mytimesheet').prop('checked')=== true) 
        {   
            emptasktable.fnDraw();
            
        }
        else{
            
            
            emptimetable.fnDraw();
        }
    
     });
     $('#checktask_mytimesheet').click(function()
     {   
        if($('#checktask_mytimesheet').prop('checked')=== false)
        {  
            $('#emptimesheettable').show();
            $('#emptasksheettable').hide();
           
        }
        else{
            $('#emptimesheettable').hide();                       
            $('#emptasksheettable').show();
            if( typeof emptasktable!="object")
            { taskdisplay();
                
            }
           
            }                    
    });
     
    $('#empdatefrom_mytimesheet').datepicker({ });
    $('#empdateto_mytimesheet').datepicker({ });
});

function taskdisplay(){
    total = 0;
    $('#taskemptotalid').html(0);
    emptasktable = $('#emptasksheettable').dataTable({
        ajax:{"url":baseurl+"/index.php?r=Timesheet/Showemptimesheet",
            data: function (da) {
                da.checkedbox = $('#checktask_mytimesheet').val();
                da.fromdate = $('#empdatefrom_mytimesheet').val();
                da.todate = $('#empdateto_mytimesheet').val();
                da.ename = $('#empname_mytimesheet').val();
                da.projectname = $('#empsearchproject_mytimesheet').val();
                da.taskname = $('#empsearchtask_mytimesheet').val();
                da.empno = empid;
                da.projectid = projid;
                da.taskid = taskid;
            }
        },
        "serverSide": true,
        "lengthChange": true,
        "searching": false,
        "bPaginate": false,
        "bInfo": false,
        fnRowCallback:function(nrow,adata,index,indexfull){
            if(index===0)
               {
                   total = 0;
                   $('#taskemptotalid').html(0);
               }
               total+= parseFloat(adata[3]);
               
               $('#taskemptotalid').html(total);
            }
            
     });
     
}