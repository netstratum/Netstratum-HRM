var newproj = "";
var pedit = "";
$(document).ready(function(){
    $('#newproject').hide();
    $('#addnewproject').click(function(){
        //location.href=baseurl+"/index.php?r=Timesheet/Addproject"; 
        $('#newproject').show();      
        $('#addprojecttab').show(); 
        $('#viewproject').hide();
        $('#viewprojecttab').hide();
        $('.active').hide();
        $('.dis').show();        
        $('#projectname').val("");
        $('#projectstatus').val("");
        $('#projectactivate').val("");
        $('#updateprojectbtn').hide();
        $('#addprojectbtn').show();   
        $('#addprojecttasksbtn').hide();
        $('#viewprojecttaks').hide();
    });
    $('#viewprojectsbtn').click(function()
    {   $('.active').show();
        $('#viewproject').show();
        $('#viewprojecttab').show();
        $('#newproject').hide();
        $('#addprojecttab').hide();
        $('.dis').hide();
        newproj.fnDraw();        
    });
    
    
    newproj = $('#projecttable').dataTable({
        ajax:baseurl+"/index.php?r=Timesheet/Viewproject",
        "serverSide": true,
        "lengthChange": false,
        "searching": true,
        "oLanguage": { "sSearch": "Search Project:" },
        "iDisplayLength" : 5,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3 ] }
       ]
        
    });
    $('#projectlist').on('click','.projstatus',function()
    {   var stat = $(this).attr('rel').split("_");
        $.ajax({
           type: "POST",
           url: baseurl+"/index.php?r=Timesheet/Status",
           data:{projid:stat[0],projstatus:stat[1]}
        })
        .done(function( msg ) {
        
             newproj.fnDraw();
        
        });
    });
    $('#projectlist').on('click','.projedit',function()
    {
        pedit = $(this).attr("rel");
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Timesheet/Editproject",
            data:{pedit:pedit}
        }).done(function(msg){
            var dataval = JSON.parse(msg);
            $('#projectname').val(dataval.project_name);
            $('#projectstatus').val(dataval.status);
            $('#projectactivate').val(dataval.active);
            $('#newproject').show();
            $('#addprojecttab').show();
            $('#viewproject').hide();
            $('#viewprojecttab').hide();
            $('.active').hide();
            $('.dis').show();
            $('#updateprojectbtn').show();
            $('#addprojectbtn').hide();
            $('#addprojecttasksbtn').show();
            $('#viewprojecttaks').show();
            projtask(taskid);
        });
    });
    
    
    
    $('#updateprojectbtn').click(function()    
    {
        var pname = $('#projectname').val();
        var pstatus = $('#projectstatus').val();
        var pactive = $('#projectactivate').val();        
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Timesheet/Updateprojectdata",
            data:{pedit:pedit,pname:pname,pstatus:pstatus,pactive:pactive}
        }).done(function(msg){
            $('#addprojectalert').fadeIn();
            
            setTimeout(
                    function(){                                                                             
                                     $('#addprojectalert').fadeOut();                                    
                                 },3000
                );
        newproj.fnDraw();
        });
    });
});