<?php
/**
 * Import dbDefinations.php to access DB definations
 */
require('dbDefinations.php');

class dbConnection extends dbDefinations
{

    /**
     * variable to hold connection object.
     *
     * @var PDO
     */
    protected static $db;

    /**
     * private construct - class cannot be instatiated externally.
     *
     * dbConn constructor.
     */
    private function __construct()
    {

        try {
            // assign PDO object to db variable
            self::$db = new PDO('mysql:host=' . $this->DB_HOST . ';port=' . $this->DB_PORT . ';dbname=' . $this->DB_NAME, $this->DB_USER, $this->DB_PASS, array(
                PDO::ATTR_PERSISTENT => true
            ));
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //Output error - would normally log this to error file rather than output to user.
            echo "Connection Error: " . $e->getMessage();

        }

    }


    /**
     * get connection function. Static method - accessible without instantiation
     *
     * @return PDO
     */
    public static function getConnection()
    {

        //Guarantees single instance, if no connection object exists then create one.
        if (!self::$db) {
            //new connection object.
            new dbConnection();
        }

        //return connection.
        return self::$db;
    }

}
