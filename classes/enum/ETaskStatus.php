<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 06-Feb-18
 * Time: 00:31
 */

namespace Rimon;


class ETaskStatus extends \Enum
{
    const Open = array(1, "פתוח");
    const InProgress = array(2, "בתהליך");
    const InHold = array(3, "בהמתנה");
    const close = array(4, "סגור");
}