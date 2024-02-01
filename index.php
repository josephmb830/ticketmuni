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
    $rutasString = implode(',', $rutasGuardadasEnBD); }





// Verifica la conexión
if ($conexion->connect_error) {
  die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Inicializa $datosUsuario con valor predeterminado null
$datosCliente = null;
$datosAdmin = null;

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_usuario_existente'])) {

  // Obtén los datos del formulario
  $nombreUsuario = $_POST['nombre_usuario_existente'];

  // Consulta para verificar si el usuario ya existe
  $sql_cliente = "SELECT * FROM cliente WHERE nombre_usuario = '$nombreUsuario'";
  $resultado_cliente = $conexion->query($sql_cliente);

  $sql_administrador = "SELECT * FROM administrador WHERE nombre_admin = '$nombreUsuario'";
  $resultado_administrador = $conexion->query($sql_administrador);

  // Verifica si se encontró algún resultado
  if ($resultado_cliente->num_rows > 0) {
      // El usuario ya existe, puedes obtener los datos de contacto
      $fila = $resultado_cliente->fetch_assoc();
      $_SESSION['datos_cliente'] = $fila; // Almacena los datos del usuario en la sesión
      $datosCliente = $fila; // Asigna los datos del usuario a $datosUsuario
  } elseif ($resultado_administrador->num_rows > 0) {
      // El administrador ya existe, puedes obtener los datos de contacto
      $fila = $resultado_administrador->fetch_assoc();
      $_SESSION['datos_admin'] = $fila; // Almacena los datos del usuario en la sesión
      $datosAdmin = $fila; // Asigna los datos del usuario a $datosUsuario
  } else {
      // El usuario no existe, puedes continuar con el proceso de abrir un nuevo ticket
      // Aquí deberías agregar el código necesario para insertar los datos del nuevo ticket en la base de datos
      echo "Usuario no encontrado. Puedes continuar con el proceso de abrir un nuevo ticket.";
  }

} else {
  // Si el formulario no ha sido enviado, muestra un mensaje o realiza alguna acción
  echo "Formulario no enviado. Puedes autorellenar tus datos consultando tu usuario o abrir un nuevo registro.";
}

// Cierra la conexión a la base de datos
//$conexion->close();




// Verifica la conexión
if ($conexion->connect_error) {
  die("Error de conexión a la base de datos: " . $conexion->connect_error);
}



// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre_usuario_nuevo'])) {

  // Obtén los datos del formulario
  $nombreUsuario = $_POST['nombre_usuario_nuevo'];

  // Consulta para verificar si el usuario ya existe
  $sql_cliente = "SELECT * FROM cliente WHERE nombre_usuario = '$nombreUsuario'";
  $resultado_cliente = $conexion->query($sql_cliente);

  $sql_administrador = "SELECT * FROM administrador WHERE nombre_admin = '$nombreUsuario'";
  $resultado_administrador = $conexion->query($sql_administrador);

  // Verifica si se encontró algún resultado
  if ($resultado_cliente->num_rows > 0) {
      // El usuario ya existe, puedes obtener los datos de contacto
      $fila = $resultado_cliente->fetch_assoc();
      $_SESSION['datos_cliente'] = $fila; // Almacena los datos del usuario en la sesión
      $datosCliente = $fila; // Asigna los datos del usuario a $datosUsuario
  } elseif ($resultado_administrador->num_rows > 0) {
      // El administrador ya existe, puedes obtener los datos de contacto
      $fila = $resultado_administrador->fetch_assoc();
      $_SESSION['datos_admin'] = $fila; // Almacena los datos del usuario en la sesión
      $datosAdmin = $fila; // Asigna los datos del usuario a $datosUsuario
  } else {
      // El usuario no existe, puedes continuar con el proceso de abrir un nuevo ticket
      // Aquí deberías agregar el código necesario para insertar los datos del nuevo ticket en la base de datos
      echo "Usuario no encontrado. Puedes continuar con el proceso de abrir un nuevo ticket.";
  }

} else {
  // Si el formulario no ha sido enviado, muestra un mensaje o realiza alguna acción
  echo "Formulario no enviado. Puedes autorellenar tus datos consultando tu usuario o abrir un nuevo registro.";
}

// Cierra la conexión a la base de datos
// $conexion->close();





    // Verificar si la conexión a la base de datos se estableció correctamente
