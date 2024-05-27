<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');  

?>
<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="user"){ 
    $usuario = $_SESSION['nombre'];
    $nombre = $_SESSION['nombre_completo'];
    
    
    ?>
<!DOCTYPE html>
<html>

<head>
  <title>Sistema de Ticket MDMM</title>
  <?php include "./inc/links.php"; ?>
  <style>
    body{
      overflow-x: hidden !important;
    }
    </style>
</head>

<body>
  <?php   
    if(isset($_SESSION['nombre'])){
    include "./inc/slidebar.php"; 
  } ?>


        <div class="container-fluid" style="margin-left:75px;">
        <div class="col-sm-12 text-center">
            <?php include "./inc/reloj.php"; ?>
              <br>
              
            </div>
        </div>
            <?php
              

                /* Todos los tickets*/
                //$num_ticket_all=Mysql::consulta(" SELECT * FROM ticket where nombre_usuario = '$nombre' ");
                $num_ticket_all=Mysql::consulta(" SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente where cliente.nombre_usuario = '$usuario' ");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente where cliente.nombre_usuario = '$usuario' and estado_ticket='Pendiente'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente where cliente.nombre_usuario = '$usuario' and estado_ticket='En proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente where cliente.nombre_usuario = '$usuario' and estado_ticket='Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);

                /* Tickets Anulados*/
                $num_ticket_can=Mysql::consulta("SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente where cliente.nombre_usuario = '$usuario' and estado_ticket='Anulado'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
            ?>

            <div class="container-fluid h-screen mt-250" style="margin-left:175px !important; max-width:85%; width:100%;margin:auto;">
                <div class="row">
                    <div class="col-md-2-5 border-r bg-blue text-center">
                        <a href="./ticketusuario.php?ticket=all" class="text-white">
                            <h3 class="f-25">Todos los Tickets</h3>
                            <p class="f-25 text-center"><?php echo $num_total_all; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-yellow text-center">
                        <a href="./ticketusuario.php?ticket=pending" class="text-white ">
                            <h3 class="f-25">Tickets Pendientes</h3>
                            <p class="f-25 text-center"><?php echo $num_total_pend; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 border-r bg-green text-center">
                        <a href="./ticketusuario.php?ticket=process" class="text-white ">
                            <h3 class="f-25">Tickets en Proceso</h3>
                            <p class="f-25 text-center"><?php echo $num_total_proceso; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-gray text-center">
                        <a href="./ticketusuario.php?ticket=resolved" class="text-white">
                            <h3 class="f-25">Tickets Resueltos</h3>
                            <p class="f-25 text-center"><?php echo $num_total_res; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-red text-center">
                    <a href="./ticketusuario.php?ticket=canceled" class="text-white">
                            <h3 class="f-25">Tickets Anulados</h3>
                            <p class="f-25 text-center"><?php echo $num_total_can; ?></p>
                        </a>
                    </div>
                </div>
                <br>
                <div class="container-fluid mt-5 mb-5">
                    <!-- Campos de entrada para la búsqueda y filtro por fecha -->
                    <div class="row">
                        <div class="col-12 mt-2 mb-2">
                        <input type="text" class="form-control" name="ticket" id="ticket" placeholder="Buscar por palabra clave...">
                        </div>
                        <div class="col-4 mt-2 mb-2">
                        <select name="responsable" id="responsable" class="form-control">
                            <option value="">Seleccione un técnico...</option>
                            <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");
                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
                                $consulta_tecnico="SELECT * FROM tecnico";
                                $selticket_tecnico=mysqli_query($mysqli,$consulta_tecnico); 
                                while ($row=mysqli_fetch_array($selticket_tecnico, MYSQLI_ASSOC)): ?>
                            <option value="<?php echo $row['id_tecnico']; ?>"><?php echo strtoupper($row['nombres_tecnico'] . " " . $row['a_paterno_tecnico'] . " " . $row['a_materno_tecnico']); ?></option>
                            <?php endwhile; ?>
                       </select>
                        </div>
                        <div class="col-4 mt-2 mb-2">
                        <select name="estado" id="estado" class="form-control">
                        <option value="">Seleccione el estado de ticket...</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En proceso">En proceso</option>
                            <option value="En proceso">Anulado</option>
                            <option value="Resuelto">Resuelto</option>
                        </select>      
                        </div>
                        <div class="col-4 mt-2 mb-2">
                        <!-- FALTA EL AREA -->  
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
                            <label for="">Desde fecha: </label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="">Hasta fecha: </label>
                            <input type="date" id="fecha_final" name="fecha_final" class="form-control">
                        </div>
                        <div class="col-6">
                            
                        </div>
                        <div class="col-1" style="position:relative;">
                                <form action="./lib/pdf_ticket.php" method="POST" style="display: inline-block;">
                                        <textarea name="tickets" style="opacity:0" cols="30" rows="10" id="all_tickets"></textarea>
                                        <button type="submit" id="toPDF" class="btn btn-success d-none" style="position:absolute; bottom:0; left:0;"><i class="fa-regular fa-file-pdf" style="font-size:30px;"></i></button>
        
                                </form>
                           
                        </div>
                        <div class="col-9">
                            
                        </div>
                        <div class="col-2" style="clear:both;" >
                        <button class="btn btn-dark btn-block" type="button" id="searchButton" style="float:right">Buscar</button>
                        <button class="btn btn-dark btn-block" type="button" id="clearButton" style="float:right">Limpiar filtro</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.*
                                        FROM ticket
                                        INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente
                                        INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico
                                        WHERE cliente.nombre_usuario = '$usuario'
                                        LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico where cliente.nombre_usuario = '$usuario' and estado_ticket='Pendiente' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico where cliente.nombre_usuario = '$usuario' and estado_ticket='En Proceso' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico where cliente.nombre_usuario = '$usuario' and estado_ticket='Resuelto' LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="canceled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico where cliente.nombre_usuario = '$usuario' and estado_ticket='Anulado' LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico where cliente.nombre_usuario = '$usuario' LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.*
                                    FROM ticket
                                    INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente
                                    INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico
                                    WHERE cliente.nombre_usuario = '$usuario'
                                    LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
                            ?>
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr class="table-title uppercase">
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Tipo de falla</th>
                                        <th class="text-center">opciones</th>
                                        <th class="text-center">técnico</th>
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selticket, MYSQLI_ASSOC)): 
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                        <td class="text-center"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                           
                                        </td>
                                        <td class="text-center"><?php echo strtoupper($row['nombres_tecnico'] . " " . $row['a_paterno_tecnico'] . " " . $row['a_materno_tecnico']); ?></td>
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <h2 class="text-center">No hay tickets registrados en el sistema</h2>
                            <?php endif; ?>
                        </div>
                        <?php 
                            if($numeropaginas>=1):
                            if(isset($_GET['ticket'])){
                                $ticketselected=$_GET['ticket'];
                            }else{
                                $ticketselected="all";
                            }
                        ?>
                        <nav aria-label="Page navigation" class="text-center">
                            <ul class="pagination">
                                <?php if($pagina == 1): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                
                                <?php
                                    for($i=1; $i <= $numeropaginas; $i++ ){
                                        if($pagina == $i){
                                            echo '<li class="active"><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=ticketadmin&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }
                                    }
                                ?>
                                
                                
                                <?php if($pagina == $numeropaginas): ?>
                                    <li class="disabled">
                                        <a aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="./admin.php?view=ticketadmin&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!--container principal-->
<?php
}else{
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    
                    
                </div>
                <div class="col-sm-7 animated flip">
                    <h1 class="text-danger">Lo sentimos esta página es solamente para administradores</h1>
                    <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
                </div>
                <div class="col-sm-1">&nbsp;</div>
            </div>
        </div>
<?php
}
?>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var tickets;
        // Obtener referencia al botón de búsqueda
        const searchButton = document.getElementById('searchButton');
        $('#clearButton').click(function() {
            console.log('CLICK')
            document.getElementById("ticket").value = '';
            document.getElementById("responsable").selectedIndex = 0;
            document.getElementById("estado").selectedIndex = 0;
            document.getElementById("departamento").selectedIndex = 0;
            document.getElementById("fecha_inicio").value = '';
            document.getElementById("fecha_final").value = '';
        })
        $('#toPDF').click( function (){
            /*
            const { jsPDF } = window.jspdf;
            var doc = new jsPDF('l', 'pt');
            var elem = document.getElementById("pdf");
            var res = doc.autoTableHtmlToJson(pdf);
            doc.autoTable(res.columns, res.data);
            doc.save("tickets.pdf");*/
            
        })
        // Escuchar el evento 'click' en el botón de búsqueda
        searchButton.addEventListener('click', () => {
            // Obtener los valores de los campos de entrada
            let searchTerm = $('#ticket').val().trim();
            let startDate = $('#fecha_inicio').val();
            console.log(startDate)
            let endDate = $('#fecha_final').val();
            console.log(endDate)
            let responsable = $('#responsable').val();    
            let estado = $('#estado').val();
            let departament = $('#departamento').val()
            
            $.ajax({
                type: 'POST',
                url: 'admin/search.php',
                data: { 
                    searchTerm: searchTerm,
                    startDate: startDate,
                    endDate: endDate
                },
                dataType: 'json',
                success: function(data) {
                    // Limpiar la tabla de resultados
                    $('#ticketTable').empty();
                    
                    // Verificar si se encontraron resultados
                    if (data && data.length > 0) {
                        // Iterar sobre los resultados y agregar filas a la tabla
                        console.log(data)
                        if ( startDate ){
                            data = data.filter((el) => Date.parse(el.fecha_solucion) >= Date.parse(startDate))
                            console.log(data)
                            data = data.filter((el) => Date.parse(el.fecha) >= Date.parse(startDate))
                            console.log(data);

                        }
                        if ( endDate ){
                            data = data.filter((el) => Date.parse(el.fecha_solucion) < Date.parse(endDate))
                            data = data.filter((el) => Date.parse(el.fecha) < Date.parse(endDate))
                        }
                        if ( responsable ){
                            data = data.filter((el ) => el.id_tecnico == responsable )
                        } 
                        console.log(data)
                        if ( estado ){
                            data = data.filter((el) => el.estado_ticket == estado)
                        }
                        console.log(data)
                        if ( departament ){
                            data = data.filter((el) => el.departamento == departament )
                        }
                        data.forEach(row => {
                            let tr = '';
                            if ( row.id_cliente != null){
                                tr = `<tr>
                                <td class="text-center"></td>
                                <td>${row.fecha}</td>
                                <td>${row.serie}</td>
                                <td>${row.estado_ticket}</td>
                                <td>${row.nombres}</td>
                                <td>${row.email_cliente}</td>
                                <td>${row.departamento}</td>
                                <td>${row.nombres_tecnico}</td>
                                <td>${row.fecha_solucion}</td>
                                <td>${row.area}</td>
                                <td>
                                    <a href="./lib/pdf.php?id=${row.id}" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a href="admin.php?view=ticketedit&id=${row.id}" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <form action="" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="id_del" value="${row.id}">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>`;
                            }else if (row.id_admin != null){
                                tr = `<tr>
                                <td class="text-center"></td>
                                <td>${row.fecha}</td>
                                <td>${row.serie}</td>
                                <td>${row.estado_ticket}</td>
                                <td>${row.nombre_completo}</td>
                                <td>${row.email_admin}</td>
                                <td>${row.departamento}</td>
                                <td>${row.nombres_tecnico}</td>
                                <td>${row.fecha_solucion}</td>
                                <td>${row.area}</td>
                                <td>
                                    <a href="./lib/pdf.php?id=${row.id}" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <a href="admin.php?view=ticketedit&id=${row.id}" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <form action="" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="id_del" value="${row.id}">
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>`;
                            }
                            
                            $('#ticketTable').append(tr);
                        });
                        console.log(data); 
                        tickets = JSON.stringify(data);
                        $('#toPDF').removeClass('d-none').addClass('d-block');
                        console.log(tickets);
                        $('#all_tickets').append(tickets);

                    } else {
                        // Mostrar mensaje de "No se encontraron resultados"
                        const tr = '<tr><td colspan="10">No se encontraron resultados</td></tr>';
                        $('#ticketTable').append(tr);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener datos:', error);
                }
            });
        });
    });
</script>
</body>
</html>