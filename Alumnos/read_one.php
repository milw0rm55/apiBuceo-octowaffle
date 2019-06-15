<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/Alumnos.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare alumno object
$alumno = new Alumnos($db);

// set ID property of record to read
$alumno->ID_Alumno = isset($_GET['ID_Alumno']) ? $_GET['ID_Alumno'] : die();

// read the details of alumno to be edited
$alumno->readOne();

if($alumno->Nombre!=null){
    // create array
    $alumno_arr = array(
        "ID_Alumno" => $alumno->ID_Alumno,
        "ID_Usuario" => $alumno->ID_Usuario,
        "Nombre" => $alumno->Nombre,
        "Apellidos" => $alumno->Apellido,
        "DNI" => $alumno->DNI,
        "Titulacion" => $alumno->Titulacion,
        "Telefono" => $alumno->Telefono,
        "Curso" => $alumno->Curso,

    );

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode($alumno_arr);
}

else{
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user $alumno does not exist
    echo json_encode(array("message" => "Alumno does not exist."));
}
?>
