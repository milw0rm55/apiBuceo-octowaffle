<?php
include 'bbdd.php';
$fecha = $_POST["Fecha"];
//$fecha= $_POST["Fecha"];
$date = str_replace('/', '-', $fecha);
$final_date = date('Y-m-d', strtotime($date));


$query = "SELECT COALESCE(alumnos.Nombre, instructores.Nombre) AS Nombre,
salidas.Rol_Grupo, salidas.Fecha,salidas.Hora, salidas.Lugar
FROM salidas
LEFT JOIN instructores ON salidas.ID_Usuario=instructores.ID_Usuario
LEFT JOIN alumnos ON salidas.ID_Usuario=alumnos.ID_Usuario
 WHERE Rol_Grupo = 'Instructor' AND Fecha = '$final_date'";

 $result = mysqli_query($conn, $query);
 $json = array();

 if(mysqli_num_rows($result) > 0){
   while ($row = mysqli_fetch_assoc($result)) {
     $json ['salidas'][] = $row;
   }
 }
 mysqli_close($conn);
 echo json_encode($json);
 echo json_last_error();
