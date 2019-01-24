<?php
require_once ('permission.php');

$permission = new permission_class();

$permission->setIsActive(1);
$permission->setIsDelete(0);

$output['data'] = $permission->getPermissionList();

echo json_encode($output);

 ?>
