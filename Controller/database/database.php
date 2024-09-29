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

        $this->conn = new mysqli($this->host, $this->username, $this->password, '', $this->port) ;

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
        $result = $this->conn->query($sql);
        if($result && $result->num_rows > 0) {

        } else {
            $sql = "CREATE DATABASE $this->name";
            $this->conn->query($sql);
            $_SESSION['DB_Name'] = $this->name;
        }

    }


}

?>