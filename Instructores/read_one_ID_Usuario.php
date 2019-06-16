<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/Instructores.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare alumno object
$instructor = new Instructores($db);

// set ID property of record to read
$instructor->ID_Usuario = isset($_GET['ID_Usuario']) ? $_GET['ID_Usuario'] : die();

// read the details of alumno to be edited
$instructor->read_one_ID_Usuario();

if($instructor->Nombre!=null){
    // create array
    $alumno_arr = array(
        "ID_Instructor" => $instructor->ID_Instructor,
        "ID_Usuario" => $instructor->ID_Usuario,
        "Nombre" => $instructor->Nombre,
        "Apellidos" => $instructor->Apellido,
        "DNI" => $instructor->DNI,
        "Titulacion" => $instructor->Titulacion,
        "Telefono" => $instructor->Telefono,

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
