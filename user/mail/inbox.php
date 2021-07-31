<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 24-Feb-18
 * Time: 11:29
 */
namespace Rimon;
require_once "../../classes/Rimon.php";
require_once "../../core/header.php";

$pageTemplate = headerTemplate;
//Google Analytics
if(Constant::GOOGLE_ANALYTICS_ACTIVE)
    $pageTemplate .= Constant::GOOGLE_ANALYTICS_CODE;
//
\Services::setPlaceHolder($pageTemplate, "PageTitle", "תיבת דואר");
$pageTemplate .= bodyTemplate;

$permissions = Rimon::GetPermissions(4);
\Services::setPlaceHolder($pageTemplate, "Menu", $permissions["Menu"]);
\Services::setPlaceHolder($pageTemplate, "manageMenu", $permissions["ManagerMenu"]);
$userObj = User::GetById($_SESSION["UserId"]);



$pageTemplate .= <<<Index
<div class="container content">
    <div class="row" style="margin-bottom: 30px">
        <div class="col-sm-12 page-photo" style="padding: 0">
            <img src="../../media/pages/unitrandom1.jpg" style="margin: 0">
        </div>  
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-2 pull-right">
            <a href="new-conversation.php" class="btn btn-danger btn-sm btn-block" role="button">שיחה חדשה</a>
            <hr />
            <ul class="nav nav-pills nav-stacked" style="padding: 0">
                <li id="inbox-coming-btn" class="active"><a style="cursor: pointer"><span class="badge pull-right"></span>כל שיחות</a></li>
                <li id="inbox-sent-btn" class=""><a style="cursor: pointer">השיחות שלי</a></li>
            </ul>
        </div>
            {ConversationsTable}
    </div>
</div>
Index;

////////////Inbox Table///////////////
$DBConversations = Rimon::GetDB()->where("Users","%" . $userObj->GetId() . "%", 'like')->get("conversation", null, "Id");
if(!empty($DBConversations)) {
    $conversationTableHtml = <<<EducationTable
    <div class="col-xs-12 col-sm-10" style="margin-bottom: 30px">
            <ul class="nav nav-tabs">
                <li class="active pull-right"><a href="#"><span class="glyphicon glyphicon-inbox"></span> ראשי</a></li>
            </ul>
            <div>
                <div class="tab-pane fade in active">
                    <div class="list-group">
                        {ConversationsTableBody}       
                    </div>
                </div>
            </div>
        </div>
EducationTable;

    $conversationRows = <<<EducationTable
<a href="conversation.php?Con={ConversationLink}" style="{backgroundColor}" class="list-group-item {InboxType}">
    <span class="name" style="min-width: 120px; display: inline-block;">{ConversationSubject}</span>
    <span class="text-muted" style="font-size: 11px; margin-right: 5px">יוצר: {ConversationOpenBy}</span> 
    <span class="badge pull-left">{ConversationDate}</span>
</a>
EducationTable;
    $bagetCounter = 0;
    $conversationRow = "";
    foreach ($DBConversations as $conversation) {
        $conversationRow .= $conversationRows;
        try {
            $conversationObj = Conversation::GetById($conversation["Id"]);
        } catch (\Throwable $e) {
            \Services::RedirectHome();
        }
        \Services::setPlaceHolder($conversationRow, "ConversationDate", $conversationObj->GetDatetime()->format("d/m/y"));
        \Services::setPlaceHolder($conversationRow, "ConversationSubject", $conversationObj->GetSubject());
        \Services::setPlaceHolder($conversationRow, "ConversationOpenBy", $conversationObj->GetOpenBy()->GetFullName());

        $conversationLinkEncode = base64_encode($conversationObj->GetId() . "_" . $conversationObj->GetDatetime()->format("U"));
        \Services::setPlaceHolder($conversationRow, "ConversationLink", $conversationLinkEncode);

        if($conversationObj->GetOpenBy()->GetId() === $userObj->GetId())
            \Services::setPlaceHolder($conversationRow, "InboxType", "inbox-sent");
        else
            \Services::setPlaceHolder($conversationRow, "InboxType", "inbox-coming");



        foreach ($conversationObj->GetMessages() as $message) {
            if((int)$message->GetDatetime()->format("U") - (int)$conversationObj->GetUserLastView()["{$_SESSION["UserId"]}"]->format("U") > 0) {
                \Services::setPlaceHolder($conversationRow, "backgroundColor", "background-color:  #ECF4FF");
                $bagetCounter++;
            } else{
                \Services::setPlaceHolder($conversationRow, "backgroundColor", "");
            }
        }

    }

    \Services::setPlaceHolder($conversationTableHtml, "ConversationsTableBody", $conversationRow);
    \Services::setPlaceHolder($pageTemplate, "ConversationsTable", $conversationTableHtml);

} else {
    \Services::setPlaceHolder($pageTemplate, "ConversationsTable", "<div class=\"col-xs-12 col-sm-10\"><center><h2>אין הודעות!</h2></center></div>");
}
//////////////////////////////////////



$pageTemplate .= footerTemplate;
echo $pageTemplate;
