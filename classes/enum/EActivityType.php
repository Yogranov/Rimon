<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 08-Feb-18
 * Time: 09:48
 */

namespace Rimon;


class EActivityType extends \Enum
{
    const meeting = array(1, "פגישה/ישיבה");
    const unit = array(2, "פעילות יחידה");
    const association = array(3, "פעילות עמותה");

}