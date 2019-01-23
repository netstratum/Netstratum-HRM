$(document).ready(function(){
    $('#joindate').datepicker();
    $('#jobform').validate({
        
        rules:{
                    joindate:"required",
                    jobtitle:"required",
                    jobcategory:"required",
                    
                    
                    },
                messages:{
                    joindate:"please enter date of joining",
                    jobtitle:"select a title",
                    jobcategory:"select category",
                    },
                    
                    submitHandler: function(form) 
                        {
                            
                            $('#jobbutton').prop("disabled", true);
                            $('#jobbutton').val("Saving...");  
                                              
                            $(form).ajaxSubmit({
                                
                            data:{empnumber:$('#empnumber').val()},
                                    
                            success: function(){
                                $('#job_message').html('Job information updated successfully');
                                 $('#jobalert').fadeIn();
                                 setTimeout(
                                 function(){
                                     $('#jobbutton').prop("disabled", '');
                                     $('#jobbutton').val("Save");  
                                     $('#jobalert').fadeOut();
                                 },3000
                                                
                                     );
                                     }  });
                       
                        
                        }
        
    });
    $('#jobbutton').click(function(){
                $('#jobform').submit();
              });
    
    
    
});