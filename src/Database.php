<?php
require_once 'HelperFunctions/displayAlert.php';
class Database {
    private $dbConnection;

    public function __construct(){
        try{
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "phpfinalproject";

            $this->dbConnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $ex){
            displayMessage("error", "Connection failed" . $ex->getMessage());
        }
    }

    // method to get database connection
    public function getConnection()
    {
        return $this->dbConnection;
    }
}