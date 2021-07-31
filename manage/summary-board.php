<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Feb-18
 * Time: 00:14
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";


$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "לוח סיכומים");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);


$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/unitrandom7.jpg" style="margin: 0">
        </div>  
    </div>
    
    <div class="row the-unit" style="border: none">
        <div class="col-sm-12">
            <h2 class="subtitles">סיכומי פעילויות</h2>
            <button style="width: 150px; margin-bottom: 10px" class="btn btn-warning btn-block" onclick="window.location='https://845.co.il/manage/add-summary.php'">הוסף סיכום</button>
        </div>
    </div> 
    
    
    <div class="row">
        <div class="col-sm-12">
     
        {activityBigTable}
      
        </div>
    </div>
    
</div>
Index;

$allActivities = Rimon::GetDB()->get("activitySummary",null, "Id");

if(!empty($allActivities)) {
    $activitySummaryTable = <<< ActivitySummaryTable
       <div class="form-group" style="direction: rtl">
            <div style="width: 150px; float: left">
                <input type="text" name="search" placeholder="חיפוש" id="search" class="form-control">
            </div>
            <select name="state" id="maxRows" class="form-control" style="width:150px;">
                <option value="5000">הצג הכל</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option>
            </select>
        </div>
        <table id="mytable" class="table table-bordered" style="direction: rtl">
            <thead>
            <tr>
                <th>תאריך</th>
                <th>צוות</th>
                <th>סוג</th>
                <th>נושא הפעילות</th>
                <th>מיקום</th>
            </tr>
            </thead>
            <tbody>
                {activitySummaryRow}
            </tbody>
        </table>

        <div class="pagination-container">
            <nav>
                <ul class="pagination"></ul>
            </nav>

        </div>

        <script>
            $(document).ready(function() {
                $('#search').keyup(function() {
                    search_table($(this).val());
                });
            });

            function search_table(value) {
                $('#mytable tbody tr').each(function() {
                    var found = 'false';
                    $(this).each(function() {
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                            found = 'true';
                        }
                    });
                    if(found == 'true') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }


        </script>

        <script>
            var table = '#mytable';
            $('#maxRows').on('change', function(){
                $('.pagination').html('');
                var trnum = 0;
                var maxRows = parseInt($(this).val());
                var totalRows = $(table+' tbody tr').length;
                $(table+' tr:gt(0)').each(function(){
                    trnum++;
                    if(trnum > maxRows){
                        $(this).hide()
                    }
                    if(trnum <= maxRows){
                        $(this).show()
                    }
                });
                if(totalRows > maxRows){
                    var pagenum = Math.ceil(totalRows/maxRows);
                    for(var i=1;i<=pagenum;){
                        $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
                    }
                }
                $('.pagination li:first-child').addClass('active');
                $('.pagination li').on('click',function(){
                    var pageNum = $(this).attr('data-page');
                    var trIndex = 0;
                    $('.pagination li').removeClass('active');
                    $(this).addClass('active');
                    $(table+' tr:gt(0)').each(function(){
                        trIndex++;
                        if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                            $(this).hide()
                        } else{
                            $(this).show()
                        }
                    })
                })
            })

        </script>

    </div>

ActivitySummaryTable;


    $activitySummaryRow = <<<ActivitySummaryRow
<tr onclick="document.location = 'activity-summary.php?activityId={summaryId}';" style="cursor: pointer">
   <td>{summaryDate}</td>
   <td>{summaryTeam}</td>
   <td>{summaryType}</td>
   <td>{summarySubject}</td>
   <td>{summaryLocation}</td>  
</tr>
ActivitySummaryRow;


    $activityRow = "";
    foreach ($allActivities as $index => $activity) {
        $activityObj = ActivitySummary::GetById($activity["Id"]);
        $activityRow .= $activitySummaryRow;

        \Services::setPlaceHolder($activityRow, "summaryId", $activityObj->GetId());
        \Services::setPlaceHolder($activityRow, "summaryDate", $activityObj->GetDate()->format("d/m/y"));
        \Services::setPlaceHolder($activityRow, "summaryTeam", $activityObj->GetTeam()->GetName());
        \Services::setPlaceHolder($activityRow, "summaryType", $activityObj->GetType()->getDesc());
        \Services::setPlaceHolder($activityRow, "summarySubject", $activityObj->GetSubject());
        \Services::setPlaceHolder($activityRow, "summaryLocation", $activityObj->GetLocation());

    }
    \Services::setPlaceHolder($activitySummaryTable, "activitySummaryRow", $activityRow);
    \Services::setPlaceHolder($pageTemplate, "activityBigTable", $activitySummaryTable);
} else {
    \Services::setPlaceHolder($pageTemplate, "activityBigTable", "<center><h2>לא קיימים סיכומים!</h2></center>");
}

$pageTemplate .= footerTemplate;
echo $pageTemplate;

