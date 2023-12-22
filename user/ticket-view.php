<?php if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])){
        date_default_timezone_set('America/Bogota');    
        $nombre = $_SESSION['nombre_completo'];
        $email =    $_SESSION['email'];
        if(isset($_SESSION['area'])){
          $area_cli=$_SESSION['area'];
        }else{
          $area_cli="Informatica";
        }
        // $area_cli = $_SESSION['area'];
       
        
        $hoy = date('d/m/Y   h:i:s  a', TIME());

        if(isset($_POST['fecha_ticket']) && isset($_POST['name_ticket']) && isset($_POST['email_ticket'])){

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

          if(MysqlQuery::Guardar("ticket", "fecha, nombre_usuario, email_cliente, departamento, asunto, mensaje, estado_ticket ,area,serie", "'$fecha_ticket', '$nombre_ticket', '$email_ticket', '$departamento_ticket', '$asunto_ticket', '$mensaje_ticket', '$estado_ticket','$area_ticket','$id_ticket'")){

            /*----------  Enviar correo con los datos del ticket
            mail($email_ticket, $asunto_ticket, $mensaje_mail, $cabecera)
            ----------*/
            
            echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET CREADO</h4>
                    <p class="text-center">
                        Ticket creado con exito '.$_SESSION['nombre'].'<br>El TICKET ID es: <strong>'.$id_ticket.'</strong>
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
                      <form class="form-horizontal" role="form" action="" method="POST">
                          <fieldset>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class='col-sm-10'>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="fechainput" placeholder="Fecha" name="fecha_ticket"  required=""   value ="<?php echo $hoy ?>" readonly>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                          <label  class="col-sm-2 control-label">Tipo de Insidente</label>
                          <div class="col-sm-10">
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

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Asunto</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                                <input type="text" class="form-control" placeholder="Asunto" name="asunto_ticket" required="">
                                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                              </div> 
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Descripcion del Asunto </label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Escriba el problema que presenta su producto" name="mensaje_ticket" required=""></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-2 control-label">Area</label>
                          <div class="col-sm-10">
                              <div class='input-group'>
                              <input type="text" class="form-control" placeholder="Area" required="" pattern="[a-zA-Z ]{1,30}" name="area_ticket" title="Area" value="<?php echo $area_cli ?>" readonly>
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
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
</script>