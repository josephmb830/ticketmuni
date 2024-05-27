<?php if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])){
        date_default_timezone_set('America/Bogota');    
        $nombre = $_SESSION['nombre_completo'];
        $email =    $_SESSION['email'];
        $id =    $_SESSION['id'];
        $dni =    $_SESSION['dni'];
        $cargo = $_SESSION['cargo'];
        if(isset($_SESSION['area'])){
          $area_cli=$_SESSION['area'];
        }else{
          $area_cli="Informatica";
        }
        // $area_cli = $_SESSION['area'];
       
        
        $hoy = date('d/m/Y   h:i:s  a', TIME());

        if(isset($_POST['fecha_ticket']) && isset($_POST['name_ticket']) && isset($_POST['email_ticket'])){
          try{

          
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

          $fecha_ticket=  MysqlQuery::RequestPost('fecha_ticket');
          $nombre_ticket=  MysqlQuery::RequestPost('name_ticket');
          $email_ticket= MysqlQuery::RequestPost('email_ticket');
          $departamento_ticket= MysqlQuery::RequestPost('departamento_ticket');
          $asunto_ticket= MysqlQuery::RequestPost('asunto_ticket');        
          $mensaje_ticket=  MysqlQuery::RequestPost('mensaje_ticket');
          $estado_ticket="Pendiente";

          $area_ticket=  MysqlQuery::RequestPost('area_ticket');

          //correo
          $cabecera="From: Municipalidad de magdalenar<prueba@gmail.com>";
          $mensaje_mail="¡Gracias por reportarnos su problema! Buscaremos una solución para su producto lo mas pronto posible. Su ID ticket es: ".$id_ticket;
          $mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");

          // Datos del ticket
          if ($_SESSION['tipo'] == "admin") {
            $id_x = 'id_admin';
          } elseif ($_SESSION['tipo'] == "user") {
              $id_x = 'id_cliente';
          } elseif ($_SESSION['tipo'] == "tecnico") {
            $id_x = 'id_tecnico';
        }
          $hoy = date_create();
          $hoy = date_timestamp_get($hoy);
          $campos_ticket = "$id_x, departamento, asunto, mensaje, estado_ticket, area, serie";
          $valores_ticket = "'$id', '$departamento_ticket', '$asunto_ticket', '$mensaje_ticket', '$estado_ticket', '$area_ticket', '$id_ticket'";

          // Guardar el ticket en la base de datos
          if (MysqlQuery::Guardar("ticket", $campos_ticket, $valores_ticket)) {

              // Enviar correo con los datos del ticket
              // mail($email_ticket, $asunto_ticket, $mensaje_mail, $cabecera);

              // Mensaje de éxito
              echo '
                  <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4 class="text-center">TICKET CREADO</h4>
                      <p class="text-center">
                          Ticket creado con éxito ' . $_SESSION['nombre'] . '<br>El TICKET ID es: <strong>' . $id_ticket . '</strong>
                      </p>
                  </div>
              ';

          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido crear el ticket. Por favor intente nuevamente.
                    </p>
                </div>
            ';
          }
        }catch(Exception $e){
          echo var_dump($e);
        }
        }
?>
        <div class="w-full">
          <div class="flex-ticket">
            <div class="col-sm-12">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Ticket</strong></h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form class="form-horizontal" id="miFormulario" role="form" action="" method="post">
                          <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="fechainput" placeholder="Fecha" name="fecha_ticket"  required   value ="<?php echo $hoy ?>" readonly>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">DNI</label>
                              <div class="col-sm-10">
                                  <div class='input-group'>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="Escribe tu dni" required="" maxlength="9" 
                                        value="<?php echo $dni ?>"
                                        readonly/>
                                    <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                                  </div>
                              </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Nombre</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" placeholder="Nombre" required="" pattern="[a-zA-Z ]{1,30}" name="name_ticket" title="Nombre Apellido" value="<?php echo $nombre ?>" readonly>
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              </div>
                          </div>
                        </div>
                    
                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email_ticket" required="" title="Ejemplo@dominio.com"value="<?php echo $email ?>" readonly>
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                              </div> 
                          </div>
                        </div>


                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Cargo</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                              <input type="text" class="form-control" placeholder="Cargo" required="" pattern="[a-zA-Z ]{1,30}" name="cargo_ticket" title="Cargo" value="<?php echo $cargo ?>" readonly>
                                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                              </div>
                          </div>
                        </div>


                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Area</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                              <select name="area" id="" class="form-control" placeholder="">
                                <option value="">Escoja un área</option>
                                <option value="Procaduría Pública Municipal">Procaduría Pública Municipal</option>
                                <option value="Concejo municipal">Concejo municipal</option>
                                <option value="Órgano de control institucional">Órgano de control institucional</option>
                                <option value="Comisión de regidores">Comisión de regidores</option>
                                <option value="Alcaldía">Alcaldía</option>
                                <option value="Concejo de Coordinación local">Concejo de Coordinación local</option>
                                <option value="Junta de Delegados Vecinales">Junta de Delegados Vecinales</option>
                                <option value="Gerencia Municipal">Gerencia Municipal</option>
                                <option value="Secretaría General">Secretaría General</option>
                                <option value="Oficina de Atención al Ciudadano y Gestión Documentaria">Oficina de Atención al Ciudadano y Gestión Documentaria</option>
                                <option value="Oficina de Estado Civil">"Oficina de Estado Civil</option>
                                <option value="Oficina General de Participación Vecinal">Oficina General de Participación Vecinal</option>
                                <option value="Oficina General de Comunicaciones">Oficina General de Comunicaciones</option>
                                <option value="Oficina General de Administración">Oficina General de Administración</option>
                                <option value="Oficina de Tesorería">Oficina de Tesorería</option>
                                <option value="Oficina de Gestión de Recursos Humanos">Oficina de Gestión de Recursos Humanos</option>
                                <option value="Oficina de Contabilidad">Oficina de Contabilidad</option>
                                <option value="Oficina de Abastecimiento y Control Patrimonial">Oficina de Abastecimiento y Control Patrimonial</option>
                                <option value="Oficina de Tecnología de Información">Oficina de Tecnología de Información</option>
                                <option value="Oficina de Contabilidad">Oficina de Contabilidad</option>
                                <option value="Oficina de Abastecimiento y Control Patrimonial">Oficina de Abastecimiento y Control Patrimonial</option>
                                <option value="Gerencia de Administración Tributaria">Gerencia de Administración Tributaria</option>
                                  <option value="Subgerencia de Recaudación Tributaria">Subgerencia de Recaudación Tributaria</option>
                                  <option value="Subgerencia de Ejecución Coactiva">Subgerencia de Ejecución Coactiva</option>
                                  <option value="Subgerencia de registro, ORientaci[on al Contribuyente y Fiscalización Tributaria">Subgerencia de registro, ORientaci[on al Contribuyente y Fiscalización Tributaria</option>
                                <option value="Gerencia de Desarrollo Territorial e Infraestructura">Gerencia de Desarrollo Territorial e Infraestructura</option>
                                  <option value="Subgerencia de Desarrollo Territorial">Subgerencia de Desarrollo Territorial</option>
                                <option value="Subgerencia de Comercialización, Anuncios y Desarrollo Económico">Subgerencia de Comercialización, Anuncios y Desarrollo Económico</option>
                                <option value="Subgerencia de Gestión de Riesgo de Desastres">Subgerencia de Gestión de Riesgo de Desastres</option>

                                <option value="Subgerencia de Serenazgo">Subgerencia de Serenazgo</option>
                                <option value="Subgerencia de Fiscalización y Sanciones">Subgerencia de Fiscalización y Sanciones</option>
                                <option value="Subgerencia de Limpieza Pública">Subgerencia de Limpieza Pública</option>
                                <option value="Subgerencia de Áreas Verdes y Ornato">Subgerencia de Áreas Verdes y Ornato</option>

                                <option value="Gerencia de Desarrollo Humano, Educación, Cultura, Deportes y Recreación">Gerencia de Desarrollo Humano, Educación, Cultura, Deportes y Recreación</option>

                                <option value="Subgerencia de Programas Sociales y Salud.">Subgerencia de Programas Sociales y Salud.</option>
                                <option value="Subgerencia de Servicios Sociales.">Subgerencia de Servicios Socilaes.</option>
                              </select>
                              <span class="input-group-addon"><i class="fa-solid fa-chart-area"></i></span>
                          </div>
                        </div>
                        

                        <div class="form-group" style="margin-top:50px;">
                          <label  class="col-sm-2 control-label">Tipo de Insidente</label>
                          <div class="col-sm-10" style="margin-left:10px; max-width:80%; width: 100%;">
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
                                <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto</label>
                          <div class="col-sm-10" style="margin-left:10px; max-width:80%; width: 100%;">
                              <div class='input-group'>
                                <input type="text" class="form-control" placeholder="Asunto" name="asunto_ticket" required="">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Descripcion del Asunto </label>
                          <div class="col-sm-10" style="margin-left:10px; max-width:80%; width: 100%;">
                            <textarea class="form-control" rows="3" placeholder="Escriba el problema que presenta su producto" name="mensaje_ticket" required=""></textarea>
                          </div>
                        </div>


                        <!-- Texto "Adjuntar archivo (Opcional)" en cursiva -->

                          <!-- Cuadro de información -->  
                          <div class="form-group">
                              <label class="control-label font-italic col-sm-2">Adjuntar archivos (Opcional)</label>
                              <div class="alert alert-info col-sm-10" style="margin-left:25px; max-width:75%; width: 100%;">
                                  <strong>ℹ Información:</strong> Puede subir hasta 3 archivos (4MB en total).<br>
                                  Formatos permitidos: .pdf, .jpeg, .jpg, .png
                              </div>
                          </div>

                          <!-- Botón para seleccionar archivos con evento onchange para validación -->
                          <div class="form-group">
                              <div class="row" style="clear:both;">
                              <label class="control-label col-sm-2">Seleccionar Archivos</label>
                              <div class="col-sm-10" style="margin-left:23px; max-width:50%; width: 100%;float:left;">
                                <input type="file" class="form-control-file" name="archivos[]" accept=".pdf, .jpeg, .jpg, .png" multiple onchange="validarArchivos(this)" />
                              </div>
                              </div>
                          </div>



                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">Abrir ticket</button>
                          </div>
                        </div>
                             </fieldset> 
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php
}?>
<script type="text/javascript">
  $(document).ready(function(){
      $("#fechainput").datepicker();
  });

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
    
</script>