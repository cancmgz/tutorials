<?php

require ('/pdoConnect/pdoConnect.php');

class permission
{

    private $permissionId;
    private $userId;
    private $rolesId;
    private $createDate;
    private $isActive;
    private $isDelete;
    private $createUser;
    private $connect;


    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return mixed
     */
    public function getCreateUser()
    {
        return $this->createUser;
    }

    /**
     * @return mixed
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @return mixed
     */
    public function getisDelete()
    {
        return $this->isDelete;
    }

    /**
     * @return mixed
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }

    /**
     * @return mixed
     */
    public function getRolesId()
    {
        return $this->rolesId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @param mixed $createUser
     */
    public function setCreateUser($createUser)
    {
        $this->createUser = $createUser;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @param mixed $isDelete
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;
    }

    /**
     * @param mixed $permissionId
     */
    public function setPermissionId($permissionId)
    {
        $this->permissionId = $permissionId;
    }

    /**
     * @param mixed $rolesId
     */
    public function setRolesId($rolesId)
    {
        $this->rolesId = $rolesId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    public function __construct()
    {
        $this->connect = dbConn::getConnection();
    }


    public function getPermission()
    {
        $pdo = $this->connect->prepare('SELECT rolesId from permission WHERE userId=:userId and isActive=:isActive and isDelete=:isDelete');
        $pdo->bindValue(':userId', $this->getUserId(), PDO::PARAM_INT);
        $pdo->bindValue(':isActive', $this->getisActive(), PDO::PARAM_BOOL);
        $pdo->bindValue(':isDelete', $this->getisDelete(), PDO::PARAM_BOOL);

        try {
            $pdo->execute();
            while ($row = $pdo->fetch()) {
                $permissinList[] = $row["rolesId"];
            }

        } catch (PDOException $errorInfo) {
            return $errorInfo->getMessage();
        }


        return $permissinList;
    }

    public function addPermission()
    {

        $addPermissionSql = "INSERT INTO `permission` (`rolesId`, `userId`, `isActive`, `createUser`, `createDate`, `isDelete`)
        VALUES (:rolesId,:userId,:isActive,:createUser,:createDate,:isDelete)";

        $pdo = $this->connect->prepare($addPermissionSql);
        $pdo->bindValue(':rolesId', $this->getRolesId(), PDO::PARAM_INT);
        $pdo->bindValue(':userId', $this->getUserId(), PDO::PARAM_INT);
        $pdo->bindValue(':isActive', $this->getisActive(), PDO::PARAM_INT);
        $pdo->bindValue(':createUser', $this->getCreateUser(), PDO::PARAM_INT);
        $pdo->bindValue(':createDate', $this->getCreateDate(), PDO::PARAM_STR);
        $pdo->bindValue(':isDelete', $this->getisDelete(), PDO::PARAM_INT);

        try {
            // Olası bir hatada işlemi bu noktadan itibaren başa alalım
            $this->connect->beginTransaction();
            $pdo->execute();
            return 100;

        } catch (PDOException $errorInfo) {
            // kayıt oluşturulduysa bunu geri alıyoruz.
            $this->connect->rollBack();
            return $errorInfo->getMessage();
        }
    }

    public function updatePermission()
    {
        $updatePermissionSql = "UPDATE `permission` SET `isDelete`=:isDelete ,`isActive`=:isActive WHERE `permissionId` = :permissionId LIMIT 1";

        $pdo = $this->connect->prepare($updatePermissionSql);
        $pdo->bindValue(':isActive', $this->getisActive(), PDO::PARAM_INT);
        $pdo->bindValue(':isDelete', $this->getisDelete(), PDO::PARAM_INT);

        try {
            // Olası bir hatada işleminde bu noktadan itibaren geri alınsın.
            $this->connect->beginTransaction();
            $pdo->execute();
            return 100;

        } catch (PDOException $errorInfo) {
            // güncelleme gerçekleştiyse bunu işlemi geri alıyoruz.
            $this->connect->rollBack();
            return $errorInfo->getMessage();
        }

    }

}
