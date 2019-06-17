<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/Coments.php';
// instantiate database and alumnos object
$database = new Database();
$db = $database->getConnection();

// initialize object
$coments = new coments($db);
$coments->ID_Alumno = isset($_GET['ID_Alumno']) ? $_GET['ID_Alumno'] : die();
$stmt = $coments->instAl();
$num = $stmt->rowCount();

// check if more than 0 record found

if($num>0){

    // alumnoss array
    $comments_arr=array();
    $comments_arr["records"]=array();
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $comments_item=array(
            "ID_Comentario" => $ID_Comentario,
            "ID_Alumno" => $ID_Alumno,
            "ID_Instructor" => $ID_Instructor,
            "Comentario" => $Comentario,
        );

        array_push($comments_arr["records"], $comments_item);
    }
    // set response code - 200 OK
    http_response_code(200);

    // show alumnoss data in json format
    echo json_encode($comments_arr);
}

else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no alumnos found
    echo json_encode(
        array("message" => "No alumnos found.")
    );
}