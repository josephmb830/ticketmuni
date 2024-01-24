<?php

session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');  



// Asegúrate de tener la conexión a la base de datos disponible
$conexion = mysqli_connect(SERVER, USER, PASS, BD);


if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

date_default_timezone_set('America/Bogota');

$hoy = date('d/m/Y   h:i:s  a', TIME());

?>






<!DOCTYPE html>
<html>

<head>
  <title>Sistema de Ticket MDMM</title>
  <link rel="shortcut icon" href="img/logomuni.png">
  <?php include "./inc/links.php"; ?>
  
 
</head>

<body>
  


  



  


        <div class=""  style="margin: 20px;">
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












  <?php    ?>                

</body>
</html>
  <script>


  </script>
  <?php 
  
?>