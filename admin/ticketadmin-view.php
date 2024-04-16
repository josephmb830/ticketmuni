<?php 
    if ($_GET['ticket']){
        var_dump($_POST['ticket']);
    }
?>
<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin"){ ?>
        
            <?php
            // Verificar si se ha enviado un formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // include './lib/config.php';
            
            // Crear conexión
            $conexion = mysqli_connect(SERVER, USER, PASS, BD);

            // Verificar conexión
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Obtener el valor del input
            $search_term = $_POST['id_like'];

                if(isset($_POST['id_del'])){
                    $id = MysqlQuery::RequestPost('id_del');
                    if(MysqlQuery::Eliminar("ticket", "id='$id'")){
                        echo '
                            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">TICKET ELIMINADO</h4>
                                <p class="text-center">
                                    El ticket fue eliminado del sistema con exito
                                </p>
                            </div>
                        ';
                    }else{
                        echo '
                            <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                                <p class="text-center">
                                    No hemos podido eliminar el ticket
                                </p>
                            </div>
                        '; 
                    }
                }
            }
                ?>

                
                
                <?php
                //$num_ticket_all=Mysql::consulta("SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente WHERE ticket.estado_ticket = 'Pendiente';");

                /* Números */
                /* Todos los tickets */
                $num_ticket_all_admin = Mysql::consulta("SELECT ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico");
                $num_ticket_all_cliente = Mysql::consulta("SELECT ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico");

                $num_total_all_admin = mysqli_num_rows($num_ticket_all_admin);
                $num_total_all_cliente = mysqli_num_rows($num_ticket_all_cliente);

                $num_total_all = $num_total_all_admin + $num_total_all_cliente;

                /* Tickets pendientes*/
                $num_ticket_pend_admin = Mysql::consulta("SELECT ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Pendiente'");
                $num_ticket_pend_cliente = Mysql::consulta("SELECT ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Pendiente'");

                $num_total_pend_admin = mysqli_num_rows($num_ticket_pend_admin);
                $num_total_pend_cliente = mysqli_num_rows($num_ticket_pend_cliente);

                $num_total_pend = $num_total_pend_admin + $num_total_pend_cliente;

                /* Tickets en proceso*/
                $num_ticket_proceso_admin = Mysql::consulta("SELECT ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'En proceso'");
                $num_ticket_proceso_cliente = Mysql::consulta("SELECT ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'En proceso'");

                $num_total_proceso_admin = mysqli_num_rows($num_ticket_proceso_admin);
                $num_total_proceso_cliente = mysqli_num_rows($num_ticket_proceso_cliente);

                $num_total_proceso = $num_total_proceso_admin + $num_total_proceso_cliente;

                /* Tickets resueltos*/
                $num_ticket_res_admin = Mysql::consulta("SELECT ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Resuelto'");
                $num_ticket_res_cliente = Mysql::consulta("SELECT ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Resuelto'");

                $num_total_res_admin = mysqli_num_rows($num_ticket_res_admin);
                $num_total_res_cliente = mysqli_num_rows($num_ticket_res_cliente);

                $num_total_res = $num_total_res_admin + $num_total_res_cliente;

                /* Tickets anulados*/
                $num_ticket_can_admin = Mysql::consulta("SELECT ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Anulado'");
                $num_ticket_can_cliente = Mysql::consulta("SELECT ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Anulado'");

                $num_total_can_admin = mysqli_num_rows($num_ticket_can_admin);
                $num_total_can_cliente = mysqli_num_rows($num_ticket_can_cliente);

                $num_total_can = $num_total_can_admin + $num_total_can_cliente;
            ?>
















<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Búsqueda de Tickets</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <!-- Estilos CSS personalizados -->
    <link rel="stylesheet" href="styles.css">
</head>


<body>






