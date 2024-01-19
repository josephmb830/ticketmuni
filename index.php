<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');  

?>
<!DOCTYPE html>
<html>

<head>
  <title>Sistema de Ticket MDMM</title>
  <link rel="shortcut icon" href="img/logomuni.png">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <?php 
  include "./inc/links.php"; 
  ?>
</head>

<body>


  <?php 
  if(isset($_POST['nombre_login']) && isset($_POST['contrasena_login'])){
    include "./process/login.php"; 
  }
  if(isset($_SESSION['nombre'])){
    include "./inc/slidebar.php"; 
  }
  
  ?>
  
  <div class="">
    <div class="flex" style="height:100%;">
      <?php if(isset($_SESSION['nombre'])){ ?>
      <div class="col-md-6 col-sm-12 mx-0">
        <div id="ticket" class="none">
              <?php include "./user/ticket-view.php"; ?>
        </div>
        <div id="consultaTicket">
              <?php 
               
              ?>
        </div>
        <div id="newTicket" class="flex-ticket" style="height:100%;">
          <div class="col-md-6 col-sm-12">
            <div class="panel panel-info">
              <div class="panel-body text-center table-title">
                <img src="./img/boleto.png" width="50" alt="">
                <h4>Abrir un nuevo ticket</h4>
                <p class="text-justify">Si tienes alguna insidencia reportalo creando un nuevo ticket y te ayudaremos a
                  solucionarlo.Si desea actualizar una peticion ya realizada utiliza el formulario de la derecha
                  <em>Comprobar estado de Ticket</em>, solamente los <strong>usuarios registrados</strong> pueden abrir
                  un nuevo ticket.</p>
                <p>Para abrir un nuevo <strong>ticket</strong> has click en el siguiente boton</p>
                <a type="button" onclick="crearTicket()" class="btn btn-white" href="./index.php?view=ticket">Nuevo
                  Ticket</a>
              </div>
            </div>
          </div>
          <!--fin col-md-6-->

          <div class="col-md-6 col-sm-12">
            <div class="panel bg-gray-05">
              <div class="panel-body text-center">
                <img src="./img/consulta.png" width="50" alt="">
                <h4>Colsultar estado de ticket</h4>
                <form class="form-horizontal" role="form" method="GET" action="./index.php">
                  <input type="hidden" name="view" value="ticketcon">
                  <div class="form-group">
                    <div class="col-sm-10">
                      <!-- <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                  <input type="email" class="form-control" name="email_consul" placeholder="Email" required="">-->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">ID Ticket</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="id_consul" placeholder="ID Ticket" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-gray-05">Colsultar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!--fin col-md-6-->
        </div>
        <!--fin row 2-->
      </div>
      <?php }else{?>
          <div class="col-md-6">
            <div class="w-50 mx-auto border-login p-2 sombra">
              <div class="col-md-12 text-center mb-4">
                <img src="./img/bloqueado.png" width="150" alt="">
              </div>
            <form action="" method="POST" style="margin: 20px;">
              <div class="form-group">
                  <label><span class=""></span>Nombre</label>
                  <input type="text" class="form-control" name="nombre_login" placeholder="Escribe tu nombre" required=""/>
              </div>
              <div class="form-group">
                  <label><span class=""></span>Contraseña</label>
                  <input type="password" class="form-control" name="contrasena_login" placeholder="Escribe tu contraseña" required=""/>
              </div>
              
              <p>¿Cómo iniciarás sesión?</p>
              <div style="display:flex;align-items: end;justify-content: space-around;width: 100%;margin-bottom:20px;">
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
              </div>
              
              
              <div class="text-center d-flex">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                  <button type="button" class="btn btn-primary btn-sm mr-2" onclick="redirigirARegistro()">Registrarse</button>
                </div>
                <div class="col-sm-4">
                  <button type="submit" class="btn btn-primary btn-sm">Iniciar sesión</button>
                  <!-- <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button> -->
                </div>
                <div class="col-sm-2">
                </div>
              </div>
          </form>
            </div>
          
          </div>
          <div class="col-md-6 col-sm-12">
        <img class="w-full h-full" src="./img/banner_muni.png" alt="">
      </div>
        <?php } ?>
      
    </div>
    
    
    <div class="">
      <?php
            if(isset($_GET['view'])){
                $content=$_GET['view'];
                $WhiteList=["index","soporte","ticket","ticketcon","registro","configuracion","ticketusuario"];
                if(in_array($content, $WhiteList) && is_file("./user/".$content."-view.php")){
                  include "./user/".$content."-view.php";
                }else{
            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="./img/Stop.png" alt="Image" class="img-responsive"/><br>
                            <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
                        </div>
                        <div class="col-sm-7 text-center">
                            <h1 class="text-danger">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h1>
                            <h3 class="text-info">Por favor intente nuevamente</h3>
                        </div>
                        <div class="col-sm-1">&nbsp;</div>
                    </div>
                </div>
              <?php
                }
                  }else{
                      include "./user/index-view.php";
                  }
              ?>
    </div> 
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
          
      function redirigirARegistro() {
      window.location.href = 'formulario_registro.php';
      }
      let newTicket= document.getElementById("newTicket");
      let ticket=document.getElementById("ticket");
      <?php if(isset($_SESSION['nombre'])){?>
      function crearTicket(){
        event.preventDefault();
        newTicket.classList.add("none");
        ticket.classList.remove("none");
      }
      function consultaTicket(){
        event.preventDefault();
        newTicket.classList.add("none");
        ticket.classList.remove("none");
      }
      <?php }else{?>
        function crearTicket(){
        event.preventDefault();
        alert("Ingrese como usuario");
      }
      <?php } ?>

    </script>

</html>