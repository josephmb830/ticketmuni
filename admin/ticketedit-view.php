<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Otros metadatos, enlaces a estilos CSS, scripts, etc., van aquí -->
</head>
<body>
<?php
    $conexion = mysqli_connect(SERVER, USER, PASS, BD);

    // Recomendación 5: Configuración de la codificación interna
    mb_internal_encoding("UTF-8");

    date_default_timezone_set('America/Bogota');
    setlocale(LC_TIME, 'spanish');
    $hoy = utf8_encode(strftime("%d/%m/%Y %H:%M"));

    if(isset($_POST['id_edit']) && isset($_POST['solucion_ticket']) && isset($_POST['estado_ticket'])){
        require_once('class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host       = "smtp.gmail.com"; // SMTP server
        $mail->SMTPDebug  = 2;                   
        $mail->SMTPAuth   = true;                 
        $mail->SMTPSecure = "ssl";                
        $mail->Host       = "smtp.gmail.com";     
        $mail->Port       = 587;                   
        $mail->Username   = "sistemas02@gmunimagdalena.com";  
        $mail->Password   = "3deabril";            

        $mail->SetFrom('sistemas02@gmunimagdalena.com', 'First Last');
        $mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 

        $address = "";
        $mail->AddAddress($address, "John Doe");

        $id_edit = MysqlQuery::RequestPost('id_edit');
        $estado_edit = MysqlQuery::RequestPost('estado_ticket');
        $diagnostico_edit = MysqlQuery::RequestPost('diagnostico_ticket');
        $solucion_edit = MysqlQuery::RequestPost('solucion_ticket');
        $observaciones_edit = MysqlQuery::RequestPost('observaciones_ticket');
        $radio_email = MysqlQuery::RequestPost('optionsRadios');
        $cierre_edit = MysqlQuery::RequestPost('fecha_solucion_ticket');
        $tecnico_edit = MysqlQuery::RequestPost('tecnico_ticket');
        $codequipo_edit = MysqlQuery::RequestPost('codequipo_ticket');

        // Utilizando consultas preparadas
        $sqlUpdate = "UPDATE ticket SET estado_ticket=?, diagnostico=?, solucion=?, observaciones=?, tecnico=?, fecha_solucion=?, codequipo=? WHERE id=?";

        // Preparar la consulta
        $stmt = mysqli_prepare($conexion, $sqlUpdate);

        if ($stmt) {
            // Vincular los parámetros
            mysqli_stmt_bind_param($stmt, "sssssssi", $estado_edit, $diagnostico_edit, $solucion_edit, $observaciones_edit, $tecnico_edit, $cierre_edit, $codequipo_edit, $id_edit);

            // Ejecutar la consulta preparada
            $resultado = mysqli_stmt_execute($stmt);

            // Verificar si la actualización fue exitosa
            if ($resultado) {
                echo '
                    <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">TICKET Actualizado</h4>
                        <p class="text-center">
                            El ticket fue actualizado con éxito
                        </p>
                    </div>
                ';
                if ($radio_email == "option2") {
                    // Lógica para enviar correo
                    // ...
                }
            } else {
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido actualizar el ticket
                        </p>
                    </div>
                ';
            }

            // Cerrar la consulta preparada
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conexion);
        }
    }
    
    $id = MysqlQuery::RequestGet('id');
    $sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
    $reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

    if ($_SESSION['cargo'] == 'tecnico') {
        $readonly = 'disabled = disabled';
    } else {
        $readonly = '';
    }

  ?>


          <!--************************************ Page content******************************-->
          <div class="container">
            <div class="row">
              <div class="col-sm-3">
                  <img width="50" src="./img/Edit.png" alt="Image" class="img-responsive animated tada">
              </div>
              <div class="col-sm-9">
                  <a href="./admin.php?view=ticketadmin" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver administrar Tickets </a>
              </div>
            </div>
          </div>
              
              
            <div class="container">
              <div class="col-sm-12">
                  <form class="form-horizontal" role="form" action="" method="POST">
                      <input type="hidden" name="id_edit" value="<?php echo $reg['id']?>">
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Fecha</label>
                              <div class='col-sm-10'>
                                  <div class="input-group">
                                      <input class="form-control" readonly="" type="text" name="fecha_ticket" readonly="" value="<?php echo $reg['fecha']?>">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                              </div>
                          </div>
                      
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Serie</label>
                              <div class='col-sm-10'>
                                  <div class="input-group">
                                      <input class="form-control" readonly="" type="text" name="serie_ticket" readonly="" value="<?php echo $reg['serie']?>">
                                      <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                  </div>
                              </div>
                          </div>
                      
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Estado</label>
                              <div class='col-sm-10'>
                                  <div class="input-group">
                                      <select class="form-control" name="estado_ticket">
                                          <option value="<?php echo $reg['estado_ticket']?>"><?php echo $reg['estado_ticket']?> (Actual)</option>
                                          <option value="Pendiente">Pendiente</option>
                                          <option value="En proceso">En proceso</option>
                                          <option value="Resuelto">Resuelto</option>
                                          <option value="Anulado">Anulado</option>
                                        </select>
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <div class='input-group'>
                                    <input type="text" readonly="" class="form-control"  name="name_ticket" readonly="" value="<?php echo $reg['nombre_usuario']?>">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <div class='input-group'>
                                    <input type="email" readonly="" class="form-control"  name="email_ticket" readonly="" value="<?php echo $reg['email_cliente']?>">
                                  <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                </div> 
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Tipo de incidencia</label>
                            <div class="col-sm-10">
                                <div class='input-group'>
                                    <input type="text" class="form-control"  name="departamento_ticket"  value="<?php echo $reg['departamento']?>" readonly>
                                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                </div> 
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Asunto</label>
                            <div class="col-sm-10">
                                <div class='input-group'>
                                    <input type="text" readonly="" class="form-control"  name="asunto_ticket" readonly="" value="<?php echo $reg['asunto']?>">
                                  <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
                                </div> 
                            </div>
                          </div>
  <!--seleccion de especialista-->

                          <div class="form-group">
                              <label class="col-sm-2 control-label">Especialista encargado</label>
                              <div class='col-sm-10'>
                                  <div class="input-group">
                                      <select class="form-control" name="tecnico_ticket" <?php echo $readonly;?>>
                                          <option value="<?php echo $reg['tecnico']?>"><?php echo $reg['tecnico']?> (Actual)</option>
                                          <option value="LUIS ALBERTO AYARZA FLORES">LUIS ALBERTO AYARZA FLORES </option>
                                          <option value="JAIME ARAGON ESCOBAR">JAIME ARAGON ESCOBAR </option>
                                          <option value="ANCEL JULCAMORO CELMI">ANCEL JULCAMORO CELMI </option>
                                          <option value="JOSE GUERRERO">JOSE GUERRERO </option>
                                          <option value="CESAR MUNOZ BERROCAL">CESAR MUNOZ BERROCAL</option>
                                          <option value="CRISTIAN SANCHEZ VIVAR">CRISTIAN SANCHEZ VIVAR</option>
                                          <option value="EDWIN PEREZ RENDON">EDWIN PEREZ RENDON </option>
                                          <option value="CAROLA CAMPOS ULLOA">CAROLA CAMPOS ULLOA </option>
                                          <option value="MILAGROS LINARES VALVERDE">MILAGROS LINARES VALVERDE</option>
                                          <option value="LUIS ALVARADO">LUIS ALVARADO</option>
                                        </select>
                                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                  </div>
                              </div>
                          </div>

                <!--termino de seleccion de especialista-->





                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Mensaje</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" readonly="" rows="3"  name="mensaje_ticket" readonly=""><?php echo $reg['mensaje']?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Diagnóstico</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="3"  name="diagnostico_ticket" required=""><?php echo htmlspecialchars($reg['diagnostico'], ENT_QUOTES, 'UTF-8');?></textarea>
                            </div>
                          </div>
                      
                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Solución</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="3"  name="solucion_ticket" required=""><?php echo $reg['solucion']?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Observaciones</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" rows="3"  name="observaciones_ticket" required=""><?php echo $reg['observaciones']?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-2 control-label">Serie o cod patrimonial </label>
                            <div class="col-sm-2">
                              <textarea class="form-control" rows="3"  name="codequipo_ticket" required=""><?php echo $reg['codequipo']?></textarea>
                            </div>
                          </div>


                        
                        
                          <div class="form-group">
                              <label class="col-sm-2 control-label">Fecha de cierre de ticket</label>
                              <div class='col-sm-10'>
                                  <div class="input-group">
                                  
                                  <input class="form-control" type="text" id="fechainput" placeholder="Fecha" name="fecha_solucion_ticket"    value ="<?php echo $hoy; ?>" readonly>
                                
                              
                                  
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                              </div>
                          </div>
                      
                          <div class="row">
                              <div class="col-sm-offset-5">
                                  <div class="radio">
                                      <label>
                                          <input type="radio" name="optionsRadios" value="option1" checked>
                                          Proceder a actualizar ticket  del usuario
                                      </label>
                                  </div>


                              <!--   <div class="radio">
                                      <label>
                                          <input type="radio" name="optionsRadios" value="option2">
                                          Enviar solución al email del usuario
                                      </label>
                                  </div>-->
                              </div>
                          </div>
                      
                      <br>
                      
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10 text-center">
                                <button type="submit" class="btn btn-info">Actualizar ticket</button>
                            </div>
                          </div>

                        </form>
              </div><!--col-md-12-->
            </div><!--container-->

  </body>
</html>