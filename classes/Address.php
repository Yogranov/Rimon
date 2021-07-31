<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 10:38
 */

namespace Rimon;


class Address
{
    private static $address = array();

    const TABLE_NAME = "address";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $userId;
    private $postalCode;
    private $cityName;
    private $street;
    private $houseNumber;
    private $apartmentNumber;



    /**
     * MilitaryService constructor.
     * @param array $addressData
     * @throws \Exception
     */
    private function __construct(array $addressData) {
        $this->id = $addressData["Id"];
        $this->userId = $addressData["UserId"];
        $this->postalCode = $addressData["PostalCode"];
        $this->cityName = $addressData["CityName"];
        $this->street = $addressData["Street"];
        $this->houseNumber = $addressData["HouseNumber"];
        $this->apartmentNumber = $addressData["ApartmentNumber"];

    }


    /**
     * @param $addressId
     * @param array $addressData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addAddressByAddressData($addressId, array $addressData){
        $res = @self::$address[$addressId];

        if(!empty($res))
            throw new Exception("address {0} already exists in this array", null, $res);

        if(count($addressData) == 0)
            throw new Exception("address {0} doesn't exists in DB", null, $addressId);

        self::$address[$addressId] = new Address($addressData);
        return self::$address[$addressId];
    }


    /**
     * @param int $addressId
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $addressId) {
        if(empty($addressId))
            throw new Exception("Illegal Id!");

        $res = @self::$address[$addressId];

        if(empty($res)) {
            $addressData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $addressId)->getOne(self::TABLE_NAME);

            if(empty($addressData))
                throw new Exception("address Id ({0}) not founded, address doesn't exists", null, $addressId);

            $res = self::addAddressByAddressData($addressId, $addressData);
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
    public function GetPostalCode(){
        return $this->postalCode;
    }

    /**
     * @return mixed
     */
    public function GetCityName(){
        return $this->cityName;
    }

    /**
     * @return mixed
     */
    public function GetStreet(){
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function GetHouseNumber(){
        return $this->houseNumber;
    }

    /**
     * @return mixed
     */
    public function GetApartmentNumber(){
        return $this->apartmentNumber;
    }

    /**
     * @param $data
     * @return Address
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