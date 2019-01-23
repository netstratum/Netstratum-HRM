var dep = '';
$(document).ready(function(){
   
     dep =  $('#dependent_table').dataTable( {                                        
                 
                ajax:        {"url":baseurl+"/index.php?r=Manageuser/Dependentlist",
                               "data":  function ( d ) {
                              
                                 d.emp_number = $('#empnumber').val();

                                // etc
                                 } },
              
                "processing": true,
                "serverSide": true,
                "paging":false,
                "searching": false,
                "pageLength":false,
                 "ordering": false, 
                    "info": false,
                });
    var d = new Date();
var n = d.getFullYear(); 
     $('#emp_dob').datepicker({ changeMonth: true,changeYear: true,yearRange: '1940:'+n});
     $('#emp_dob').click(function(){
        $('.ui-datepicker-year').css( 'width','80px');
        $('.ui-datepicker-month').css( 'width','80px');
      

     });

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
               
        
);
    if(empno>0){
        
        $('#profileform').validate({
            
                rules:{
                        fname:{
                                required:true,
                                regex:"^[a-zA-Z'.\\s]{1,40}$",
                            },
                        lname:{required:true,
                               regex:"^[a-zA-Z'.\\s]{1,40}$",
                            },
                                                
                        
                 
                    },
                
                messages:{
                        fname:"Please enter your firstname",
                        lname:"Please enter your lastname",
                        
                },
                      submitHandler: function(form) 
                        {
                            $('#sbtn').prop("disabled", true);
                            $('#sbtn').val("Saving...");               
                            $(form).ajaxSubmit({
                                    
                            success: function(empno){
                               

                                $('#empnumber').val(empno);
                                dep.fnDraw();
                               // var empno =   $('#empnumber').val();
                                 $('#disp_message').html('Profile information updated successfully');
                                 $('#profilealert').fadeIn();
                                 setTimeout(
                                 function(){
                                       $('#sbtn').prop("disabled", '');
                                     $('#sbtn').val("Save"); 
                                     $('#profilealert').fadeOut();
                                 },3000
                                 
                
                 );
                                    
                            }  });
                       
                        
                        }
            
            });
    }
    else{
        
        $('#profileform').validate({
            
                rules:{
                        fname:{
                                required:true,
                                regex:"^[a-zA-Z'.\\s]{1,40}$",
                            },
                        lname:{required:true,
                               regex:"^[a-zA-Z'.\\s]{1,40}$",
                            },
                        gender:{required:true},
                                                
                        uname:  {
                                required:true,
                                minlength:2,
                                remote:baseurl+"/index.php?r=Manageuser/Uservalidation",                                                                                     
                                },
                        pswd:{
                                required:true,
                                minlength:5,
                                },
                        cpswd:{
                                required:true,
                                minlength:5,
                                equalTo: "#pswd"
                                }, 
                 
                    },
                
                messages:{
                        fname:"Please enter your firstname",
                        lname:"Please enter your lastname",
                        gender:"Please select your gender",
                        uname:{
                                required: "Please enter a username",
                                minlength: "Your username must consist of at least 2 characters",
                                remote:"Username already taken"
                            },
                        pswd:{
                                 required: "Please provide a password",
                                 minlength: "Your password must be at least 5 characters long"   
                             },
                        cpswd:{
                                 required: "Please provide a password",
                                 minlength: "Your password must be at least 5 characters long",
                                 equalTo: "Please enter the same password as above"   
                        },
                },
                   
                errorPlacement: function (error, element) {
            if(element.attr("name") =='gender'){
            error.insertAfter($("#emp_gender"));
            error.css('padding-left','190px');
            }else{
           error.insertAfter(element);
            }
          
       
    
},
                      submitHandler: function(form) 
                        {
                             $('#sbtn').prop("disabled", true);
                            $('#sbtn').val("Saving...");                       
                            $(form).ajaxSubmit({
                                    
                            success: function(empno){
                                
                                 
                                $('#empnumber').val(empno);
                                 dep.fnDraw();
                               // var empno =   $('#empnumber').val();
                                
                                 $('#disp_message').html('User has been registered successfully');
                                 $('#profilealert').fadeIn();
                                 setTimeout(
                                 function(){
                                    getTabs();
                                      $('#sbtn').prop("disabled", '');
                                     $('#sbtn').val("Save"); 
                                     $('#profilealert').fadeOut();
                                    
                                 },4000);
                                    
                                                                    

                            }  });
                       
                        
                        }
            
            });
        }
            
            $('#sbtn').click(function(){
            
               $('#profileform').submit();        
                  

            });
    
    
    

});

function getTabs(){

    $('#profilealert').fadeOut();
    
                                 $('.tabs-top > li').each(function(){

                                   $(this).show();
                                 });


                                 $('.tabs-top > li > a').each(function(){
                                    if ($(this).attr('href') =='#econtact')
                                        $(this).trigger('click');
                                    else if ($(this).attr('href') =='#profile'){
                                        $(this).attr('href','');
                                        $(this).parent().hide();
                                    }
                                 });

    
}



