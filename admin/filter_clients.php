<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php';
include './class_mysql.php';
// Obtener la cadena de búsqueda del parámetro POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';
$searchTerm = "%$searchTerm%";
// Inicializar la variable para la consulta SQL
$sql = "SELECT * FROM cliente WHERE 1=1 ";
if (!empty($searchTerm)){
    $sql .= 'AND (dni LIKE "'.$searchTerm.'" OR nombre_usuario LIKE "'.$searchTerm.'" OR nombres LIKE "'.$searchTerm.'" OR a_paterno LIKE "'.$searchTerm.'" OR cargo LIKE "'.$searchTerm.'" OR area LIKE "'.$searchTerm.'" OR email_cliente LIKE "'.$searchTerm.'" ) ';
}
// Inicializar el array de parámetros para la consulta preparada
// Preparar la consulta
$con = mysqli_connect(SERVER,USER,PASS,BD);

$consulta = mysqli_query($con, $sql);
$clients = [];
while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
 $clients[] = $row;
}
// Devolver los resultados como JSON

echo json_encode($clients);

// Cerrar la conexión
$conn->close();
$con->close();
?>