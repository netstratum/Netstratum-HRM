$(document).ready(function(){
    $('#addprojectform').validate({
        rules:
            {
                projectname : "required",
                projectstatus:"required",
                projectactivate:"required"
            },
             messages:{
                 projectname:"Enter project name",
                 projectstatus:"Select project status",
                 projectactivate:"Select project active/deactive"
             },
             submitHandler: function(form){
                 
                 $('#addprojectbtn').prop("disabled", true);
                 $('#addprojectbtn').val("Saving...");
                 $(form).ajaxSubmit({
                     success: function(){
                         
                         
//                       $('#addproject_alert').html('New Project added successfully');
                         $('#addprojectalert').fadeIn();                         
                         setTimeout(
                                 function(){
//                                     $('#addproject_alert').fadeOut();
                                     $('#addprojectbtn').prop("disabled", true);
                                     $('#addprojectbtn').val("Save");                                     
                                     $('#addprojectalert').fadeOut(); 
                                 },3000
                                 );
                     }
                 });
             }
        
    });
    $('#addprojecttasksbtn').click(function(){
       $('#taskModal').modal("show");
       $('#addtaskbtn').show();
       $('#updatetaskbtn').hide();
       $('#projtaskname').val("");
    });
    $('#addprojectbtn').click(function(){
                $('#addprojectform').submit();
              });
});