<?php

define("USER", "root");
define("SERVER", "localhost:33065");
define("BD", "ticket");
define("PASS", "");

$conn = new mysqli(SERVER, USER, PASS, BD);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
//pendiente

?>