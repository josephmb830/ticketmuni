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

?>

<?php
    if(isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['descripcion'])){
        $dni=MysqlQuery::RequestPost('dni');
        $nombresx=MysqlQuery::RequestPost('nombres');
        $a_paterno=MysqlQuery::RequestPost('a_paterno');
        $a_materno=MysqlQuery::RequestPost('a_materno');
        $cargo=MysqlQuery::RequestPost('cargo');
        $email=MysqlQuery::RequestPost('email');
        $asunto=MysqlQuery::RequestPost('asunto');
        $descripcion=MysqlQuery::RequestPost('descripcion');
        
        $rutasGuardadasEnBD = array();

    // Obtener la información de los archivos
    $archivos = $_FILES['archivos'];
    

    if (isset($archivos['name']) && !is_array($archivos['name'])) {
        // Procesar y guardar el archivo único en el servidor
        $rutaArchivos = "./storage/";

        $nombreArchivo = $archivos['name'];
        $rutaGuardadaEnServidor = $rutaArchivos . $nombreArchivo;

        // Mueve el archivo desde la ubicación temporal a la carpeta deseada
        if (move_uploaded_file($archivos['tmp_name'], $rutaGuardadaEnServidor)) {
            $rutasGuardadasEnBD[] = $rutaGuardadaEnServidor;
        } else {
            // Manejar el caso en que haya un error al mover el archivo
            echo "Error al mover el archivo: $nombreArchivo. Detalles: " . error_get_last()['message'];
        }
    } elseif (isset($archivos['name']) && is_array($archivos['name'])) {
        // Procesar y guardar los archivos múltiples en el servidor
        $rutaArchivos = "./storage/";

        for ($i = 0; $i < count($archivos['name']); $i++) {
            $nombreArchivo = $archivos['name'][$i];
            $rutaGuardadaEnServidor = $rutaArchivos . $nombreArchivo;

            // Mueve el archivo desde la ubicación temporal a la carpeta deseada
            if (move_uploaded_file($archivos['tmp_name'][$i], $rutaGuardadaEnServidor)) {
                $rutasGuardadasEnBD[] = $rutaGuardadaEnServidor;
            } else {
                // Manejar el caso en que haya un error al mover el archivo
                echo "Error al mover el archivo: $nombreArchivo. Detalles: " . error_get_last()['message'];
            }
        }
    } else {
        // Imprimir $archivos en el bloque else
        echo '<pre>';
        var_dump($archivos);
        echo '</pre>';
        // o
        // print_r($archivos);
        // Manejar el caso en que $archivos no es un array
    }

    // Continuar con el resto del código

    // Convertir el array de rutas en una cadena para almacenar en la base de datos
    $rutasString = implode(',', $rutasGuardadasEnBD);

    // Verificar si la conexión a la base de datos se estableció correctamente
    if (!$conexion) {
        die("Error en la conexión a la base de datos: " . mysqli_connect_error());
    }

    // Consulta SQL para insertar datos en la tabla cliente
    $sqlInsert = "INSERT INTO cliente (dni, nombre_usuario, a_paterno, a_materno, cargo, email_cliente) 
                  VALUES ('$dni', '$nombresx', '$a_paterno', '$a_materno', '$cargo', '$email')";

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conexion, $sqlInsert);

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