<?php

class Database {

    public $port;
    public $host;
    public $username;
    public $password;
    public $name;
    public $conn;

    public function __construct() {

        $this->port = getenv('DB_PORT');
        $this->host = getenv('DB_HOST');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->name = getenv('DB_NAME');

    }


    public function start(){

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->name, $this->port) ;

        // Check connection
        if ($this->conn->connect_error) {

            die("Connection failed: " . $this->conn->connect_error);

        }

    }

    public function stop() {

        $this->conn->close();

    }

    public function createDatabase(){

        //Call Database to check if existing
        //If not existing then create
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$this->name'";
        $conn2 = new mysqli($this->host, $this->username, $this->password, '', $this->port) ;
        $result = $conn2->query($sql);
        if($result && $result->num_rows > 0) {

            $conn2->close();

        } else {

            $sql = "CREATE DATABASE $this->name";
            $conn2->query($sql);
            $conn2->close();
            
        }

    }

    public function createTable($Tname){
        //Call Tab to check if existing
        //If not existing then create
        $sql = "SHOW TABLES LIKE '$Tname';";
        $result = $this->conn->query($sql);
        if($result && $result->num_rows > 0) {

        } else {
            $sql = "CREATE TABLE $Tname (id INT AUTO_INCREMENT PRIMARY KEY);";
            $this->conn->query($sql);
        }

    }

    public function createCol($Ttype, $Tname, $Cname, $extras){
        //Call Column to check if existing
        //If not existing then create
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '$Tname' AND column_name = '$Cname';";
        $result = $this->conn->query($sql);
        if($result && $result->num_rows > 0) {

        } else {

            if($Ttype == "v"){
                
                $sql = "ALTER TABLE $Tname ADD $Cname VARCHAR". $extras .";";
                $this->conn->query($sql);

            } elseif($Ttype == "i"){

            }
        }

    }


}

?>