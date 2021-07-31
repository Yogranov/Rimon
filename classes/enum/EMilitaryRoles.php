<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 11:02
 */

namespace Rimon;


class EMilitaryRoles extends \Enum
{

    const Warrior = array(1, "לוחם");
    const CombatSupport = array(2, "תומך לחימה");
    const Officer = array(3, "קצין");
    const Other = array(4, "אחר");


}