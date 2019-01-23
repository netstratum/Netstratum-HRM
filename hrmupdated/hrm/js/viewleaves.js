var v = "";
var leaveid = "";
var lname = "";
var lmaxno = "";
var lprob = "";
var cus = "";
var custom_leaveid = '';
var myreport = '';
var lreport = '';
var holidaytab = '';
var atable = "";
var emp_leave_balance_da = "";
var cancel_leave_id = '';
var approve_leave_id = '';
var approval_status_text = '';
var leaveid_approve = ''; 
var leave_remarks = '';



//availableDates  = ["14-12-2014","16-12-2014"];
function available(date) {
  

  dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
  //console.log(dmy+' : '+($.inArray(dmy, availableDates)));
  if ($.inArray(dmy, availableDates) != -1 || availableDates=='') {
    return [true, "","Available"];
  } else {
    return [false,"","unAvailable"];
  }
}


$(document).ready(function(){

$.validator.addMethod(
        "customempno",
        function(value, element, regexp) {
           
            return $('#cus_emp').val();
        },
        "Enter Valid Employee name"
               
        
);


  atable = $('#adminleavebalancetable').dataTable({
    ajax: {
      "url":baseurl+"/index.php?r=Leave/Adminbalance",
      data: function ( d ) {
              
               d.emp_name = $('#emp_name').val();
               d.leave_year = $('#leave_year').val();
               d.emp_num = $('#emp_num').val();
              
               
            }

          },
     "serverSide": true,
      "lengthChange": true,
      "searching": true,
  });

  emp_leave_balance_da = $('#leavebalancetable').dataTable({
    ajax: baseurl+"/index.php?r=Leave/Empbalance",
     "serverSide": true,
      "lengthChange": true,
      "searching": true,
  });



   v = $('#leaves').dataTable({
       ajax: baseurl+"/index.php?r=Leave/Viewleaves",
      
        "serverSide": true,
      "lengthChange": true,
      "searching": true,
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 4 ] }
       ]
     // "searching": false
       
   });
 
$('#holidayform').validate({
  rules:{
    holidayname:"required",
    holidaydate:"required",
  },
  messages:{
    holidayname:"Enter holiday name",
    holidaydate:"Enter holiday date",
  },
submitHandler: function(form) 
                        {
                           
                            $('#holidaybtn').prop("disabled", true);
                            $('#holidaybtn').val("Saving...");                      
                            $(form).ajaxSubmit({
                                    
                            success: function(){
                               $('#assign_holiday_message').html('You have successfully added the holiday');
                               $('#assign_holiday').fadeIn();
                                 setTimeout(
                                 function(){   
                              $('#holidaybtn').prop("disabled", '');
                            $('#holidaybtn').val("Save");  
                               holidaytab.fnDraw();
                               $('#assign_holiday').fadeOut();
                              $('#holidayname').val("");    
                              $('#holidaydate').val("");    
                              $('#holidaytype').val(""); 
                            },3000
                            );

                            }  });
                       
                        
                        }

});

 $('#holidaybtn').click(function(){
                $('#holidayform').submit();
              });

 $('#holidaydate').datepicker({ changeYear: true});
     $('#dateofbirth').click(function(){
        $('.ui-datepicker-year').css( 'width','80px');

     });

  $('#otherleave').on('click','.assign',function(){

    
      
      $('#customleave').html($(this).attr('rel'));
      splitval = $(this).attr('id').split('~');
      $('#customleaveno').val(splitval[1]);
      custom_leaveid = splitval[0];
      $('#otherModal').modal();
   
    /*  $('#alertModal').css('width','50%');
      $('#alertModal').css('left','50%');
       $('#alertModal').css('top','20%');
      $('#alertModal').modal();

    */

  });

 $('#leaves').css('width','100%');
   cus = $('#othertable').dataTable({
       ajax: baseurl+"/index.php?r=Leave/Customviewleaves",
      
       "serverSide": true,
      "lengthChange": true,
        "searching": true,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3 ] }
       ]
   });
    
   myreport = $('#myreporttable').dataTable({
       ajax: {"url":baseurl+"/index.php?r=Leave/Myreport",
      data: function ( d ) {
               d.myleaveid = myleaveid;
               d.from = $('#datefrom_myreport').val();
               d.to = $('#dateto_myreport').val();
               d.leave_status = $('#leave_status_myreport').val();
               
            }
          },

       "serverSide": true,
       "lengthChange": true,
        "searching": true
   });   

