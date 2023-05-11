<?php

    class Categoria{
        private $conn;
        private $table = 'categorias';

        // Props
        public $id;
        public $nombre;
        public $fecha_creacion;

        // Construccion conexion a db
        public function __construct($db){
            $this->conn = $db;
        }

        // Obtener categorias
        public function leer(){
            // Crear query
            $query = 'SELECT id, nombre, fecha_creacion FROM ' . $this->table . ' ORDER BY fecha_creacion DESC';
            
            // Preparar la sentencia
            $stmt = $this->conn->prepare($query);

            // Ejecutar query
            $stmt->execute();
            return $stmt;
        }

        // Obtener categoria individual
        public function leer_individual(){
            // Crear query
            $query = 'SELECT id, nombre, fecha_creacion FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
            
            // Preparar la sentencia
            $stmt = $this->conn->prepare($query);

            // Vincular un parametro
            $stmt->bindParam(1, $this->id);

            // Ejecutar query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->fecha_creacion = $row['fecha_creacion'];

        }

    }



?>