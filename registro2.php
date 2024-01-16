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
    $sqlInsert = "INSERT INTO cliente (dni, nombres, a_paterno, a_materno, cargo, email, asunto, descripcion, archivos) 
                  VALUES ('$dni', '$nombresx', '$a_paterno', '$a_materno', '$cargo', '$email', '$asunto', '$descripcion', '$rutasString')";

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





<!DOCTYPE html>
<html>

<head>
  <title>Sistema de Ticket MDMM</title>
  <link rel="shortcut icon" href="img/logomuni.png">
  <?php include "./inc/links.php"; ?>
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <?php // include "./inc/slidebar.php"; ?>


  <div class="container mt-50">

    <div class="d-flex justify-content-center">
      <h4>
        <strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Registrar Ticket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
      </h4>
      <h4>
        <strong><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Consultar Ticket</strong>
      </h4>
    </div>

    <div class="flex h-screen">


        <div class="panel panel-info">
          <div class="panel-heading text-center">
            <div class="d-flex justify-content-center">
              <h3 class="panel-title text-center">
                <strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Registrar Ticket</strong>
              </h3>
            </div>
            
          </div>
          <div class="panel-body">
            <form role="form" action="" method="POST" enctype="multipart/form-data">
            <label><span class=""></span>INFORMACIÓN DEL CONTACTO</label>
              
              <div class= "row d-flex">

                <div class="form-group has-success has-feedback col-sm-3">
                      <label><span class=""></span>DNI</label>
                      <input type="text" class="form-control" name="dni" placeholder="Escribe tu dni" required="" maxlength="9"/>
                </div>
                <div class="form-group col-sm-3">
                  <label><span class="fa fa-male"></span>&nbsp;Nombres</label>
                  <input type="text" class="form-control" name="nombres" placeholder="Escribe tus nombres" required="" />
                </div>
                <div class="form-group col-sm-3">
                  <label><span class=""></span>Apellido Paterno</label>
                  <input type="text" class="form-control" name="a_paterno" placeholder="Escribe tu Apellido Paterno" required="" />
                </div>
                <div class="form-group col-sm-3">
                  <label><span class=""></span>Apellido Materno</label>
                  <input type="text" class="form-control" name="a_materno" placeholder="Escribe tu Apellido Materno" required="" />
                </div>

              </div>

              <div class="row d-flex">

                <div class="form-group col-sm-7">
                  <label><span class=""></span>Cargo</label>
                  <input type="text" class="form-control" name="cargo" placeholder="Escribe el cargo" required="" />
                </div>
                <div class="form-group col-sm-3">
                  <label><span class="fa fa-envelope"></span>&nbsp;Correo Electrónico</label>
                  <input type="email" class="form-control" name="email" placeholder="Escribe tu correo electrónico" required="" />
                </div>

              </div>
             

              <label><span class=""></span>INFORMACIÓN DEL TICKET</label>

              <div class="row d-flex">

                <div class="form-group col-sm-8">
                      <label><span class=""></span>Asunto</label>
                      <input type="text" class="form-control" name="asunto" placeholder="Escribe el asunto" required=""/>
                </div>

              </div>
              
              <div class="form-group">
                    <label><span class=""></span>Descripción del Problema</label>
                    <textarea class="form-control" name="descripcion" rows="4" placeholder="Escribe la descripción del problema" required=""></textarea>
              </div>
               <!-- Texto "Adjuntar archivo (Opcional)" en cursiva -->
               <div class="form-group col-md-12">
                    <label class="font-italic">Adjuntar archivos (Opcional)</label>
                </div>

                <!-- Cuadro de información -->  
                <div class="form-group col-md-12">
                    <div class="alert alert-info">
                        <strong>ℹ Información:</strong> Puede subir hasta 3 archivos (4MB en total).<br>
                        Formatos permitidos: .pdf, .jpeg, .jpg, .png
                    </div>
                </div>

                <!-- Botón para seleccionar archivos con evento onchange para validación -->
                <div class="form-group col-md-12">
                    <label><span class=""></span>Seleccionar Archivos</label>
                    <input type="file" class="form-control-file" name="archivos[]" accept=".pdf, .jpeg, .jpg, .png" multiple onchange="validarArchivos(this)" />
                </div>
              <button type="submit" class="btn btn-danger">Crear cuenta</button>
            </form>
          </    div>
        </div>
      
    </div>
  </div>
  <?php    ?>
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

    $(document).ready(function() {
      // Establecer inicialmente el primer elemento como coloreado
      $('.panel-title[data-ticket="1"]').addClass('colored');

      $('.panel-title').click(function() {
        var ticketNumber = $(this).data('ticket');
        $('.panel-title').removeClass('colored grayed');

        // Simular una solicitud AJAX, puedes ajustar esto según tus necesidades reales
        $.ajax({
          url: 'tu_servidor/tu_script.php',
          type: 'POST',
          data: { ticket: ticketNumber },
          success: function(response) {
            // Manejar la respuesta del servidor (si es necesario)
          },
          error: function(error) {
            console.log(error);
          }
        });

        // Establecer el elemento clicado como coloreado
        $(this).addClass('colored');
        // Establecer el otro elemento como gris
        $('.panel-title[data-ticket="' + (3 - ticketNumber) + '"]').addClass('grayed');
      });
    });
  </script>
  <?php 
  
?>