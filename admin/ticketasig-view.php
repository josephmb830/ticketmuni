<?php if( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="admin"){ 
    $usuario = $_SESSION['nombre'];
    $nombre = $_SESSION['nombre_completo'];
    ?>
        <div class="container mt-100">
          <div class="row">
          <div class="col-sm-12 text-center">
            <?php include "./inc/reloj.php"; ?>
              <br>
              
            </div>
          </div>
        </div>
            <?php
              

                /* Todos los tickets*/
                $num_ticket_all=Mysql::consulta(" SELECT * FROM ticket where nombre_usuario = '$nombre' ");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Pendiente'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='En proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);

                /* Tickets anulados*/
                $num_ticket_can=Mysql::consulta("SELECT * FROM ticket WHERE nombre_usuario = '$nombre' and estado_ticket='Anulado'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
            ?>

            <div class="container h-screen">
            <div class="row mt-250">
                    <div class="col-md-2-5 border-r bg-blue text-center">
                        <a href="./admin.php?view=ticketasig&ticket=all" class="text-white">
                            <h3 class="f-25">Todos los Tickets</h3>
                            <p class="f-25 text-center"><?php echo $num_total_all; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-yellow text-center">
                        <a href="./admin.php?view=ticketasig&ticket=pending" class="text-white ">
                            <h3 class="f-25">Tickets Pendientes</h3>
                            <p class="f-25 text-center"><?php echo $num_total_pend; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 border-r bg-green text-center">
                        <a href="./admin.php?view=ticketasig&ticket=process" class="text-white ">
                            <h3 class="f-25">Tickets en Proceso</h3>
                            <p class="f-25 text-center"><?php echo $num_total_proceso; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-gray text-center">
                        <a href="./admin.php?view=ticketasig&ticket=resolved" class="text-white">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Pendiente'  order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='En Proceso' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Resuelto' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="canceled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE nombre_usuario = '$nombre' and estado_ticket='Anulado' order by id desc LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket order by id desc LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS t.* FROM ticket t,administrador c where t.nombre_usuario = c.nombre_completo and c.nombre_admin = '$usuario' LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
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
                                        <th class="text-center">Opciones</th>
                                        

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
                                        <td class="text-center"><?php echo $row['tecnico']; ?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                           
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
                                            echo '<li class="active"><a href="./admin.php?view=ticketasig&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=ticketasig&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=ticketasig&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
}elseif( $_SESSION['nombre']!="" && $_SESSION['clave']!="" && $_SESSION['tipo']=="tecnico"){
    $usuario = $_SESSION['nombre'];
    $nombre = $_SESSION['nombre_completo'];
    ?>
        <div class="container mt-100">
          <div class="row">
          <div class="col-sm-12 text-center">
            <?php include "./inc/reloj.php"; ?>
              <br>
              
            </div>
          </div>
        </div>
            <?php
              

                /* Todos los tickets*/
                $num_ticket_all=Mysql::consulta(" SELECT * FROM ticket where nombre_usuario = '$nombre' ");
                $num_total_all=mysqli_num_rows($num_ticket_all);

                /* Tickets pendientes*/
                $num_ticket_pend=Mysql::consulta("SELECT * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Pendiente'");
                $num_total_pend=mysqli_num_rows($num_ticket_pend);

                /* Tickets en proceso*/
                $num_ticket_proceso=Mysql::consulta("SELECT * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='En proceso'");
                $num_total_proceso=mysqli_num_rows($num_ticket_proceso);

                /* Tickets resueltos*/
                $num_ticket_res=Mysql::consulta("SELECT * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Resuelto'");
                $num_total_res=mysqli_num_rows($num_ticket_res);

                /* Tickets anulados*/
                $num_ticket_can=Mysql::consulta("SELECT * FROM ticket WHERE nombre_usuario = '$nombre' and estado_ticket='Anulado'");
                $num_total_can=mysqli_num_rows($num_ticket_can);
            ?>

            <div class="container h-screen">
            <div class="row mt-250">
                    <div class="col-md-2-5 border-r bg-blue text-center">
                        <a href="./admin.php?view=ticketasig&ticket=all" class="text-white">
                            <h3 class="f-25">Todos los Tickets</h3>
                            <p class="f-25 text-center"><?php echo $num_total_all; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-yellow text-center">
                        <a href="./admin.php?view=ticketasig&ticket=pending" class="text-white ">
                            <h3 class="f-25">Tickets Pendientes</h3>
                            <p class="f-25 text-center"><?php echo $num_total_pend; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 border-r bg-green text-center">
                        <a href="./admin.php?view=ticketasig&ticket=process" class="text-white ">
                            <h3 class="f-25">Tickets en Proceso</h3>
                            <p class="f-25 text-center"><?php echo $num_total_proceso; ?></p>
                        </a>
                    </div>
                    <div class="col-md-2-5 text-white border-r bg-gray text-center">
                        <a href="./admin.php?view=ticketasig&ticket=resolved" class="text-white">
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                mysqli_set_charset($mysqli, "utf8");

                                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                                $regpagina = 15;
                                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                                
                                if(isset($_GET['ticket'])){
                                    if($_GET['ticket']=="all"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="pending"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Pendiente'  order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="process"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='En Proceso' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="resolved"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket where nombre_usuario = '$nombre' and estado_ticket='Resuelto' order by id desc LIMIT $inicio, $regpagina";
                                    }elseif($_GET['ticket']=="canceled"){
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE nombre_usuario = '$nombre' and estado_ticket='Anulado' order by id desc LIMIT $inicio, $regpagina";
                                    }else{
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM ticket order by id desc LIMIT $inicio, $regpagina";
                                    }
                                }else{
                                    $consulta="SELECT SQL_CALC_FOUND_ROWS t.* FROM ticket t,administrador c where t.nombre_usuario = c.nombre_completo and c.nombre_admin = '$usuario' LIMIT $inicio, $regpagina";
                                }


                                $selticket=mysqli_query($mysqli,$consulta);

                                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
                        
                                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                                if(mysqli_num_rows($selticket)>0):
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
                                        <th class="text-center">Opciones</th>
                                        

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
                                        <td class="text-center"><?php echo $row['tecnico']; ?></td>
                                        <td class="text-center">
                                            <a href="./lib/pdf.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="admin.php?view=ticketedit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                           
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
                                            echo '<li class="active"><a href="./admin.php?view=ticketasig&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
                                        }else{
                                            echo '<li><a href="./admin.php?view=ticketasig&ticket='.$ticketselected.'&pagina='.$i.'">'.$i.'</a></li>';
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
                                        <a href="./admin.php?view=ticketasig&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
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
        <div>
</div>
<?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.js"></script>
<div class="none">
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>