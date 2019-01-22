<?php

require ('/pdoConnect/pdoConnect.php');

class roles
{
    private $rolesId;
    private $name;
    private $page;
    private $description;
    private $createDate;
    private $isActive;
    private $isDelete;
    private $createUser;
    private $connect;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function getisDelete()
    {
        return $this->isDelete;
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
    public function getCreateUser()
    {
        return $this->createUser;
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $rolesId
     */
    public function setRolesId($rolesId)
    {
        $this->rolesId = $rolesId;
    }

    /**
     * @param mixed $isDelete
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @param mixed $createUser
     */
    public function setCreateUser($createUser)
    {
        $this->createUser = $createUser;
    }

    /**
     * @param mixed $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    public function __construct()
    {
        $this->connect = dbConn::getConnection();
    }

    public function addRoles()
    {
        $addRolesSql = "INSERT INTO `roles` (`name`, `page`, `isActive`, `createUser`, `createDate`, `isDelete`, `description`)
        VALUES (:name,:page,:isActive,:createUser,:createDate,:isDelete,:description)";

        $pdo = $this->connect->prepare($addRolesSql);
        /* $pdo->bindParam(':name', $this->getName(), PDO::PARAM_STR);

        * bindParam ile bindValue arasında ki fark bindParam kullanıldığında
        * aldığı parametre execute olmadan önce değiştirilse bu son değişikliği kabul eder.
        * bindValue ise o andaki veriyi kullanır objenin sonradan değişmesi bir şey ifade etmez.
        */

        $pdo->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $pdo->bindValue(':page', $this->getPage(), PDO::PARAM_INT);
        $pdo->bindValue(':isActive', $this->getisActive(), PDO::PARAM_BOOL);
        $pdo->bindValue(':createUser', $this->getCreateUser(), PDO::PARAM_INT);
        $pdo->bindValue(':createDate', $this->getCreateDate(), PDO::PARAM_STR);
        $pdo->bindValue(':isDelete', $this->getisDelete(), PDO::PARAM_BOOL);
        $pdo->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);

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

    public function updateRoles()
    {

        $updateRolesSql = "UPDATE `roles` SET `name`=:name,`page`=:page,`isDelete`=:isDelete
        ,`isActive`=:isActive, `description`=:description
        WHERE rolesId=:rolesId LIMIT 1";

        $pdo = $this->connect->prepare($updateRolesSql);
        $pdo->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $pdo->bindValue(':page', $this->getPage(), PDO::PARAM_INT);
        $pdo->bindValue(':isActive', $this->getisActive(), PDO::PARAM_BOOL);
        $pdo->bindValue(':isDelete', $this->getisDelete(), PDO::PARAM_BOOL);
        $pdo->bindValue(':description', $this->getDescription(), PDO::PARAM_STR);


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

    public function getRoles()
    {
        $getRolesSql = 'SELECT * FROM `roles` WHERE isActive=:isActive and isDelete=:isDelete';
        $pdo = $this->connect->prepare($getRolesSql);
        $pdo->bindParam(':isActive', $this->getisActive(), PDO::PARAM_BOOL);
        $pdo->bindParam(':isDelete', $this->getisDelete(), PDO::PARAM_BOOL);


        try {

            $pdo->execute();
            $getRolesResult = $pdo->fetchAll();
            $getRolesJsonResult = json_encode($getRolesResult);
            return $getRolesJsonResult;

        } catch (PDOException $errorInfo) {
            return $errorInfo->getMessage();
        }
    }

}
