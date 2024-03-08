<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
header('Content-Type: text/html; charset=UTF-8');  
$conexion = mysqli_connect(SERVER, USER, PASS, BD);
if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}
?>

<?php
    if(isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['nombre_usuario'])){
        $dni=MysqlQuery::RequestPost('dni');
        $nombresu=MysqlQuery::RequestPost('nombre_usuario');
        $pass_save=md5(MysqlQuery::RequestPost('tecnico_clave_reg'));
        $nombresx=MysqlQuery::RequestPost('nombres');
        $a_paterno=MysqlQuery::RequestPost('a_paterno');
        $a_materno=MysqlQuery::RequestPost('a_materno');
        $cargo=MysqlQuery::RequestPost('cargo');
        $area=MysqlQuery::RequestPost('area');
        $email=MysqlQuery::RequestPost('email');
        
        

    


    // Verificar si la conexión a la base de datos se estableció correctamente
    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Consulta SQL para insertar datos en la tabla cliente
    $sqlInsert = "INSERT INTO tecnico (dni, nombre_tecnico, clave, nombres_tecnico, a_paterno_tecnico, a_materno_tecnico, cargo, area, email_tecnico) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conexion, $sqlInsert);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssss", $dni, $nombresu, $pass_save, $nombresx, $a_paterno, $a_materno, $cargo, $area, $email);

    // Execute the statement
    $resultado = mysqli_stmt_execute($stmt);

    // Verificar si la inserción fue exitosa
    if ($resultado) {
        echo "Datos insertados exitosamente en la base de datos.";
    } else {
        echo "Error al insertar datos en la base de datos: " . mysqli_error($conexion);
    }
}


/* Actualizar cuenta admin */
        
if(isset($_POST['nom_admin_up']) && isset($_POST['admin_up']) && isset($_POST['old_nom_admin_up'])){
  $nom_complete_update=MysqlQuery::RequestPost('nom_admin_up');
  $nom_admin_update=MysqlQuery::RequestPost('admin_up');
  $old_nom_admin_update=MysqlQuery::RequestPost('old_nom_admin_up');
  $pass_admin_update=md5(MysqlQuery::RequestPost('admin_clave_up'));
  $old_pass_admin_uptade=md5(MysqlQuery::RequestPost('old_admin_clave_up'));
  $email_admin_update=MysqlQuery::RequestPost('admin_email_up');

  $sql=Mysql::consulta("SELECT * FROM administrador WHERE nombre_admin= '$old_nom_admin_update' AND clave='$old_pass_admin_uptade'");
  if(mysqli_num_rows($sql)>=1){
      if(MysqlQuery::Actualizar("administrador", "nombre_completo='$nom_complete_update', nombre_admin='$nom_admin_update', clave='$pass_admin_update', email_admin='$email_admin_update'", "nombre_admin='$old_nom_admin_update' and clave='$old_pass_admin_uptade'")){
          $_SESSION['nombre']=$nom_admin_update;
          $_SESSION['clave']=$pass_admin_update;
          echo '
              <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="text-center">ADMINISTRADOR ACTUALIZADO</h4>
                  <p class="text-center">
                      El administrador se actualizo con exito
                  </p>
              </div>
          ';
      }else{
          echo '
              <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                  <p class="text-center">
                      No hemos podido actualizar el administrador
                  </p>
              </div>
          ';
      }
  }else{
      echo '
          <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="text-center">OCURRIÓ UN ERROR</h4>
              <p class="text-center">
                  Usuario y clave incorrectos
              </p>
          </div>
      ';
 }
}

?>



