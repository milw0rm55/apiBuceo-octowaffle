<?php
class Alumnos
{

    // database connection and table nombre
    private $conn;
    private $table_name = "Alumnos";

    // object properties
    public $id_alumno;
    public $nombre;
    public $apellidos;
    public $dni;
    public $titulo;
    public $telefono;
    public $curso;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read alumnos
    function read()
    {

        // select all query
        $query = "SELECT
               *
            FROM
                " . $this->table_name . " p";

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
                nombre=:nombre, apellidos=:apellidos, dni=:dni, titulo=:titulo, telefono=:telefono, curso=:curso";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->dni = htmlspecialchars(strip_tags($this->dni));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->curso = htmlspecialchars(strip_tags($this->curso));

        // bind values
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":dni", $this->dni);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":telefono", $this->telefono);

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
                " . $this->table_name . " p
            WHERE
                p.id = ?
            LIMIT
                0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of Alumnos to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->dni = $row['dni'];
        $this->titulo = $row['tituñp'];
        $this->telefono = $row['telefono'];
        $this->curso = $row['curso'];
    }// used when filling up the update Alumnos form

    // update the Alumnos
    function update()
    {

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                nombre = :nombre,
                apellidos = :apellidos,
                dni = :dni,
                titulo = :titulo
                telefono = :telefono
                curso = :curso
            WHERE
                id_alumno = :id_alumno";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->dni = htmlspecialchars(strip_tags($this->dni));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->curso = htmlspecialchars(strip_tags($this->curso));
        $this->id_alumno = htmlspecialchars(strip_tags($this->id_alumno));

        // bind new values
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellidos', $this->apellidos);
        $stmt->bindParam(':dni', $this->dni);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':curso', $this->curso);
        $stmt->bindParam(':id_alumno', $this->id_alumno);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete the Alumnos
    function delete()
    {

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id_alumno = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id_alumno = htmlspecialchars(strip_tags($this->id_alumno));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id_alumno);

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