<?php
// Establecer la conexión a la base de datos
require_once '../lib/config.php'; // Asegúrate de que este archivo establece la conexión correctamente

// Obtener las variables POST
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
// $searchTerm = "%$searchTerm%";
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
if (!empty($ticket)) {
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
        "serie"=>$row["serie"],
        "estado_ticket"=>$row["estado_ticket"],
        "departamento"=>$row["departamento"],
        "asunto"=>$row["asunto"],
        "mensaje"=>$row["mensaje"],
        "archivos"=>$row["archivos"],
        "diagnostico"=>$row["diagnostico"],
        "solucion"=>$row["solucion"],
        "observaciones"=>$row["observaciones"],
        "mes"=>$row["mes"],
        "area"=>$row["area"],
        "fecha_solucion"=>$row["fecha_solucion"],
        "codequipo"=>$row["codequipo"],
        "dni"=>$row["dni"],
        "nombre_usuario"=>$row["nombre_usuario"],
        "nombres"=>$row["nombres"],
        "a_paterno"=>$row["a_paterno"],
        "a_materno"=>$row["a_materno"],
        "cargo"=>$row["cargo"],
        "email_cliente"=>$row["email_cliente"],
        "clave"=>$row["clave"],
        "nombre_tecnico"=>$row["nombre_tecnico"],
        "nombres_tecnico"=>$row["nombres_tecnico"],
        "a_paterno_tecnico"=>$row["a_paterno_tecnico"],
        "a_materno_tecnico"=>$row["a_materno_tecnico"],
        "email_tecnico"=>$row["email_tecnico"],
        "nombre_completo"=>$row["nombre_completo"],
        "nombre_admin"=>$row["nombre_admin"],
        "email_admin"=>$row["email_admin"],
                     ];
    }
// Devolver los resultados como JSON 
 
$json = json_encode($tickets);

echo $json;

// Cerrar la conexión
$stmt->close();
$con->close();
?>
