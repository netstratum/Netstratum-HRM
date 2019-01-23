var t1="";
var timeid="";
var timetable="";
$(document).ready(function(){
    $('#projectlist').change(function(){
       var projvalue = $('#projectlist option:selected').val();
       
       if(projvalue==="")
       {
           $('#tasklist').val("");
           return false;
       }
           
       $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Timesheet/Newtimesheet",
           data:{projvalue:projvalue}
       }).done(function(msg){
           
           $('#tasklist').html(msg);
       });
       
    });
    $('#tasklist').change(function(){
        t1 = $('#tasklist option:selected').val();
        
        if(t1 ==="")
            return false;
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Timesheet/Weekrange",            
            data:{"tasksident":t1}
        }).done(function(msg){
                $('#weeklist').html(msg);
                if( typeof timetable === "object") 
                {
                    timetable.fnDestroy();
                }
               timetable = $('#weekstable').dataTable({
                   
               ajax:baseurl+"/index.php?r=Timesheet/Viewtimesheets&taid="+t1,
               "serverSide": true,
               "lengthChange": false,
               "searching": true,
               "oLanguage": { "sSearch": "Search Date:" },
               
               "iDisplayLength" : 5,
               "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3 ] }
       ]
            });
        });
        
    });
    
    $('#weeklist').change(function(){
        var weekday = $('#weeklist option:selected').val();
        
        $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Timesheet/Weekdata",
           data:{"tasksid1":t1,weekdays:weekday}
        }).done(function(msg){
            $('#displayweeks').html(msg);
            if($('#weeklist').val()==="")
            $('#weektable').hide();        
        });
        
    });
    
    $('#viewweeks').on('click','.timesheetdelete',function()
    {
        timeid = $(this).attr("rel");
        $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Timesheet/Deletetimesheet",
           data:{timesid:timeid}
        }).done(function(msg){
            timetable.fnDraw();            
        });
    });
   
    
    $('#addtimesheetform').validate({
        
        rules:{
          projectlist:"required",
          tasklist:"required",
          weeklist:"required"
        },
        messages:{
          projectlist:"Select a project",
          tasklist:"Select a task",
          weeklist:"Select a date range"
        },
        submitHandler: function(form){
            
            $.ajax({
                type:"POST",
                url:baseurl+"/index.php?r=Timesheet/Createtimesheet",
                data:{tid:$('#addtimesheetform').serialize()}
            }).done(function(msg)
            {
              $('#addtimsheetalert').fadeIn();
              setTimeout(
                      function(){
                          $('#addtimsheetalert').fadeOut();
                      },3000
                      );
              timetable.fnDraw();
            });
       }
    });
    $('#weektimesheetbtn').click(function()
    {           
        $('#addtimesheetform').submit();            
                
    });
    
    
    
});