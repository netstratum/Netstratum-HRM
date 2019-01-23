<?php
 $session = new CHttpSession;
 $session->open();
 ?>
 <link type="text/css" rel="stylesheet" href="./css/jquery.qtip.min.css?<?php echo time();?>" />
 <script type="text/javascript" src="./js/jquery.qtip.min.js?<?php echo time();?>"></script>

<!-- Optional: imagesLoaded script to better support images inside your tooltips -->
<script type="text/javascript" src="./js/imagesloaded.pkg.min.js?<?php echo time();?>"></script>
<div style="margin-top:15px;"><div class="span7"  style="padding-top:5px;margin-left:100px;margin-top:10px; position: absolute; left: 270px; <?php if ($session['user_role']>2){?>display:none;<?php }?>">  <input type="text" name="employee_name" id="employee_name" placeholder="Employee Name" ><input type="hidden" name="employee_id" id="employee_id" value=""></div></div>
<div class="span10" id='calendar' style="padding-top:5px;margin-left:60px;"></div>
<div class="rightside span2">

<div class="divcolor"><span class="color1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="listsp">Holiday</span></div>
<div class="divcolor"><span class="color2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="listsp">Festival Holiday</span></div>
<div class="divcolor"><span class="color3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="listsp">Leave Scheduled</span></div>
<div class="divcolor"><span class="color4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="listsp">Leave Pending</span></div>
<div class="divcolor"><span class="color5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="listsp">Leave Taken</span></div>


</div>

<link href='./css/fullcalendar.css' rel='stylesheet' />
<style>

    body {
     
        padding: 0;
        
    }

    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }

</style>
<script src='./js/moment.min.js?<?php echo time();?>'></script>

<script src='./js/fullcalendar.min.js?<?php echo time();?>'></script>
<script>
  var baseurl="<?php echo Yii::app()->request->baseUrl; ?>";
  var employee_id_val = '';
	$(document).ready(function() {
		
        

         $('#employee_name').autocomplete({
                source:baseurl+"/index.php?r=Leave/Employeelist",
                minLength: 2,
                select:function( event, ui ) {
                        //ui.item.id;
                        $('#employee_id').val(ui.item.id);
                        employee_id_val = ui.item.id;
                        $('#calendar').fullCalendar('destroy');  
                         LoadCalender();
                         //$('#calendar').fullCalendar('refetchEvents');
                    }
    });
    

         LoadCalender();

	
		
	});

    function LoadCalender()
    {


        $('#calendar').fullCalendar({
            header: {
                
                
                
            },
            theme: true,
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            aspectRatio: 1.4,
             eventSources: [ {
        url: '<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=Holiday/ShowHolidays',
         data: {
                "emp_number": $('#employee_id').val(),
               
            },
        error: function() {
            alert('there was an error while fetching events!');
        },
        
     
        textColor: 'black' // a non-ajax option
    }, 
    ],
    viewRender: function (view, element) {
        //alert( view.start);
$( element ).css('font-size', '17px');

            var end_date_max   = '<?php echo date("Y");?>-12-31';
            var start_date_min = '<?php echo date("Y");?>-00-01';
            var startdate = new Date(view.start);
            var curr_date = startdate.getDate()-1;
            if (curr_date<10)
                curr_date="0"+curr_date;
            var curr_month = startdate.getMonth();
            if (curr_month<9){
                curr_month=curr_month+1;
                curr_month="0"+curr_month;  
            }else
                curr_month=curr_month+1;

        
            var curr_year = startdate.getFullYear();
            var start_date = curr_year + "-" + (curr_month)+ "-" + (curr_date);
            


            var enddate = new Date(view.start);
            enddate.setDate(enddate.getDate()+7);
            var curr_date = enddate.getDate()-1;
            if (curr_date<10)
                curr_date="0"+curr_date;
            var curr_month = enddate.getMonth();
            if (curr_month<9){
                curr_month=curr_month+1;
                curr_month="0"+curr_month;  
            }else
                curr_month=curr_month+1;
            var curr_year = enddate.getFullYear();
            var end_date = curr_year + "-" + (curr_month)+ "-" + (curr_date);
            

            if (start_date_min>start_date && start_date_min>end_date ){

                $('.fc-next-button').trigger('click');
            }

    
            if (end_date_max<end_date ){
            

              //  $('.fc-prev-button').trigger('click');
            }

            

     },
        eventRender: function (event, element, monthView) 
    {
            var start1 = new Date(event.start);
            var curr_date = start1.getDate();
            if (curr_date<10)
                curr_date="0"+curr_date;
            var curr_month = start1.getMonth();
            var curr_year = start1.getFullYear();

               if (curr_month<9){
                curr_month=curr_month+1;
                curr_month="0"+curr_month;  
            }else
                curr_month=curr_month+1;
            
            var curdate = curr_year + "-" + (curr_month)+ "-" + (curr_date);

         if (event.typename == "holiday") 
         {          
        
            $( ".fc-day-grid" ).find( 'td[data-date="' + curdate + '"]').css('color', '#D10A02');

            
           
         }else if (event.typename == "optional"){
            
            $( ".fc-day-grid" ).find( 'td[data-date="' + curdate + '"]').css('color', '#0066FF');


        
         }else if (event.typename == "approve"){
            
           
            $( ".fc-day-grid" ).find( 'td[data-date="' + curdate + '"]').css('color', '#DEACE3');


         }else if (event.typename == "pending"){
            
            $( ".fc-day-grid" ).find( 'td[data-date="' + curdate + '"]').css('color', '#DE9218');


         }else if (event.typename == "taken"){
            
            $( ".fc-day-grid" ).find( 'td[data-date="' + curdate + '"]').css('color', '#20EB0B');

           


         }else if (event.typename == "weekend"){
           
            $( ".fc-day-grid" ).find( 'td[data-date="' + curdate + '"]').css('color', '#D10A02');


         }else if (event.typename = "leave_scheduler")
         {
           

            element.qtip({ // Grab some elements to apply the tooltip to
    content: {
        text: "<div>"+event.profileimg+" "+event.description+"</div>"
    },
    style: {
        classes: 'qtip-red qtip-shadow'
    }
})


         }

       


    },
    dayClick: function(date, allDay, jsEvent, view) {

        if (allDay) {
      //      alert('Clicked on the entire day: ' + date);
        }else{
         //   alert('Clicked on the slot: ' + date);
        }

       

    },
    eventClick: function(calEvent, jsEvent, view) {
   
        //alert('Event: ' + calEvent.title);
       // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        //alert('View: ' + view.name);

        // change the border color just for fun
      //  $(this).css('border-color', 'red');

    }
        });

        //$('#calendar').fullCalendar( 'addEventSource', source )
        //$('#calendar').fullCalendar('removeEventSource', 'calendarJSON.php' );

    }

</script>
