<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php';

// Obtener la cadena de búsqueda del parámetro POST
$searchTerm = isset($_GET['ticket']) ? trim($_GET['ticket']) : '';
return print_r($searchTerm);


// Obtener las fechas de inicio y fin del rango, si están disponibles
$startDate = isset($_POST['fecha_inicio']) ? trim($_POST['fecha_final']) : '';
$endDate = isset($_POST['fecha_inicio']) ? trim($_POST['fecha_final']) : '';
$estado = isset($_POST['estado']);
$responsable = isset($_POST['responsable']);
// Inicializar la variable para la consulta SQL

$sql = "SELECT * FROM ticket INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE 1=1 ";


// Inicializar el array de parámetros para la consulta preparada
$params = array();

// Verificar si se proporciona un término de búsqueda
if (!empty($searchTerm)) {
    $sql .= "AND (serie LIKE ? OR estado_ticket LIKE ? OR nombre_usuario LIKE ? OR email_cliente LIKE ? OR departamento LIKE ? OR id_tecnico LIKE ? OR fecha_solucion LIKE ? OR area LIKE ? OR fecha LIKE ?) ";
    $searchTerm = "%$searchTerm%"; // Agregar comodines de búsqueda
    // Agregar los parámetros para la consulta preparada
    $estado = "%$estado%"; 
    $responsable = "%$responsable%"; 
    $params[] = $searchTerm;
    $params[] = $estado;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $responsable;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}

// Verificar si se proporciona un rango de fechas
if (!empty($startDate) && !empty($endDate)) {
    $sql .= "AND (DATE(fecha) BETWEEN ? AND ?) ";
    // Agregar los parámetros para la consulta preparada
    $params[] = $startDate; // Formato Y-m-d
    $params[] = $endDate; // Formato Y-m-d
}

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Vincular parámetros si hay alguno
if (!empty($params)) {
    $types = str_repeat('s', count($params)); // 's' para cadenas de texto
    $stmt->bind_param($types, ...$params);
}

// Ejecutar la consulta
$stmt->execute();

// Obtener resultados
$result = $stmt->get_result();

// Crear un array para almacenar los resultados
$tickets = array();


// Verificar si hay resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
        $tickets[] = $row;
    }
}

// Devolver los resultados como JSON
echo json_encode($tickets);

// Cerrar la conexión
$conn->close();
?>