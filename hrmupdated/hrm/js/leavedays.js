$(document).ready(function(){
  
    
    $('#leavedayform').validate({
        rules:{
            leavelistbox:"required",
        },
        messages:{
            leavelistbox:"Select day"
        },
        submitHandler: function(form) 
                        {
                            
                            $('#leavebtn').prop("disabled", true);
                            $('#leavebtn').val("Saving...");   

                            $(form).ajaxSubmit({
                                data:{empnumber:$('#empnumber').val()},
                                
                                success: function(){
                                    $('#leaveday_message').html('Week holiday(s) updated successfully');
                                    $('#leaveformalert').fadeIn();
                                 setTimeout(
                                 function(){
                                     $('#leavebtn').prop("disabled", '');
                                     $('#leavebtn').val("Save");  
                                     $('#leaveformalert').fadeOut();
                                 },3000
                                                
                                     );
                                
                                }
                            });
                        }
    });
    
     $('#leavebtn').click(function(){
                $('#leavedayform').submit();
              });
    
});