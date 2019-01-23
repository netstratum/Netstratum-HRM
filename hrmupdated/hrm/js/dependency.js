$(document).ready(function(){
    
    var d = new Date();
    var n = d.getFullYear(); 
     $('#dateofbirth').datepicker({ changeMonth: true,changeYear: true,yearRange: '1920:'+n});
     $('#dateofbirth').click(function(){
        $('.ui-datepicker-year').css( 'width','80px');

     });
     

    $("#relationship").change(function () {
        
        var va = $("#relationship option:selected").val();
        if(va ==='other'){
            
            $('#otherdep').fadeIn();
        }
        else{
            $('#otherdep').fadeOut();
        }
    
    });
    
    

    $('#dependent_div').on('click','.depremove',function(){


       $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Manageuser/DeleteDependent",
         data:{dp_id:$(this).attr('rel')}
       }).done(function(msg)
       {
           
           dep.fnDraw();
                             
       });  

     });

    $('#dependentform').validate({
        
        rules:{
                    dname:"required",
                    
                    dateofbirth:"required",
                    
                    },
                messages:{
                    dname:"please enter dependent name",
                    
                    dateofbirth:"date of birth required",
                    
                    },
                    
                    submitHandler: function(form) 
                        {
                            $('#depbutton').prop("disabled", true);
                            $('#depbutton').val("Saving...");        

                            $(form).ajaxSubmit({
                                    data:{empnumber:$('#empnumber').val()},
                                    
                            success: function(){
                                 $('#dependentalert').fadeIn();
                                 $('#dependency_message').html('Dependency information added successfully');
                                 setTimeout(
                                 function(){
                                     $('#depbutton').prop("disabled", '');
                            $('#depbutton').val("Save");
                               $('#depreset').trigger('click');
                                 dep.fnDraw();
                                     $('#dependentalert').fadeOut();
                                 },3000
                                                
                                     );
                              
                                     }  });
                       
                        
                        }
        
    });
    $('#depbutton').click(function(){
                $('#dependentform').submit();
              });
    
    
    
});