<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Feb-18
 * Time: 09:47
 */
namespace Rimon;


class ActivitySummary
{

    private static $activitySummaries = array();

    const TABLE_NAME = "activitySummary";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $team;
    private $subject;
    private $type;
    private $location;
    private $date;
    private $presents;
    private $content;



    /**
     * ActivitySummary constructor.
     * @param array $activitySummary
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $activitySummary) {
        $this->id = $activitySummary["Id"];
        $this->team = Team::GetById($activitySummary["Team"]);
        $this->subject = $activitySummary["Subject"];
        $this->type = EActivityType::search($activitySummary["Type"]);
        $this->location = $activitySummary["Location"];
        $this->date = new \DateTime($activitySummary["Date"]);

        $allTeam = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $this->id)->getOne(self::TABLE_NAME,"Presents");
        $teamMembers = explode(",",$allTeam["Presents"]);
        foreach ($teamMembers as $member){
            $this->presents["$member"] = User::GetById($member);
        }

        $this->content = $activitySummary["Content"];
    }

    /**
     * @param $activitySummaryId
     * @param array $activitySummaryData
     * @return ActivitySummary
     * @throws Exception
     * @throws \Exception
     */
    private static function addActivitySummaryByActivitySummaryData($activitySummaryId, array $activitySummaryData) : ActivitySummary{
        $res = @self::$activitySummaries[$activitySummaryId];

        if(!empty($res))
            throw new Exception("activitySummary {0} already exists in this array", null, $res);

        if(count($activitySummaryData) == 0)
            throw new Exception("activitySummary {0} doesn't exists in DB", null, $activitySummaryId);

        self::$activitySummaries[$activitySummaryId] = new activitySummary($activitySummaryData);
        return self::$activitySummaries[$activitySummaryId];
    }

    /**
     * @param $activitySummaryId
     * @return ActivitySummary
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById($activitySummaryId) {
        if(empty($activitySummaryId))
            throw new Exception("Illegal Id!");

        $res = @self::$activitySummaries[$activitySummaryId];

        if(empty($res)) {
            $activitySummaryData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $activitySummaryId)->getOne(self::TABLE_NAME);

            if(empty($activitySummaryData))
                throw new Exception("activitySummary Id ({0}) not founded, activitySummary doesn't exists", null, $activitySummaryId);

            $res = self::addActivitySummaryByActivitySummaryData($activitySummaryId, $activitySummaryData);
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
     * @return Team
     */
    public function GetTeam() {
        return $this->team;
    }



    /**
     * @return string
     */
    public function GetSubject() {
        return $this->subject;
    }

    /**
     * @return EActivityType
     */
    public function GetType() {
        return $this->type;
    }

    /**
     * @return string
     */
    public function GetLocation() {
        return $this->location;
    }

    /**
     * @return \DateTime
     */
    public function GetDate(): \DateTime {
        return $this->date;
    }

    /**
     * @return User[]
     */
    public function GetPresents() {
        return $this->presents;
    }

    /**
     * @return string
     */
    public function GetContent() {
        return $this->content;
    }

    /**
     * @param $data
     * @return Job
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
    public function Update($data = array()){
        if(empty($data))
            throw new Exception("Update cannot be done, info miss");
        $success = Rimon::GetDB()->where("Id",$this->id)->update(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
    }
}