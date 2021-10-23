<?php

class Database
{

    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=bildirisistem;charset=utf8mb4', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8',SET CHARSET 'utf8mb4'"); 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}