<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 24-Feb-18
 * Time: 10:24
 */
namespace Rimon;

class Conversation
{
    const TABLE_NAME = "conversation";
    const TABLE_KEY_COLUMN = "Id";

    private static $conversations = array();

    private $id;
    private $datetime;
    private $subject;
    private $messages = array();
    private $users = array();
    private $userLastView = array();
    private $openBy;
    private $show;


    /**
     * Task constructor.
     * @param array $conversationData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $conversationData) {
        $this->id = $conversationData["Id"];
        $this->datetime = new \DateTime($conversationData["Datetime"], new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
        $this->subject = $conversationData["Subject"];

        $privateMessageArray = Rimon::GetDB()->where("ConversationId", $this->id)->get("privateMessage", null, "Id");
        foreach ($privateMessageArray as $privateMessageId) {
            $this->messages[$privateMessageId["Id"]] = &PrivateMessage::GetById($privateMessageId["Id"]);
        }

        $allTeam = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $this->id)->getOne(self::TABLE_NAME,"Users");
        $teamMembers = explode(",",$allTeam["Users"]);
        foreach ($teamMembers as $member){
            $this->users["$member"] = User::GetById($member);
        }

        $usersLastView = json_decode($conversationData["UserLastView"]);
        foreach ($usersLastView as $index => $userLastView) {
            $this->userLastView["$index"] = new \DateTime($userLastView, new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
        }

        $this->openBy = User::GetById($conversationData["OpenBy"]);
        $this->show = $conversationData["Show"];

    }


    /**
     * @param $conversationId
     * @param array $conversationData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addConversationByConversationData($conversationId, array $conversationData){
        $res = @self::$conversations[$conversationId];

        if(!empty($res))
            throw new Exception("conversation {0} already exists in this array", null, $res);

        if(count($conversationData) == 0)
            throw new Exception("conversation {0} doesn't exists in DB", null, $conversationId);

        self::$conversations[$conversationId] = new Conversation($conversationData);
        return self::$conversations[$conversationId];
    }


    /**
     * @param int $conversationId
     * @return Conversation
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $conversationId) {
        if(empty($conversationId))
            throw new Exception("Illegal Id!");

        $res = @self::$conversations[$conversationId];

        if(empty($res)) {
            $conversationData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $conversationId)->getOne(self::TABLE_NAME);

            if(empty($conversationData))
                throw new Exception("conversation Id ({0}) not founded, conversation doesn't exists", null, $conversationId);

            $res = self::addConversationByConversationData($conversationId, $conversationData);
        }

        return $res;
    }

    /**
     * @return int
     */
    public function GetId() {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function GetDatetime() {
        return $this->datetime;
    }


    /**
     * @return mixed
     */
    public function GetSubject() {
        return $this->subject;
    }

    /**
     * @return PrivateMessage[]
     */
    public function GetMessages() {
        return $this->messages;
    }

    /**
     * @return User[]
     */
    public function GetUsers(): array {
        return $this->users;
    }

    /**
     * @return \DateTime[]
     */
    public function GetUserLastView() {
        return $this->userLastView;
    }

    /**
     * @return User
     */
    public function GetOpenBy(): User {
        return $this->openBy;
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function Update($data = array()){
        if(empty($data))
            throw new Exception("Update cannot be done, info miss");
        $success = Rimon::GetDB()->where("Id",$this->id)->update(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
    }

    /**
     * @return int
     */
    public function GetShow() {
        return $this->show;
    }

    /**
     * @param $userId
     * @throws Exception
     */
    public function UpdateUserLastView($userId) {
        $datetime =  new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
        $infoArray = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN,$this->id)->getOne(self::TABLE_NAME, "UserLastView");
        $infoDecode = json_decode($infoArray["UserLastView"], true);
        $infoDecode["$userId"] = $datetime->format("Y-m-d H:i:s");
        $this->Update(array("UserLastView" => json_encode($infoDecode)));
    }

    /**
     * @param $data
     * @return Conversation
     * @throws Exception
     * @throws \Exception
     */
    public static function &New(array $data){
        if(empty($data))
            throw new Exception("Add cannot be done, info miss");
        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
        $res = &self::GetById($success);
        return $res;
    }


}