<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate Alumnos object
include_once '../objects/Alumnos.php';

$database = new Database();
$db = $database->getConnection();

$alumno = new Alumnos($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->Nombre) &&
    !empty($data->Apellido) &&
    !empty($data->DNI) &&
    !empty($data->Titulacion)&&
    !empty($data->Telefono)
){
    echo "hola";
    // set Alumnos property values
    $alumno->Nombre = $data->Nombre;
    $alumno->Apellido = $data->Apellido;
    $alumno->DNI = $data->DNI;
    $alumno->Titulacion = $data->Titulo;
    $alumno->Telefono = $data->Telefono;

    // create the Alumnos
    if($alumno->create()){

        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Alumnos was created."));
    }

    // if unable to create the Alumnos, tell the user
    else{

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create Alumnos."));
    }
}

// tell the user data is incomplete
else{

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create Alumnos. Data is incomplete."));
}
?>