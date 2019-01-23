 $(document).ready(function(){

	$('#changepswdform').validate({

		rules:{
			newpassword:{
				required:true,
				minlength:5,
			},
			confirmpassword:{
				required:true,
				minlength:5,
				equalTo: "#newpassword"
			}
		},
		messages:{
			newpassword:{
				required: "Enter new password",
                minlength: "Your password must be at least 5 characters long" 
			},
			confirmpassword:{
				required: "Please provide a password",
				equalTo: "Enter the same password as above"
			}
		},

		submitHandler: function(form) 
                        {                            
                            $(form).ajaxSubmit({                                                        
                            success: function(){                                                               
                                 $('#passwordalert').fadeIn();
                                 setTimeout(
                                 function(){                                     
                                     $('#passwordalert').fadeOut();
                                      $('#newpassword').val('');
                                     $('#confirmpassword').val('');
                                     $('#changepswdmodal').modal("hide");
                                 },3000                                                
                                     );  

                                
                                     } 
                                     
                                     

                                    } );                                                                 
                        }
	});

 $('#passwordbtn').click(function(){
                $('#changepswdform').submit();
              });
 
 $('#changepswdlink').click(function()
    {
        $('#changepswdmodal').modal("show");
    });

});