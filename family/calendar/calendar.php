<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 10-Feb-18
 * Time: 09:52
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";


$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "לוח אירועים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(2);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

if(isset($_SESSION["UserId"])) {
    $userObj = User::GetById($_SESSION["UserId"]);
    $userVerify = base64_encode($userObj->GetId() . "_" . $userObj->GetRegisterDate()->format("U"));
} else
    $userVerify = 0;

$pageTemplate .= <<<Index
        <!-- Full Calendar -->
<meta charset='utf-8'/>
<link rel="stylesheet" href="https://845.co.il/css/fullcalendar.css" />
<script src="https://845.co.il/js/moment.min.js"></script>
<script src="https://845.co.il/js/fullcalendar.min.js"></script>
<script src="https://845.co.il/js/he.js"></script>
    
    <script>
      
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    header:{
     left:'next,prev today'
    },
    events: {
        url: 'load.php',
        type: 'POST',
        data: {Verify: '{$userVerify}'}
    },
    selectable: false,
    selectHelper: false,
    select: function(start, end, allDay) {
     var title = prompt("כותרת האירוע");
     
     if(title) {
          var content = prompt("תוכן האירוע");
          var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
          $.ajax({
           url:"insert.php",
           type:"POST",
           data:{title:title, content:content, start:start, end:end},
           success:function()
           {
            calendar.fullCalendar('refetchEvents');
            alert("האירוע נוסף בהצלחה");
           }
          })
     }
    },
    editable:false,
    eventResize:function(event) {
         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
         var title = event.title;
         var id = event.id;
         $.ajax({
          url:"update.php",
          type:"POST",
          data:{title:title, start:start, end:end, id:id},
          success:function(){
           calendar.fullCalendar('refetchEvents');
           alert('עדכן אירוע');
          }
         })
    },

    eventDrop:function(event) {
         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
         var title = event.title;
         var id = event.id;
         $.ajax({
          url:"update.php",
          type:"POST",
          data:{title:title, start:start, end:end, id:id},
          success:function()
          {
           calendar.fullCalendar('refetchEvents');
           alert("אירוע עודכן");
          }
         });
    },

    eventClick:function(event) {
        console.log("asd");
          var id = event.id;
          $.ajax({
           url:"read.php",
           type:"POST",
           data:{id:id},
           success:function(data)
           {
               var json = data,
               obj = JSON.parse(json);
            calendar.fullCalendar('refetchEvents');
            
            window.location='https://845.co.il/family/calendar/event.php?EventVerify='+obj.verify;
            /*
            $('#calendar-title').text(obj.Title);
            $('#calendar-content').html(obj.Content);
            $('#calendar-edit-button').attr("onclick","window.location='https://845.co.il/manage/calendar/edit-event.php?EventId="+obj.Id+"'");
                
            $('#calendar-open-by').html(obj.UserFullName);
            $('#calendar-location').html(obj.Location);
                
            var objDate = new Date(obj.OpenDate);
            $('#calendar-open-date').html(objDate.toLocaleDateString('de-DE'));
            $('#modal-calendar').modal();
            */
           }
          })
    }
     
   });
  });
   
  </script>
<div class="container content">
    <div class="row">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom2.jpg">
        </div>  
    </div>


            <h2>לוח אירועים</h2>
            {CreateButton}			

    <div class="row" style="padding: 40px 0">
        <div class="col-sm-12" style="background-color: rgba(255,255,255,0.4)">  
           <div id="calendar"></div>   
        </div>
    </div>
   
   {FutureEventTable}
   
<!-- Calendar Modal -->
</div>
<div class="calendar-modal" style="width: 100%">
    <div class="modal fade" id="modal-calendar" role="dialog">
        <div class="modal-dialog">
              <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="calendar-title" class="modal-subject">{Title}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 pull-right">
                                <h4>תוכן האירוע:</h4>
                                <p id="calendar-content">
                                {Content}
                                </p>
                                <br>
                                <h4>פרטי האירוע:</h4>
                                <p>מקום האירוע: <span id="calendar-location">{location}</span></p>
                                <p>נפתח ע"י: <span id="calendar-open-by">{openBy}</span></p>
                                <p>נפתח ב: <span id="calendar-open-date">{openDate}</span></p>
                                <br>
                                <button id="calendar-edit-button" style="width: 75px; margin-bottom: 10px" class="btn btn-warning btn-block pull-right" onclick="window.location='edit-event.php'">ערוך</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור חלון</button>
                    </div>
              </div>
        </div>
    </div>
</div>
Index;


$date = new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
$allFutureEventsArray = Rimon::GetDB()->where("StartEvent", $date->format("Y-m-d"),">")->where("ShowLevel", $userObj->GetRole()->getValue(), "<=")->get("events", null, "Id");

if(!empty($allFutureEventsArray)){
$futureEventsList = <<<FutureEvent
<table class="eventsTable">
    <thead>
      <tr>
        <th>תאריך</th>
        <th>שם האירוע</th>
        <th>מיקום</th>
      </tr>
    </thead>
    <tbody>
        {EventsRows}
    </tbody>
  </table>
FutureEvent;

$eventRow = <<<EventRow
      <tr>
        <td>{EventDate}</td>
        <td>{EventName}</td>
        <td>{EventLocation}</td>
      </tr>
EventRow;

    $arrayEventRow = "";
    foreach ($allFutureEventsArray as $index => $event) {
        $eventObj = Event::GetById($event["Id"]);
        $arrayEventRow .= $eventRow;
        \Services::setPlaceHolder($arrayEventRow, "EventDate", $eventObj->GetStartEvent()->format('d/m/y'));
        \Services::setPlaceHolder($arrayEventRow, "EventName", $eventObj->GetTitle());
        \Services::setPlaceHolder($arrayEventRow, "EventLocation", $eventObj->GetLocation());
    }
    \Services::setPlaceHolder($futureEventsList, "EventsRows", $arrayEventRow);
    \Services::setPlaceHolder($pageTemplate, "FutureEventTable", $futureEventsList);
} else {
    \Services::setPlaceHolder($pageTemplate, "FutureEventTable", "<center><h3>אין אירועים עתידיים</h3></center>");
}

if(isset($_SESSION["UserId"])){
    if($userObj->GetRole()->getValue() >= 4)
        \Services::setPlaceHolder($pageTemplate, "CreateButton","<button style=\"width: 150px; margin-bottom: 10px\" class=\"btn btn-warning btn-block\" onclick=\"window.location='add-event.php'\">צור אירוע</button>");
     else
        \Services::setPlaceHolder($pageTemplate, "CreateButton", "");
} else
    \Services::setPlaceHolder($pageTemplate, "CreateButton", "");

$pageTemplate .= footerTemplate;
echo $pageTemplate;


?>