<div class="container mt-100" style="margin-left: 120px !important;">
    <div class="col-sm-12 flex-vertical">
        <div class="col-sm-12 text-center">
            <?php include "./inc/reloj.php"; ?>
            <br>              
        </div>  
    </div>
    </html>































            
    <div class="container mt-100">




          


            <div class="container mt-250 h-screen">
            <div class="row">
            <div class="col-sm-12 text-center">
                        
                    </div>
                    <div class="col-md-2-5 border-r bg-blue text-center">
                    <a href="./admin.php?view=ticketadmin&ticket=all" class="text-white">
                            <h3 class="f-25">Todos los Tickets</h3>
                            <p class="f-25 text-center"><?php echo $num_total_all; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-yellow text-center">
                    <a href="./admin.php?view=ticketadmin&ticket=pending" class="text-white">
                            <h3 class="f-25">Tickets Pendientes</h3>
                            <p class="f-25 text-center"><?php echo $num_total_pend; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 border-r bg-green text-center">
                    <a href="./admin.php?view=ticketadmin&ticket=process" class="text-white">
                            <h3 class="f-25">Tickets en Proceso</h3>
                            <p class="f-25 text-center"><?php echo $num_total_proceso; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-gray text-center">
                    <a href="./admin.php?view=ticketadmin&ticket=resolved" class="text-white">
                            <h3 class="f-25">Tickets Resueltos</h3>
                            <p class="f-25 text-center"><?php echo $num_total_res; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-red text-center">
                    <a href="./admin.php?view=ticketadmin&ticket=canceled" class="text-white">
                            <h3 class="f-25">Tickets Anulados</h3>
                            <p class="f-25 text-center"><?php echo $num_total_can; ?></p>
                        </a>
                    </div>
                </div>
                <br>
                <div class="container mt-5">
                    <h2 class="text-center">Tabla de Tickets</h2>
                    <!-- Campos de entrada para la búsqueda y filtro por fecha -->

                    <div class="input-group mb-3">

                        <select name="ticket" id="ticket" class="form-control">
                            <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");
                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
                                $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico order by id desc LIMIT $inicio, $regpagina";
                                $selticket_admin=mysqli_query($mysqli,$consulta_admin); 
                                while ($row=mysqli_fetch_array($selticket_admin, MYSQLI_ASSOC)): ?>
                            <option value="<?php echo $row['serie']; ?>"><?php echo $row['serie']; ?></option>
                            <?php endwhile; ?>
                       </select>
                       <select name="responsable" id="responsable" class="form-control">
                            <?php 
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");
                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
                                $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico order by id desc LIMIT $inicio, $regpagina";
                                $selticket_admin=mysqli_query($mysqli,$consulta_admin); 
                                while ($row=mysqli_fetch_array($selticket_admin, MYSQLI_ASSOC)): ?>
                            <option value="<?php echo $row['id_tecnico']; ?>"><?php echo strtoupper($row['nombres_tecnico'] . " " . $row['a_paterno_tecnico'] . " " . $row['a_materno_tecnico']); ?></option>
                            <?php endwhile; ?>
                       </select>
                        <select name="estado" id="estado" class="form-control">
                            <option value="Pendiente">Pendiente</option>
                            <option value="En proceso">En proceso</option>
                            <option value="En proceso">Anulado</option>
                            <option value="Resuelto">Resuelto</option>
                        </select>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                        <input type="date" id="fecha_final" name="fecha_final" class="form-control">
                        <button class="btn btn-dark" type="button" id="searchButton">Buscar</button>
                        </div>

                    <!-- Tabla donde se mostrarán los registros -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Serie</th>
                                    <th>Fecha</th>
                                    <th>Estado del Ticket</th>
                                    <th>Nombre de Usuario</th>
                                    <th>Email del Cliente</th>
                                    <th>Departamento</th>
                                    <th>Técnico</th>
                                    <th>Fecha de Solución</th>
                                    <th>Área</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="ticketTable">
                                <!-- Aquí se mostrarán los resultados de la búsqueda -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                //$num_ticket_all=Mysql::consulta("SELECT ticket.*, cliente.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente WHERE ticket.estado_ticket = 'Pendiente';");
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico order by id desc LIMIT $inicio, $regpagina";
                                        $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico order by id desc LIMIT $inicio, $regpagina";                                       
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Pendiente' order by id desc LIMIT $inicio, $regpagina";
                                        $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Pendiente' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'En proceso' order by id desc LIMIT $inicio, $regpagina";
                                        $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'En proceso' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Resuelto' order by id desc LIMIT $inicio, $regpagina";
                                        $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Resuelto' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="canceled"){
                                        $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Anulado' order by id desc LIMIT $inicio, $regpagina";
                                        $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE ticket.estado_ticket = 'Anulado' order by id desc LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico LIMIT $inicio, $regpagina";
                                        $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta_admin="SELECT SQL_CALC_FOUND_ROWS ticket.*, administrador.*, tecnico.* FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico order by id desc LIMIT $inicio, $regpagina";
                                    $consulta_cliente="SELECT SQL_CALC_FOUND_ROWS ticket.*, cliente.*, tecnico.* FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico order by id desc LIMIT $inicio, $regpagina";
                                }


                                $selticket_admin=mysqli_query($mysqli,$consulta_admin);
                                $selticket_cliente=mysqli_query($mysqli,$consulta_cliente);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if (mysqli_num_rows($selticket_admin) + mysqli_num_rows($selticket_cliente) > 0):
                            ?>
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Tipo de falla</th>
                                        <th class="text-center">Tecnico</th>
                                        <th class="text-center">Fecha de actualizacion de estado</th>
                                        <th class="text-center">Area</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>

                                
                                <tbody>

                                
                                    <?php
                                        $ct=$inicio+1;
                                        while ($row=mysqli_fetch_array($selticket_admin, MYSQLI_ASSOC)): 
                            
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_admin']; ?></td>
                                        <td class="text-center"><?php echo $row['email_admin']; ?></td>
                                        <td class="text-center"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center"><?php echo strtoupper($row['nombres_tecnico'] . " " . $row['a_paterno_tecnico'] . " " . $row['a_materno_tecnico']); ?></td>
                                        <td class="text-center"><?php echo $row['fecha_solucion']; ?></td>
                                        <td class="text-center"><?php echo "Informática"; ?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                      
                                    </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 

                                        while ($row = mysqli_fetch_array($selticket_cliente, MYSQLI_ASSOC)) :
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $ct; ?></td>
                                        <td class="text-center"><?php echo $row['fecha']; ?></td>
                                        <td class="text-center"><?php echo $row['serie']; ?></td>
                                        <td class="text-center"><?php echo $row['estado_ticket']; ?></td>
                                        <td class="text-center"><?php echo $row['nombre_usuario']; ?>a</td>
                                        <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                        <td class="text-center"><?php echo $row['departamento']; ?></td>
                                        <td class="text-center"><?php echo strtoupper($row['nombres_tecnico'] . " " . $row['a_paterno_tecnico'] . " " . $row['a_materno_tecnico']); ?></td>
                                        <td class="text-center"><?php echo $row['fecha_solucion']; ?></td>
                                        <td class="text-center"><?php echo $row['area']; ?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <form action="" method="POST" style="display: inline-block;">
                                                <input type="hidden" name="id_del" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                      
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
                    <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                    <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                    
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Obtener referencia al botón de búsqueda
        const searchButton = document.getElementById('searchButton');

        // Escuchar el evento 'click' en el botón de búsqueda
        searchButton.addEventListener('click', () => {
            // Obtener los valores de los campos de entrada
            console.log('CLICK')
            let searchTerm = $('#ticket').val();
            console.log(searchTerm);
            let startDate = $('#fecha_inicio').val();
            let endDate = $('#fecha_final').val();
            let responsable = $('#responsable').val();
            console.log(responsable)
            let estado = $('#estado').val();
            console.log(estado)
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
                        data = data.filter((el ) => el.serie === searchTerm )
                        data = data.filter((el ) => el.id_tecnico === responsable )
                        data = data.filter((el) => el.estado_ticket === estado)
                        data.forEach(row => {
                            const tr = `<tr>
                                <td>${row.serie}</td>
                                <td>${row.fecha}</td>
                                <td>${row.estado_ticket}</td>
                                <td>${row.nombre_usuario}</td>
                                <td>${row.email_cliente}</td>
                                <td>${row.departamento}</td>
                                <td>${row.id_tecnico}</td>
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
                            $('#ticketTable').append(tr);
                        });
                        console.log(data);  
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