if (!$conexion) {
  die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

if (($datosCliente === null && $datosAdmin === null) && ( isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['descripcion']))){
  // Datos para la tabla cliente
  $sqlInsertCliente = "INSERT INTO cliente (nombre_usuario, dni, nombres, a_paterno, a_materno, cargo, area, email_cliente) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  // Datos para la tabla ticket
  $sqlInsertTicket = "INSERT INTO ticket (id_cliente, fecha, serie, departamento, asunto, mensaje, archivos, estado_ticket) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  // Preparar la consulta statement para cliente
  $stmtCliente = mysqli_prepare($conexion, $sqlInsertCliente);

  // Preparar la consulta statement para ticket
  $stmtTicket = mysqli_prepare($conexion, $sqlInsertTicket);

      if ($stmtCliente && $stmtTicket) {
          // Vincular los parámetros para la tabla cliente
          mysqli_stmt_bind_param($stmtCliente, "ssssssss", $usuario, $dni, $nombresx, $a_paterno, $a_materno, $cargo, $area_ticket, $email);

          // Ejecutar la consulta preparada para la tabla cliente
          $resultadoCliente = mysqli_stmt_execute($stmtCliente);

          // Obtener el id_cliente generado por la inserción anterior
          $id_cliente = mysqli_insert_id($conexion);

          // Vincular los parámetros para la tabla ticket
          mysqli_stmt_bind_param($stmtTicket, "isssssss", $id_cliente, $fecha_ticket, $id_ticket, $departamento_ticket, $asunto, $descripcion, $rutasString, $estado_ticket);

          // Ejecutar la consulta preparada para la tabla ticket
          $resultadoTicket = mysqli_stmt_execute($stmtTicket);

          // Verificar si ambas inserciones fueron exitosas
          if ($resultadoCliente && $resultadoTicket) {
              echo "Datos insertados exitosamente en las tablas cliente y ticket. Consulte el estado de su ticket con su número de serie: $id_ticket";
          } else {
              echo "Error al insertar datos en la base de datos: " . mysqli_stmt_error($stmtCliente) . " - " . mysqli_stmt_error($stmtTicket);
          }

          // Cerrar las consultas preparadas
          mysqli_stmt_close($stmtCliente);
          mysqli_stmt_close($stmtTicket);
      } else {
          echo "Error al preparar las consultas: " . mysqli_error($conexion);
      }
} elseif (($datosCliente !== null || $datosAdmin !== null) && ( isset($_POST['dni']) && isset($_POST['email']) && isset($_POST['descripcion']))) {
    // Datos para la tabla ticket
    $sqlInsertTicket = "INSERT INTO ticket (id_cliente, fecha, serie, departamento, asunto, mensaje, archivos, estado_ticket) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta statement para ticket
    $stmtTicket = mysqli_prepare($conexion, $sqlInsertTicket);

    if ($stmtTicket) {
        // Obtener el id_cliente buscado en los datos del cliente
        $id_cliente = $datosCliente['id_cliente'];

        // Vincular los parámetros para la tabla ticket
        mysqli_stmt_bind_param($stmtTicket, "isssssss", $id_cliente, $fecha_ticket, $id_ticket, $departamento_ticket, $asunto, $descripcion, $rutasString, $estado_ticket);

        // Ejecutar la consulta preparada para la tabla ticket
        $resultadoTicket = mysqli_stmt_execute($stmtTicket);

        // Verificar si la inserción fue exitosa
        if ($resultadoTicket) {
            echo "Datos insertados exitosamente en la tabla ticket. Consulte el estado de su ticket con su número de serie: $id_ticket";
        } else {
            echo "Error al insertar datos en la base de datos: " . mysqli_stmt_error($stmtTicket);
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmtTicket);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conexion);
    }
} else {
  echo "Datos de usuario no proporcionados o datos de administrador encontrados. No se pueden realizar las inserciones.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>



<?php



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

    
    <div class="row d-flex" style="margin: 30px;">
    <!-- Contenido de tu div aquí -->
    </div>



   
      







    <div id="viewTicket" class="ticket-section none">
        <?php include "./user/consulta-view.php"; ?>
    </div>

    
    <div id="newTicket" class="ticket-section flex h-screen">

    <!-- formulario 1 -->
    <div id="formulario1" class="row" style="margin-right: 10px;">
            <div class="col-sm-12">
              <div class="panel panel-success">
              <div class="panel-heading text-center"><i class="fa fa-plus"></i>&nbsp;<strong>Autorellenar Datos</strong></div>
              <div class="panel-body">
                    <form role="form" action="" method="post">
                    
                    <div class="form-group has-success has-feedback">
                      <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nombre de usuario</label>
                      <input type="text" id="input_user_old" class="form-control" name="nombre_usuario_existente" placeholder="Nombre de usuario" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                      <div id="com_form"></div>
                    </div>
                    
                    
                    <div class="col-md-6">
                    <center><button type="submit" id="ingresoButton" class="btn btn-success">Ingresar</button></center>
                    <center><button type="button" id="registroButton" class="btn btn-success">Registrarse</button></center>
                    </div>             
                              </form>  
                
              </div>
            </div>
          </div>
        </div>

        <!-- formulario 2 -->
        <div id="formulario2" class="panel panel-info" style="display: block;">
          <div class="panel-heading text-center">
            <div class="d-flex justify-content-center">
              <h3 class="panel-title text-center">
                <strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Registrar Ticket</strong>
              </h3>
            </div>
            
          </div>
          <div class="panel-body">


          <?php
          // Verifica si la variable de sesión está definida y no es nula y prepara la vista formulario2
            if (isset($_SESSION['datos_admin']) && $_SESSION['datos_admin'] !== null) {
              $datosAdmin = $_SESSION['datos_admin'];
              // Muestra los datos del administrador
              echo "Datos del administrador existente:<br>";
              ?>
              <script>
                  document.getElementById("formulario1").style.display = "none";
                  document.getElementById("formulario2").style.display = "block";
              </script>
          <?php

              // ... Continúa con los demás datos del formulario
            } elseif (isset($_SESSION['datos_cliente']) && $_SESSION['datos_cliente'] !== null) {
              $datosCliente = $_SESSION['datos_cliente'];
              // Muestra los datos del usuario
              echo "Datos del usuario existente:<br>";
              //echo "DNI: " . $datosUsuario['dni'] . "<br>";
              ?>
              <script>
                  document.getElementById("formulario1").style.display = "none";
                  document.getElementById("formulario2").style.display = "block";
              </script>
          <?php
            } else {
              // Si la variable de sesión no está definida o es nula, muestra un mensaje o realiza alguna acción
              echo "No se han encontrado datos de usuario. Puedes continuar llenando el formulario.";
            }
          ?>
          

          <form role="form" action="" method="POST" enctype="multipart/form-data">

          <fieldset>

              <label><span class=""></span>INFORMACIÓN DEL USUARIO</label>

              
              <!-- Rellenar los campos con los datos del usuario -->
              <div class= "row d-flex">

                <div class="form-group has-success has-feedback col-sm-3">
                  <label class="control-label"><i class="fa fa-user"></i>&nbsp;Usuario</label>
                  <input type="text" id="input_user_new" class="form-control" name="nombre_usuario_nuevo" placeholder="Nombre de usuario" required="" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 máximo 15 caracteres" maxlength="15" 
                    <?php if ($datosCliente): ?>
                        value="<?php echo $datosCliente['nombre_usuario']; ?>" 
                    <?php elseif ($datosAdmin): ?>
                        value="<?php echo $datosAdmin['nombre_admin']; ?>" 
                    <?php else: ?>
                        value=""
                    <?php endif; ?>
                        readonly/> 
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
                      <input type="text" class="form-control" id="dni" name="dni" placeholder="Escribe tu dni" required="" maxlength="9" 
                      <?php if ($datosCliente): ?>
                          value="<?php echo $datosCliente['dni']; ?>"
                      <?php elseif ($datosAdmin): ?>
                          value="<?php echo $datosAdmin['id_admin']; ?>"
                      <?php else: ?>    
                          value=""
                      <?php endif; ?>
                          readonly/>
                </div>
                <div class="form-group col-sm-3">
                  <label><span class="fa fa-male"></span>&nbsp;Nombres</label>
                  <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escribe tus nombres" required="" 
                  <?php if ($datosCliente): ?>
                      value="<?php echo $datosCliente['nombres']; ?>"
                  <?php elseif ($datosAdmin): ?>
                      value="<?php echo $datosAdmin['nombre_completo']; ?>"
                  <?php else: ?>
                      value=""
                  <?php endif; ?>
                      readonly/>
                </div>
                <div class="form-group col-sm-3">
                  <label><span class=""></span>Apellido Paterno</label>
                  <input type="text" class="form-control" id="a_paterno" name="a_paterno" placeholder="Escribe tu Apellido Paterno" required="" 
                  <?php if ($datosCliente): ?>
                      value="<?php echo $datosCliente['a_paterno']; ?>"
                  <?php elseif ($datosAdmin): ?>
                      value="<?php echo $datosAdmin['nombre_completo']; ?>"
                  <?php else: ?>
                      value=""
                  <?php endif; ?>
                      readonly/>
                </div>
                <div class="form-group col-sm-3">
                  <label><span class=""></span>Apellido Materno</label>
                  <input type="text" class="form-control" id="a_materno" name="a_materno" placeholder="Escribe tu Apellido Materno" required="" 
                  <?php if ($datosCliente): ?>
                      value="<?php echo $datosCliente['a_materno']; ?>"
                  <?php elseif ($datosAdmin): ?>
                      value="<?php echo $datosAdmin['nombre_completo']; ?>"
                  <?php else: ?>
                      value=""
                  <?php endif; ?>
                      readonly/>
                </div>

              </div>

              <div class="row d-flex">

                <div class="form-group col-sm-5">
                  <label><span class=""></span>Cargo</label>
                  <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Escribe el cargo" required="" 
                  <?php if ($datosCliente): ?>
                      value="<?php echo $datosCliente['cargo']; ?>"
                  <?php elseif ($datosAdmin): ?>
                      value="<?php echo $datosAdmin['cargo']; ?>"
                  <?php else: ?>
                      value=""
                  <?php endif; ?>
                      readonly/>
                </div>

                <div class="form-group col-sm-4">
                  <label  class="control-label">Area</label>
                  <div class="">
                    <div class='input-group'>
                    <input type="text" class="form-control" placeholder="Area" required="" pattern="[a-zA-Z ]{1,30}" id="area" name="area_ticket" title="Area" 
                    <?php if ($datosCliente): ?>
                        value="<?php echo $datosCliente['area']; ?>" 
                    <?php elseif ($datosAdmin): ?>
                        value="<?php echo $datosAdmin['cargo']; ?>" 
                    <?php else: ?>
                        value=""
                    <?php endif; ?>
                        readonly/>
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    </div>
                  </div>
                </div>

                <div class="form-group col-sm-3">
                  <label><span class="fa fa-envelope"></span>&nbsp;Correo Electrónico</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Escribe tu correo electrónico" required="" 
                  <?php if ($datosCliente): ?>
                      value="<?php echo $datosCliente['email_cliente']; ?>"
                  <?php elseif ($datosAdmin): ?>
                      value="<?php echo $datosAdmin['email_admin']; ?>"
                  <?php else: ?>
                      value=""
                  <?php endif; ?>
                      readonly/>
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
              <button type="button" id="volverButton" class="btn btn-danger">Volver</button>
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


// función para limpiar inputs y quitar atributos readonly para nuevo registro y funcion para mostrar y ocultar form 1 y 2 fusionado
document.addEventListener("DOMContentLoaded", function () {
    var registroButton = document.getElementById("registroButton");
    var volverButton = document.getElementById("volverButton");

    registroButton.addEventListener("click", function (event) {
        event.preventDefault();
        var inputUserOldValue = document.getElementById("input_user_old").value;
        document.getElementById("input_user_new").value = inputUserOldValue;
        document.getElementById("input_user_new").removeAttribute("readonly");
        document.getElementById("input_user_old").value = "";

        document.getElementById("dni").value = "";
        document.getElementById("dni").removeAttribute("readonly");
        document.getElementById("nombres").value = "";
        document.getElementById("nombres").removeAttribute("readonly");
        document.getElementById("a_paterno").value = "";
        document.getElementById("a_paterno").removeAttribute("readonly");
        document.getElementById("a_materno").value = "";
        document.getElementById("a_materno").removeAttribute("readonly");
        document.getElementById("cargo").value = "";
        document.getElementById("cargo").removeAttribute("readonly");
        document.getElementById("area").value = "";
        document.getElementById("area").removeAttribute("readonly");
        document.getElementById("email").value = "";
        document.getElementById("email").removeAttribute("readonly");

        setTimeout(function () {
            mostrarFormulario2();
        }, 50);
    });

    volverButton.addEventListener("click", function (event) {
        event.preventDefault();
        mostrarFormulario1();
    });

    function mostrarFormulario2() {
        document.getElementById("formulario1").style.display = "none";
        document.getElementById("formulario2").style.display = "block";
    }

    function mostrarFormulario1() {
        document.getElementById("formulario1").style.display = "block";
        document.getElementById("formulario2").style.display = "none";
    }
});


  </script>
  <?php 
  
?>