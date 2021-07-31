<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 11:19
 */

namespace Rimon;


class EEducationTypes extends \Enum
{
    const HighSchool = array(1, "השכלה תיכונית");
    const PracticalEngineer = array(2, "הנדסאי");
    const BA = array(3, "תואר ראשון");
    const MA = array(4, "תואר שני");
    const other = array(5, "אחר");

}