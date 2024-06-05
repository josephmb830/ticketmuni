<?php
// Verificar que el usuario esté autenticado y sea un administrador
if ($_SESSION['nombre'] != "" && $_SESSION['clave'] != "" && $_SESSION['tipo'] == "admin") {
?>

<?php
$mysqli = mysqli_connect(SERVER, USER, PASS, BD);
mysqli_set_charset($mysqli, "utf8");

// Inicialización de variables para contar tickets
$num_total_all = 0;
$num_total_pend = 0;
$num_total_proceso = 0;
$num_total_res = 0;
$num_total_can = 0;

// Consulta para obtener el recuento total de tickets
$consulta_total_all = "SELECT COUNT(*) AS total FROM ticket";
$result_total_all = mysqli_query($mysqli, $consulta_total_all);
if ($result_total_all) {
    $row_total_all = mysqli_fetch_assoc($result_total_all);
    $num_total_all = $row_total_all['total'];
}

// Consulta para obtener el recuento de tickets pendientes
$consulta_total_pend = "SELECT COUNT(*) AS total FROM ticket WHERE estado_ticket = 'Pendiente'";
$result_total_pend = mysqli_query($mysqli, $consulta_total_pend);
if ($result_total_pend) {
    $row_total_pend = mysqli_fetch_assoc($result_total_pend);
    $num_total_pend = $row_total_pend['total'];
}

// Consulta para obtener el recuento de tickets en proceso
$consulta_total_proceso = "SELECT COUNT(*) AS total FROM ticket WHERE estado_ticket = 'En proceso'";
$result_total_proceso = mysqli_query($mysqli, $consulta_total_proceso);
if ($result_total_proceso) {
    $row_total_proceso = mysqli_fetch_assoc($result_total_proceso);
    $num_total_proceso = $row_total_proceso['total'];
}

// Consulta para obtener el recuento de tickets resueltos
$consulta_total_res = "SELECT COUNT(*) AS total FROM ticket WHERE estado_ticket = 'Resuelto'";
$result_total_res = mysqli_query($mysqli, $consulta_total_res);
if ($result_total_res) {
    $row_total_res = mysqli_fetch_assoc($result_total_res);
    $num_total_res = $row_total_res['total'];
}

// Consulta para obtener el recuento de tickets anulados
$consulta_total_can = "SELECT COUNT(*) AS total FROM ticket WHERE estado_ticket = 'Anulado'";
$result_total_can = mysqli_query($mysqli, $consulta_total_can);
if ($result_total_can) {
    $row_total_can = mysqli_fetch_assoc($result_total_can);
    $num_total_can = $row_total_can['total'];
}
?>


<?php
// Comprobar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conexión a la base de datos usando mysqli
    $conexion = new mysqli(SERVER, USER, PASS, BD);

    // Verificar la conexión y manejar errores
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Ejemplo de consulta, puede ajustarse según los requisitos
    $query = "SELECT * FROM tickets";

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare($query);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener el resultado de la consulta
        $result = $stmt->get_result();
        $tickets = [];
        // Recorrer los resultados y almacenarlos en un array
        while ($row = $result->fetch_assoc()) {
            $tickets[] = $row;
        }

        // Enviar la respuesta en formato JSON si es una solicitud AJAX
        if (isset($_POST['ajax']) && $_POST['ajax'] == true) {
            echo json_encode($tickets);
            exit;
        }
    } else {
        // Mostrar error en caso de falla en la consulta
        echo "Error en la consulta: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <style>
        .mt-100 { margin-top: 100px; }
        .mt-250 { margin-top: 250px; }
        .border-r { border-right: 1px solid #ddd; }
        .bg-blue { background-color: #007bff; }
        .bg-yellow { background-color: #ffc107; }
        .bg-green { background-color: #28a745; }
        .bg-gray { background-color: #6c757d; }
        .bg-red { background-color: #dc3545; }
        .f-20 { font-size: 20px; }
        .h-screen { height: 100vh; }
    </style>
</head>
<body>
<div class="container-fluid mt-100">
    <div class="row">
        <div class="col-sm-12 text-center">
            <?php include "./inc/reloj.php"; ?>
            <br>
        </div>
    </div>
</div>
<div class="container-fluid mt-250 h-screen" style="max-width:80%;">
    <div class="row">
        <?php
        // Array of ticket statuses and their corresponding properties
        $statuses = [
            'all' => ['bg' => 'bg-blue', 'label' => 'Todos los Tickets', 'count' => $num_total_all],
            'pending' => ['bg' => 'bg-yellow', 'label' => 'Tickets Pendientes', 'count' => $num_total_pend],
            'process' => ['bg' => 'bg-green', 'label' => 'Tickets en Proceso', 'count' => $num_total_proceso],
            'resolved' => ['bg' => 'bg-gray', 'label' => 'Tickets Resueltos', 'count' => $num_total_res],
            'canceled' => ['bg' => 'bg-red', 'label' => 'Tickets Anulados', 'count' => $num_total_can]
        ];
        // Loop through each status to generate the corresponding columns
        foreach ($statuses as $key => $status) { ?>
            <div class="col-md-2-5 border-r <?php echo $status['bg']; ?> text-center pt-4 pb-4">
                <a href="./admin.php?view=ticketasig&ticket=<?php echo $key; ?>" class="text-white">
                    <h3 class="f-20 text-center"><?php echo $status['label']; ?></h3>
                    <p class="f-20 text-center"><?php echo $status['count']; ?></p>
                </a>
            </div>
        <?php } ?>
    </div>
    <br>
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col-12 mt-2 mb-2">
                <input type="text" class="form-control" name="ticket" id="ticket" placeholder="Buscar por palabra clave...">
            </div>
            <div class="col-4 mt-2 mb-2">
                <select name="responsable" id="responsable" class="form-control">
                    <option value="">Seleccione un técnico...</option>
                    <?php
                    // Fetching technician data from the database
                    $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                    mysqli_set_charset($mysqli, "utf8");
                    $consulta_tecnico = "SELECT * FROM tecnico";
                    $selticket_tecnico = mysqli_query($mysqli, $consulta_tecnico);
                    while ($row = mysqli_fetch_array($selticket_tecnico, MYSQLI_ASSOC)) { ?>
                        <option value="<?php echo $row['id_tecnico']; ?>">
                            <?php echo strtoupper($row['nombres_tecnico'] . " " . $row['a_paterno_tecnico'] . " " . $row['a_materno_tecnico']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-4 mt-2 mb-2">
                <select name="estado" id="estado" class="form-control">
                    <option value="">Seleccione el estado de ticket...</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Anulado">Anulado</option>
                    <option value="Resuelto">Resuelto</option>
                </select>
            </div>
            <div class="col-4 mt-2 mb-2">
                <select class="form-control" name="departamento" id="departamento">
                    <option value="">Escoja la área de falla...</option>
                    <option value="Mantenimiento preventivo">Mantenimiento preventivo</option>
                    <option value="Mantenimiento correctivo">Mantenimiento correctivo</option>
                    <option value="Instalacion de accesorios">Instalacion de accesorios</option>
                    <option value="Instalacion de equipo">Instalacion de equipo</option>
                    <option value="Instalacion de red">Instalacion de red</option>
                    <option value="Configuracion de equipo">Configuracion de equipo</option>
                    <option value="Configuracion de servicio de red">Configuracion de servicio de red</option>
                    <option value="Instalacicion, mantenimiento y actualizacion de software">Instalacicion, mantenimiento y actualizacion de software</option>
                    <option value="Clave de usuario">Clave de usuario</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>
            <div class="col-3">
                <label for="fecha_inicio">Desde fecha: </label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
            </div>
            <div class="col-3">
                <label for="fecha_final">Hasta fecha: </label>
                <input type="date" id="fecha_final" name="fecha_final" class="form-control">
            </div>
            <div class="col-6"></div>
            <div class="col-1" style="position:relative;">
                <form action="./lib/pdf_ticket.php" method="POST" style="display: inline-block;">
                    <textarea name="tickets" style="opacity:0" cols="30" rows="10" id="all_tickets"></textarea>
                    <button type="submit" id="toPDF" class="btn btn-success d-none" style="position:absolute; bottom:0; left:0;">
                        <i class="fa-regular fa-file-pdf" style="font-size:30px;"></i>
                    </button>
                </form>
            </div>
            <div class="col-9"></div>
            <div class="col-2" style="clear:both;">
                <button class="btn btn-dark btn-block" type="button" id="searchButton" style="float:right">Buscar</button>
                <button class="btn btn-dark btn-block" type="button" id="clearButton" style="float:right">Limpiar filtro</button>
            </div>
        </div>
    </div>
    <div class="row mt-5">
    <div class="col-12">
        <div class="table-responsive">
            <?php
            // Database connection and query handling
            $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
            mysqli_set_charset($mysqli, "utf8");

            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $regpagina = 15;
            $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

            $estado = '';
            if (isset($_GET['ticket'])) {
                $ticket = $_GET['ticket'];
                switch ($ticket) {
                    case 'pending':
                        $estado = "WHERE ticket.estado_ticket = 'Pendiente'";
                        break;
                    case 'process':
                        $estado = "WHERE ticket.estado_ticket = 'En proceso'";
                        break;
                    case 'resolved':
                        $estado = "WHERE ticket.estado_ticket = 'Resuelto'";
                        break;
                    case 'canceled':
                        $estado = "WHERE ticket.estado_ticket = 'Anulado'";
                        break;
                }
            }

            $consulta_admin = "SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* 
                                FROM ticket 
                                INNER JOIN administrador ON ticket.id_admin = administrador.id_admin 
                                INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico 
                                $estado 
                                ORDER BY id DESC LIMIT $inicio, $regpagina";

            $consulta_cliente = "SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* 
                                 FROM ticket 
                                 INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente 
                                 INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico 
                                 $estado 
                                 ORDER BY id DESC LIMIT $inicio, $regpagina";

            $selticket_admin = mysqli_query($mysqli, $consulta_admin);
            $selticket_cliente = mysqli_query($mysqli, $consulta_cliente);

            $total_registros = mysqli_query($mysqli, "SELECT FOUND_ROWS()");
            $total_registros = mysqli_fetch_array($total_registros, MYSQLI_ASSOC);
            $total_paginas = ceil($total_registros["FOUND_ROWS()"] / $regpagina);

            if ($_SESSION['tipo'] == "Administrador") {
                if (mysqli_num_rows($selticket_admin) > 0) {
                    echo '<table class="table table-hover table-sm table-bordered"><thead><tr class="text-center bg-dark text-white">';
                    echo '<th>Ticket</th><th>Asunto</th><th>Fecha de reporte</th><th>Área</th><th>Cliente</th><th>Estado</th><th>Responsable</th><th>Fecha de respuesta</th><th>Ver ticket</th>';
                    echo '</tr></thead><tbody id="ticket_table_admin">';
                    while ($row = mysqli_fetch_array($selticket_admin, MYSQLI_ASSOC)) {
                        $background = match($row['estado_ticket']) {
                            'Resuelto' => 'bg-gray text-dark',
                            'Pendiente' => 'bg-yellow text-dark',
                            'En proceso' => 'bg-green text-dark',
                            default => 'bg-red text-dark'
                        };
                        echo '<tr class="text-center '.$background.'">';
                        echo '<td>'.$row['codigo_ticket'].'</td><td>'.$row['asunto_ticket'].'</td><td>'.$row['fecha_ticket'].'</td><td>'.$row['departamento_ticket'].'</td>';
                        echo '<td>'.$row['nombres_admin'].' '.$row['a_paterno_admin'].' '.$row['a_materno_admin'].'</td><td>'.$row['estado_ticket'].'</td>';
                        echo '<td>'.$row['nombres_tecnico'].' '.$row['a_paterno_tecnico'].' '.$row['a_materno_tecnico'].'</td><td>'.$row['fecharespuesta_ticket'].'</td>';
                        echo '<td><a href="admin.php?view=ticketview&ticketcode='.$row['codigo_ticket'].'" class="btn btn-primary">Ver</a></td></tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p class="alert alert-danger text-center">No hay tickets registrados.</p>';
                }
            } else if ($_SESSION['tipo'] == "Cliente") {
                if (mysqli_num_rows($selticket_cliente) > 0) {
                    echo '<table class="table table-hover table-sm table-bordered"><thead><tr class="text-center bg-dark text-white">';
                    echo '<th>Ticket</th><th>Asunto</th><th>Fecha de reporte</th><th>Área</th><th>Cliente</th><th>Estado</th><th>Responsable</th><th>Fecha de respuesta</th><th>Ver ticket</th>';
                    echo '</tr></thead><tbody id="ticket_table_cliente">';
                    while ($row = mysqli_fetch_array($selticket_cliente, MYSQLI_ASSOC)) {
                        $background = match($row['estado_ticket']) {
                            'Resuelto' => 'bg-gray text-dark',
                            'Pendiente' => 'bg-yellow text-dark',
                            'En proceso' => 'bg-green text-dark',
                            default => 'bg-red text-dark'
                        };
                        echo '<tr class="text-center '.$background.'">';
                        echo '<td>'.$row['codigo_ticket'].'</td><td>'.$row['asunto_ticket'].'</td><td>'.$row['fecha_ticket'].'</td><td>'.$row['departamento_ticket'].'</td>';
                        echo '<td>'.$row['nombre_cliente'].' '.$row['ap_paterno_cliente'].' '.$row['ap_materno_cliente'].'</td><td>'.$row['estado_ticket'].'</td>';
                        echo '<td>'.$row['nombres_tecnico'].' '.$row['a_paterno_tecnico'].' '.$row['a_materno_tecnico'].'</td><td>'.$row['fecharespuesta_ticket'].'</td>';
                        echo '<td><a href="admin.php?view=ticketview&ticketcode='.$row['codigo_ticket'].'" class="btn btn-primary">Ver</a></td></tr>';
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p class="alert alert-danger text-center">No hay tickets registrados.</p>';
                }
            }
            if ($total_paginas > 0) {
                echo '<nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">';
                echo '<ul class="pagination">';
                for ($i = 1; $i <= $total_paginas; $i++) {
                    $active = ($pagina == $i) ? 'active' : '';
                    $ticket_param = isset($_GET['ticket']) ? '&ticket=' . $_GET['ticket'] : '';
                    echo '<li class="page-item '.$active.'"><a class="page-link" href="admin.php?view=ticketasig'.$ticket_param.'&pagina='.$i.'">'.$i.'</a></li>';
                }
                echo '</ul></nav>';
            }
            ?>
        </div>
    </div>
</div>

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Custom Script -->
<script>
$(document).ready(function() {
    $('#searchButton').on('click', function() {
        const ticket = $('#ticket').val().toLowerCase();
        const responsable = $('#responsable').val();
        const estado = $('#estado').val();
        const departamento = $('#departamento').val();
        const fechaInicio = $('#fecha_inicio').val();
        const fechaFinal = $('#fecha_final').val();
        
        $('#ticket_table_admin tr, #ticket_table_cliente tr').filter(function() {
            const rowText = $(this).text().toLowerCase();
            const ticketMatch = !ticket || rowText.includes(ticket);
            const responsableMatch = !responsable || rowText.includes(responsable);
            const estadoMatch = !estado || rowText.includes(estado);
            const departamentoMatch = !departamento || rowText.includes(departamento);
            const fechaMatch = (!fechaInicio || $(this).text().includes(fechaInicio)) && (!fechaFinal || $(this).text().includes(fechaFinal));
            
            $(this).toggle(ticketMatch && responsableMatch && estadoMatch && departamentoMatch && fechaMatch);
        });
    });

    $('#clearButton').on('click', function() {
        $('#ticket').val('');
        $('#responsable').val('');
        $('#estado').val('');
        $('#departamento').val('');
        $('#fecha_inicio').val('');
        $('#fecha_final').val('');
        $('#ticket_table_admin tr, #ticket_table_cliente tr').show();
    });

    const totalPages = '<?php echo $total_paginas; ?>';
    const currentPage = '<?php echo $pagina; ?>';
    if (currentPage == totalPages) {
        $('#toPDF').removeClass('d-none');
    }
});
</script>
</body>
</html>

    <script>
        $(document).ready(function() {
            // Manejar el evento de clic en el botón de aplicar filtros
            $('#apply-filters').on('click', function() {
                // Obtener el valor del filtro de estado
                var estado = $('#filter-estado').val();
                // Realizar una solicitud AJAX para obtener los tickets filtrados
                $.ajax({
                    url: 'ticketadmin-view.php', // URL del script PHP
                    type: 'POST', // Método de la solicitud
                    data: {
                        estado: estado, // Parámetro de filtro
                        ajax: true // Indicador de solicitud AJAX
                    },
                    success: function(data) {
                        // Parsear la respuesta JSON y actualizar el contenedor de tickets
                        var tickets = JSON.parse(data);
                        $('#tickets-container').empty(); // Limpiar el contenedor
                        // Recorrer los tickets y agregarlos al contenedor
                        tickets.forEach(function(ticket) {
                            $('#tickets-container').append('<div class="ticket">' + ticket.id + ': ' + ticket.estado + '</div>');
                        });
                    },
                    error: function() {
                        // Mostrar alerta en caso de error
                        alert('Error al cargar los tickets');
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
} else {
    // Mensaje de acceso denegado si el usuario no está autenticado como administrador
    echo "Acceso denegado.";
}
?>