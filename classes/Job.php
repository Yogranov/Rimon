<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 01-Feb-18
 * Time: 13:08
 */

namespace Rimon;

class Job
{
    private static $job = array();

    const TABLE_NAME = "jobs";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $title;
    private $content;
    private $jobScope;
    private $openDate;
    private $openBy;
    private $type;
    private $location;
    private $wage;
    private $status;
    private $contactName;
    private $contactPhoneNumber;
    private $contactEmail;
    private $contactSite;
    private $contactOther;


    /**
     * Job constructor.
     * @param array $jobData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $jobData) {
        $this->id = $jobData["Id"];
        $this->title = $jobData["Title"];
        $this->content = $jobData["Content"];
        $this->jobScope = $jobData["JobScope"];
        $this->openDate = new \DateTime($jobData["OpenDate"]);
        $this->openBy = User::GetById($jobData["OpenBy"]);
        $this->type = EjobType::search($jobData["Type"]);
        $this->location = $jobData["Location"];
        $this->wage = $jobData["Wage"];
        $this->status = EjobStatus::search($jobData["Status"]);
        $this->contactName = $jobData["ContactName"];
        $this->contactPhoneNumber = $jobData["ContactPhoneNumber"];
        $this->contactEmail = $jobData["ContactEmail"];
        $this->contactSite = $jobData["ContactSite"];
        $this->contactOther = $jobData["ContactOther"];
    }

    /**
     * @param $jobId
     * @param array $jobData
     * @return Job
     * @throws Exception
     * @throws \Exception
     */
    private static function addJobByJobData($jobId, array $jobData) : Job{
        $res = @self::$job[$jobId];

        if(!empty($res))
            throw new Exception("job {0} already exists in this array", null, $res);

        if(count($jobData) == 0)
            throw new Exception("job {0} doesn't exists in DB", null, $jobId);

        self::$job[$jobId] = new Job($jobData);
        return self::$job[$jobId];
    }

    /**
     * @param $jobId
     * @return Job
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById($jobId) {
        if(empty($jobId))
            throw new Exception("Illegal Id!");

        $res = @self::$job[$jobId];

        if(empty($res)) {
            $jobData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $jobId)->getOne(self::TABLE_NAME);

            if(empty($jobData))
                throw new Exception("job Id ({0}) not founded, job doesn't exists", null, $jobId);

            $res = self::addJobByJobData($jobId, $jobData);
        }

        return $res;
    }

    /**
     * @return int
     */
    public function GetId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function GetTitle(){
        return $this->title;
    }

    /**
     * @return string
     */
    public function GetContent(){
        return $this->content;
    }

    /**
     * @return \DateTime
     */
    public function GetOpenDate(): \DateTime{
        return $this->openDate;
    }

    /**
     * @return User
     */
    public function GetOpenBy(): User{
        return $this->openBy;
    }

    /**
     * @return EjobType
     */
    public function GetType(){
        return $this->type;
    }

    /**
     * @return string
     */
    public function GetLocation(){
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function GetWage(){
        return $this->wage;
    }

    /**
     * @return EjobStatus
     */
    public function GetStatus(){
        return $this->status;
    }

    /**
     * @return string
     */
    public function GetJobScope(){
        return $this->jobScope;
    }

    /**
     * @return string
     */
    public function GetContactName(){
        return $this->contactName;
    }

    /**
     * @return string
     */
    public function GetContactPhoneNumber(){
        return $this->contactPhoneNumber;
    }

    /**
     * @return string
     */
    public function GetContactEmail(){
        return $this->contactEmail;
    }

    /**
     * @return mixed
     */
    public function GetContactSite(){
        return $this->contactSite;
    }

    /**
     * @return mixed
     */
    public function GetContactOther(){
        return $this->contactOther;
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
    public function &Update($data = array()){
        if(empty($data))
            throw new Exception("Update cannot be done, info miss");
        $success = Rimon::GetDB()->where("Id",$this->id)->update(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
    }

    /**
     * @throws Exception
     */
    public function Close() {
        $success = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $this->id)->update(self::TABLE_NAME, array("Status" => 2));
        if(!$success)
            throw new Exception("Unable to close right now");
    }
}