if (user_role == 1 || user_role==2)
{
   lreport = $('#reporttable').dataTable({
       ajax: { "url":baseurl+"/index.php?r=Leave/Allreport",
        data: function ( d ) {
              d.myleaveid = myleaveid;
               d.from = $('#datefrom').val();
               d.to = $('#dateto').val();
               d.leave_status = $('#leave_status').val();
               
            }
          },
        "serverSide": true,
         
       "lengthChange": true,
        "searching": true,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 7 ] }
       ],

   });
}else{
lreport = $('#reporttable').dataTable({
       ajax: { "url":baseurl+"/index.php?r=Leave/Allreport",
        data: function ( d ) {
              d.myleaveid = myleaveid;
               d.from = $('#datefrom').val();
               d.to = $('#dateto').val();
               d.leave_status = $('#leave_status').val();
               
            }
          },
        "serverSide": true,
         
       "lengthChange": true,
        "searching": true,
        

   });


}

    holidaytab = $('#holidaytable').dataTable({
       ajax: baseurl+"/index.php?r=holiday/ListHoliday",
        "serverSide": true,
       "lengthChange": true,
        "searching": true,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3 ] }
       ]
   });

    $('#addholiday').on('click','.holidayemove',function(){


       $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Holiday/DeleteHoliday",
         data:{hol_id:$(this).attr('rel')}
       }).done(function()
       {
           
           holidaytab.fnDraw();
                             
       });  

     });
   

    $('#oholiday').validate({
  rules:{
    suggemp:{
          required:true,
          customempno:true,
                            },
    customleaveno:"required",
    customempno:true
  },
  messages:{
    suggemp:"Enter Valid Employee name",

    customleaveno:"Enter Leave Number",
  },
submitHandler: function(form) 
 {
           
            $('#custombtn').prop("disabled", true);
            $('#custombtn').val("Saving...");               
                                              
        $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Leave/CustomUpdateleave",
         data:{customleaveid:custom_leaveid,employid:$('#cus_emp').val(),custom_leave_no:$('#customleaveno').val()}
       }).done(function(msg)
       {

        
        $('#assign_custom_message').html('You have assigned the custom leave(s) successfully');                                                    
        $('#assign_custom').fadeIn();
         setTimeout(
                                 function(){ 
            $('#custombtn').prop("disabled", '');
            $('#custombtn').val("Save");   
           $('#cus_emp').val('');
           $('#suggemp').val('');
            $('#assign_custom').fadeOut();
           $('#otherModal').modal("hide");  
           cus.fnDraw();
         },3000                                                
                                     );
                             
       });  
                       
                        
                        }

});

$('#datefrom,#dateto,#leave_status').change(function(){

  lreport.fnDraw();

});

$('#emp_name,#leave_year').change(function(){

  atable.fnDraw();

});

 


$('#datefrom_myreport,#dateto_myreport,#leave_status_myreport').change(function(){

  myreport.fnDraw();

});

   $('#custombtn').click(function() {

       $('#oholiday').submit();

       

   });

      
   $('#leaves').on('click','.editleave',function()
    { 
       $('#loading-image').fadeIn(); 
      
       $('#editmyModal').modal("show");  
        leaveid = $(this).attr("rel");
       
                
       

       $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Leave/Editleave",
            data:{leaveid:$(this).attr("rel")}
            
       }).done(function(msg)
       {  
          
           var dataval = JSON.parse(msg);
           $('#editleavename').val(dataval.name);
           $('#editleavemax').val(dataval.leave_max_no);
           $('#edit_expiry_date').val(dataval.expiry_date);
           $('#editleaveprobation').val(dataval.probation_period);
           
      
            $('#popupbody').show();
            $('#loading-image').hide();  
           v.fnDraw();
       });                    
       
    });
    

   $('#leaves').on('click','.customleave_remove',function(){

      leaveid = $(this).attr("rel");
      $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Leave/Deleteleave",
            data:{leaveid:$(this).attr("rel")}
            
       }).done(function(msg)
       {  
          v.fnDraw();
           
       });


   });
    
    $('#editpopupbtn').click(function()
    {  
        var lname = $('#editleavename').val();
        var lmaxno = $('#editleavemax').val();
        var lprob = $('#editleaveprobation').val();
        var lexpdate = $('#edit_expiry_date').val();
    //alert(leaveid);
        
     $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Leave/Updateleave",
         data:{leaveid:leaveid,lname:lname,lmaxno:lmaxno,lprob:lprob,lexpdate:lexpdate}
       }).done(function(msg)
       {
           
          
//           $('#leaveform').html(msg);             
             $('#editleavealert').fadeIn();
                                 setTimeout(
                                 function(){                                     
                                     $('#editleavealert').fadeOut();
                                 },3000                                                
                                     );  
                             v.fnDraw();
                             
       });  
       $('#editmyModal').modal("hide");
    });
    
    
     setTimeout(
                                 function(){                                     
                                     $('#ui-id-2').css('z-index','1000000');
                                 },3000                                                
                                     );

    $('#suggemp').autocomplete({
                source:baseurl+"/index.php?r=Leave/Employeelist",
                minLength: 2,
                select:function( event, ui ) {                        
                        $('#cus_emp').val(ui.item.id);
                    }
    });

    $('#emp_name').autocomplete({
                source:baseurl+"/index.php?r=Leave/Employeelist",
                minLength: 2,
                select:function( event, ui ) {                        
                        $('#emp_num').val(ui.item.id);
                          atable.fnDraw();
                    }
    });




    $('#lreport').on('change','.approve',function(){

       $('#leaveApprove').modal();
        approve_leave_id = $(this).attr('id');
        var title = $(this).val().charAt(0).toUpperCase()+ $(this).val().slice(1);
        approval_status_text = $(this).val();
        $('#leaveApprove_head').html(title+' Leave');
        $('#approvepopupbtn').val(title+' Leave');
        

       $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Leave/Approve_show",
         data:{leaveid:$(this).attr('id'),approve_type:$(this).val()}
       }).done(function(msg)
       {
            var dataval = JSON.parse(msg);

           $('#approve_leave_id').val(approve_leave_id);
           $('#approve_leave_type').html(dataval.name);
           $('#approve_leave_date').html(dataval.start_date+" - "+dataval.end_date);                       
             leaveid_approve = $('#approve_leave_id').val();   
               
                       
           lreport.fnDraw();
                             
       }); 



    });





