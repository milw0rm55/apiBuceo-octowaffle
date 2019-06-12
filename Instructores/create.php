<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate instructores object
include_once '../objects/Instructores.php';

$database = new Database();
$db = $database->getConnection();

$instructor = new Instructores($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->nombre) &&
    !empty($data->apellidos) &&
    !empty($data->dni) &&
    !empty($data->titulo)&&
    !empty($data->telefono)&&
    !empty($data->disponibilidad)
){

    // set instructores property values
    $instructor->nombre = $data->nombre;
    $instructor->apellidos = $data->apellidos;
    $instructor->dni = $data->dni;
    $instructor->titulo = $data->titulo;
    $instructor->telefono = $data->telefono;
    $instructor->disponibilidad = $data->disponibilidad;

    // create the instructores
    if($instructor->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Instructor was created."));
    }

    // if unable to create the instructores, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create instructores."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create instructor. Data is incomplete."));
}
?>