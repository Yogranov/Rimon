<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 01-Feb-18
 * Time: 13:30
 */

namespace Rimon;


class EjobStatus extends \Enum
{

    const available = array(1, "עבודה זמינה");
    const notAvailable = array(2, "עבודה לא זמינה");

}