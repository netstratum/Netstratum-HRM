$(document).ready(function(){
   
    
     $("#country").change(function () {
                
              
                var coid = $('#country option:selected').val();
                
                
                
                $.ajax({
                        type: "POST",
                        url: baseurl+"/index.php?r=Manageuser/Dynamicstates",
                        data: { countryid: coid}
                    })
                        .done(function(msg) {
                            
                           $('#state').html(msg);
                
                       });
                      
              });                 
            
            
            
            
            $('#contact').validate({
                
                rules:{
                    name:"required",
                    address:"required",
                    state:"required",
                    pincode:"required",
                    relation:"required",
                    hnumber:"required",
                    mnumber:"required",
                    },
                messages:{
                    name:"Please enter a valid contact person name",
                    address:"Add your address",
                    state:"Add state",
                    pincode:"Valid pincode required",
                    relation:"Add relationship",
                    hnumber:"Home number required",
                    mnumber:"Add mobile number 10 digits",
                    },
                    
                    submitHandler: function(form) 
                        {
                            //var empno =   $('#empnumber').val();                  
                            
                            $('#sbutton').prop("disabled", true);
                            $('#sbutton').val("Saving...");
                            $(form).ajaxSubmit({
                            data:{empnumber:$('#empnumber').val()},   
                            
                            success: function(){
                                
                               
                                $('#contact_message').html('Emergency contact information saved successfully');
                                 $('#contactalert').fadeIn();
                                 setTimeout(
                                 function(){
                                     
                                     $('#contactalert').fadeOut();
                                      $('#sbutton').prop("disabled", '');
                                     $('#sbutton').val("Save");
                                 },3000
                                                
                                     );
                                     }  });
                       
                        
                        }
                    
            });
            
            $('#sbutton').click(function(){
                $('#contact').submit();
              });
            
    
    
});