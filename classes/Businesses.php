<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 10:39
 */

namespace Rimon;


class Businesses
{
    private static $businesses = array();

    const TABLE_NAME = "businesses";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $userId;
    private $name;
    private $address;
    private $phoneNumber;
    private $about;


    /**
     * Businesses constructor.
     * @param array $businessData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $businessData) {
        $this->id = $businessData["Id"];
        $this->userId = $businessData["UserId"];
        $this->name = $businessData["Name"];
        $this->address = Address::GetById($businessData["Address"]);
        $this->phoneNumber = $businessData["PhoneNumber"];
        $this->about = $businessData["About"];

    }


    /**
     * @param $businessId
     * @param array $businessData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addBusinessByBusinessData($businessId, array $businessData){
        $res = @self::$businesses[$businessId];

        if(!empty($res))
            throw new Exception("business {0} already exists in this array", null, $res);

        if(count($businessData) == 0)
            throw new Exception("business {0} doesn't exists in DB", null, $businessId);

        self::$businesses[$businessId] = new Businesses($businessData);
        return self::$businesses[$businessId];
    }


    /**
     * @param int $businessId
     * @return Businesses
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $businessId) {
        if(empty($businessId))
            throw new Exception("Illegal Id!");

        $res = @self::$businesses[$businessId];

        if(empty($res)) {
            $businessData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $businessId)->getOne(self::TABLE_NAME);

            if(empty($businessData))
                throw new Exception("business Id ({0}) not founded, business doesn't exists", null, $businessId);

            $res = self::addBusinessByBusinessData($businessId, $businessData);
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
     * @return mixed
     */
    public function GetName(){
        return $this->name;
    }

    /**
     * @return Address
     */
    public function GetAddress(){
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function GetPhoneNumber(){
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function GetAbout(){
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function GetUserId(){
        return $this->userId;
    }

    /**
     * @param $data
     * @return Businesses
     * @throws Exception
     * @throws \Exception
     */
    public static function &Add($data){
        if(empty($data))
            throw new Exception("Update cannot be done, info miss");
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