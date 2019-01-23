$(document).ready(function(){
    
    
    if(roundid == "")
    {
        $('#roundpopupmodal').modal("show");
    }
    else{
        $('#iframeid').attr('src','http://'+domain+'/'+baseurl+'/roundcubemail-1.0.4/?_task=mail&_mbox=INBOX&roundid='+roundid);
    }
    
    
    $('#roundpopupform').validate({
        
        rules:{
            roundusername:{
                required:true,                
            },
            roundpassword:{
                required:true,
                minlength:5,
            }
            
        },
        messages:{
            roundusername:{
                required:"Enter valid email"
            },
            roundpassword:{
                required:"Input your password",
                minlength:"Your password must be at least 5 characters long"
            }
        },
        submitHandler: function(form) 
             {
               $.ajax({
                    type:"POST",
                    url:baseurl+"/index.php?r=Roundcubemail/Addnewdata",
                     data:{rrid:roundid,roundpassword:$('#roundpassword').val()}
                 }).done(function(id)
                 {        $("body").addClass("loading_round");
			//alert('http://'+domain+''+baseurl+'/roundcubemail-1.0.4/?_task=mail&_mbox=INBOX&roundid='+id);
                         $('#iframeid').attr('src','http://'+domain+''+baseurl+'/roundcubemail-1.0.4/?_task=mail&_mbox=INBOX&roundid='+id);
                  $('#rmailerror').hide();      
                 $('#rmailalert').fadeIn();
                        
                        setTimeout(
                                function(){
                                    $('#rmailalert').fadeOut();
                                   
                                    $('#roundpopupmodal').modal("hide");
                                },3000
                                );
                    } 
                 );
              }
    });
    
    
    $('#roundbtn').click(function(){
                $('#roundpopupform').submit();
              });
    
    

   
    $("body").addClass("loading_round");
   //  ajaxStop: function() { $body.removeClass("loading"); }    
      

   
    
    
//    $('#changepswdlink').click(function()
//    {
//        $('#changepswdmodal').modal("show");
//    });
    
});
