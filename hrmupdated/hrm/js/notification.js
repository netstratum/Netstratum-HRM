 function desktops(){
         $.ajax({
        type:"POST",
        url:baseurl+"/index.php?r=Manageuser/Employeenotification"
    }).done(function(msg)
    {      
         $('#notificationarea').html(msg);
         
    });
     $.ajax({
        type:"POST",
        url:baseurl+"/index.php?r=Manageuser/Updatenotice"
    }).done(function(msg)
    {    //alert(navigator.userAgent);
//        localStorage.removeItem("fordesktopdata");
//        localStorage.removeItem("fordesktopother"); 
         desk = JSON.parse(msg);
         var datas=[];
         var otherdata=[];
         
      
        localdata = localStorage.getItem("fordesktopdata");
        localother = localStorage.getItem("fordesktopother");
         
        
       
        localdata = JSON.parse(localdata);
        localother = JSON.parse(localother);
        if(localdata==null)
            localdata=[];
        if(localother==null)
            localother=[];
      
         if(desk.length>0)
         {
             for(var i=0;i<desk.length;i++)
             {
                 if(desk[i].TYPE=="notification"){
                   
                     if($.inArray(desk[i].noticeid,localdata)== -1)
                     { 
                         PNotify.desktop.permission();
                        (
                                new PNotify({
                            title: 'Notification',
                            text: desk[i].message,
                            desktop: {
                                desktop: true
                            }
                        })).get().click(function(e) {
                            if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                           
                        });
                         
                         
                     }
                     
                     datas.push($.trim(desk[i].noticeid));
                 }
                 else{
                    
                    
                   
                     if($.inArray(desk[i].noticeid,localother)== -1)
                     {
                         PNotify.desktop.permission();
                        (
                                new PNotify({
                            title: 'Notification',
                            text: desk[i].name+" birthday alert",
                            desktop: {
                                desktop: true
                            }
                        })).get().click(function(e) {
                            if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
                           
                        });
                         
                         
                     }
                     otherdata.push($.trim(desk[i].noticeid));
                 }
             }
             if(localdata.length>20){             
                 localStorage.removeItem("fordesktopdata"); 
                
                    localStorage.setItem("fordesktopdata",JSON.stringify(datas));
               
             }
             else
             {
                 if(datas===null)
                    localStorage.setItem("fordesktopdata",JSON.stringify(datas));
                 else
                    localStorage.setItem("fordesktopdata",JSON.stringify(datas.concat(localdata)));
             }
             
              if(localother.length>20){             
                 localStorage.removeItem("fordesktopother");
                 localStorage.setItem("fordesktopother",JSON.stringify(otherdata));
              }
              else{
                   if(otherdata===null)
                         localStorage.setItem("fordesktopother",JSON.stringify(otherdata));
                    else
                        localStorage.setItem("fordesktopother",JSON.stringify(otherdata.concat(localother)));
            
                }
         }
    });
    }
$(document).ready(function(){
   
    
    setInterval(function(){
        desktops();
    },5000);
//alert("hhh");


$('#loginForm').submit();

});
