$(document).ready(function(){
    
    
    $('#taskpopupform').validate({
      rules:{
          projtaskname:"required"
      },
      messages:{
          projtaskname:"Please enter the task name"
      },
      submitHandler: function(form){
        $.ajax({
                type:"POST",
                url:baseurl+"/index.php?r=Timesheet/Newtask",
                data:{pedit:pedit,projtaskname:$('#projtaskname').val()}
            }).done(function(msg){
                $('#addtaskalert').fadeIn();
                setTimeout(
                    function(){
                        $('#taskModal').modal("hide");
                        $('#addtaskalert').fadeOut();
                    },3000
                    );
            });
      }
    });
    
    $('#viewprojecttaks').on('click','.taskdelete',function()
    {
        taskid = $(this).attr("rel");
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Timesheet/Deletetask",
            data:{taskid:taskid}
            
        }).done(function(msg)
        {   
            tasktable.fnDraw();
        });
    });
    
    $('#addtaskbtn').click(function(){
            $('#taskpopupform').submit();
            tasktable.fnDraw();
            
    });
    
    $('#viewprojecttaks').on('click','.taskedit',function(){
        $('#taskModal').modal("show");
        taskid = $(this).attr("rel");
        
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Timesheet/Edittask",
            data:{taskid:taskid}
        }).done(function(msg)
        {
            var dataval = JSON.parse(msg);
            $('#projtaskname').val(dataval.taskname);
            $('#updatetaskbtn').show();
            $('#addtaskbtn').hide();
        });
    });
    
    $('#updatetaskbtn').click(function()
    {
        var tname = $('#projtaskname').val();
        $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Timesheet/Updatetaskdata",
           data:{taskid:taskid,tname:tname}
        }).done(function(msg)
        {
           $('#addtaskalert').fadeIn();
           setTimeout(
                    function(){       $('#taskModal').modal("hide");                              
                                     $('#addtaskalert').fadeOut();                                    
                                 },3000 
                );
        tasktable.fnDraw();
        
        });
    });
    
});
function projtask(){
    if( typeof tasktable === "object") 
    {
        tasktable.fnDestroy();
    }
    
    tasktable = $('#projecttasktable').dataTable({
        ajax:baseurl+"/index.php?r=Timesheet/Viewtasks&pedit="+pedit,
        "serverSide": true,
        "lengthChange": false,
        "searching": true,
        "oLanguage": { "sSearch": "Search Task:" },
        "iDisplayLength" : 10,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 2 ] }
       ]
        });
    }