<?php
require_once(__ROOT__ . '/libs/mysqlManager/MysqliDb.php');
class DbManager
{
    private static $instance;
    private $connection;

    private $dbhost = 'mysql';
    private $dbuser = 'myuser';
    private $dbpass = 'mypassword';
    private $dbname = 'mydatabase';

    private function __construct()
    {
        // Private constructor to prevent instantiation
        $this->connection = new MysqliDb($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        // Adjust the connection details as per your database configuration
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

}