<?php

    class Conexao {

        private $host = 'localhost';
        private $dbName = 'php_com_pdo';
        private $user = 'root';
        private $password = '';

        public function connect() {
            try {
                return new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->user, $this->password);
            } catch (PDOException $e) {
                echo '<p>' . $e->getMessage() . '</p>';
                
                return null;
            }
        }
    }

?>