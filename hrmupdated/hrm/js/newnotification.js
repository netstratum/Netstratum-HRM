$(document).ready(function(){
    $('#notificationform').validate({
        rules:
                {
                    notificationmsg:"required"
                },
        messages:{
                    notificationmsg:"Add a message"
                },
                submitHandler:function(form){
                    $('#notificationbtn').prop("disabled", true);
                    $('#notificationbtn').val("Saving...");
                    $(form).ajaxSubmit({
                        success: function(){
                            $('#notificationalert').fadeIn();
                            setTimeout(
                                    function(){
                                        $('#notificationbtn').prop("disabled", true);
                                        $('#notificationbtn').val("Save");
                                        $('#notificationalert').fadeOut();
                                        $('#workgroup').val("");
                                        $('#notificationmsg').val("");
                                    },3000
                                    );
                        }
                    });
                }
    });    
    $('#notificationbtn').click(function(){
        $('#notificationform').submit();
        notetable.fnDraw();
    });
});