var st = "";
$(document).ready(function(){
                     
        
                 $('#addnew').click(function(){
                        


                        location.href=baseurl+"/index.php?r=Manageuser/View";                 
                 });
                
                
               st =  $('#example').dataTable( {                                        
                 
                ajax:        baseurl+"/index.php?r=Manageuser/Userdisplay",
                 
       "serverSide": true,
       "lengthChange": true,
        "searching": true
               
                });
                
                $('.box-content').on('click','.empremove',function()                        
                {
        
              
                deleteuser(st, $(this).attr("rel"));
                
                
                
                }
                        
            );

       $('#userlist').on('click','.status_active',function(){

        $.ajax({
        
            type: "POST",
            url: baseurl+"/index.php?r=Manageuser/StatusChange", 
            data: { status: "Y",userid:$(this).attr('rel')}
        
        })
        .done(function( msg ) {
        
             st.fnDraw();
        
        });


    });

     $('#userlist').on('click','.status_deactive',function(){

         $.ajax({
        
            type: "POST",
            url: baseurl+"/index.php?r=Manageuser/StatusChange", 
            data: { status: "N",userid:$(this).attr('rel')}
        
        })
        .done(function( msg ) {
        
             st.fnDraw();
        
        });

    });

         

                
 });
        function deleteuser(st,rel){
            
            $.ajax({
                    
                    type: "POST",
                    url: baseurl+"/index.php?r=Manageuser/Userdelete",
                    data:{ empno:rel}, 
                    success:function(){
                        
                        st.fnDraw();
                    }
                });
        }