<?php if( isset($_SESSION['nombre'])){ ?>

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
   <h2>Registro de Técnico</h2>
    <div class="flex h-screen">
      <div class="col-sm-4 text-center hidden-xs">
        
        <center> <img src="img/user.png" class="img-responsive" width="250" height="450"></center>
      </div>
      <div class="col-sm-8">
        <div class="panel panel-success">
          <div class="panel-heading text-center"><strong>Para poder registrarte debes de llenar todos los campos de este
              formulario</strong></div>
          <div class="panel-body">
            <form role="form" action="" method="POST" enctype="multipart/form-data">
            <label><span class=""></span>INFORMACIÓN DEL CONTACTO</label>
              
          
              <div class="form-group has-success has-feedback">
                    <label><span class=""></span>DNI</label>
                    <input type="text" class="form-control" name="dni" placeholder="Escribe tu dni" required="" maxlength="9"/>
              </div>
              <div class="form-group">
                <label><span class="fa fa-male"></span>&nbsp;Nombre de usuario</label>
                <input type="text" class="form-control" name="nombre_usuario" placeholder="Escribe tu nombre de usuario" required="" />
              </div>
              <div class="form-group">
                <label><i class="fa fa-shield"></i>&nbsp;Contraseña</label>
                <input type="password" class="form-control" name="tecnico_clave_reg" placeholder="Contraseña" required="">
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
                <label><span class=""></span>Area</label>
                <input type="text" class="form-control" name="area" placeholder="Escribe el area" required="" />
              </div>
              <div class="form-group">
                <label><span class="fa fa-envelope"></span>&nbsp;Correo Electrónico</label>
                <input type="email" class="form-control" name="email" placeholder="Escribe tu correo electrónico" required="" />
              </div>
              
              <button type="submit" class="btn btn-danger">Crear cuenta</button>
            </form>
          </div>
        </div>
      </div>



      <div class="col-sm-4">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="panel panel-info">
                         <div class="panel-heading text-center"><i class="fa fa-refresh"></i>&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                         <div class="panel-body">
                            <?php
                                $idad=$_SESSION['id'];
                                $sql1=Mysql::consulta("SELECT * FROM administrador WHERE id_admin='$idad'");
                                $reg1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);
                            ?>
                             <form role="form" action="" method="POST">
                             <div class="form-group">
                               <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
                               <input type="text" class="form-control" value="<?php echo $reg1['nombre_completo']; ?>" name="nom_admin_up" placeholder="Nombre completo" required="" pattern="[a-zA-Z ]{1,40}" title="Nombre Apellido" maxlength="40">
                             </div>
                             <div class="form-group">
                               <label><i class="fa fa-user"></i>&nbsp;Nombre de administrador anterior</label>
                               <input type="text" class="form-control" value="<?php echo $reg1['nombre_admin']; ?>" name="old_nom_admin_up" placeholder="Nombre anterior de administrador" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                             </div>
                             <div class="form-group has-success has-feedback">
                               <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nuevo nombre de administrador</label>
                               <input type="text" id="input_user2" class="form-control" name="admin_up" placeholder="Nombre de administrador" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                               <div id="com_form2"></div>
                             </div>
                             <div class="form-group">
                               <label><i class="fa fa-shield"></i>&nbsp;Contraseña anterior</label>
                               <input type="password" class="form-control" name="old_admin_clave_up" placeholder="Contraseña anterior" required="">
                             </div>
                                 <div class="form-group">
                               <label><i class="fa fa-shield"></i>&nbsp;Nueva contraseña</label>
                               <input type="password" class="form-control" name="admin_clave_up" placeholder="Nueva contraseña" required="">
                             </div>
                             <div class="form-group">
                               <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                               <input type="email" class="form-control" value="<?php echo $reg1['email_admin']; ?>" name="admin_email_up"  placeholder="Email administrador" required="">
                             </div><button type="submit" class="btn btn-info">Actualizar datos</button>
                           </form>
                         </div>
                       </div>
                       </div>
                  </div><!--Fin row-->
              </div><!--Fin class col-md-4-->


              
    </div>
  </div>
  <?php  include './inc/footer.php';  ?>
</body>
</html>
  <script>
    function validarArchivos(input) {
        var archivos = input.files;
        var totalSize = 0;

        // Verificar la cantidad máxima de archivos
        if (archivos.length > 3) {
            alert("Por favor, seleccione un máximo de 3 archivos.");
            input.value = ''; // Limpiar la selección
            return;
        }

        // Calcular el tamaño total de los archivos
        for (var i = 0; i < archivos.length; i++) {
            totalSize += archivos[i].size;
        }

        // Verificar el tamaño total de los archivos
        var maxSizeMB = 4; // Tamaño máximo permitido en MB
        var maxSizeBytes = maxSizeMB * 1024 * 1024;
        if (totalSize > maxSizeBytes) {
            alert("El tamaño total de los archivos no debe superar los 4 MB en total.");
            input.value = ''; // Limpiar la selección
            return;
        }
    }

    $(document).ready(function () {
      $("#input_user").keyup(function () {
        $.ajax({
          url: "./process/val.php?id=" + $(this).val(),
          success: function (data) {
            $("#com_form").html(data);
          }
        });
      });
    });
  </script>
  <?php 
  }else{
    header("Location:index.php");
}

?>