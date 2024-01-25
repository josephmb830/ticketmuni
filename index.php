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

<?php
    if( isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['descripcion'])){

        /*Este codigo nos servira para generar un numero diferente para cada ticket*/
        $codigo = ""; 
        $longitud = 2; 
        for ($i=1; $i<=$longitud; $i++){ 
          $numero = rand(0,9); 
          $codigo .= $numero; 
        } 
        $num=Mysql::consulta("SELECT * FROM ticket");
        $numero_filas = mysqli_num_rows($num);

        $numero_filas_total=$numero_filas+1;
        $id_ticket="TK".$codigo."N".$numero_filas_total;
        /*Fin codigo numero de ticket*/

        $usuario=MysqlQuery::RequestPost('nombre_usuario_nuevo');
        $fecha_ticket=MysqlQuery::RequestPost('fecha_ticket');
        $dni=MysqlQuery::RequestPost('dni');
        $nombresx=MysqlQuery::RequestPost('nombres');
        $a_paterno=MysqlQuery::RequestPost('a_paterno');
        $a_materno=MysqlQuery::RequestPost('a_materno');
        $cargo=MysqlQuery::RequestPost('cargo');
        $area_ticket=  MysqlQuery::RequestPost('area_ticket');
        $email=MysqlQuery::RequestPost('email');
        $departamento_ticket=MysqlQuery::RequestPost('departamento_ticket');
        $asunto=MysqlQuery::RequestPost('asunto');
        $descripcion=MysqlQuery::RequestPost('descripcion');
        $estado_ticket="Pendiente";
        
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
    $sqlInsert = "INSERT INTO ticket (nombre_usuario, fecha, serie, dni, nombres, a_paterno, a_materno, cargo, area, email_cliente, departamento, asunto, mensaje, archivos, estado_ticket) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $sqlInsert);

    if ($stmt) {
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "sssssssssssssss", $usuario, $fecha_ticket, $id_ticket, $dni, $nombresx, $a_paterno, $a_materno, $cargo, $area_ticket, $email, $departamento_ticket, $asunto, $descripcion, $rutasString, $estado_ticket);

        // Ejecutar la consulta preparada
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            echo "Datos insertados exitosamente en la base de datos. Consulte el estado de su ticket con su número de serie: $id_ticket ";
        } else {
            echo "Error al insertar datos en la base de datos: " . mysqli_stmt_error($stmt);
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conexion);
    }
}
?>


<?php

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_usuario_existente'])) {

    // Obtén los datos del formulario
    $nombreUsuario = $_POST['nombre_usuario_existente'];

    // Consulta para verificar si el usuario ya existe
    $sql = "SELECT * FROM cliente WHERE nombre_usuario = '$nombreUsuario'";
    $resultado = $conexion->query($sql);

    // Verifica si se encontró algún resultado
    if ($resultado->num_rows > 0) {
        // El usuario ya existe, puedes obtener los datos de contacto
        while ($fila = $resultado->fetch_assoc()) {
            $dni = $fila['dni'];
            $nombres = $fila['nombres'];
            $apellidoPaterno = $fila['a_paterno'];
            $apellidoMaterno = $fila['a_materno'];
            $cargo = $fila['cargo'];
            $area = $fila['area'];
            $email = $fila['email_cliente'];

            // Ahora puedes utilizar estos datos según tus necesidades
            // Por ejemplo, imprimirlos o almacenarlos en variables para su posterior uso
            echo "Datos del usuario existente:<br>";
            echo "DNI: $dni<br>";
            echo "Nombres: $nombres<br>";
            echo "Email: $email<br>";
            // ... Continúa con los demás datos
        }
    } else {
        // El usuario no existe, puedes continuar con el proceso de abrir un nuevo ticket
        // Aquí deberías agregar el código necesario para insertar los datos del nuevo ticket en la base de datos
        echo "Usuario no encontrado. Puedes continuar con el proceso de abrir un nuevo ticket.";
    }

} else {
    // Si el formulario no ha sido enviado, muestra un mensaje o realiza alguna acción
    echo "Formulario no enviado. Puedes continuar con el proceso de abrir un nuevo ticket.";
}

// Cierra la conexión a la base de datos
$conexion->close();

?>




<!DOCTYPE html>
<html>

<head>
  <title>Sistema de Ticket MDMM</title>
  <link rel="shortcut icon" href="img/logomuni.png">
  <?php include "./inc/links.php"; ?>
  
  <style>
  .colored{
    color: blue;
  }
  .grayed{
    color: brown;
  }
  </style>
</head>

