var m = "";
var mailid = "";
var tadata = "";
var dis = "";
$(document).ready(function(){
  tadata =  $('#temptable').dataTable({
        "lengthChange": false,
        "searching": false,
        "paging": false,
        "info": false,
        "ordering": false,
         "aoColumns": [
      { "sWidth": "25%" }, // 1st column width 
      { "sWidth": "75%" }, // 2nd column width 
      
        ]
   });
   
   
   
   m = $('#emailtable').dataTable({
       ajax: baseurl+"/index.php?r=Manageuser/Allmail",
      
      "serverSide": true,
       "lengthChange": true,
        "searching": true,
        "aoColumnDefs": [
         
            { 'bSortable': false, 'aTargets': [ 3 ] }
       ],
   });
   
   $('#content').on('click','.editemail',function()
   {
       $('#mailModal').modal("show");
       $('#maileditor').show();       
       mailid = $(this).attr("rel");
       
       $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Manageuser/Editemail",
           data:{mailid:$(this).attr("rel")}
       }).done(function(msg)
       {
            var dataval = JSON.parse(msg);
          
            $('#frommail').val(dataval.from_address);
            $('#bccmail').val(dataval.mail_bcc);
             $('#subjectmail').val(dataval.subject);
            CKEDITOR.instances['ck'].setData(dataval.mail_content);
            ///CKEDITOR.instances.ck.insertText(dataval.mail_content);
           // $('#ck').val(dataval.mail_content);
            arr = dataval.dynamic_variable.split('|');
            if(arr.length>0 ){
                tadata.fnClearTable();
                arr.forEach(function(data)
                {
                     displaydata = data.split('~');
                   adddata(displaydata);
                   
                });
            dis = 1;
            }
            
            $('#maileditor').show();
            
       });
   });
   
   
   $('#mailbtn').click(function()
   {
      var fmail = $('#frommail').val();
      var bmail = $('#bccmail').val();
      var smail = $('#subjectmail').val();
      //var messagebody = $('#ck').val();
      var messagebody = CKEDITOR.instances.ck.getData();
      
      $.ajax({
          type:"POST",
          url:baseurl+"/index.php?r=Manageuser/Updatemail",
          data:{mailid:mailid,fmail:fmail,bmail:bmail,messagebody:messagebody,smail:smail}
      }).done(function(msg)              
       {
           $('#mailalert').fadeIn();
           setTimeout(
                                 function(){                                     
                                     $('#mailalert').fadeOut();
                                     $('#mailModal').modal("hide");
                                 },3000                                                
                                     ); 
                             m.fnDraw();
                             
       });
       
        
   });
   
   
//   $('#mailbtn').click(function(){
//        $('#mailform').submit();   
//    });
    
    
    
});

function adddata(data){
     
             tadata.fnAddData([ 
            data[0],
            data[1]

             ]  );
}