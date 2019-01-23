
var emp_id = "";
var count_resource = "";
var hardware_id = '';
var software_id = '';
var his_hardware_id = "";
var newsoft_validate = '';
var newhar_validate = '';

$(document).ready(function(){

  $('.close').click(function(){
    if (typeof newsoft_validate === 'object')
      newsoft_validate.resetForm();
    if (typeof newhar_validate === 'object')
      newhar_validate.resetForm();

  });

   hardware = $('#hardware_resource_table').dataTable({
      ajax:baseurl+"/index.php?r=Resource/Showhardwaredetails",
      "serverSide":true,
      "lengthChange":false,
      "searching":true,
      "oLanguage":{"sSearch":"Search:"},
      "iDisplayLength" : 10,
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3,4 ] }
       ]
   });
   software = $('#software_resource_table').dataTable({
       ajax:baseurl+"/index.php?r=Resource/Showsoftwaredetails",
       "serverSide":true,
      "lengthChange":false,
      "searching":true,
      "oLanguage":{"sSearch":"Search"},
      "iDisplayLength" : 10,
      "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3,4 ] }
       ]
   });
    
   $('#hardware_img').click(function(){

     $('#hardwareModalLabel').html("New Hardware Resources");
      $("#hard_serial").removeAttr("disabled");
     $('#hard_name').val("");
     $('#hard_make').val("");
     $('#hard_serial').val("");
     $('#hard_model').val("");
     $('#hard_remarks').val("");
     $('#hard_vendor').val("");
     $('#hard_warranty_year').val("");
     $('#hard_warranty_month').val("");
     $('#mac_address1').val("");
     $('#mac_address2').val("");
     $('#mac_address3').val("");
     $('#mac_address4').val("");
     $('#hard_pdate').val("");
     $('#hardware_btn').show();
     $('#hardware_update').hide();
     $('#hardware_modal').modal("show"); 

   });
    $('#software_img').click(function(){   

       $('#softwareModalLabel').html("New Software Resources");
        $("#soft_serial").removeAttr("disabled");
     $('#software_btn').prop('disabled',false);
     $('#software_btn').val("Save");
     $('#soft_name').val("");
     $('#soft_maker').val("");
     $('#soft_serial').val("");
     $('#soft_model').val("");
     $('#soft_remark').val("");
     $('#soft_vendor').val("");
     $('#soft_warranty_year').val("");
     $('#soft_warranty_month').val("");
     $('#soft_pdate').val("");
      $('#software_modal').modal("show");
      $('#software_btn').show();
      $('#software_update').hide();
   });
   $('#hard_pdate').datepicker();
   $('#soft_pdate').datepicker();
   
   
   
   
   
  newhar_validate =  $('#new_hardware').validate({
       rules:{
           hard_name:"required",
            hard_serial:"required",
           hard_make:"required",
          
           hard_pdate:"required"
       },
       messages:{
           hard_name:"Enter Hardware Name",
           hard_serial:"Enter Serial Number",
           hard_make:"Enter Maker Name",
           hard_pdate:"Enter Purchase Date"
       },
       submitHandler:function(form){
           $('#hardware_btn').prop("disabled",true);
           $('#hardware_btn').val("Saving...");
           $(form).ajaxSubmit({
             success: function(){
                 setTimeout(
                         function(){

                             $('#hardware_btn').prop('disabled',false);
                             $('#hardware_btn').val("Save");
                             $('#hard_name').val("");
                             $('#hard_serial').val("");
                             $('#hard_make').val("");
                             $('#hard_model').val("");
                             $('#hard_remarks').val("");
                             $('#hard_vendor').val("");
                             $('#hard_warranty_year').val("");
                             $('#hard_warranty_month').val("");
                             $('#hard_pdate').val("");
			     $('#mac_address1').val("");
			     $('#mac_address2').val("");
                             $('#mac_address3').val("");
			     $('#mac_address4').val("");		 	
				

                             $('#hardware_modal').modal("hide");
                             hardware.fnDraw();
                         },2000
                         );
             } 
          });
       }
   });
  newsoft_validate =  $('#new_software').validate({
      rules:{
        soft_name:"required",
         soft_serial:"required",
        soft_maker:"required",
        soft_pdate:"required"
      },
      messages:{
          soft_name:"Enter Software Name",
          soft_serial:"Enter Software Serial Number",
          soft_maker:"Enter Software Maker",
          soft_pdate:" Enter purchase Date"
      },
      submitHandler:function(form){
          $('#software_btn').prop("disabled",true);
          $('#software_btn').val("Saving...");
          $(form).ajaxSubmit({
             success: function(){
                 setTimeout(
                         function(){
                             $('#software_btn').prop('disabled',false);
                             $('#software_btn').val("Save");
                             $('#soft_name').val("");
                             $('#soft_maker').val("");
                             $('#soft_serial').val("");
                             $('#soft_model').val("");
                             $('#soft_remark').val("");
                             $('#soft_vendor').val("");
                             $('#soft_warranty_year').val("");
                             $('#soft_warranty_month').val("");
                             $('#soft_pdate').val("");
                             $('#software_modal').modal("hide");
                             software.fnDraw();
                         },2000
                         );
             } 
          });
      }
   });
   
   $('#hardware_allresources').on('click','.hardware_class',function(){

       hardware_id = $(this).attr('rel');
       $('#assign_hardware_modal').modal("show");       
   
   });
   
   $('#software_allresources').on('click','.software_class',function(){

       software_id = $(this).attr('rel');
       $('#assign_software_modal').modal("show");
   

   });



   $('#hardware_allresources').on('click','.hardware_history',function(){

       his_hardware_id = $(this).attr('rel');
       $('#history_hardware_modal tbody tr').remove();
       $('#history_hardware_modal').modal("show"); 
       
       $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/show_history",
            data:{resource_id:his_hardware_id,type:'h'}
          
          }).done(function(msg){
              //alert(msg);
                        
                       $('#history_hardware_modal tbody').append(msg);
          
          });

   
   });
   
   $('#software_allresources').on('click','.software_history',function(){

       var his_software_id = $(this).attr('rel');
       $('#history_software_modal tbody tr').remove();
       $('#history_software_modal').modal("show");
       
       
        $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/Software_history",
            data:{resource_id:his_software_id,type:'s'}
          
          }).done(function(msg){
          
                        $('#history_software_modal tbody').append(msg);      
          
          });

   

   });



   
   $('#hardware_allresources').on('click','.return_hardware',function(){
        
      if (confirm("Do you want to return the resource from the employee?"))
      {
          var del_id = $(this).attr('rel');
           $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/deleteResource",
            data:{resource_id:del_id,type:'h'}
          
          }).done(function(serial_id){
          
                hardware.fnDraw();                
          
          });


      }

   });

   $('#software_allresources').on('click','.return_software',function(){
        
      if (confirm("Do you want to return the resource from the employee?"))
      {
         var del_id = $(this).attr('rel');
           $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/deleteResource",
            data:{resource_id:del_id,type:'s'}
          
          }).done(function(serial_id){
          
                software.fnDraw();           
          
          });

        
      }

   });


   $('#hardware_allresources').on('click','.hardware_delete',function(){
        
      if (confirm("Do you want to remove the Hardware Resource?"))
      {
          var del_id = $(this).attr('rel');
           $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/RemoveHardware",
            data:{resource_id:del_id}
          
          }).done(function(serial_id){
          
                hardware.fnDraw();                
          
          });


      }

   });

   $('#software_allresources').on('click','.software_delete',function(){
        
      if (confirm("Do you want to remove the Software Resource?"))
      {
          var del_id = $(this).attr('rel');
           $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/RemoveSoftware",
            data:{resource_id:del_id}
          
          }).done(function(serial_id){
          
                software.fnDraw();                
          
          });


      }

   });
   
   
   
   
   $('#hard_emp_assign').autocomplete({
    source:baseurl+"/index.php?r=Resource/Search_hardware_employee",
    minLength:2,
    select:function(event,ui){
        emp_id = ui.item.employee_id;
        emp_num = ui.item.emp_number;
         //showhardare_serial();           
    }    
   });
   
   $('#soft_emp_assign').autocomplete({
      source:baseurl+"/index.php?r=Resource/Search_software_employee",
      minLength:2,
      select:function(event,ui){
          emp_id = ui.item.employee_id;
          emp_num = ui.item.emp_number;
          // showsoftware_serial();
      }
   });
   //$("#soft_emp_assign").css("z-index", "1100");
   
   function showhardare_serial()
        { 

          $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/Usercount",
            data:{empno:emp_num,type:'A'}
          
          }).done(function(serial_id){
          
            //$('#hard_serial_assign').val("A - "+emp_id+" - "+serial_id);        
          
          });

          
      
        }

  // });
   
       function showsoftware_serial()
        { 

          $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Resource/Usercount",
            data:{empno:emp_num,type:'B'}
          
          }).done(function(serial_id){
          
           // $('#soft_serial_assign').val("B - "+emp_id+" - "+serial_id);        
          
          });


      
        }
   
   $('#hardware_assign').validate({
    rules:{
        hard_emp_assign:"required",
       // hard_serial_assign:"required"
    },
    messages:{
        hard_emp_assign:"Select an employee",
       // hard_serial_assign:"Provide valid hardware serial number"
    },
    submitHandler:function(form){
        $('#hardware_assign_btn').prop("disabled",true);
        $('#hardware_assign_btn').val("Saving...");
        $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Resource/Assign_hardware",
           data:{"params":$(form).serialize(),employno:emp_num,hardware_id:hardware_id}
        }).done(function(msg){
                setTimeout(function(){
                    $('#hardware_assign_btn').prop("disabled",false);
                    $("#hardware_assign_btn").val("Save");
                    $('#hard_emp_assign').val("");
                  //  $('#hard_serial_assign').val("");
                    $('#assign_hardware_modal').modal('hide');
                },3000);
                hardware.fnDraw();            
        });
    }
   });
   
   $('#software_assign').validate({
      rules:{
          soft_emp_assign:"required",
        //  soft_serial_assign:"required"
      } ,
      messages:{
          soft_emp_assign:"Select an employee",
          //soft_serial_assign:"Provide valid software serial number"
      },
       submitHandler:function(form){
           $('#software_assign_btn').prop("disabled",true);
           $('#software_assign_btn').val("Saving...");
        $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Resource/Assign_software",
           data:{"params":$(form).serialize(),employno:emp_num,software_id:software_id}
        }).done(function(msg){
            setTimeout(function(){
                $('#software_assign_btn').prop('disabled',false);
                $('#software_assign_btn').val("Save");
                $('#soft_emp_assign').val("");
                //$('#soft_serial_assign').val("");
                $('#assign_software_modal').modal("hide");
            },3000);

            software.fnDraw();
            
        });
    }
   });
   
   
   $('#hardware_btn').click(function(){
      $('#new_hardware').submit();
   });
   $('#software_btn').click(function(){
      $('#new_software').submit(); 
   });
   $('#hardware_assign_btn').click(function(){
       $('#hardware_assign').submit();
   });
   $('#software_assign_btn').click(function(){
      $('#software_assign').submit(); 
   });
});
