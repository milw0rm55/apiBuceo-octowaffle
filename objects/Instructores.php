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
    function update()
    {
        // update query
        $query = "UPDATE
                instructores
            SET
                Nombre = :Nombre,
                Apellidos = :Apellido,
                DNI = :DNI,
                Titulacion = :Titulo,
                Telefono = :Telefono,
                Disponibilidad = :Disponibilidad
            WHERE
                ID_Instructor = :ID_Instructor";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Apellido = htmlspecialchars(strip_tags($this->Apellido));
        $this->DNI = htmlspecialchars(strip_tags($this->DNI));
        $this->Titulacion = htmlspecialchars(strip_tags($this->Titulacion));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->ID_Instructor = htmlspecialchars(strip_tags($this->ID_Instructor));

        // bind new values
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Apellido', $this->Apellido);
        $stmt->bindParam(':DNI', $this->DNI);
        $stmt->bindParam(':Titulo', $this->Titulacion);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':ID_Instructor', $this->ID_Instructor);

        // execute the query
        echo var_dump($stmt->execute());
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function read_one_ID_Usuario()
    {
        // query to read single record
        $query = "SELECT
                *
            FROM
               instructor
            WHERE
                ID_Usuario = ? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of Alumnos to be updated
        $stmt->bindParam(1, $this->ID_Usuario);
        // execute query
        $stmt->execute();
        echo var_dump($stmt->execute());
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // set values to object properties
        $this->Nombre = $row['Nombre'];
        $this->Apellido = $row['Apellidos'];
        $this->DNI = $row['DNI'];
        $this->Titulacion = $row['Titulacion'];
        $this->Telefono = $row['Telefono'];
    }
}
