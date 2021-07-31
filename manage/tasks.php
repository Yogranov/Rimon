<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 05-Feb-18
 * Time: 19:53
 */
namespace Rimon;
require_once "../classes/Rimon.php";
require_once "../core/header.php";

$pageTemplate = headerTemplate;
\Services::setPlaceHolder($pageTemplate, "PageTitle", "לוח משימות");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);

/////Change Status
if(isset($_POST["task-row-status"]) && isset($_POST["taskId"])) {
    $changeStatusTaskObj = &Task::GetById($_POST["taskId"]);
    $changeStatusTaskObj->ChangeStatus($_POST["task-row-status"]);
    //log
    $userObj = User::GetById($_SESSION["UserId"]);
    $logString = "המשתמש {$userObj->GetFullName()} שינה למשימה {$changeStatusTaskObj->GetSubject()} את הסטאטוס ל{$changeStatusTaskObj->GetStatus()->getDesc()}";
    Rimon::NewLog($logString);
    if($changeStatusTaskObj->GetStatus()->getValue() == 4){
        $message = "המשימה '{$changeStatusTaskObj->GetSubject()}' נסגרה על ידי המשתמש {$userObj->GetFullName()}";
        $EmailObject = Rimon::GetEmail("אחת המשימות בעמותה נסגרה", $message);
        $EmailObject->addAddress(Constant::SEO_EMAIL);
        $EmailObject->send();
    }

    header("Location: tasks.php");
}


$pageTemplate .= <<<Index
<div class="container content">

    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../media/pages/contact-us.jpg" style="margin: 0">
        </div>  
    </div>
        <h2>טבלת משימות</h2>
            <button style="width: 150px; margin-bottom: 10px" class="btn btn-warning btn-block" onclick="window.location='https://845.co.il/manage/addtask.php'">הוסף משימה</button>			
        {TaskBigTable}        
</div>
Index;

$allOpenTasks = Rimon::GetDB()->where("Status",4, '!=')->get("tasks",null,"Id");

////////////Tasks Table///////////////
if(!empty($allOpenTasks)) {
    $tasksSection = <<<TasksSetion
    
		<section class="content">

			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-filter" data-target="manage">הנהלה</button>
                                <button type="button" class="btn btn-success btn-filter" data-target="technology">טכנולוגיה</button>
								<button type="button" class="btn btn-warning btn-filter" data-target="big-brother">האח הגדול</button>
                                <button type="button" class="btn btn-info btn-filter" data-target="civilian">אזרחות</button>
                                <button type="button" class="btn btn-success btn-filter" data-target="money">כספים</button>
								<button type="button" class="btn btn-danger btn-filter" data-target="assistance">פרט וסיוע</button>
								<button type="button" class="btn btn-default btn-filter" data-target="all">הצג הכל</button>
							</div>
						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody>
								{TableRows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
TasksSetion;

    $tableRowTemplate = <<<TableRowTemplate
<tr data-status="{TeamNameEnglish}" data-toggle="modal" data-target="#modal-task-{TaskId}">
    <td>
        <div class="media">
            <span class="task-status">{TaskStatus}</span>
            <div class="media-body">
                <span class="media-meta pull-right">{OpenDate}</span>
                <h4 class="title">
                     {UserName}
                    <span class="{TeamNameEnglish}">({TeamName})</span>
                </h4>
                <p class="summary">{RowContent}</p>
            </div>
        </div>
    </td>
</tr>

<!-- Modal -->
<div class="modal fade" id="modal-task-{TaskId}" role="dialog">
    <div class="modal-dialog">
          <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-subject">{OpenDate} - {UserName} ({TeamName})</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                      <div class="col-sm-12 pull-right">
                          <p>
                              {RowContentFull}
                          </p>
                          <br>
                          <button style="width: 75px; margin-bottom: 10px" class="btn btn-warning btn-block pull-right" onclick="window.location='https://845.co.il/manage/edittask.php?TaskId={TaskId}'">ערוך</button>
                      </div>
                  </div>
                </div>
        <div class="modal-footer">
          <button style="float: right" type="button" class="btn btn-default" data-dismiss="modal">סגור חלון</button>
          
              <form method="POST">
                  <select class="form-control pull-left" style="width: 35%;" name="task-row-status" onchange="this.form.submit()" required>
                       {taskStatusEnum}
                  </select>
                  <input type="hidden" name="taskId" value="{TaskId}">
              </form>     
          
        </div>
      </div>
    </div>
</div>

TableRowTemplate;

    $taskRow = "";
    foreach ($allOpenTasks as $task) {
        $taskObj = Task::GetById($task["Id"]);
        $taskRow .= $tableRowTemplate;
        \Services::setPlaceHolder($taskRow, "TeamNameEnglish", $taskObj->GetTeam()->GetEnglishName());
        \Services::setPlaceHolder($taskRow, "TaskStatus", $taskObj->GetStatus()->getDesc());
        \Services::setPlaceHolder($taskRow, "OpenDate", $taskObj->GetOpenDate()->format("d/m/y"));
        \Services::setPlaceHolder($taskRow, "UserName", $taskObj->GetCreateBy()->GetFullName());
        \Services::setPlaceHolder($taskRow, "TeamName", $taskObj->GetTeam()->GetName());

        $shortContent = strlen(strip_tags($taskObj->GetTask())) > 50 ? substr($taskObj->GetTask(),0,50)."..." : $shortContent = $taskObj->GetTask();
        $shortContentNoHtml = strip_tags($shortContent);
        \Services::setPlaceHolder($taskRow, "RowContent", $shortContentNoHtml);

        \Services::setPlaceHolder($taskRow, "RowContentFull", $taskObj->GetTask());

        \Services::setPlaceHolder($taskRow, "TaskId", $taskObj->GetId());

        $taskStatusString = "";
        foreach (ETaskStatus::toArray() as $status) {
            $taskStatusString .= "<option value='".$status[0]."' ";
            if ($taskObj->GetStatus()->getValue() == $status[0]){
                $taskStatusString .= "selected='selected'";}
            $taskStatusString .= ">".$status[1]."</option>";

        }
        \Services::setPlaceHolder($taskRow, "taskStatusEnum", $taskStatusString);


    }
    \Services::setPlaceHolder($tasksSection, "TableRows", $taskRow);
    \Services::setPlaceHolder($pageTemplate, "TaskBigTable", $tasksSection);

} else {
    \Services::setPlaceHolder($pageTemplate, "TaskBigTable", "<center><h2>לא קיימות כרגע משימות!</h2></center>");
}



//////////////////////////////////////


$pageTemplate .= footerTemplate;
echo $pageTemplate;
