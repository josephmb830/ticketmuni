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
                  <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Ingresa el código de tu Ticket</strong></h3>
                </div>
                
                <div class="panel-body">
                    <h5 class="">
                        <strong>&nbsp;&nbsp;&nbsp;El código de Ticket puedes encontrarlo en la bandeja del correo registrado.</strong>
                    </h5>

                    <div class= "row d-flex">

                        <div class="form-group has-success has-feedback col-sm-6">
                            <label><span class=""></span>ID Ticket</label>
                            <input type="text" class="form-control" name="dni" placeholder="Escribe el ID de tu Ticket" required="" maxlength="9"/>
                        </div>
                        

                        <div class="form-group col-sm-6">
                            <button type="submit" class="btn btn-info">Consultar</button>
                        </div>

                    </div>

                  
                      </form>
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