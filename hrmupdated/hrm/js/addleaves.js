$(document).ready(function(){
   
   var leavetable = $('#leaves').dataTable();
   
    $('#leavepopupform').validate({
        rules:{
            leavename:"required",
            leavemax:"required",
            leaveprobation:"required"
        },
        messages:{
            leavename:"Please give a leave name",
            leavemax:"Provide maximum leave number",
            leaveprobation:"Provide the probation period"
        },
        
        submitHandler: function(form) 
                        {                            
                            
                            $('#popupbtn').prop("disabled", true);
                            $('#popupbtn').val("Saving...");        

                            $(form).ajaxSubmit({                                                        
                            success: function(){       
                                    
                                $('#popup_leave_mess').html('You have added the leave successfully');                                                    
                                 $('#leavealert').fadeIn();
                                 setTimeout(
                                 function(){   
                                     $('#popupbtn').val("Save");                                    
                                     $('#leavealert').fadeOut();
                                      $('#popupbtn').prop("disabled", '');
                                     
                                     $('#myModal').modal("hide"); 
                             leavetable.fnDraw();

                             $('#leavename').val('');
                             $('#leavemax').val('');
                             $('#leaveprobation').val('');
                             $('#expiry_date').val('');
                             
                                 },3000                                                
                                     );
                             
                                     }  });                                              
                        }    
                 
                 
    });
    
    $('#popupbtn').click(function(){
                $('#leavepopupform').submit();
              });

    $('#expiry_date').datepicker();
    $('#edit_expiry_date').datepicker();
              
    
});