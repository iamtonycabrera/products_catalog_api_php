<?php

    class Basemysql {

        // Parametros de base de datos
        private $host = 'localhost';
        private $db_name = 'catalogo_productos';
        private $username = 'root';
        private $password = '';
        private $conn;
        
        // Conexion a la db
        public function connect(){
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error en la conexion: " . $e->getMessage();
            }

            return $this->conn;
        }
    }

?>