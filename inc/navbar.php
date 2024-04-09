<?php
    if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
        include "./process/index.php";
    }
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #23b7e5; height: 100px;">
    <div class="flex-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="" href="index.php"></i><img src="./img/logo_magda.png" width="100" alt=""></a>
            
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if(isset($_SESSION['tipo']) && isset($_SESSION['nombre'])): ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['nombre']; ?><b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">

                        <!-- usuarios -->
                        <?php if($_SESSION['tipo']=="user"): ?>
                        
                        <!--<li>
                            <a href="#!"><span class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Mensajes</a>
                        </li>-->
                        <li>
                            <a href="./ticketusuario.php"><span class="glyphicon glyphicon-envelope"></span> &nbsp; Mis Tickets</a>
                        </li>
                        <li>
                            <a href="./configuracion-user.php"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                        </li> 
                        <li>
                            <a href="./index.php?view=ticket"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Generar nuevo ticket</a>
                        </li>

                        <li>	
                             <a href="/ticket/Manual.pdf", target='blank'  download="Manual.pdf">Descargar Manual de Usuario</a>
                        </li>
                        <?php endif; ?>


                        
                        <!-- admins -->
                        <?php if($_SESSION['tipo']=="admin" && $_SESSION['cargo']=="tecnico"){ ?>
                         <!--<center> <script language="javascript">alert("no te olvides de cambiar tu contraseña en la opcion configuracion") </script></center>-->
                       

                        <li>
                            <a href="admin.php?view=ticketasig"><i class="fa fa-cogs"></i> &nbsp; mis tickets asignados</a>
                        </li>

                        <li>
                            <a href="/ticket/pdf"><i class="fa fa-cogs"></i> &nbsp; reportes</a>
                        </li>

                       <!-- <li>
                            <a href="admin.php?view=users"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar Usuarios</a>
                        </li>-->
                       <!-- <li>
                            <a href="admin.php?view=admin"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar usuaios</a>
                        </li>-->
    
                        <li>
                             <a href="registro.php"><i class="fa fa-users"></i>&nbsp;&nbsp;Registro de nuevos usuarios</a>
                        </li>


                     




                        <!-- admins -->
                        <?php } else if($_SESSION['tipo']=="admin" && $_SESSION['cargo']!="tecnico"){ ?>

                           <!-- <center> <script language="javascript">alert("no te olvides de cambiar tu contraseña en la opcion configuracion") </script></center>-->
                        <li>
                            <a href="admin.php?view=ticketadmin"><span class="glyphicon glyphicon-envelope"></span> &nbsp; asignaciones de tickets</a>
                        </li>

                        <li>
                            <a href="admin.php?view=ticketasig"><i class="fa fa-cogs"></i> &nbsp; mis tickets asignados</a>
                        </li>



                        <li>
                            <a href="/ticket/pdf"><i class="fa fa-cogs"></i> &nbsp; reportes</a>
                        </li>

                       <!-- <li>
                            <a href="admin.php?view=users"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar Usuarios</a>
                        </li>-->
                        <li>
                            <a href="admin.php?view=admin"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar usuaios</a>
                        </li>
    
                        <li>
                             <a href="registro.php"><i class="fa fa-users"></i>&nbsp;&nbsp;Registro de nuevos usuarios</a>
                        </li>


                        <li>
                            <a href="admin.php?view=config"><i class="fa fa-cogs"></i> &nbsp; Configuracion de Administrador</a>
                        </li>
                        <?php } ?> 
                        <li class="divider"></li>
                        <li ><a href="./process/logout.php"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
            <?php endif; ?>

            <!--Obciones de menu inicion iniciada-->
            <ul class=" nav navbar-nav navbar-right">
                <li>
                    <a href="./index.php"><span class="glyphicon glyphicon-home text-white"></span> &nbsp; Inicio</a>
                </li>
              <!--  <li>
                    <a href="./index.php?view=productos"><span class="glyphicon glyphicon-shopping-cart"></span> &nbsp; </a>
                </li>-->
               <!-- <li>
                    <a href="./index.php?view=soporte"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;Soporte técnico</a>
                </li>-->

                <?php if(!isset($_SESSION['tipo']) && !isset($_SESSION['nombre'])): ?>
               
                <li>
                    <a href="#!" data-toggle="modal" data-target="#modalLog"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Login</a>
                </li>
                <?php endif; ?>

            </ul>
            <!--<form class="navbar-form navbar-right hidden-xs" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Buscar">
                </div>
                <button type="button" class="btn btn-success">Buscar</button>
            </form>-->
        </div>
    </div>
</nav>

<div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title text-center text-primary" id="myModalLabel">Bienvenido </h4>
            </div>
          <form action="" method="POST" style="margin: 20px;">
              <div class="form-group">
                  <label><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</label>
                  <input type="text" class="form-control" name="nombre_login" placeholder="Escribe tu nombre" required=""/>
              </div>
              <div class="form-group">
                  <label><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
                  <input type="password" class="form-control" name="contrasena_login" placeholder="Escribe tu contraseña" required=""/>
              </div>
              
              <p>¿Cómo iniciaras sesión?</p>
              <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" value="user" checked>
                    Usuario
                </label>
             </div>
             <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" value="admin">
                     Administrador
                </label>
             </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Iniciar sesión</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
      </div>
    </div>
</div>