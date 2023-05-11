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

        // Crear categoria
        public function crear(){
            // Crear query
            $query = 'INSERT INTO ' . $this->table . ' (nombre)VALUE(:nombre)';

            // Preparar la sentencia
            $stmt = $this->conn->prepare($query);

            // Limpiar datos
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));

            // Vincular un parametro
            $stmt->bindParam(':nombre', $this->nombre);

            // Ejecutar query
            if($stmt->execute()){
                return true;
            }

            // If Error
            printf("Error: $s.\n", $stmt->error);
            return false;

        }

        // Actualizar categoria
        public function actualizar(){
            // Crear query
            $query = 'UPDATE ' . $this->table . ' SET nombre = :nombre WHERE id = :id';

            // Preparar la sentencia
            $stmt = $this->conn->prepare($query);

            // Limpiar datos
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Vincular un parametro
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':id', $this->id);

            // Ejecutar query
            if($stmt->execute()){
                return true;
            }

            // If Error
            printf("Error: $s.\n", $stmt->error);
            return false;

        }

        // Borrar categoria
        public function borrar(){
            // Crear query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Preparar la sentencia
            $stmt = $this->conn->prepare($query);

            // Limpiar datos
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Vincular un parametro
            $stmt->bindParam(':id', $this->id);

            // Ejecutar query
            if($stmt->execute()){
                return true;
            }

            // If Error
            printf("Error: $s.\n", $stmt->error);
            return false;

        }

    }
