<?php
class Instructores{
 
    // database connection and table name
    private $conn;
    private $table_name = "Instructores";
 
    // object properties
    public $id_instructor;
    public $nombre;
    public $apellidos;
    public $dni;
    public $titulo;
    public $telefono;
    public $disponibilidad;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
// read alumnos
    function read(){

        // select all query
        $query = "SELECT
               *
            FROM
                " . $this->table_name ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}