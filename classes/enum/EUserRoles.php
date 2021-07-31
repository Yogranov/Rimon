<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 21-Jan-18
 * Time: 10:21
 */

namespace Rimon;


class EUserRoles extends \Enum {

    const NewUser = array(1, "נרשם חדש");
    const AssociationMember = array(2, "חבר עמותה");
    const AssociationMemberVIP = array(3, "חבר עמותה VIP");
    const ActiveMember = array(4, "פעיל עמותה");
    const TeamLeader = array(5, "ראש צוות");
    const Manager = array(6, "מנהל");

}