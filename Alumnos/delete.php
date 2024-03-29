<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/database.php';
include_once '../objects/Alumnos.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare Alumnos object
$alumnos = new Alumnos($db);

// get Alumnos id
$data = json_decode(file_get_contents("php://input"));

// set Alumnos id to be deleted
$alumnos->ID_Alumno = $data->ID_Alumno;

// delete the Alumnos
if($alumnos->delete()){
    echo $alumnos->ID_Alumno;
    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("message" => "Alumno was deleted."));
}

// if unable to delete the Alumnos
else{

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete Alumnos."));
}
?>