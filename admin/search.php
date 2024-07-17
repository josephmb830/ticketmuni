<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php'; // Asegúrate de que este archivo establece la conexión correctamente

// Obtener las variables POST
$searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';
$startDate = isset($_POST['startDate']) ? trim($_POST['startDate']) : '';
$endDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';

///---------
$ticket= isset($_POST['ticket']) ? trim($_POST['ticket']) : '';
$ticket="%$ticket%";
///----------

$estado= isset($_POST['estado']) ? trim($_POST['estado']) : '';
$estado="%$estado%";

$responsable = isset($_POST['responsable']) ? trim($_POST['responsable']) : '';
$responsable ="%$responsable%";

$departamento = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';
$departamento ="%$departamento%";

//echo [$ticket, $estado, $responsable, $departamento, $startDate, $endDate];
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
$filter = "";

// Añadir condiciones a la consulta
if (!empty($searchTerm)) {
    //$sql .= " AND (ticket.serie LIKE ? OR ticket.id_tecnico LIKE ? OR ticket.estado_ticket LIKE ? OR ticket.departamento LIKE ? OR ticket.fecha LIKE ? OR ticket.fecha_solucion LIKE ?)";
    $sql .= " AND (ticket.serie LIKE ? OR ticket.id_tecnico LIKE ? OR ticket.estado_ticket LIKE ? OR ticket.departamento LIKE ? )";
    $filter = "ssss";
    //----
    $params[] = $ticket;
    //----
    $params[] = $responsable;
    $params[] = $estado;
    $params[] = $departamento;
    //$params[] = $startDate;
    //$params[] = $endDate;
}

if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND (DATE(ticket.fecha) BETWEEN ? AND ?)";
    $filter .= "ss";
    $params[] = $startDate;
    $params[] = $endDate;
}

// Preparar la consulta
$stmt = $con->prepare($sql);

if ($filter) {
    $stmt->bind_param($filter, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Inicializar el array de tickets
//----
$tickets = ["ticket"=>$ticket,
            "responsable"=>$responsable,
            "estado"=>$estado,
            "departamento"=>$departamento,
            "fecha_inicio"=>$startDate,
            "fecha_final"=>$endDate];

  
  
$tickets = array(); 
if($result->fetch_assoc())
    while ($row = $result->fetch_assoc()) {
        print_r($row);

        $tickets[] = ["id"=>$row["id"],
        "id_cliente"=>$row["id_cliente"],
        "id_admin"=>$row["id_admin"],
        "id_tecnico"=>$row["id_tecnico"],
        "fecha"=>$row["fecha"],
                     ];
    }
// Devolver los resultados como JSON 
 
echo (json_encode($tickets));

// Cerrar la conexión
$stmt->close();
$con->close();
?>
