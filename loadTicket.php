<?php
require_once './lib/config.php';

$columns = ['fecha', 'serie', 'area', 'id_tecnico', 'estado_ticket', 'fecha_solucion', 'id', 'nombre_usuario', 'email_cliente', 'departamento', 'id_tecnico', 'a_paterno', 'a_materno'];

$table = "ticket";

$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$sql = "SELECT " . implode(",", $columns) . " FROM $table WHERE serie LIKE '%$campo%'";

$result = $conn->query($sql);

if ($result === false) {
    throw new Exception("Error en la consulta SQL: " . $conn->error);
}

$num_rows = $result->num_rows;

$html = '';

if ($num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['serie'] . '</td>';
        $html .= '<td>' . $row['estado_ticket'] . '</td>';
        $html .= '<td>' . $row['nombre_usuario'] . '</td>';
        $html .= '<td>' . $row['email_cliente'] . '</td>';
        $html .= '<td>' . $row['departamento'] . '</td>';
        $html .= '<td>' . strtoupper($row['id_tecnico'] . " " . $row['a_paterno'] . " " . $row['a_materno']) . '</td>';
        $html .= '<td>' . $row['fecha_solucion'] . '</td>';
        $html .= '<td>' . $row['area'] . '</td>';
        $html .= '<td class="text-center">';
        $html .= '<a href="./lib/pdf.php?id=' . $row['id'] . '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>';
        $html .= '<a href="admin.php?view=ticketedit&id=' . $row['id'] . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

        $html .= '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="9"> Sin resultados </td>';
    $html .= '</tr>';
}

$conn->close();

$data = array(
    'html' => $html
);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>
