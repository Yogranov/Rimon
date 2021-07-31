<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 01-Feb-18
 * Time: 13:30
 */

namespace Rimon;


class EjobType extends \Enum
{

    const explanation = array(1, "הסברה");
    const office = array(2, "משרדית");
    const security = array(3, "אבטחה");
    const Sales = array(4, "מכירות");
    const teach = array(5, "הדרכה");
    const drive = array(6, "נהיגה");
    const manage = array(7, "ניהול");
    const medicine = array(8, "רפואה");
    const other = array(9, "אחר");

}