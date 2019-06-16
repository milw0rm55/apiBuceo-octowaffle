<?php
include 'bbdd.php';

$correo = $_POST["Correo"];
$password = $_POST["Password"];

$query = "SELECT * FROM usuarios WHERE Correo = '$correo'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
     while($row = mysqli_fetch_array($result))
     {
          if(password_verify($password, $row["Password"]) && $row["Rol"] == "Alumno"){

            echo "Login Success";
            echo $row["ID_Usuario"];
          }
          else {
            echo "Login not success";
          }
      }
}
else{
  echo "Login not success";
}
