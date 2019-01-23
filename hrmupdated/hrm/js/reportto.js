var re_sup = '';
var re_sub = '';
$(document).ready(function(){
   
        re_sup =  $('#super_table').dataTable( {                                        
                 
                ajax:        {"url":baseurl+"/index.php?r=Manageuser/supervisor",
                               "data":  function ( d ) {
                               
                                 d.emp_number = $('#empnumber').val();

                                // etc
                                 } },
              
                "processing": true,
                "serverSide": true,
                paging: false,
                searching: false,
                "info": false,
                "ordering": false
               
                });


        re_sub =  $('#sub_table').dataTable( {                                        
                 
                 ajax:        {"url":baseurl+"/index.php?r=Manageuser/subordinate",
                               "data":  function ( d ) {
                               
                                 d.emp_number = $('#empnumber').val();

                                // etc
                                 } },
               
                "processing": true,
                "serverSide": true,
                 paging: false,
                 searching: false,
                 "info": false,
                  "ordering": false 
                });





        $("#rname").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: baseurl+"/index.php?r=Manageuser/Report",
                dataType: "json",
                data: {
                    term : request.term,
                    "emp_number" :  $('#empnumber').val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        min_length: 2,
        delay: 300,
        select: function( event, ui ) {
                        //ui.item.id;
                        $('#report_user_id').val(ui.item.id);

                    }
    });
    
    
    
    
    $( "#super" ).click(function(){

        
        $( "#leave_approval_div" ).show();
        

    });

    $( "#sub" ).click(function(){

        $( "#leave_approval_div" ).hide();
        $( "#order_div" ).hide();
        $("#leave_approval" ).prop('checked',false);

    });

    $( "#leave_approval" ).click(function(){

        if ($(this).prop('checked'))
        {
            //$( "#order_div" ).show(); 
        }else{
            //$( "#order_div" ).hide(); 
        }

    });

     $('#report').on('click','.supremove',function(){


       $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Manageuser/Deletesupervisor",
         data:{report_id:$(this).attr('rel')}
       }).done(function(msg)
       {
           
           re_sup.fnDraw();
                             
       });  

     });


      $('#report').on('click','.subremove',function(){


       $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Manageuser/Deletesubordinate",
         data:{report_id:$(this).attr('rel')}
       }).done(function(msg)
       {
           
           re_sub.fnDraw();
                             
       });  

     });
   

    
    jQuery.validator.addMethod("validempname", function(value, element) {

        if ($('#report_user_id').val()=='')
            return false;
        else
            return true;    
}, "Please Select a Valid Employee Name");     

 jQuery.validator.addMethod("ordercheck", function(value, element) {

        if ($("#leave_approval" ).prop('checked')==true)
        {
           if ($('#order_no').val()=='') 
            return false;
            else
            return true;
        }
        else
            return true;    
}, "Please Select an Order Number");        

    
    
    $('#reportform').validate({
        
        rules:{
                    rname:"required",  
                    rname:"validempname", 
                    order_no:"ordercheck"                                                       
                    },
                messages:{                    
                   required:"Employee Name required", 
                   validempname:"Please Select a Valid Employee Name", 
                   ordercheck:"Please Select an order number"
                          },  
                    
                    submitHandler: function(form) 
                        {
                            $('#reportbutton').prop("disabled", true);
                            $('#reportbutton').val("Saving");                  
                            $(form).ajaxSubmit({
                                data:{empnumber:$('#empnumber').val()},
                                    
                            success: function(){
                                 $('#report_message').html('Supervisor/Subordinate information updated successfully')
                                 $('#reportalert').fadeIn();
                                 setTimeout(
                                 function(){
                                     
                                     $('#reportalert').fadeOut();
                                    $('#sub').trigger('click');
                                     $('#report_reset').trigger('click');
                                    $('#reportbutton').prop("disabled", '');
                                    $('#reportbutton').val("Save");  
                                      re_sub.fnDraw();
                                      re_sup.fnDraw();
                                 },3000
                                                
                                     );
                                     }  });
                       
                        
                        }
        
        
        
    });
    $('#reportbutton').click(function(){
                $('#reportform').submit();
              });
    
    
    
});