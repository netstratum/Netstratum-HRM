$(document).ready(function(){
    
    $('#forgotpass').click(function(){


     $('#forgotpassform').show();
     $('#loginform').hide();
//loginform 
    });

     


     $('#btnsubmit').click(function(){
         
         if($("#remember").prop('checked') == true){
         var store = $("#remember").val();
         }
         else{
             var store = "";
         }


          $.post(baseurl+"/index.php?r=Loginregister/LoginValidation",{uemail:$('#uemail').val(),upw:$('#upw').val(),cookstore:store}).done(function(data)
          {
             if (data!='success')
             {
                  $('#error_msg').html("Invalid username or password");
                 $('#error_msg').show();
                 
                 
             }
             else{
                 
                 location.href=baseurl+"/index.php";
             }
            
    });
    
    });


      $('#forgotbtn').click(function(){
         
         $.post(baseurl+"/index.php?r=Manageuser/Mailsend",{loginemail:$('#loginemail').val()}).done(function(data)
         {
             if (data!='success')
             {
                 $('#forgetalert').html("Invalid Email");
                 $('#forgetalert').show();
                 $('#forgetsuccess').hide();
                 
                 
             }else{

                  $('#forgetalert').hide();
                  $('#forgetsuccess').html("Please check your mail to get the login details");
                 $('#forgetsuccess').show();

             }
             
            
    });
    
    });
    
     $('#uemail,#upw').keypress(function(e)
    {
        if(e.which==13){
            
            $('#btnsubmit').trigger('click');
        }
        
    });
    

var h4 = $('div#greeting h4');
    
    h4.hide().contents().each(function() {
        var words;
        if (this.nodeType === 3) {
            words = '<span> ' + this.data.split(/\s+/).join(' </span><span> ') + ' </span>';
            $(this).replaceWith(words);
        } else if (this.nodeType === 1) {
            this.innerHTML = '<span> ' + this.innerHTML.split(/\s+/).join(' </span><span> ') + ' </span>';
        }
    });

    h4.find('span').hide().each(function() {
        if( !$.trim(this.innerHTML) ) {
            $(this).remove();
        }
    });

    h4.show().find('span').each(function(i) {
         $(this).delay(100 * i).fadeIn(600);
    });


    
    });
    

