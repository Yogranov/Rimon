<?php
/**
 * Created by PhpStorm.
 * User: Yogev
 * Date: 07-Apr-18
 * Time: 19:06
 */
namespace Rimon;
require_once "../../classes/Rimon.php";


$SqlCredential = \Credential::GetCredential('sql_' . Constant::MYSQL_SERVER . '_' . Constant::MYSQL_SERVER_PORT . '_' . Constant::MYSQL_DATABASE);

return array(
    'backup_dir'    => '/path/to/your/backups',
    'keep_files'    => 14,
    'compression'   => '', // gzip, bzip2, etc
    'db_host'       => Constant::MYSQL_SERVER,
    'db_port'       => Constant::MYSQL_SERVER_PORT,
    'db_protocol'   => Constant::MYSQL_PROTOCOL,
    'db_user'       => $SqlCredential->GetUsername(),
    'db_passwd'     => $SqlCredential->GetPassword(),
    'db_names'      => Constant::DB_BACKUP_DBS
);