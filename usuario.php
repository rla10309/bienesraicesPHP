<?php
// importar la conexion
require "includes/config/database.php";
$db = conectarDB();

// Crear un mail y un password
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);




// Query para insertar usuarios
$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";




// Agregarlo a la BBDD
mysqli_query($db, $query);
