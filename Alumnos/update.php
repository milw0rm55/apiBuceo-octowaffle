<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/Instructores.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare Alumnos object
$alumno = new Alumnos($db);

// get id of Alumnos to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of Alumnos to be edited
$alumno->ID_Alumno = $data->ID_Alumno;

// set Alumnos property values
$alumno->Nombre = $data->Nombre;
$alumno->Apellido = $data->Apellido;
$alumno->DNI = $data->DNI;
$alumno->Titulacion = $data->Titulacion;
$alumno->Telefono = $data->Telefono;
// update the Alumnos
if($alumno->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}

// if unable to update the Alumnos, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update Alumnos."));
}
?>