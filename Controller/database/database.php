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

        // Create database
        $sql = "CREATE DATABASE '$this->name'";
        $this->conn->query($sql);

    }

}

?>