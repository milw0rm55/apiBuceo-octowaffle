<?php
class Instructores{
 
    // database connection and table name
    private $conn;
    private $table_name = "Instructores";
 
    // object properties
    public $ID_Instructor;
    public $Nombre;
    public $Apellido;
    public $DNI;
    public $Titulacion;
    public $Telefono;
    public $disponibilidad;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
// read alumnos
    function read(){

        // select all query
        $query = "select * from instructores" ;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}