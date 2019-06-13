<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/Alumnos.php';
// instantiate database and alumnos object
$database = new Database();
$db = $database->getConnection();

// initialize object
$alumnos = new alumnos($db);
 
// read alumnoss will be here
// query alumnoss
$stmt = $alumnos->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
 
    // alumnoss array
    $alumnos_arr=array();
    $alumnos_arr["records"]=array();
    echo $alumnos_arr;
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $alumnos_item=array(
            "ID_Alumno" => $ID_Alumno,
            "ID_Usuario" => $ID_Usuario,
            "Nombre" => $Nombre,
            "Apellidos" => $Apellidos,
            "DNI" => $DNI,
            "Titulacion" => $Titulacion,
            "Telefono" => $Telefono,
            "Curso" => $Curso,
            
        );
 
        array_push($alumnos_arr["records"], $alumnos_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show alumnoss data in json format
    echo json_encode(alumnos_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no alumnos found
    echo json_encode(
        array("message" => "No alumnos found.")
    );
}