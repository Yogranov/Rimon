<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 16-Sep-17
 * Time: 17:37
 */

namespace Rimon;

//use Log\ELogLevel;

class Exception extends \Exception
{
    public function __construct($message = "", $dumpVar = null, ...$vars) {
        $dumpVarRes = "";
        $trace = debug_backtrace();
        unset($trace[0]);
        $res = \Services::dump($trace, false);

        if ($dumpVar)
            $dumpVarRes = \Services::dump($dumpVar, false);

        for ($i=0; $i < count($vars); $i++) {
            $message = str_replace("{".$i."}", $vars[$i], $message);
        }


        $message = "Exception: ".$message."<BR>".$res."<BR>".$dumpVarRes;

        parent::__construct($message, 0, null);
    }
}