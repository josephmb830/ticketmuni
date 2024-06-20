<?php

date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, 'spanish');
$hoy = utf8_encode(strftime("%d/%m/%Y %H:%M"));


if(isset($_POST['id_edit']) && isset($_POST['solucion_ticket']) && isset($_POST['estado_ticket'])){


  // $hoy = date(); 

//error_reporting(E_STRICT);

//date_default_timezone_set('America/Toronto');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body             = file_get_contents('contents.html');
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.gmail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "sistemas02@gmunimagdalena.com";  // GMAIL username
$mail->Password   = "3deabril";            // GMAIL password

$mail->SetFrom('sistemas02@gmunimagdalena.com', 'First Last');

//$mail->AddReplyTo("name@yourdomain.com","First Last");

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

//$mail->MsgHTML($body);

$address = "";
$mail->AddAddress($address, "John Doe");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment



//send the message, check for errors


		$id_edit=MysqlQuery::RequestPost('id_edit');
		$estado_edit=  MysqlQuery::RequestPost('estado_ticket');
		$solucion_edit=  MysqlQuery::RequestPost('solucion_ticket');
		$radio_email=  MysqlQuery::RequestPost('optionsRadios');
    $cierre_edit=  MysqlQuery::RequestPost('fecha_solucion_ticket');
    $tecnico_edit=  MysqlQuery::RequestPost('tecnico_ticket');
    $codequipo_edit=MysqlQuery::RequestPost('codequipo_ticket');

    //	$cabecera="From: Area de soporte de la Municipalidad de la Punta <j.huaman@munilapunta.gob.pe>";
		//$mensaje_mail="Estimado usuario la solución a su problema es la siguiente : ".$solucion_edit;
		//$mensaje_mail=wordwrap($mensaje_mail, 70, "\r\n");


    //validando correo  
    $asunto_edit=  MysqlQuery::RequestPost('asunto_ticket');
    //$email_edit=  MysqlQuery::RequestPost('email_ticket');



    //if(MysqlQuery::Actualizar("ticket", "estado_ticket='$estado_edit', solucion='$solucion_edit'", "id='$id_edit'")){
		if(MysqlQuery::Actualizar("ticket", "estado_ticket='$estado_edit', solucion='$solucion_edit', tecnico='$tecnico_edit', fecha_solucion='$cierre_edit' ,codequipo='$codequipo_edit'", "id='$id_edit'")){

			echo '
                <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET Actualizado</h4>
                    <p class="text-center">
                        El ticket fue actualizado con exito
                    </p>
                </div>
            ';
			if($radio_email=="option2"){

       // mail($to,$subject,$txt,$headers);
			//	mail( $email_edit,$asunto_edit,$mensaje_mail, $cabecera);

      if(!$mail->Send())
      {
         echo "Message could not be sent. <p>";
         echo "Mailer Error: " . $mail->ErrorInfo;
         exit;
      }

      echo "Message has been sent";
			}

		}else{
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
	}     


	$id = MysqlQuery::RequestGet('id');
	$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
	$reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);

  if($_SESSION['cargo']=='tecnico'){

    $readonly = 'disabled = disabled';
  }else{
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
                          <label  class="col-sm-2 control-label">Solución</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="3"  name="solucion_ticket" required=""><?php echo $reg['solucion']?></textarea>
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