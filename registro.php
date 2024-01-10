<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');  

?>
<?php
    if(isset($_POST['user_reg']) && isset($_POST['clave_reg']) && isset($_POST['nom_complete_reg'])){
        $nombre_reg=MysqlQuery::RequestPost('nom_complete_reg');
        $user_reg=MysqlQuery::RequestPost('user_reg');
        $clave_reg=md5(MysqlQuery::RequestPost('clave_reg'));
        $clave_reg2=MysqlQuery::RequestPost('clave_reg');
        $email_reg=MysqlQuery::RequestPost('email_reg');
        $area_reg=MysqlQuery::RequestPost('area_reg');
        $asunto2=MysqlQuery::RequestPost('asunto2');

      

        //correo
        $asunto="Registro de cuenta en la Plataforma de Soporte Tecnico";
        $cabecera="From: Area de Desarollo de la Municipalidad de la Magdalena del Mar <soporte02@munimagdalena.com>";
        $mensaje_mail="Hola ".$nombre_reg.", Tu reagistro fue exitoso . Los datos de cuenta son los siguientes:\nNombre Completo: ".$nombre_reg."\nNombre de usuario: ".$user_reg."\nClave: ".$clave_reg2."\nEmail: ".$email_reg."\n Página";

        
        if(MysqlQuery::Guardar("ticket2", "nombre_completo, nombre_usuario, email_cliente, clave, area, asunto2", "'$nombre_reg', '$user_reg', '$email_reg', '$clave_reg','$area_reg', '$asunto2'")){

            /*----------  Enviar correo con los datos de la cuenta ----*/
                
            

            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10000;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">REGISTRO EXITOSO</h4>
                    <p class="text-center">
                        Cuenta creada exitosamente, ahora puedes iniciar sesión, ya eres usuario.
                    </p>
                </div>
            ';
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10000;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        ERROR AL REGISTRARSE: Por favor intente nuevamente.
                    </p>
                </div>
            '; 
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
  <title>Sistema de Ticket MDMM</title>
  <link rel="shortcut icon" href="img/logomuni.png">
  <?php include "./inc/links.php"; ?>
</head>

<body>
  <?php include "./inc/slidebar.php"; ?>


  <div class="container mt-100">
   <h2>Registro de Usuario</h2>
    <div class="flex h-screen">
      <div class="col-sm-4 text-center hidden-xs">
        
        <center> <img src="img/user.png" class="img-responsive" width="250" height="450"></center>
      </div>
      <div class="col-sm-8">
        <div class="panel panel-success">
          <div class="panel-heading text-center"><strong>Para poder registrarte debes de llenar todos los campos de este
              formulario</strong></div>
          <div class="panel-body">
            <form role="form" action="" method="POST">
              <div class="form-group">
                <label><i class="fa fa-male"></i>&nbsp;Nombres completo</label>
                <input type="text" class="form-control" name="nom_complete_reg" placeholder="Nombre completo"
                  required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
              </div>
              <div class="form-group has-success has-feedback">
                <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de usuario</label>
                <input type="text" id="input_user" class="form-control" name="user_reg" placeholder="Nombre de usuario"
                  required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="20">
                <div id="com_form"></div>
              </div>

              <div class="form-group">
                <label><i class="fa fa-key"></i>&nbsp;Contraseña</label>
                <input type="password" class="form-control" name="clave_reg" placeholder="Contraseña" required="">
              </div>
              <div class="form-group">
                <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                <input type="email" class="form-control" name="email_reg" placeholder="Escriba su email" required="">
              </div>
              <div class="form-group">
                <label>area</label>
                <input type="text" id="input_user" class="form-control" name="area_reg" placeholder="Escriba su area"
                  required="">
              </div>
              <div class="form-group col-md-12">
                    <label><span class=""></span>Asunto</label>
                    <input type="text" class="form-control col-md-12" name="asunto2" placeholder="Escribe el asunto" required=""/>
              </div>
              <button type="submit" class="btn btn-danger">Crear cuenta</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php    ?>
</body>
</html>
  <script>
   
  </script>
  <?php 
  
?>