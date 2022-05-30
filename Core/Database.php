<?php

class Database
{

    const HOST = "localhost";
    const USENAME = "root";
    const PASSWORD = "";
    const DB_NAME = "db_shoe";
    private $connect = null;

    public function connect()
    {
        try {
            $this->connect = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=UTF8", self::USENAME, self::PASSWORD);
            // set the PDO error mode to exception
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->connect;
    }
    public function disConnect()
    {
        return $this->connect = null;
    }
}