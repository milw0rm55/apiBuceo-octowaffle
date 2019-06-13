<?php
class Database{
 
    // specify your own database credentials
    private $host = "remotemysql.com";
    private $db_name = "wnyQW4w4LG";
    private $username = "wnyQW4w4LG";
    private $password = "pXrtL58yqk";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>