<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 10:38
 */

namespace Rimon;


class Education
{


    private static $education = array();

    const TABLE_NAME = "education";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $userId;
    private $type;
    private $years;
    private $name;
    private $institute;


    /**
     * MilitaryService constructor.
     * @param array $educationData
     * @throws \Exception
     */
    private function __construct(array $educationData) {
        $this->id = $educationData["Id"];
        $this->userId = $educationData["UserId"];
        $this->type = EEducationTypes::search($educationData["Type"]);
        $this->years = $educationData["Years"];
        $this->name = $educationData["Name"];
        $this->institute = $educationData["Institute"];
    }


    /**
     * @param $educationId
     * @param array $educationData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addEducationByEducationData($educationId, array $educationData){
        $res = @self::$education[$educationId];

        if(!empty($res))
            throw new Exception("education {0} already exists in this array", null, $res);

        if(count($educationData) == 0)
            throw new Exception("education {0} doesn't exists in DB", null, $educationId);

        self::$education[$educationId] = new Education($educationData);
        return self::$education[$educationId];
    }


    /**
     * @param int $educationId
     * @return Education
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById($educationId) {
        if(empty($educationId))
            throw new Exception("Illegal Id!");

        $res = @self::$education[$educationId];

        if(empty($res)) {
            $educationData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $educationId)->getOne(self::TABLE_NAME);

            if(empty($educationData))
                throw new Exception("education Id ({0}) not founded, education doesn't exists", null, $educationId);

            $res = self::addEducationByEducationData($educationId, $educationData);
        }

        return $res;
    }

    /**
     * @return mixed
     */
    public function GetId(){
        return $this->id;
    }



    /**
     * @return EEducationTypes
     */
    public function GetType(){
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function GetYears(){
        return $this->years;
    }

    /**
     * @return mixed
     */
    public function GetName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function GetInstitute(){
        return $this->institute;
    }

    /**
     * @return mixed
     */
    public function GetUserId(){
        return $this->userId;
    }


    /**
     * @param $data
     * @return Education
     * @throws Exception
     * @throws \Exception
     */
    public static function &Add($data){
        if(empty($data))
            throw new Exception("Add cannot be done, info miss");
        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Add didn't complete, DB error");
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
        $success = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN,$this->id)->update(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
    }


    /**
     * @throws Exception
     */
    public function Delete () {
        $success = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $this->id)->delete(self::TABLE_NAME);
        if(!$success) {
            throw new Exception("Cannot delete remind {0} right now!",null,$this->id);
        }
    }

}