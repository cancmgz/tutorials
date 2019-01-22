<?php
echo 'Hello world!';

include('roles.php');
include('permission.php');

$permission = new permission();
$roles = new roles();

$name="userDelete";
$description ="Can this person user delete ?";

/*
veritabanımızda pages diye bir tablo oluşturup projemizde ki sayfaları buradan yönetebiliriz.
Bu şekilde kullanmak istemiyorsanız,
roles sınıfımızda kullandığımız page alanını integer'dan string ifadeye değiştirmeyi unutmayınız.
*/
$page=20; //20 user sayfamız olsun. bu eylemi hangi sayfada gerçekleştirecek diye düşünebiliriz.
$createUser = 1; // Bu kayıtı oluşturan yetkilinin id numarası.

$nowTime = Date('Y-m-d H:i:s');
$roles->setName($name);
$roles->setIsActive(1);
$roles->setIsDelete(0);
$roles->setDescription($description);
$roles->setPage($page);
$roles->setCreateUser($createUser);
$roles->setCreateDate($nowTime);
$addRole = $roles->addRoles();

if($addRole==100){
  echo 'successfully';
}else {
  echo $addRole;
}

$roleId = 231; //kullanıcıya atayacağımız rolün id numarası.
$userId = 1907; //rolün atanacağı kullanıcının id numarası.

$permission->setRolesId($roleId);
$permission->setIsActive(1);
$permission->setIsDelete(0);
$permission->setUserId($userId);
$permission->setCreateUser($createUser);
$permission->setCreateDate($nowTime);
$addPermission = $permission->addPermission();

if($addPermission==100){
  echo 'successfully';
}else {
  echo $addPermission;
}

function checkPermission($roleId, $userId){
  /*
  Her seferinde veritabanına gidip kontrol etmesini engellemek için, üye login alanında izinleri bir session arrayinde tutabilirsiniz.
  Aşağıda veritabanına giden örneği bulunmakta.
  */
    $permission->setUserId($userId);
    $permission->setIsActive(1);
    $permission->setIsDelete(0);
    $permission->setRolesId($roleId);

    if (in_array($this->getRolesId(), $permission->getPermission())) {
        return true;
    } else {
        return false;
    }
}

// örnek kullanım:
if(checkPermission(231, 1907)){
  echo 'so secret content.';
}else {
  echo 'gesi baglarinda dolaniyorum.';
}

 ?>
