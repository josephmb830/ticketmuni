<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');  

?>
<?php
    if(isset($_POST['user_reg']) && isset($_POST['clave_reg']) && isset($_POST['nombres'])){
        $user_reg=MysqlQuery::RequestPost('user_reg');
        $clave_reg=md5(MysqlQuery::RequestPost('clave_reg'));
        $clave_reg2=MysqlQuery::RequestPost('clave_reg');
        $email_reg=MysqlQuery::RequestPost('email_reg');
        $area_reg=MysqlQuery::RequestPost('area_reg');
        $dni=MysqlQuery::RequestPost('dni');
        $nombresx=MysqlQuery::RequestPost('nombres');
        $a_paterno=MysqlQuery::RequestPost('a_paterno');
        $a_materno=MysqlQuery::RequestPost('a_materno');
        $cargo=MysqlQuery::RequestPost('cargo');
        $email=MysqlQuery::RequestPost('email');
        $asunto=MysqlQuery::RequestPost('asunto');
        $descripcion=MysqlQuery::RequestPost('descripcion');

      

        //correo
        

        
        if(MysqlQuery::Guardar("cliente", "nombre_usuario, email_cliente, clave, area, dni, nombres, a_paterno, a_materno, cargo, email, asunto, descripcion", "'$user_reg', '$email_reg', '$clave_reg','$area_reg', '$dni', '$nombresx', '$a_paterno', '$a_materno', '$cargo', '$email', '$asunto', '$descripcion' ")){

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
            <label><span class=""></span>INFORMACIÓN DEL CONTACTO</label>
              
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
                <label>Area</label>
                <input type="text" id="input_user" class="form-control" name="area_reg" placeholder="Escriba su area"
                  required="">
              </div>
              <div class="form-group ">
                    <label><span class=""></span>DNI</label>
                    <input type="text" class="form-control" name="dni" placeholder="Escribe tu dni" required=""/>
              </div>
              <div class="form-group">
                <label><span class="fa fa-male"></span>&nbsp;Nombres</label>
                <input type="text" class="form-control" name="nombres" placeholder="Escribe tus nombres" required="" />
              </div>
              <div class="form-group">
                <label><span class=""></span>Apellido Paterno</label>
                <input type="text" class="form-control" name="a_paterno" placeholder="Escribe tu Apellido Paterno" required="" />
              </div>
              <div class="form-group">
                <label><span class=""></span>Apellido Materno</label>
                <input type="text" class="form-control" name="a_materno" placeholder="Escribe tu Apellido Materno" required="" />
              </div>
              <div class="form-group">
                <label><span class=""></span>Cargo</label>
                <input type="text" class="form-control" name="cargo" placeholder="Escribe el cargo" required="" />
              </div>
              <div class="form-group">
                <label><span class="fa fa-envelope"></span>&nbsp;Correo Electrónico</label>
                <input type="email" class="form-control" name="email" placeholder="Escribe tu correo electrónico" required="" />
              </div>
              <label><span class=""></span>INFORMACIÓN DEL TICKET</label>
              <div class="form-group ">
                    <label><span class=""></span>Asunto</label>
                    <input type="text" class="form-control" name="asunto" placeholder="Escribe el asunto" required=""/>
              </div>
              <div class="form-group">
                    <label><span class=""></span>Descripción del Problema</label>
                    <textarea class="form-control" name="descripcion" rows="4" placeholder="Escribe la descripción del problema" required=""></textarea>
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