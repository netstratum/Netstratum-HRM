$(document).ready(function(){
    
    $('#salaryform').validate({
        
        rules:{
                    pgrade:"required",                                       
                    amount:"required",
                    
                    },
                messages:{
                    pgrade:"please provide a pay grade",
                    amount:"provide salary",                    
                    
                    },
                    
                    submitHandler: function(form) 
                        {
                                              
                            $(form).ajaxSubmit({
                                    
                            success: function(){
                                 $('#salaryalert').fadeIn();
                                 setTimeout(
                                 function(){
                                     
                                     $('#salaryalert').fadeOut();
                                 },3000
                                                
                                     );
                                     }  });
                       
                        
                        }
        
    });
    $('#salarybutton').click(function(){
                $('#salaryform').submit();
              });
    
    
    
});