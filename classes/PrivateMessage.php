<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 24-Feb-18
 * Time: 10:24
 */
namespace Rimon;

class PrivateMessage
{
    const TABLE_NAME = "privateMessage";
    const TABLE_KEY_COLUMN = "Id";

    private static $messages = array();

    private $id;
    private $conversationId ;
    private $sentBy;
    private $datetime;
    private $message;


    /**
     * Task constructor.
     * @param array $messageData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $messageData) {
        $this->id = $messageData["Id"];
        $this->conversationId = $messageData["ConversationId"];
        $this->sentBy = User::GetById($messageData["SentBy"]);
        $this->datetime = new \DateTime($messageData["Datetime"], new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
        $this->message = $messageData["Message"];
    }


    /**
     * @param $messageId
     * @param array $messageData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addPrivateMessageByPrivateMessageData($messageId, array $messageData){
        $res = @self::$messages[$messageId];

        if(!empty($res))
            throw new Exception("message {0} already exists in this array", null, $res);

        if(count($messageData) == 0)
            throw new Exception("message {0} doesn't exists in DB", null, $messageId);

        self::$messages[$messageId] = new PrivateMessage($messageData);
        return self::$messages[$messageId];
    }


    /**
     * @param int $messageId
     * @return PrivateMessage
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $messageId) {
        if(empty($messageId))
            throw new Exception("Illegal Id!");

        $res = @self::$messages[$messageId];

        if(empty($res)) {
            $messageData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $messageId)->getOne(self::TABLE_NAME);

            if(empty($messageData))
                throw new Exception("message Id ({0}) not founded, message doesn't exists", null, $messageId);

            $res = self::addPrivateMessageByPrivateMessageData($messageId, $messageData);
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
     * @return int
     */
    public function GetConversationId() {
        return $this->conversationId;
    }

    /**
     * @return User
     */
    public function GetSentBy(): User{
        return $this->sentBy;
    }

    /**
     * @return \DateTime
     */
    public function GetDatetime(): \DateTime {
        return $this->datetime;
    }

    /**
     * @return mixed
     */
    public function GetMessage() {
        return $this->message;
    }

    /**
     * @param $data
     * @return PrivateMessage
     * @throws Exception
     * @throws \Exception
     */
    public static function NewMessage(array $data){
        if(empty($data))
            throw new Exception("Add cannot be done, info miss");
        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
        $res = &self::GetById($success);
        return $res;
    }
}