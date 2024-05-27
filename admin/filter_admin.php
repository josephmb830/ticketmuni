<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php';
include './class_mysql.php';
// Obtener la cadena de búsqueda del parámetro POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';
$searchTerm = "%$searchTerm%";
// Inicializar la variable para la consulta SQL
$sql = "SELECT * FROM administrador WHERE 1=1 ";
if (!empty($searchTerm)){
    $sql .= 'AND (dni LIKE "'.$searchTerm.'" OR nombre_completo LIKE "'.$searchTerm.'" OR nombre_admin LIKE "'.$searchTerm.'" OR email_admin LIKE "'.$searchTerm.'" OR cargo LIKE "'.$searchTerm.'") ';
}
// Inicializar el array de parámetros para la consulta preparada
// Preparar la consulta
$con = mysqli_connect(SERVER,USER,PASS,BD);

$consulta = mysqli_query($con, $sql);
$admins = [];
while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
 $admins[] = $row;
}
// Devolver los resultados como JSON

echo json_encode($admins);

// Cerrar la conexión
$conn->close();
$con->close();
?>
