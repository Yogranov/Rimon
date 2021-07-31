<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 11-Feb-18
 * Time: 12:41
 */

namespace Rimon;


class Event
{

    private static $events = array();

    const TABLE_NAME = "events";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $title;
    private $subTitle;
    private $content;
    private $location;
    private $startEvent;
    private $endEvent;
    private $openBy;
    private $openDate;
    private $comingUsers = array();
    private $notComingUsers = array();

    /**
     * Job constructor.
     * @param array $eventData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $eventData) {
        $this->id = $eventData["Id"];
        $this->title = $eventData["Title"];
        $this->subTitle = $eventData["SubTitle"];
        $this->content = $eventData["Content"];
        $this->location = $eventData["Location"];
        $this->startEvent = new \DateTime($eventData["StartEvent"]);
        $this->endEvent = new \DateTime($eventData["EndEvent"]);
        $this->openBy = User::GetById($eventData["OpenBy"]);
        $this->openDate = new \DateTime($eventData["OpenDate"]);
        $this->comingUsers = unserialize($eventData["ComingUsers"]);
        $this->notComingUsers = unserialize($eventData["NotComingUsers"]);
    }

    /**
     * @param $eventId
     * @param array $eventData
     * @return Event
     * @throws Exception
     * @throws \Exception
     */
    private static function addEventByEventData($eventId, array $eventData) : Event{
        $res = @self::$events[$eventId];

        if(!empty($res))
            throw new Exception("Event {0} already exists in this array", null, $res);

        if(count($eventData) == 0)
            throw new Exception("Event {0} doesn't exists in DB", null, $eventId);

        self::$events[$eventId] = new Event($eventData);
        return self::$events[$eventId];
    }

    /**
     * @param $eventId
     * @return Event
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById($eventId) {
        if(empty($eventId))
            throw new Exception("Illegal Id!");

        $res = @self::$events[$eventId];

        if(empty($res)) {
            $eventData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $eventId)->getOne(self::TABLE_NAME);

            if(empty($eventData))
                throw new Exception("Event Id ({0}) not founded, Event doesn't exists", null, $eventId);

            $res = self::addEventByEventData($eventId, $eventData);
        }

        return $res;
    }

    /**
     * @return mixed
     */
    public function GetId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function GetTitle() {
        return $this->title;
    }

    /**
     * @return string
     */
    public function GetSubTitle() {
        return $this->subTitle;
    }

    /**
     * @return mixed
     */
    public function GetContent() {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function GetLocation(){
        return $this->location;
    }


    /**
     * @return \DateTime
     */
    public function GetStartEvent(): \DateTime {
        return $this->startEvent;
    }

    /**
     * @return \DateTime
     */
    public function GetEndEvent(): \DateTime {
        return $this->endEvent;
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
     * @return array
     */
    public function GetComingUsers() {
        return $this->comingUsers;
    }

    /**
     * @return array
     */
    public function GetNotComingUsers() {
        return $this->notComingUsers;
    }

    /**
     * @param string $title
     * @param string $content
     * @param $startEvent
     * @param $endEvent
     * @param $openBy
     * @param $level
     * @return Event
     * @throws Exception
     * @throws \Exception
     */
    public static function NewEvent(string $title,string $subtitle, string $content, $startEvent, $endEvent, $openBy, $level){
        if(empty($title) || empty($content) || empty($startEvent) || empty($endEvent) || empty($openBy))
            throw new Exception("Add cannot be done, info miss");

        $openDate = new \DateTime('now',new \DateTimeZone('Asia/Jerusalem'));

        $arrayToInsert = array("Title" => $title,
            "SubTitle" => $subtitle,
            "Content" => $content,
            "StartEvent" => $startEvent,
            "EndEvent" => $endEvent,
            "OpenBy" => $openBy,
            "OpenDate" => $openDate->format("Y-m-d H:i:s"),
            "ShowLevel" => $level,
            "ComingUsers" => "a:0:{}",
            "NotComingUsers" => "a:0:{}"
        );

        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $arrayToInsert);

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


    /**
     * @param $userId
     * @throws Exception
     */
    public function MarkUserAsComing($userId) {
        if(empty($userId))
            throw new Exception("User field is empty!");

        if(!in_array($userId, $this->comingUsers)) {
            array_push($this->comingUsers, $userId);
            Rimon::GetDB()->where("Id", $this->id)->update(self::TABLE_NAME, array("ComingUsers" => serialize($this->comingUsers)));
        }

        if($this->notComingUsers && in_array($userId, $this->notComingUsers)){
            $pos = array_search($userId, $this->notComingUsers);
            unset($this->notComingUsers[$pos]);
            Rimon::GetDB()->where("Id", $this->id)->update(self::TABLE_NAME, array("NotComingUsers" => serialize($this->notComingUsers)));
        }
    }

    /**
     * @param $userId
     * @throws Exception
     */
    public function MarkUserAsNotComing($userId) {
        if(empty($userId))
            throw new Exception("User field is empty!");

        if(!in_array($userId, $this->notComingUsers)) {
            array_push($this->notComingUsers, $userId);
            Rimon::GetDB()->where("Id", $this->id)->update(self::TABLE_NAME, array("NotComingUsers" => serialize($this->notComingUsers)));
        }

        if($this->comingUsers && in_array($userId, $this->comingUsers)){
            $pos = array_search($userId, $this->comingUsers);
            unset($this->comingUsers[$pos]);
            Rimon::GetDB()->where("Id", $this->id)->update(self::TABLE_NAME, array("ComingUsers" => serialize($this->comingUsers)));
        }
    }
}