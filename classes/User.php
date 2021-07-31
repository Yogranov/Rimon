<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 10:03
 */

namespace Rimon;


class User{

    private static $users = array();

    const TABLE_NAME = "users";
    const TABLE_KEY_COLUMN = "Id";

    private $id;
    private $password;
    private $email;
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $personalNumber;
    private $birthday;
    private $address;
    private $militaryType;
    private $recruitment;
    private $profession;
    private $education = array();
    private $businesses = array();
    private $facebook;
    private $about;
    private $registerDate;
    private $lastLogin;
    private $associationJob;
    private $role;
    private $recoverPassword;


    /**
     * User constructor.
     * @param array $userData
     * @throws Exception
     * @throws \Exception
     */
    private function __construct(array $userData) {
        $this->id = $userData["Id"];
        $this->password = $userData["Password"];
        $this->email = $userData["Email"];
        $this->firstName = $userData["FirstName"];
        $this->lastName = $userData["LastName"];
        $this->phoneNumber = $userData["PhoneNumber"];
        $this->personalNumber = $userData["PersonalNumber"];
        $this->birthday = new \DateTime($userData["Birthday"]);
        $this->address = Address::GetById($userData["Address"]);
        $this->militaryType = EMilitaryRoles::search($userData["MilitaryType"]);
        $this->recruitment = new \DateTime($userData["Recruitment"]);
        $this->profession = $userData["Profession"];


        $educationArray = Rimon::GetDB()->where("UserId", $userData["Id"])->get("education", null, "Id");
        foreach ($educationArray as $educationId) {
            $this->education[$educationId["Id"]] = &Education::GetById($educationId["Id"]);
        }

        $BusinessArray = Rimon::GetDB()->where("UserId", $userData["Id"])->get("businesses", null, "Id");
        foreach ($BusinessArray as $businessId) {
            $this->businesses[$businessId["Id"]] = &Businesses::GetById($businessId["Id"]);
        }


        $this->facebook = $userData["Facebook"];
        $this->about = $userData["About"];
        $this->registerDate = new \DateTime($userData["RegisterDate"]);
        $this->lastLogin = new \DateTime($userData["LastLogin"]);
        $this->role = EUserRoles::search($userData["Role"]);
        $this->recoverPassword = $userData["RecoverPassword"];

    }


    /**
     * @param $UserId
     * @param array $UserData
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    private static function addUserByUserData($UserId, array $UserData){
        $res = @self::$users[$UserId];

        if(!empty($res))
            throw new Exception("User {0} already exists in this array", null, $res);

        if(count($UserData) == 0)
            throw new Exception("User {0} doesn't exists in DB", null, $UserId);

        self::$users[$UserId] = new User($UserData);
        return self::$users[$UserId];
    }


    /**
     * @param int $UserId
     * @return User
     * @throws Exception
     * @throws \Exception
     */
    public static function &GetById(int $UserId) {
        if(empty($UserId))
            throw new Exception("Illegal Id!");

        $res = @self::$users[$UserId];

        if(empty($res)) {
            $UserData = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $UserId)->getOne(self::TABLE_NAME);

            if(empty($UserData))
                throw new Exception("User Id ({0}) not founded, User doesn't exists", null, $UserId);

            $res = self::addUserByUserData($UserId, $UserData);
        }

