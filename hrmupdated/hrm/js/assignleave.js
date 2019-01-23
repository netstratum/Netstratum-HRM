var empnoo = "";
$(document).ready(function(){
    
 $("#assfromleave").datepicker({          
    onSelect:function(selected){
        $('#asstoleave').datepicker("option","minDate", selected);
        }        
    });        
    
    $("#asstoleave").datepicker({   
     onSelect: function(selected) {
         $("#assfromleave").datepicker("option","maxDate", selected);
        }
    });

$('#assleave').validate({
        rules:{
            assiemp:"required",
            assileavetype:"required",
            assfromleave:"required",
            asstoleave:"required",
            asstotime:"greaterThan",
            assendto:"greaterThan"
        },
        messages:{
            assiemp:"Provide an employee name",
            assileavetype:"Select a leave category",
            assfromleave:"Select from date",
            asstoleave:"Select to date",
            asstotime:"",
            assendto:""
        },
         submitHandler: function(form) 
                        {         

                            
                             $('#assibutton').prop("disabled", true);
                            $('#assibutton').val("Saving...");        

                            $(form).ajaxSubmit({                                                        
                            success: function(data){  
                                 if (data =='holiday_error'){

                                    
                                    $('#assign_error_message').html('Please select some other dates');                                                       
                                    $('#assierror').fadeIn();

                                 }else{
                                 
                                    $('#assign_message').html('You have successfully assigned the leave');                                                       
                                    $('#assialert').fadeIn();

                                 
                                 }
                                 setTimeout(
                                 function(){                                     
                                     $('#assialert').fadeOut();
                                     $('#assierror').fadeOut();
                                     if (data !='holiday_error')
                                     $('#assignreset').trigger('click');
                                        $('#assibutton').prop("disabled", '');
                                         $('#assibutton').val("Save");        
                                 },3000                                                
                                     );
                                     }  });                                               
                        }  
    });
    $('#asspdays').change(function()
     {  
        if($('#asspdays').val()==1){
            $('#assisday').show();
            $('#asseday').hide();
        }
        else if($('#asspdays').val()==2){
            $('#asseday').show();
            $('#assisday').hide();
        }
        else if($('#asspdays').val()==3){
            $('#assisday').show();
            $('#asseday').show();
        }
        else{
            $('#asseday').hide();
            $('#assisday').hide();
            }
    });
    $('#assfromtime,#asstotime').change(function () {
        var assftime = parseInt($('#assfromtime option:selected').val());
        var assttime = parseInt($('#asstotime option:selected').val());
        var assdtime = assttime-assftime;
        if(assdtime>=0)
            $('#assduration').val(assdtime);
        else
            $('#assduration').val(0);
        
    });
    
    $('#assendfrom,#assendto').change(function () {
        var assendf = parseInt($('#assendfrom option:selected').val());
        var assendt = parseInt($('#assendto option:selected').val());
        var assdend = assendt-assendf;
        if(assdend>=0)
            $('#assendduration').val(assdend);
        else
            $('#assendduration').val(0);
        
    });
    
    $('#leavelist').on('change','#assileavetype',function(){

        if($(this).val()>0)                 
            $('#asslbalance').show();    
        else 
            $('#asslbalance').hide();
        var assltype = $(this).val();
        if(assltype==="")
            return false;
        jQuery.ajax({
                    type:"POST",
                    url:baseurl+"/index.php?r=Leave/Assignforbalance",
                    data:{assleavetype: assltype,empnum:empnoo}
                    }).done(function(msg) {
                                            balvalues = msg.split('|');
                                           $('#albalance').val(balvalues[0]);
                                           if (balvalues[1]!=''){
                                                   balance = balvalues[1].split(',');
                                                   availableDates= [];
                                                   for (i=0; i<balance.length; i++)
                                                   {
                                                      availableDates.push('"'+balance[i]+'"');                              
                                                   }
                                                }
                    });
                        
    });
    
    $('#assiemp').autocomplete({
                source:baseurl+"/index.php?r=Leave/Employeelist",
                minLength: 2,
                select:function( event, ui ) {
                        //ui.item.id;
                        $('#emp_id').val(ui.item.id);
			empnoo = ui.item.id;
                        if($('#assiemp').val()!=0)
            $('#assleavetype').show();
        else
            $('#assleavetype').hide();
        
        
        var eno = $('#emp_id').val();
        if(eno==="")
            return false;
        
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Leave/AssLeavetype",
            data:{assiempleave:eno}
        }).done(function(msg){                            
                           $('#leavelist').html(msg);                
                            });

                    }
    });
    
    $('#assiemp').change(function(){
        
        
        
    });
    
    $('#assileavetype').change(function()            
    {
        var assltype = $('#assileavetype option:selected').val();
        if(assltype=="")
            return false;
                
        
        
        $.ajax({
            type:"POST",
            url:baseurl+"/index.php?r=Leave/Assignleavetype",
            data:{ assleavetype: assltype}                       
        })
             .done(function(msg) {                            
                           $('#albalance').val(msg);                
                            });
           
    });
    
    
    
    
    
    $('#assistartday').change(function()
    {
        if($('#assistartday').val()==3){
            $('#assispecific').show();
           }
         else
             $('#assispecific').hide();                          
    });
    
    $('#assendday').change(function()
    {
        if($('#assendday').val()==3){
            $('#assendspecific').show();            
        }
        else
            $('#assendspecific').hide();            
        
    });
    
    $('#assibutton').click(function(){
                $('#assleave').submit();
              });                          
});
