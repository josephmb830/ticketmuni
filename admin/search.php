<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php';

// Obtener la cadena de búsqueda del parámetro POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';

if (!empty($searchTerm)) {
    // Definir la consulta SQL con una consulta preparada para evitar la inyección SQL
    $sql = "SELECT serie, estado_ticket, nombre_usuario, email_cliente, departamento, id_tecnico, fecha_solucion, area FROM ticket WHERE serie LIKE ? OR estado_ticket LIKE ? OR nombre_usuario LIKE ? OR email_cliente LIKE ? OR departamento LIKE ? OR id_tecnico LIKE ? OR fecha_solucion LIKE ? OR area LIKE ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la consulta
    $searchTerm = "%$searchTerm%"; // Agregar comodines de búsqueda
    $stmt->bind_param("ssssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();

    // Obtener resultados
    $result = $stmt->get_result();

    // Crear un array para almacenar los resultados
    $tickets = array();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Agregar cada fila como un elemento al array
            $tickets[] = $row;
        }
    }

    // Devolver los resultados como JSON
    echo json_encode($tickets);
} else {
    // Si el término de búsqueda está vacío, devolver un mensaje de error
    echo json_encode(array('error' => 'La cadena de búsqueda está vacía'));
}

// Cerrar la conexión
$conn->close();
?>