        return $res;
    }

    /**
     * @return string
     */
    public function GetId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function GetEmail(){
        return $this->email;
    }

    /**
     * @return string
     */
    public function GetFirstName(){
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function GetLastName(){
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function GetPhoneNumber(){
        return $this->phoneNumber;
    }

    /**
     * @return int
     */
    public function GetPersonalNumber(){
        return $this->personalNumber;
    }

    /**
     * @return Address
     */
    public function GetAddress(){
        return $this->address;
    }

    /**
     * @return \DateTime
     */
    public function GetBirthday(){
        return $this->birthday;
    }

    /**
     * @return EMilitaryRoles
     */
    public function GetMilitaryType(){
        return $this->militaryType;
    }

    /**
     * @return \DateTime
     */
    public function GetRecruitment(){
        return $this->recruitment;
    }


    /**
     * @return string
     */
    public function GetProfession(){
        return $this->profession;
    }

    /**
     * @return Education[]
     */
    public function GetEducation(){
        return $this->education;
    }

    /**
     * @return Businesses[]
     */
    public function GetBusinesses(){
        return $this->businesses;
    }

    /**
     * @return string
     */
    public function GetFacebook(){
        return $this->facebook;
    }

    /**
     * @return string
     */
    public function GetAbout(){
        return $this->about;
    }

    /**
     * @return \DateTime
     */
    public function GetRegisterDate(){
        return $this->registerDate;
    }

    /**
     * @return \DateTime
     */
    public function GetLastLogin(){
        return $this->lastLogin;
    }

    /**
     * @return EUserRoles
     */
    public function GetRole() {
        return $this->role;
    }

    public function GetFullName(){
        return $this->firstName." ".$this->lastName;
    }

    /**
     * @throws Exception
     */
    public function SetLastLogin(){
        $time = new \DateTime('now',new \DateTimeZone('Asia/Jerusalem'));
        $this->lastLogin = $time;
        $arrayToUpdate = array("LastLogin" =>$time->format("Y-m-d H:i:s"));
        Rimon::GetDB()->where("Id", $this->id)->update(self::TABLE_NAME,$arrayToUpdate);
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
     * @param $userId
     * @return bool
     * @throws Exception
     */
    public static function IsExist($userId){
        $DB = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN, $userId)->getOne(self::TABLE_NAME);
        if(!empty($DB))
            return true;
        else
            return false;
    }

    /**
     * @return bool
     * @throws Exception
     * @throws \Exception
     */
    public function Approve(){
        $userInfo = Rimon::GetDB()->where(self::TABLE_KEY_COLUMN,$this->GetId())->where("Role",1)->getOne(self::TABLE_NAME);
        if(empty($userInfo))
            throw new Exception("לא נמצא משתמש בדרגה המתאימה");

        $update = User::GetById($userInfo["Id"])->Update(array("Role" => 2));
        if(!$update){
            return false;
            throw new Exception("לא ניתן לשנות הרשאה למשתמש [0]", null, $userInfo["Id"]);
        } else {
            return true;
        }
    }

    /**
     * @param $data
     * @return User
     * @throws Exception
     * @throws \Exception
     */
    public static function Add($data){
        if(empty($data))
            throw new Exception("Update cannot be done, info miss");

        if(self::IsExist($data["Id"]))
            throw new Exception("The user [0] already exists" , null, $data["Id"]);

        $success = Rimon::GetDB()->insert(self::TABLE_NAME, $data);

        if(!$success)
            throw new Exception("Update didn't complete, DB error");
        $res = &self::GetById($data["Id"]);
        return $res;
    }


    /**
     * @param string $message
     * @param string $subject
     * @param string $AttachedFile
     * @throws Exception
     * @throws \Exception
     */
    public function SendEmail(string $message, string $subject, string $AttachedFile = "") {
        if (empty($this->email))
            throw new Exception("Email not exist!", $this);

        $emailObject = Rimon::GetEmail($subject, $message);
        $emailObject->addAddress($this->email);
        //if (is_string($AttachedFile) && file_exists($AttachedFile)) {
        //\Services::dump($AttachedFile);
        //$emailObject->addAttachment($AttachedFile);
        //}

        if (!$emailObject->send())
            throw new Exception($emailObject->ErrorInfo);

    }

    /**
     * @param string $subject
     * @param string $message
     * @throws Exception
     */
    public function SendGmail(string $subject, string $message) {
        if (empty($this->email))
            throw new Exception("Email not exist!", $this);

        $emailObject = Rimon::GetGmail($subject, $message);
        $emailObject->addAddress($this->email);

        try {
            $emailObject->Send();
        } catch (\Throwable $e) {
            echo $e;
        }
    }

    /**
     *
     */
    public function ResetPassword(){
        $recoverPassword = \Services::GenerateRandomString(32);
        $recoverPasswordHash = md5($recoverPassword);
        $subject = "עמותת בוגרי רימון - איפוס סיסמה";
        $message = EmailsConstant::forgotPassword;


        $forgotLink = "{$this->email}_{$recoverPassword}";
        $forgotLinkEncode = base64_encode($forgotLink);
        \Services::setPlaceHolder($message,"forgotLink",$forgotLinkEncode);

        try {
            self::Update(array("RecoverPassword" => $recoverPasswordHash));

            \Services::setPlaceHolder($message,"userName",self::GetFirstName());
            self::SendEmail($message, $subject);

            $_SESSION["FlashText"] = "בקשתך התקבלה, בעוד רגע תקבל הודעה לדואר האלקטרוני על איפוס הסיסמה (עלול להגיע לספאם).";
            header("Location: flash.php");

        } catch (\Throwable $e){
            echo $e;
        }
    }

}