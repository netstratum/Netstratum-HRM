var hard_id = "";
var soft_id = "";
$(document).ready(function(){
    
    $('#hardware_allresources').on('click','.hardware_edit',function(){
    
    $('#hardwareModalLabel').html("Update Hardware Resources");

    $('#hardware_modal').modal("show");
    $('#hardware_update').show();
    $('#hardware_btn').hide();
        hard_id = $(this).attr("rel");
        $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Resource/EditHardwares",
           data:{hard_id:hard_id}
        }).done(function(msg){
            
            var edithard = JSON.parse(msg);
            
            $('#hard_warranty_year').val("");
            $('#hard_warranty_month').val("");
            $('#hard_serial').val(edithard.serial_no);
            $('#hard_name').val(edithard.resource_name);
             $("#hard_serial").attr("disabled", "disabled"); 
            $('#hard_make').val(edithard.make);
            $('#hard_model').val(edithard.model);
            $('#hard_remarks').val(edithard.remarks);
            $('#hard_vendor').val(edithard.vendor_details);
            $('#hard_pdate').val(edithard.purchase_date);

	    $('#mac_address1').val(edithard.macaddress1);
	    $('#mac_address2').val(edithard.macaddress2);
            $('#mac_address3').val(edithard.macaddress3);
            $('#mac_address4').val(edithard.macaddress4);


            //$('#hardware_modal').modal("hide");
        });
   });
   $('#software_allresources').on('click','.software_edit',function(){
      $('#softwareModalLabel').html("Update Software Resources");
      $('#software_modal').modal("show");
      $('#software_update').show();
      $('#software_btn').hide();
      soft_id = $(this).attr("rel");
      $.ajax({
          type:"POST",
          url:baseurl+"/index.php?r=Resource/EditSoftwares",
          data:{soft_id:soft_id}
      }).done(function(msg){
          var editsoft = JSON.parse(msg);
          
          $('#soft_warranty_year').val("");
          $('#soft_warranty_month').val("");
          $('#soft_name').val(editsoft.resource_name);
          $('#soft_maker').val(editsoft.make);
          $('#soft_serial').val(editsoft.serial_no);
          $("#soft_serial").attr("disabled", "disabled"); 
          //$('#soft_serial').css();
          $('#soft_model').val(editsoft.model);
          $('#soft_remark').val(editsoft.remarks);
          $('#soft_vendor').val(editsoft.vendor_details);
          $('#soft_pdate').val(editsoft.purchase_date);
      });
       
   });
   
   $('#software_update').click(function(){
       $('#software_update').prop("disabled",true);
       $('#software_update').val("Updating...");
      var softname = $('#soft_name').val();
      var softmaker = $('#soft_maker').val();
      var softmodel = $('#soft_model').val();
      var softremark = $('#soft_remark').val();
      var softvendor = $('#soft_vendor').val();
      var softdate = $('#soft_pdate').val();
      var softyear = $('#soft_warranty_year').val();
      var softmonth = $('#soft_warranty_month').val();
      $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Resource/Updatesoftware",         
         data:{soft_id:soft_id,softname:softname,softmaker:softmaker,softmodel:softmodel,softremark:softremark,softvendor:softvendor,softdate:softdate,softyear:softyear,softmonth:softmonth}
      }).done(function(msg){
          setTimeout(function(){
              $('#software_update').prop("disabled",false);
              $('#software_update').val("Update");
              $('#software_modal').modal("hide");
          },3000);
          software.fnDraw();
      });
   });
   
   $('#hardware_update').click(function(){
      $('#hardware_update').prop("disabled",true);
      $('#hardware_update').val("Updating...");
      var hardname = $('#hard_name').val();
      var hardmaker = $('#hard_make').val();
      var hardmodel = $('#hard_model').val();
      var hardremark = $('#hard_remarks').val();
      var hardvendor = $('#hard_vendor').val();
      var harddate = $('#hard_pdate').val();
      var mac_address1 = $('#mac_address1').val();
      var mac_address2 = $('#mac_address2').val();
      var mac_address3 = $('#mac_address3').val();
      var mac_address4 = $('#mac_address4').val();
      var warryear = $('#hard_warranty_year').val();
      var warrmonth = $('#hard_warranty_month').val();
      $.ajax({
         type:"POST",
         url:baseurl+"/index.php?r=Resource/Updatehardware",
         data:{hard_id:hard_id,hardname:hardname,hardmaker:hardmaker,hardmodel:hardmodel,hardremark:hardremark,hardvendor:hardvendor,harddate:harddate,warryear:warryear,warrmonth:warrmonth,mac_address1:mac_address1,mac_address2:mac_address2,mac_address3:mac_address3,mac_address4:mac_address4}
      }).done(function(msg){
          setTimeout(function(){
              $('#hardware_update').prop("disabled",false);
              $('#hardware_update').val("Update");
             $('#hardware_modal').modal("hide");
          },3000
                  );
           hardware.fnDraw();
           
      });
      
   });
   
});
