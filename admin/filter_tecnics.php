<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php';
include './class_mysql.php';
// Obtener la cadena de búsqueda del parámetro POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';
$searchTerm = "%$searchTerm%";
// Inicializar la variable para la consulta SQL
$sql = "SELECT * FROM tecnico WHERE 1=1 ";
if (!empty($searchTerm)){
    $sql .= 'AND (dni LIKE "'.$searchTerm.'" OR nombre_tecnico LIKE "'.$searchTerm.'" OR a_paterno_tecnico LIKE "'.$searchTerm.'" OR a_materno_tecnico LIKE "'.$searchTerm.'" OR cargo LIKE "'.$searchTerm.'" OR area LIKE "'.$searchTerm.'" OR email_tecnico LIKE "'.$searchTerm.'" ) ';
}
// Inicializar el array de parámetros para la consulta preparada
// Preparar la consulta
$con = mysqli_connect(SERVER,USER,PASS,BD);

$consulta = mysqli_query($con, $sql);
$tecnicos = [];
while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
 $tecnicos[] = $row;
}
// Devolver los resultados como JSON
echo json_encode($tecnicos);
// Cerrar la conexión
$conn->close();
$con->close();
?>