<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 15-Mar-18
 * Time: 10:57
 */
namespace Rimon;

class MessageBoard
{
    private static $messages = array();

    const TABLE_NAME = "messageBoard";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $title;
    private $content;
    private $imageName;
    private $openBy;
    private $openDate;
    private $show;

    /**
     * MessageBoard constructor.
     * @param array $messageData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $messageData) {
        $this->id = $messageData["Id"];
        $this->title = $messageData["Title"];
        $this->content = $messageData["Content"];
        $this->imageName = $messageData["Image"];
        $this->openBy = User::GetById($messageData["OpenBy"]);
        $this->openDate = new \DateTime($messageData["OpenDate"]);
        $this->show = $messageData["Status"];
    }

    /**
     * @param $messageId
     * @param array $messageData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addMessageByMessageData($messageId, array $messageData) {
        $res = @self::$messages[$messageId];

        if(!empty($res))
            throw new Exception("message {0} already exists in this array", null, $res);

        if(count($messageData) == 0)
            throw new Exception("message {0} doesn't exists in DB", null, $messageId);

        self::$messages[$messageId] = new MessageBoard($messageData);
        return self::$messages[$messageId];
    }

    /**
     * @param $messageId
     * @return MessageBoard
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById($messageId) {
        if(empty($messageId))
            throw new Exception("Illegal Id!");

        $res = @self::$messages[$messageId];

        if(empty($res)) {
            $messageData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $messageId)->getOne(self::TABLE_NAME);

            if(empty($messageData))
                throw new Exception("message Id ({0}) not founded, message doesn't exists", null, $messageId);

            $res = self::addMessageByMessageData($messageId, $messageData);
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
     * @return string
     */
    public function GetTitle() {
        return $this->title;
    }

    /**
     * @return string
     */
    public function GetContent() {
        return $this->content;
    }

    /**
     * @return string
     */
    public function GetImageName() {
        return $this->imageName;
    }

    /**
     * @return User
     */
    public function GetOpenBy(): User {
        return $this->openBy;
    }

    /**
     * @return \DateTime
     */
    public function GetOpenDate(): \DateTime {
        return $this->openDate;
    }

    /**
     * @return int
     */
    public function GetShow() {
        return $this->show;
    }

    /**
     * @param $data
     * @return MessageBoard
     * @throws Exception
     * @throws \Exception
     */
    public static function &Add(array $data){
        if(empty($data))
            throw new Exception("Add cannot be done, info miss");
        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
        $res = &self::GetById($success);
        return $res;
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function &Update($data = array()){
        if(empty($data))
            throw new Exception("Update cannot be done, info miss");
        $success = Rimon::GetDB()->where("Id",$this->id)->update(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
    }

}