<body>
  


  <div class="container mt-50">
    

    <div class="d-flex justify-content-center">
      <h4 class="panel-title colored" data-ticket="1" onclick="changeStyle(this)">
        <strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Registrar Ticket&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
      </h4>
      <h4 class="panel-title grayed" data-ticket="2" onclick="changeStyle(this)">
        <strong><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Consultar Ticket</strong>
      </h4>
    </div>

    
    <div class="row d-flex" style="margin: 10px;">
    <!-- Contenido de tu div aquí -->
    </div>



   
      







    <div id="viewTicket" class="ticket-section none">
        <?php include "./user/consulta-view.php"; ?>
    </div>

    
    <div id="newTicket" class="ticket-section flex h-screen">


    <div class="row" style="margin-right: 10px;">
            <div class="col-sm-12">
              <div class="panel panel-success">
              <div class="panel-heading text-center"><i class="fa fa-plus"></i>&nbsp;<strong>Consultar Datos de Usuario</strong></div>
              <div class="panel-body">
                    <form role="form" action="" method="post">
                    
                    <div class="form-group has-success has-feedback">
                      <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de usuario</label>
                      <input type="text" id="input_user" class="form-control" name="nombre_usuario_existente" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                      <div id="com_form"></div>
                    </div>
                    
                    
                    <div class="col-md-6">
                    <center><button type="submit" class="btn btn-success">Consultar datos</button></center>
                    </div>             
                              </form>  
                
              </div>
            </div>
          </div>
        </div>


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

          <fieldset>

              <label><span class=""></span>INFORMACIÓN DEL USUARIO</label>

              

              <div class= "row d-flex">

                <div class="form-group has-success has-feedback col-sm-3">
                  <label class="control-label"><i class="fa fa-user"></i>&nbsp;Usuario</label>
                  <input type="text" id="input_user" class="form-control" name="nombre_usuario_nuevo" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                  <div id="com_form"></div>
                </div>


                <div class="form-group col-sm-5">
                    <label class="control-label">Fecha</label>
                    <div class=''>
                        <div class="input-group">
                            <input class="form-control" type="text" id="fechainput" placeholder="Fecha" name="fecha_ticket"  required=""   value ="<?php echo $hoy ?>" readonly>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                  
                </div>  

              </div>

            
              
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

                <div class="form-group col-sm-5">
                  <label><span class=""></span>Cargo</label>
                  <input type="text" class="form-control" name="cargo" placeholder="Escribe el cargo" required="" />
                </div>

                <div class="form-group col-sm-4">
                  <label  class="control-label">Area</label>
                  <div class="">
                      <div class='input-group'>
                      <input type="text" class="form-control" placeholder="Area" required="" pattern="[a-zA-Z ]{1,30}" name="area_ticket" title="Area" value="<?php echo $area_cli ?>" readonly>
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      </div>
                  </div>
                </div>

                <div class="form-group col-sm-3">
                  <label><span class="fa fa-envelope"></span>&nbsp;Correo Electrónico</label>
                  <input type="email" class="form-control" name="email" placeholder="Escribe tu correo electrónico" required="" />
                </div>

              </div>
             

              <label><span class=""></span>INFORMACIÓN DEL TICKET</label>

              <div class="row d-flex">
                <div class="form-group col-sm-8">
                  <label  class="control-label">Tipo de Insidente</label>
                  <div class="">
                      <div class='input-group'>
                        <select class="form-control" name="departamento_ticket">
                        <option value="Escoja una opcion">Escoja una opcion</option>
                          <option value="Mantenimiento preventivo">Mantenimiento preventivo</option>
                          <option value="Mantenimiento correctivo">Mantenimiento correctivo</option>
                          <option value="Instalacion de accesorios">Instalacion de accesorios</option>
                          <option value="Instalacion de equipo">Instalacion de equipo</option>
                          <option value="Instalacion de red">Instalacion de red</option>
                          <option value="Configuracion de equipo">Configuracion de equipo</option>
                          <option value="Configuracion de servicio de red">Configuracion de servicio de red</option>
                          <option value="Instalacicion, mantenimiento y actualizacion de software">Instalacicion, mantenimiento y actualizacion de software</option>
                          <option value="Clave de usuario">Clave de usuario</option>
                          <option value="Otros">Otros</option>




                        </select>
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      </div> 
                  </div>
                </div>
              </div>


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
              <button type="submit" class="btn btn-danger">Abrir Ticket</button>
              </fieldset>
            </form>
          </div>
        </div>
      
    </div>
  </div>


  
<!-- Antes consulta ticket section -->

        



  <?php    ?>                

</body>
</html>
  <script  type="text/javascript">
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

    function changeStyle(element) {
    var ticketNumber = element.getAttribute('data-ticket');
    var elements = document.querySelectorAll('.panel-title');
    
    elements.forEach(function(el) {
      el.classList.remove('colored', 'grayed');
    });
    
    element.classList.add('colored');
    var otherElement = document.querySelector('.panel-title[data-ticket="' + (3 - ticketNumber) + '"]');
    if (otherElement) {
      otherElement.classList.add('grayed');
    }

    // Mostrar/Ocultar secciones según el ticket seleccionado
    if (ticketNumber === '1') {
      showSection('newTicket');
      hideSection('viewTicket');
    } else if (ticketNumber === '2') {
      showSection('viewTicket');
      hideSection('newTicket');
    }
  }

  function showSection(sectionId) {
  document.getElementById(sectionId).classList.remove('none');
}

function hideSection(sectionId) {
  document.getElementById(sectionId).classList.add('none');
}


$(document).ready(function(){
      $("#fechainput").datepicker();
  });


  </script>
  <?php 
  
?>