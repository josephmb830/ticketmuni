<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php'; // Asegúrate de que este archivo establece la conexión correctamente

// Obtener las variables POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';
$startDate = isset($_POST['startDate']) ? trim($_POST['startDate']) : '';
$endDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';

// Preparar el término de búsqueda para LIKE
$searchTerm = "%$searchTerm%";

// Inicializar la conexión
$con = mysqli_connect(SERVER, USER, PASS, BD);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Crear la consulta con placeholders
$sql = "SELECT ticket.*, cliente.*, tecnico.*, administrador.*
        FROM ticket
        LEFT JOIN cliente ON ticket.id_cliente = cliente.id_cliente
        LEFT JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico
        LEFT JOIN administrador ON ticket.id_admin = administrador.id_admin
        WHERE 1=1";

$params = [];
$types = "";

// Añadir condiciones a la consulta
if (!empty($searchTerm)) {
    $sql .= " AND (ticket.serie LIKE ? OR ticket.estado_ticket LIKE ? OR ticket.departamento LIKE ? OR ticket.fecha_solucion LIKE ? OR ticket.fecha LIKE ?)";
    $types .= "sssss";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}

if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND (DATE(ticket.fecha) BETWEEN ? AND ?)";
    $types .= "ss";
    $params[] = $startDate;
    $params[] = $endDate;
}

// Preparar la consulta
$stmt = $con->prepare($sql);

if ($types) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Inicializar el array de tickets
$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

// Devolver los resultados como JSON
echo json_encode($tickets);

// Cerrar la conexión
$stmt->close();
$con->close();
?>
