var from_date_mand="";
var balance_expt = 0;
$(document).ready(function(){
    
    $("#fromleave").datepicker({   
    minDate:0,  
    beforeShowDay: available,     
    onSelect:function(selected){
        $('#toleave').datepicker("option","minDate", selected);
 	from_date_mand = $("#fromleave").val();
        }        
    });        
    
    $("#toleave").datepicker({   
     onSelect: function(selected) {
         $("#fromleave").datepicker("option","maxDate", selected);
        }
    });
            
    $('#fromtime,#totime').change(function () {
        var ftime = parseInt($('#fromtime option:selected').val());
        var ttime = parseInt($('#totime option:selected').val());
        var dtime = ttime-ftime;
        if(dtime>=0)
            $('#duration').val(dtime);
        else
            $('#duration').val(0);        
    });
    
    $('#endfrom,#endto').change(function () {
        var endf = parseInt($('#endfrom option:selected').val());
        var endt = parseInt($('#endto option:selected').val());
        var dend = endt-endf;
        if(dend>=0)
            $('#endduration').val(dend);
        else
            $('#endduration').val(0);
        
    });
    
    $('#leavetype').change(function()
    {
    if($('#leavetype').val()>0)
        $('#leavebalance').show();
    else 
        $('#leavebalance').hide();
    });
    
    $('#leavetype').change(function()            
    {
        var ltype = $('#leavetype option:selected').val();
	
	
	if ($.trim($('#leavetype option:selected').text()) == 'Work From Home (WFH)')
{
 // $('#leavebalance').hide();
balance_expt = 0;		
//return false;

}else{
balance_expt = 0;
}
        
        if(ltype==="")
            return false;
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Leave/Leavetype",
            data:{ leavetype: ltype}                       
        })
             .done(function(msg) {
                            
                           getvalues = msg.split('|'); 

                           $('#lbalance').val(getvalues[0]);
                       if (getvalues[1]!=''){
                           
                           aldates = getvalues[1].split(',');
                           availableDates= [];
                           for (i=0; i<aldates.length; i++)
                           {

                               
                                  //  availableDates.push('"'+aldates[i]+'"');
                              

                           }

                       
                          


                        }
                       });
           
    });
    
    
    $('#pdays').change(function()
     {  
        if($('#pdays').val()==1){
            $('#sday').show();
            $('#endday').val("");
             $('#startday').val("");
             $('#specific').hide(); 
              $('#endspecific').hide();  
            $('#eday').hide();
        }
        else if($('#pdays').val()==2){
            $('#eday').show();
            $('#startday').val("");
             $('#endday').val("");
             $('#specific').hide(); 
              $('#endspecific').hide();  
            $('#sday').hide();
        }
        else if($('#pdays').val()==3){
            $('#sday').show();
            $('#startday').val("");
            $('#endday').val("");
            $('#eday').show();
               $('#endspecific').hide(); 
                  $('#specific').hide(); 
        }
        else{
            $('#eday').hide();
            $('#sday').hide();
            }
    });
    
    $('#startday').change(function()
    {
        if($('#startday').val()==3){
            $('#specific').show();
            
           }
         else
             $('#specific').hide();                          
    });
    
    $('#endday').change(function()
    {
        if($('#endday').val()==3){
            $('#endspecific').show();   
            
        }
        else
            $('#endspecific').hide();            
        
    });
    
    
    
    $.validator.addMethod('greaterThan', function(value, element, param) {
    var i = parseInt($('#fromtime').val());
    var j = parseInt($('#totime').val());    
    
   if( i <= j)
    return true;
   else 
    return false;
}, "");

    $.validator.addMethod('greaterThan', function(value, element, param) {
    var k = parseInt($('#endfrom').val());
    var l = parseInt($('#endto').val());    
    
   if( k <= l)
    return true;
   else 
    return false;
}, "");


    
    $('#rleave').validate({
        
        rules:{
            leavetype:"required",
            fromleave:"required",
            toleave:"required",
            totime:"greaterThan",
            endto:"greaterThan",
        },
        messages:{
            leavetype:"Select a leave category",
            fromleave:"Select from date",
            toleave:"Select to date",
            totime:"",
            endto:"",            
        },
        submitHandler: function(form) 
                        {   
		if (from_date_mand !=$("#fromleave").val())
		{

			$('#req_alert').html('Please Select a Date from Date Picker');   
			$('#reqalert').fadeIn(); 
			return false;
		}
                       $('#reqbutton').prop("disabled", true);
                       $('#reqbutton').val("Saving...");
                          
                            $(form).ajaxSubmit({ 
                data:{'leave_balance':$('#lbalance').val(),'balance_expt':balance_expt},                                                       
                            success: function(msg){ 
                              $('#req_alert').css("color", "#468847");
			     if (msg == 'expiry_error'){
				 $('#req_alert').css("color", "red");
				 $('#req_alert').html('Your selected leave type has been expired, Please select a different leave type.');   
                                  $('#reqalert').fadeIn(); 
                                 setTimeout(
                                 function(){   
                                   
                                    // business logic...
   $('#reqbutton').prop("disabled", false);
   $('#reqbutton').val("Apply");   
                                                    
                                     
                                 },3000                                                
                                     );

                             }else if (msg == 'balance_error')
                              { $('#req_alert').css("color", "red");
                                 $('#req_alert').html('Leave applied exceeds leave balance');   
                                  $('#reqalert').fadeIn(); 
                                 setTimeout(
                                 function(){   
                                   
                                    // business logic...
   $('#reqbutton').prop("disabled", false);
   $('#reqbutton').val("Apply");   
                                                    
                                     
                                 },3000                                                
                                     );

                              } else if (msg == 'holiday_error')
                              { $('#req_alert').css("color", "red");
                                $('#req_alert').html('Select any other date than holiday'); 
                                 $('#reqalert').fadeIn();
                                 setTimeout(
                                 function(){   
                                       // business logic...
    $('#reqbutton').prop("disabled", false);
   $('#reqbutton').val("Apply");   
    // $('#rleave').reset();                           
                                     
                                 },3000                                                
                                     );


                              } else{                                                        
                                
                                 $('#req_alert').html('Successfully applied for the leave'); 
                                  $('#reqalert').fadeIn();
                                 setTimeout(
                                 function(){                                     
                                     $('#reqalert').fadeOut();
                                   $('#reqbutton').prop("disabled", false);
                                    $('#reqbutton').val("Apply");  
                                    $('#req_discard').trigger('click');
                                 },3000                                                
                                     );
                               }
                                     }  });                                               
                        }                        
    });
    $('#reqbutton').click(function(){
                $('#rleave').submit();
              });
});
