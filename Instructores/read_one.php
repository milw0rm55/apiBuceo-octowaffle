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
$alumno->id = isset($_GET['id_alumno']) ? $_GET['id_alumno'] : die();

// read the details of alumno to be edited
$alumno->readOne();

if($alumno->nombre!=null){
    // create array
    $alumno_arr = array(
        "id_alumno" =>  $alumno->id_aluumno,
        "nombre" => $alumno->nombre,
        "dni" => $alumno->dni,
        "titulo" => $alumno->price,
        "telefono" => $alumno->category_id,
        "curso" => $alumno->category_name

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
