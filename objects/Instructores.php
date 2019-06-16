<?php
class Instructores{
 
    // database connection and table name
    private $conn;
    private $table_name = "Instructores";
 
    // object properties
    public $ID_Instructor;
    public $ID_Usuario;
    public $Nombre;
    public $Apellido;
    public $DNI;
    public $Titulacion;
    public $Telefono;
    public $Disponibilidad;
 
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
    function readOne()
    {
        // query to read single record
        $query = "SELECT
                *
            FROM
               instructores
            WHERE
                ID_Instructor = ? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of Alumnos to be updated
        $stmt->bindParam(1, $this->ID_Instructor);
        // execute query
        $stmt->execute();
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->Nombre = $row['Nombre'];
        $this->Apellido = $row['Apellidos'];
        $this->DNI = $row['DNI'];
        $this->Titulacion = $row['Titulacion'];
        $this->Telefono = $row['Telefono'];
    }

function delete()
{

    // delete query
    $query = "DELETE FROM instructores WHERE ID_Instructor = ?";
    // prepare query
    $stmt = $this->conn->prepare($query);
    // sanitize
    $this->ID_Instructor=htmlspecialchars(strip_tags($this->ID_Instructor));
    echo var_dump($this->ID_Instructor);
    $stmt->bindParam(1, $this->ID_Instructor);
    // execute query
    if ($stmt->execute()) {
        return true;
    }

    return false;

}
}