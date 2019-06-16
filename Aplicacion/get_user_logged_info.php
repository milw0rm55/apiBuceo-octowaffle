<?php
include 'bbdd.php';
$userid = $_POST["UserID"];

$query = "SELECT * FROM alumnos WHERE ID_Usuario = '$userid'";

$result = mysqli_query($conn, $query);
$json = array();

if(mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {
    $json ['usuario'][] = $row;
  }
}
mysqli_close($conn);
echo json_encode($json);
echo json_last_error();
