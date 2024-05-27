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
        $pass_save=md5(MysqlQuery::RequestPost('clave_reg'));
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
    $sqlInsert = "INSERT INTO cliente (dni, nombre_usuario, clave, nombres, a_paterno, a_materno, cargo, area, email_cliente) 
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
            <form role="form" action="" method="POST" enctype="multipart/form-data">
            <label><span class=""></span>INFORMACIÓN DEL CONTACTO</label>
              
          
              <div class="form-group has-success has-feedback">
                    <label><span class=""></span>DNI</label>
                    <input type="text" class="form-control" name="dni" placeholder="Escribe tu dni" required="" maxlength="9"/>
              </div>
              <div class="form-group">
                <label><span class="fa fa-male"></span>&nbsp;Nombre de usuario</label>
                <input type="text" class="form-control" name="nombre_usuario" placeholder="Escribe tu nombre de usuario" required="" title="Solo es validos letras y numeros no caracteres especiales" maxlength="20" pattern="[a-zA-Z0-9 ]{1,30}" />
              </div>
              <div class="form-group">
                <label><i class="fa fa-shield"></i>&nbsp;Contraseña</label>
                <input type="password" class="form-control" name="clave_reg" placeholder="Contraseña" required="">
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
                <input type="text" class="form-control" name="area" placeholder="Escribe el area" required="" value="Informática" readonly="readonly"/>
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