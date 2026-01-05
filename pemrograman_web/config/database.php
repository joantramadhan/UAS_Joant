<?php
class Database {
    private $host = "localhost";
    private $port = "8111"; // Port sesuai request awal Anda (8111)
    private $db_name = "uas_web"; // PERBAIKAN: Disesuaikan dengan nama DB di screenshot Anda
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            exit;
        }
        return $this->conn;
    }
}