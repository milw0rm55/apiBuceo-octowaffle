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
    function instAl(){

        // select all query
        $query = "SELECT * FROM comentarios WHERE ID_Alumno = ?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_Alumno);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function addComment(){
        $query = "INSERT INTO
                comentarios
            SET
                ID_Alumno=:ID_Alumno, ID_Instructor=:ID_Instructor, Comentario=:Comentario";

        // prepare query
        $stmt = $this->conn->prepare($query);

        $this->ID_Alumno = htmlspecialchars(strip_tags($this->ID_Alumno));
        $this->ID_Instructor = htmlspecialchars(strip_tags($this->ID_Instructor));
        $this->Comentario = htmlspecialchars(strip_tags($this->Comentario));

        $stmt->bindParam(":ID_Alumno", $this->ID_Alumno);
        $stmt->bindParam(":ID_Instructor", $this->ID_Instructor);
        $stmt->bindParam(":Comentario", $this->Comentario);
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

}