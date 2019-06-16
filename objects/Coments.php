<?php


class Coments
{
    // database connection and table nombre
    private $conn;
    private $table_name = "comentarios";

    // object properties
    public $ID_Comentario;
    public $ID_Alumno;
    public $ID_Instructor;
    public $Comentario;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    function readOne()
    {
        // query to read single record
        $query = "SELECT
                *
            FROM
               comentarios
            WHERE
                ID_Alumno = ? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of Alumnos to be updated
        $stmt->bindParam(1, $this->ID_Instructor);
        // execute query
        $stmt->execute();
        // get retrieved row
       return $stmt;
    }
}