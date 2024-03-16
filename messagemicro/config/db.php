<?php 
    class DB {
        private $host = 'localhost';
        private $user = 'root';
        private $password = 'root';
        private $dbName = 'notifications';

        public function connect() {
            $conn_str = "mysql:gost=$this->host;dbname=$this->dbName";
            $conn = new PDO($conn_str, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
    }
