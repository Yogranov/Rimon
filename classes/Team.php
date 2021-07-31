<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 26-Jan-18
 * Time: 13:59
 */

namespace Rimon;


class Team
{

    const TABLE_NAME = "teams";
    const TABLE_KEY_COLUMN = "Id";

    private static $teams = array();

    private $id;
    private $name;
    private $email;
    private $users = array();
    private $leader;
    private $about;


    /**
     * Team constructor.
     * @param array $teamData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $teamData) {
        $this->id = $teamData["Id"];
        $this->name = $teamData["Name"];
        $this->email = $teamData["Email"];

        $allTeam = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $this->id)->getOne(self::TABLE_NAME,"Users");
        $teamMembers = explode(",",$allTeam["Users"]);
        foreach ($teamMembers as $member){
            $this->users["$member"] = User::GetById($member);
        }

        $this->leader = User::GetById($teamData["Leader"]);
        $this->about = $teamData["About"];
    }


    /**
     * @param $teamId
     * @param array $teamData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addTeamByTeamData($teamId, array $teamData){
        $res = @self::$teams[$teamId];

        if(!empty($res))
            throw new Exception("team {0} already exists in this array", null, $res);

        if(count($teamData) == 0)
            throw new Exception("team {0} doesn't exists in DB", null, $teamId);

        self::$teams[$teamId] = new Team($teamData);
        return self::$teams[$teamId];
    }


    /**
     * @param int $teamId
     * @return Team
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $teamId) {
        if(empty($teamId))
            throw new Exception("Illegal Id!");

        $res = @self::$teams[$teamId];

        if(empty($res)) {
            $teamData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $teamId)->getOne(self::TABLE_NAME);

            if(empty($teamData))
                throw new Exception("team Id ({0}) not founded, team doesn't exists", null, $teamId);

            $res = self::addTeamByTeamData($teamId, $teamData);
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
    public function GetName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function GetEmail(){
        return $this->email;
    }

    /**
     * @return User[];
     */
    public function GetUsers(): array {
        return $this->users;
    }

    /**
     * @return User
     */
    public function GetLeader() {
        return $this->leader;
    }

    /**
     * @return mixed
     */
    public function GetAbout() {
        return $this->about;
    }

    /**
     * @return string
     */
    public function GetEnglishName() {
        switch ($this->name) {
            case "צוות מדיה ודיגיטל":
                $englishName = "technology";
                break;

            case "שיווק ופיתוח עסקי":
                $englishName = "marketing";
                break;

            case "צוות פיננסי":
                $englishName = "money";
                break;

            case "צוות האח הגדול":
                $englishName = "big-brother";
                break;

            case "צוות פרט וסיוע":
                $englishName = "assistance";
                break;

            case "צוות אזרחות":
                $englishName = "civilian";
                break;

            case "הנהלה":
                $englishName = "manage";
                break;

            default:
                $englishName = "";
                break;
        }
        return $englishName;
    }


}