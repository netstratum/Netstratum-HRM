
$(document).ready(function(){
    
    notetable = $('#notificationtable').dataTable({
        ajax:baseurl+"/index.php?r=Manageuser/Viewnotifications",
        "serverSide": true,
        "lengthChange": false,
        "searching": true,
        "oLanguage": { "sSearch": "Search Message:" },
        "iDisplayLength" : 10,
        "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3 ] }
       ]
    });
    
    $('#notifier').on('click','.notificationdelete',function()
    {
        notiid = $(this).attr("rel");
         $.ajax({
             type:"POST",
             url:baseurl+"/index.php?r=Manageuser/Deletenotification",
             data:{noteid:notiid}
         }).done(function(msg){
             notetable.fnDraw();
         });
    });
    
    $('#notificationtable tbody').on('click','tr', function(event) {
       var nTds = $('td', this);
       var gplist = $(nTds[0]).text();
//       alert(event.target.nodeName);
       if($.trim(gplist)==="All" && event.target.nodeName!='I'){
           return false;
       }
//       var data = table.row(this).data();
        if(event.target.nodeName!='I')
            $('#notificationModal').modal("show");
//        var sTitle;
      
//       this.setAttribute( 'title', sTitle );
       $.ajax({
           type:"POST",
           url:baseurl+"/index.php?r=Manageuser/Grouplist",
           data:{gpid:gplist}
       }).done(function(msg){
          // alert(msg);
          var datavalue = JSON.parse(msg);
          $('#noticename').html("");
          for(i=0;i<datavalue.length;i++)
          { 
              $('#noticename').append(datavalue[i].name+"<br>");
//              alert(datavalue[i].name);
          }
          
          
//       $('#noticename').html(msg);
       
       });
        
    });
    $(notetable.fnGetNodes()).tooltip( {
                "delay": 0,
		"track": true,
		"fade": 250 
    });
    
});