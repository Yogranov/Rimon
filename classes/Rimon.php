<?php
namespace Rimon;

require "MysqliDb.php";
require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";

//aux classes
include_once "Exception.php";
include_once "Constant.php";
include_once "EmailsConstant.php";
include_once "Services.php";
include_once "Cookie.php";

//Enums
include_once "Enum.php";
include_once "enum/EEducationTypes.php";
include_once "enum/EMilitaryRoles.php";
include_once "enum/EUserRoles.php";
include_once "enum/EjobType.php";
include_once "enum/EjobStatus.php";
include_once "enum/ETaskStatus.php";
include_once "enum/EActivityType.php";

//inner classes
include_once "Login.php";
include_once "PasswordHash.php";
include_once "Address.php";
include_once "Businesses.php";
include_once "Education.php";
include_once "Team.php";
include_once "User.php";
include_once "Job.php";
include_once "Task.php";
include_once "ActivitySummary.php";
include_once "Event.php";
include_once "Token.php";
include_once "Conversation.php";
include_once "PrivateMessage.php";
include_once "MessageBoard.php";
include_once "TelegramBot.php";
include_once "Encryption.php";

class Rimon {

    private static $db;
    private static $email;


    /**
     * @return \MysqliDb
     * @throws Exception
     */
    public static function GetDB() {
        if (isset(self::$db) && !empty(self::$db)) {
            return self::$db;
        }
        else {
            if (!class_exists("MysqliDb"))
                throw new Exception("Mandatory 'MysqliDB' class not exist!");

            $SqlCredential = \Credential::GetCredential('sql_' . Constant::MYSQL_SERVER . '_' . Constant::MYSQL_SERVER_PORT . '_' . Constant::MYSQL_DATABASE);
            self::$db = new \MysqliDb (Constant::MYSQL_SERVER, $SqlCredential->GetUsername(), $SqlCredential->GetPassword(), Constant::MYSQL_DATABASE, Constant::MYSQL_SERVER_PORT);
            return self::$db;
        }
    }

    /**
     * @param string $subject
     * @param string $message
     * @param bool $clear
     * @return \PHPMailer
     * @throws Exception
     */
    public static function GetEmail(string $subject, string $message, bool $clear = True) {
        try {
            if (isset(self::$email) && !empty(self::$email)) {
                $ret = self::$email;
            } else {
                $Email = new \PHPMailer();

                //$Email->isSendmail();
                $Email->IsHTML(true);
                $Email->setFrom(Constant::EMAIL_MAIN_ADDRESS, Constant::EMAIL_MAIN_NAME);
                $Email->ContentType = "text/html;charset=utf-8";
                $Email->headerLine("MIME-Version", 1.0);
                $Email->CharSet = "UTF-8";

                $body = <<<RIMON
                    <html dir=rtl>
                        <body>
                            {$message}
                        </body>
                    </html>
RIMON;
                $Email->Subject = $subject;
                $Email->Body = $body;
                $Email->AltBody = strip_tags($message);


                $ret = self::$email = $Email;
            }

            /*
            $ret->addReplyTo(Constant::EMAIL_MAIN_ADDRESS, Constant::EMAIL_MAIN_NAME);
            $ret->headerLine("Return-Path", Constant::EMAIL_MAIN_ADDRESS);
            $ret->headerLine("From", Constant::EMAIL_MAIN_ADDRESS);
            $ret->headerLine("Organization", Constant::EMAIL_MAIN_NAME);
            $ret->headerLine("X-Priority", 1);
            */

            if ($clear) {
                self::$email->ClearAddresses(); //
                self::$email->ClearCCs();
                self::$email->ClearBCCs();
                self::$email->clearAttachments();
            }
            return $ret;
        } catch (\Throwable $e) {
            throw new Exception($e->getMessage());
        }

    }

    /**
     * @param string $subject
     * @param string $body
     * @return \PHPMailer
     * @throws \Exception
     */
    public static function GetGmail(string $subject, string $body) {
        $mail = new \PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = Constant::MAIN_GMAIL;
        $mail->Password = \Credential::GetCredential(Constant::MYSQL_DATABASE . "_gmail_account")->GetPassword();;
        $mail->SetFrom(Constant::MAIN_GMAIL, Constant::EMAIL_MAIN_NAME);


        $mail->Subject = $subject;
        $mail->Body = $body;

        return $mail;
    }

    /**
     * @param null $fromRole
     * @return array
     * @throws Exception
     */
    public static function GetPermissions($fromRole = null){
        $permissions = array();
        ///Menu Setting
        if (isset($_SESSION["UserId"])) {

            $userObj = &User::GetById($_SESSION["UserId"]);
            if($userObj->GetRole()->getValue() !== EUserRoles::NewUser[0]) {
                $permissions["Menu"] = familyMenu;

                switch ($userObj->GetRole()->getValue()){

                    case EUserRoles::ActiveMember[0]:
                        $managerMenu = ActiveMember;
                        break;

                    case EUserRoles::TeamLeader[0]:
                        $managerMenu = TeamLeader;
                        break;

                    case EUserRoles::Manager[0]:
                        $managerMenu = ManagerMenu;
                        break;

                    default:
                        $managerMenu = "";
                        break;
                }
                $permissions["ManagerMenu"] = $managerMenu;

            } else {
                Login::Disconnect();
            }
        } else {
            $permissions["Menu"] = officialMenu;
            $permissions["ManagerMenu"] = "";
        }

        /// Page Permissions
        if ($fromRole != null) {
            if(isset($_SESSION["UserId"])) {
                if ($userObj->GetRole()->getValue() < $fromRole)
                    \Services::RedirectHome();
            } else
                \Services::RedirectHome();
        }
    return $permissions;
    }

    /**
     * @param string $text
     */
    public static function NewLog(string $text) {
        $time = new \DateTime('now', new \DateTimeZone(Constant::SYSTEM_TIMEZONE));
        $logFile = fopen(__DIR__ . "/../manage/logs/" . Constant::SYSTEM_NAME . "-" . $time->format("Y-m") . ".php", "a");
        fwrite($logFile,$time->format("Y-m-d H:i:s") . ": " . $text . "<br>" . "\n");
        fclose($logFile);
    }
}