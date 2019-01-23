var empnoo = "";
var rewardempno = 0;
var rewardemname = '';
var pointsConsumed = false;
var rewardlistempno = 0;
var peer_employeenamelist = 0;
var rewardatable = {};
var peerdatable = {};
var peerempno = '';
var peeremname = '';
$(document).ready(function(){

    $('#redeem_reward').click(function(){

      if (confirm("Do you want to redeem points?"))
      {
          $.ajax({
          
            type:"POST",
            url:baseurl+"/index.php?r=Reward/RedeemPoints",
            data:{total_points:total_points}
          
          }).done(function(serial_id){
            $('#redeemDiv').css('color','green');
            $('#redeemDiv').html('You have Redeemed the points!!!')
            rewardatable.fnDraw();                
          
          });


      }

    });

    $(document).on('change', '#datefromReward,#datetoReward', function (e) {
        rewardatable.fnDraw();
    });


    $(document).on('change', '#peer_datefrom,#peer_dateto,#peer_employeename', function (e) {
       
        peerdatable.fnDraw();
    });



    $("#datefromReward").datepicker({  
          
    onSelect:function(selected){
        $('#datetoReward').datepicker("option","minDate", selected);
        rewardatable.fnDraw();
        }        
    });  
    
    $("#peer_datefrom").datepicker({  
          
        onSelect:function(selected){
            $('#peer_dateto').datepicker("option","minDate", selected);
            peerdatable.fnDraw();
            }        
    });  

    $("#peer_dateto").datepicker({  
          
        onSelect:function(selected){
            $('#peer_datefrom').datepicker("option","maxDate", selected);
             peerdatable.fnDraw();
            }        
    });  
    

 $("#datetoReward").datepicker({   
     onSelect: function(selected) {
         $("#datefromReward").datepicker("option","maxDate", selected);
         rewardatable.fnDraw();
        }
    });

$('#recognitionaddform').validate({
        rules:{
            rewardcoworker:"required",
            awardpoints:"required",
            awardrecognizedfor:"required",
            awardmessage:"required"
        },
        messages:{
            rewardcoworker:"Provide an employee name",
            awardpoints:"Please Select Points"
            
            
        },
         submitHandler: function(form) 
                        {   
                            $('#assierrorreward').hide();      
                            var empname = $('#rewardcoworker').val();
                            
                            if (rewardempno == '' || rewardemname!=empname){
                               
                                $('#assierrorreward').show();
                                $('#assign_reward_error_message').html('Please select an employee');  
                                                                                   
                                
                                return true;
                            }
                            if (pointsConsumed == true) {
                                $('#assierrorreward').show();
                                $('#assign_reward_error_message').html('Consumed all the points for this employee');                                                       
                               
                                return true;
                            }
                            $('#assinRewardbutton').prop("disabled", true);
                            $('#assinRewardbutton').val("Assigning...");        

                            $(form).ajaxSubmit({ 
                             data: { emp_number: rewardempno},                                                   
                            success: function(data){  
                                $('#assialertreward').show();
                                $('#assignrewardreset').trigger('click');
                                $('#assinRewardbutton').prop("disabled", '');
                                $('#assinRewardbutton').val("Assign");
                                 setTimeout(
                                 function(){                                     
                                        $('#assialertreward').hide();
                                               
                                 },3000                                                
                                     );
                                     }  });                                               
                        }  
    });

    $('#assinRewardbutton').click(function(){
        $('#recognitionaddform').submit();
    });
    

    //

 // reward list table
  rewardatable = $('#reporttableReward').dataTable({
    ajax: {
      "url":baseurl+"/index.php?r=Reward/RewardDatalist",
      data: function ( d ) {
              
               d.start_date = $('#datefromReward').val();
               d.end_date = $('#datetoReward').val();
               d.emp_num = rewardlistempno;
              
               
            }

          },
     "serverSide": true,
      "lengthChange": true,
      "searching": false,
      "bFilter": false,
  });


  // peer list table
  peerdatable = $('#peerdatable').dataTable({
    ajax: {
      "url":baseurl+"/index.php?r=Reward/PeerDatalist",
      data: function ( d ) {
              
               d.start_date = $('#peer_datefrom').val();
               d.end_date = $('#peer_dateto').val();
               d.emp_num = peer_employeenamelist;
              
               
            }

          },
     "serverSide": true,
      "lengthChange": true,
      "searching": false,
      "bFilter": false,
  });

  





    $('#assignrewardreset').click(function(){
        $('#recognitionaddform')[0].reset();
    });
    
    
    
    $('#peer_employeename').autocomplete({
        source:baseurl+"/index.php?r=Reward/sublistPeer",
        minLength: 2,
        select:function( event, ui ) {
            peer_employeenamelist = ui.item.id;
            peerdatable.fnDraw();
        },
        response: function( event, ui ) {
            if (ui.content.length==0)
            {
                peer_employeenamelist = 0;
                
               
            }
            peerdatable.fnDraw();
            return ui;

        }

    });


    $('#reward_employeename').autocomplete({
        source:baseurl+"/index.php?r=Reward/sublist",
        minLength: 2,
        select:function( event, ui ) {
            rewardlistempno = ui.item.id;
            rewardatable.fnDraw();
        },
        response: function( event, ui ) {
            if (ui.content.length==0)
            {
                rewardlistempno = 0;
            }
            return ui;

        }

    });

    // Rewardcoworker add form suggestion


    $('#peercoworker').autocomplete({
        source:baseurl+"/index.php?r=Reward/sublistPeer",
        minLength: 2,
        select:function( event, ui ) {
                //ui.item.id;
            peerempno = ui.item.id;
            peeremname = ui.item.label;                             
        }
});




    $('#rewardcoworker').autocomplete({
        source:baseurl+"/index.php?r=Reward/sublist",
        minLength: 2,
        select:function( event, ui ) {
                //ui.item.id;
            rewardempno = ui.item.id;
            rewardemname = ui.item.label;
              


      $.ajax({
       type:"POST",
       url:baseurl+"/index.php?r=Reward/getSubRemaining",
       data:{empid:rewardempno}
     }).done(function(points){                            
            $('#pointsinyourkitty').val(points);      
            if (points==0)
                pointsConsumed = true;
            else
                pointsConsumed = false;
            var output = [];
            if (points==1000) {                      
                  output = ['<option value="">--Select--</option>',
                             '<option value="250">250</option>',
                            '<option value="500">500</option>',
                            '<option value="750">750</option>',
                            '<option value="1000">1000</option>'];
            }else if (points==750) {
                output = ['<option value="">--Select--</option>',
                '<option value="250">250</option>',
                '<option value="500">500</option>',
                '<option value="750">750</option>'];  
            }else if (points==500) {
                output = ['<option value="">--Select--</option>',
                '<option value="250">250</option>',
                '<option value="500">500</option>'
                ];  
            }else if (points==250) {
                output = ['<option value="">--Select--</option>',
                '<option value="250">250</option>'
                
                ];  
            }else {
                output = ['<option value="">--Select--</option>'];  
            }
            
            $('#awardpoints').html(output.join(''));

     });

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



    //peer list

    $('#peersubmit').click(function(){
        $('#peerform').submit();
    });
    
    $('#peerform').validate({
        rules:{
            peercoworker:"required",
            peerrecognizedfor:"required",
            peermessage:"required"
        },
        messages:{
            peercoworker:"Provide an employee name",
                       
            
        },
         submitHandler: function(form) 
                        {   
                            $('#peererror').hide();
                            var empname = $('#peercoworker').val();
                            
                            if (peerempno == '' || peeremname!=empname){
                               
                                $('#peererror').show();
                                $('#peer_error_message').html('Please select an employee');  
                                return true;
                            }
                            
                            $('#peersubmit').prop("disabled", true);
                            $('#peersubmit').val("Sending...");        

                            $(form).ajaxSubmit({ 
                             data: { emp_number: peerempno},                                                   
                            success: function(data){  
                                $('#peeralert').show();
                                $('#peerreset').trigger('click');
                                $('#peersubmit').prop("disabled", '');
                                $('#peersubmit').val("Send");
                                 setTimeout(
                                 function(){                                     
                                        $('#peeralert').hide();
                                               
                                 },3000                                                
                                     );
                                     }  });                                               
                        }  
    });


    
                              
});