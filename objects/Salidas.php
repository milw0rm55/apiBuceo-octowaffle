<?php
class Salidas{
 
    // database connection and table name
    private $conn;
    private $table_name = "Salidas";
 
    // object properties
    public $id_alumno;
    public $nombre;
    public $apellidos;
    public $dni;
    public $titulo;
    public $telefono;
    public $curso;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}