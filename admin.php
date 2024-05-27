<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');

if($_SESSION['tipo']!=("admin" || "tecnico")){
    session_start(); 
    session_unset();
    session_destroy();
    header("Location: ./index.php"); 
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Sistema de Ticket MDMM</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="img/logomuni.png">
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/slidebar.php"; ?>
        <div class="container">
          
        </div>
        <?php
            $WhiteList=["ticketadmin","ticketedit","users","admin", "tech","config","configusuario","ticketedittec","ticketasig", "configtecnico"];
            if(isset($_GET['view']) && in_array($_GET['view'], $WhiteList) && is_file("./admin/".$_GET['view']."-view.php")){
                include "./admin/".$_GET['view']."-view.php";
                
            }else{
                echo '<h2 class="text-center">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h2>';
            }
        ?>

        <script>
        $(document).ready(function (){

            $("#input_user").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form").html(data);
                    }
                });
            });


            $("#input_user2").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form2").html(data);
                    }
                });
            });

        });
        </script>
    </body>
</html>


