var empid="";
//var addresstable="";
$(document).ready(function(){
   $.ajax({
       type:"POST",
       url:baseurl+"/index.php?r=Manageuser/Addressbook"
       
   }).done(function(msg)
   {
      $('#nameid').html(msg);
   });
   $('#searchname').autocomplete({
      source:baseurl+"/index.php?r=Manageuser/Searchaddressbook",
      minLength: 2,
      select:function(event, ui){
            empid = ui.item.emp_number;
              address();
        }
   });
   
//   addresstable = $('#addresstable').dataTable({
//      ajax:{"url":baseurl+"/index.php?r=Manageuser/Showaddressbook",
//        data:function(da){
//            da.empnumb=empid;
//        }
//      }
//   });
   $('#searchname').keyup(function()
   {
       //alert($(this).val());
       if($(this).val()===''){
            empid = "";
        }   
          
           address("searchstr");
       
   });
   
   
   
});
function address(searchstr){
//    alert('sss');
   var searchval = searchstr!=''? $('#searchname').val():"";
        
    $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Manageuser/Showaddressbook",
           data:{empnumb:empid,searchdata:searchval}
       }).done(function(msg)
       {
           $('#nameid').html(msg);

       });
}