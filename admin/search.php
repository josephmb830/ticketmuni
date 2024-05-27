<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php';
include './class_mysql.php';
// Obtener la cadena de búsqueda del parámetro POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';

// Obtener las fechas de inicio y fin del rango, si están disponibles
$startDate = isset($_POST['startDate']) ? trim($_POST['startDate']) : '';
$endDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';
$searchTerm = "%$searchTerm%";
// Inicializar la variable para la consulta SQL
$sql = "SELECT * FROM ticket INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE 1=1 ";
if (!empty($searchTerm)){
    $sql .= 'AND (serie LIKE "'.$searchTerm.'" OR estado_ticket LIKE "'.$searchTerm.'" OR departamento LIKE "'.$searchTerm.'" OR fecha_solucion LIKE "'.$searchTerm.'" OR fecha LIKE "'.$searchTerm.'") ';
}
if (!empty($startDate) && !empty($endDate)) {
    $sql .= "AND (DATE(fecha) BETWEEN $startDate AND $endDate) ";
}
// Inicializar el array de parámetros para la consulta preparada
// Preparar la consulta
$con = mysqli_connect(SERVER,USER,PASS,BD);

$consulta = mysqli_query($con, $sql);
$tickets = [];
while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
    if ($row['id_cliente'] != null){
        $joinsql = "SELECT * FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE id =".$row['id'];
        $join_consulta = mysqli_query($con, $joinsql); 
        $row = mysqli_fetch_array($join_consulta, MYSQLI_ASSOC);
    }
    if ( $row['id_admin'] != null ){
        $joinsql = "SELECT * FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE id=".$row['id'];
        $join_consulta = mysqli_query($con, $joinsql); 
        $row = mysqli_fetch_array($join_consulta, MYSQLI_ASSOC);
    }
 $tickets[] = $row;
}
// Devolver los resultados como JSON

echo json_encode($tickets);

// Cerrar la conexión
$conn->close();
$con->close();
?>
