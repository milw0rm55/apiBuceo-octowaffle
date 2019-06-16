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

// prepare instructores object
$instructores = new instructores($db);

// get id of instructores to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of instructores to be edited
$instructores->ID_Instructor = $data->ID_Instructor;

// set instructores property values
$instructores->Nombre = $data->Nombre;
$instructores->Apellido = $data->Apellidos;
$instructores->DNI = $data->DNI;
$instructores->Titulacion = $data->Titulacion;
$instructores->Telefono = $data->Telefono;
//$instructores->Disponibilidad = $data->Disponibilidad;
// update the instructores
if($instructores->update()){

    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Instructor was updated."));
}

// if unable to update the instructores, tell the user
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to update Instrucor."));
}
?>