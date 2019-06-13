<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/Instructores.php';

// instantiate database and instructores object
$database = new Database();
$db = $database->getConnection();

// initialize object
$instructores = new Instructores($db);

// read instructoress will be here
// query instructoress
$stmt = $instructores->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){

    // instructoress array
    $instructores_arr=array();
    $instructores_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $instructores_item=array(
            "ID_Instructor" => $ID_Instructor,
            "Nombre" => $Nombre,
            "Apellidos" => $Apellidos,
            "DNI" => $DNI,
            "Titulacion" => $Titulacion,
            "telefono" => $Telefono,
            "disponibilidad" => $Disponibilidad,

        );

        array_push($instructores_arr["records"], $instructores_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show instructoress data in json format
    echo json_encode($instructores_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no instructores found
    echo json_encode(
        array("message" => "No instructores found.")
    );
}