<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 06-Feb-18
 * Time: 00:23
 */
namespace Rimon;

class Task
{
    const TABLE_NAME = "tasks";
    const TABLE_KEY_COLUMN = "Id";

    private static $tasks = array();

    private $id;
    private $subject;
    private $task;
    private $status;
    private $createBy;
    private $team;
    private $openDate;
    private $finishDate;


    /**
     * Task constructor.
     * @param array $taskData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $taskData) {
        $this->id = $taskData["Id"];
        $this->subject = $taskData["Subject"];
        $this->task = $taskData["Task"];
        $this->status = ETaskStatus::search($taskData["Status"]);
        $this->createBy = User::GetById($taskData["CreateBy"]);
        $this->team = Team::GetById($taskData["Team"]);
        $this->openDate = new \DateTime($taskData["OpenDate"]);
        $this->finishDate = new \DateTime($taskData["FinishDate"]);
    }


    /**
     * @param $taskId
     * @param array $taskData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addTaskByTaskData($taskId, array $taskData){
        $res = @self::$tasks[$taskId];

        if(!empty($res))
            throw new Exception("task {0} already exists in this array", null, $res);

        if(count($taskData) == 0)
            throw new Exception("task {0} doesn't exists in DB", null, $taskId);

        self::$tasks[$taskId] = new Task($taskData);
        return self::$tasks[$taskId];
    }


    /**
     * @param int $taskId
     * @return Task
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $taskId) {
        if(empty($taskId))
            throw new Exception("Illegal Id!");

        $res = @self::$tasks[$taskId];

        if(empty($res)) {
            $taskData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $taskId)->getOne(self::TABLE_NAME);

            if(empty($taskData))
                throw new Exception("task Id ({0}) not founded, task doesn't exists", null, $taskId);

            $res = self::addTaskByTaskData($taskId, $taskData);
        }

        return $res;
    }


    /**
     * @return array
     * @throws Exception
     */
    public static function GetActive() {
        $allTasks = Rimon::GetDB()->where("Status",4,'IS NOT')->get(self::TABLE_NAME,null,"Id");
        return $allTasks;
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
    public function GetSubject() {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function GetTask() {
        return $this->task;
    }

    /**
     * @return ETaskStatus
     */
    public function GetStatus() {
        return $this->status;
    }

    /**
     * @return User
     */
    public function GetCreateBy(): User {
        return $this->createBy;
    }

    /**
     * @return Team
     */
    public function GetTeam() {
        return $this->team;
    }


    /**
     * @return \DateTime
     */
    public function GetOpenDate(): \DateTime {
        return $this->openDate;
    }

    /**
     * @return \DateTime
     */
    public function GetFinishDate(): \DateTime {
        return $this->finishDate;
    }

    /**
     * @param int $status
     * @throws DBException
     * @throws Exception
     */
    public function ChangeStatus(int $status) {
        if(empty($status))
            throw new Exception("Status doesn't changed, no status found");

        $success  = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN,$this->id)->update(self::TABLE_NAME,array("Status" => $status));
        $this->status = ETaskStatus::search($status);
        if(!$success)
            throw new DBException("Status doesn't changed, DB error");
    }

    /**
     * @param $data
     * @return Businesses
     * @throws Exception
     * @throws \Exception
     */
    public static function &Add($data){
        if(empty($data))
            throw new Exception("Create cannot be done, info miss");
        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Create didn't complete, DB error");
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