<?php
class Alumnos
{

    // database connection and table nombre
    private $conn;
    private $table_name = "alumnos";

    // object properties
    public $ID_Alumno;
    public $ID_Usuario;
    public $Nombre;
    public $Apellido;
    public $DNI;
    public $Titulacion;
    public $Telefono;
    public $Curso;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read alumnos
    function read()
    {

        // select all query
        $query = "SELECT * FROM alumnos";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create Alumnos
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                Nombre=:Nombre, Apellido=:Apellido, DNI=:DNI, Titulacion=:Titulacion, Telefono=:Telefono";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Apellido = htmlspecialchars(strip_tags($this->Apellido));
        $this->DNI = htmlspecialchars(strip_tags($this->DNI));
        $this->Titulacion = htmlspecialchars(strip_tags($this->Titulacion));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));


        // bind values
        $stmt->bindParam(":Nombre", $this->Nombre);
        $stmt->bindParam(":Apellido", $this->Apellido);
        $stmt->bindParam(":DNI", $this->DNI);
        $stmt->bindParam(":Titulacion", $this->Titulacion);
        $stmt->bindParam(":Telefono", $this->Telefono);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    // used when filling up the update Alumnos form
    function readOne()
    {
        // query to read single record
        $query = "SELECT
                *
            FROM
               alumnos
            WHERE
                ID_Alumno = ? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // bind id of Alumnos to be updated
        $stmt->bindParam(1, $this->ID_Alumno);
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
    // update the Alumnos
    function update()
    {
        // update query
        $query = "UPDATE
                alumnos
            SET
                Nombre = :Nombre,
                Apellidos = :Apellido,
                DNI = :DNI,
                Titulo = :Titulo
                Telefono = :Telefono
            WHERE
                ID_Alumno = :ID_Alumno";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Apellido = htmlspecialchars(strip_tags($this->Apellido));
        $this->DNI = htmlspecialchars(strip_tags($this->DNI));
        $this->Titulacion = htmlspecialchars(strip_tags($this->Titulacion));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->ID_Alumno = htmlspecialchars(strip_tags($this->ID_Alumno));

        // bind new values
        $stmt->bindParam(':Nombre', $this->Nombre);
        $stmt->bindParam(':Apellido', $this->Apellido);
        $stmt->bindParam(':DNI', $this->DNI);
        $stmt->bindParam(':Titulo', $this->Titulacion);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':ID_Alumno', $this->ID_Alumno);

        // execute the query
        echo var_dump($stmt);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete the Alumnos
    function delete()
    {

        // delete query
        $query = "DELETE FROM alumnos WHERE ID_Alumno = ?";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->ID_Alumno=htmlspecialchars(strip_tags($this->ID_Alumno));
        $stmt->bindParam(1, $this->ID_Alumno);
        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
    // search products
    function search($keywords){

        // select all query
        $query = "SELECT
               *
            FROM
                " . $this->table_name . " p
            WHERE
                nombre LIKE ? OR apellidos LIKE ? OR dni LIKE ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}