$('#approvepopupbtn').click(function(){

        $('#leaveApproveform').submit();

     });

     $('#leaveApproveform').validate({
    
submitHandler: function(form) 
                        {
               leave_remarks = $('#leave_approve_text').val();                              
         $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Leave/Approve",
         data:{'leaveid':leaveid_approve,'leave_approve_text':leave_remarks,'approve_type':approval_status_text}
       }).done(function(msg){


       

                      $('#approvepopupbtn').val('Updating...');
                        $('#approvepopupbtn').prop("disabled", true);
                          
                          if (approval_status_text =='approve')
                            var approve_msg = 'Approved';
                          else
                            var approve_msg = 'Rejected';

                          $('#approve_message').html('You have '+approve_msg+' the leave successfully'); 
                        $('#leaveapprovealert').fadeIn(); 
                         setTimeout(
                                 function(){ 
                                 
                              $('#approvepopupbtn').prop("disabled", '');
                                  lreport.fnDraw();
                               $('#approvereset').trigger('click');
                               $('#leaveApprove').modal('hide');
                               $('#leaveapprovealert').fadeOut(); 
                                if (approval_status_text == 'approve')
                                    $('#approvepopupbtn').val('Approve Leave');
                                  else
                                    $('#approvepopupbtn').val('Reject Leave');

                                 },3000);
                               
                                 
                            }); 
                       
                        
                        }

});




     $('#myleave').on('change','.cancel',function(){

        $('#leaveCancel').modal();
        cancel_leave_id = $(this).attr('id');
       $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Leave/Cancel_show",
         data:{leaveid:$(this).attr('id')}
       }).done(function(msg)
       {
           var dataval = JSON.parse(msg);

           $('#cancel_leave_id').val(cancel_leave_id);
           $('#cancel_leave_type').html(dataval.name);
           $('#cancel_leave_date').html(dataval.start_date+" - "+dataval.end_date);                       

           myreport.fnDraw();
                             
       }); 

       

    });

     $('#cancelpopupbtn').click(function(){

        $('#leavecancelform').submit();

     });

     $('#leavecancelform').validate({
  rules:{
    leave_cancel:"required",
   
  },
  messages:{
    leave_cancel:"Enter Reason",
  
  },
submitHandler: function(form) 
                        {
                            
                          $('#cancelpopupbtn').val('Canceling...');
                           $('#cancelpopupbtn').prop("disabled", true);
                            $(form).ajaxSubmit({
                                    
                            success: function(){
                              
                               $('#leave_cancel_message').html('You have successfully cancelled the leave'); 
                               $('#leavecancelalert').fadeIn(); 
                              
                               setTimeout(
                                 function(){  
                                 $('#cancelpopupbtn').val('Cancel Leave');
                           $('#cancelpopupbtn').prop("disabled", ''); 
                                  $('#leavecancelalert').fadeOut(); 
                                  myreport.fnDraw();
                               $('#cancelreset').trigger('click');
                               $('#leaveCancel').modal('hide');
                                   
                               },3000);


                               
                                 
                            }  });
                       
                        
                        }

});

    $('#datefrom').datepicker({ });
    $('#dateto').datepicker({ });
    $('#datefrom_myreport').datepicker({ });
    $('#dateto_myreport').datepicker({ });



  $('#lreport').on('click','[data-toggle="popover"]',function(){
 $('[data-toggle="popover"]').popover({
        placement : 'top'
    });});


});


