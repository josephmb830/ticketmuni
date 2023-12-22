<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contacto</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript">
			function validar_form_contato(){
				var nome = formcontato.nome.value;
				var email = formcontato.email.value;
				var assunto = formcontato.assunto.value;
				var mensagem = formcontato.mensagem.value;
				
				if(nome == ""){
					alert("Campo nombre obligatorio");
					formcontato.nome.focus();
					return false;
				}if(email == ""){
					alert("Campo email obligatorio");
					formcontato.email.focus();
					return false;
				}if(assunto == ""){
					alert("Campo asunto obligatorio");
					formcontato.assunto.focus();
					return false;
				}if(mensagem == ""){
					alert("Campo mensaje obligatorio");
					formcontato.mensagem.focus();
					return false;
				}
			}
		</script>
	<head>
	<body>
<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="./">BaulPHP</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="ListaContacto.php">Inicio <span class="sr-only">(current)</span></a></li>
        <li ><a href="form_contacto.php">Registrar</a></li>
        <li ><a href="GenerarExcel.php">Generar Excel </a></li>      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">

  <div class="row">
    <div class="col-md-12">
<div class="panel-body">
<!--Inicio elementos contenedor-->

		<div class="container theme-showcase" role="main">
			<div class="page-header">
				<h1>Pagina de Contacto</h1>
			</div>
			<form class="form-horizontal" name="formcontato" method="POST" action="MensajeError.php">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">
						Nombres: 
					</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="nombres" placeholder="Nombre Completo" 
						<?php
							if(!empty($_SESSION['value_nombres'])){
								echo "value='".$_SESSION['value_nombres']."'";
								unset($_SESSION['value_nombres']);
							}
						 ?>	>
						 <?php
							if(!empty($_SESSION['baulphp_nombres'])){
								echo "<p style='color: #f00; '>".$_SESSION['baulphp_nombres']."</p>";
								unset($_SESSION['baulphp_nombres']);
							}
						 ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">
						E-mail: 
					</label>
					<div class="col-sm-10">
						 <input type="email" class="form-control" name="email" placeholder="Su e-mail" 
						<?php
							if(!empty($_SESSION['value_email'])){
								echo "value='".$_SESSION['value_email']."'";
								unset($_SESSION['value_email']);
							}
						 ?>>
						 <?php
							if(!empty($_SESSION['baulphp_email'])){
								echo "<p style='color: #f00; '>".$_SESSION['baulphp_email']."</p>";
								unset($_SESSION['baulphp_email']);
							}
						 ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">
						Asunto: 
					</label>
					<div class="col-sm-10">
						 <input type="text" class="form-control" name="asunto" placeholder="Asunto de contacto" 
						<?php
							if(!empty($_SESSION['value_asunto'])){
								echo "value='".$_SESSION['value_asunto']."'";
								unset($_SESSION['value_asunto']);
							}
						 ?>>
						 <?php
							if(!empty($_SESSION['baulphp_asunto'])){
								echo "<p style='color: #f00; '>".$_SESSION['baulphp_asunto']."</p>";
								unset($_SESSION['baulphp_asunto']);
							}
						 ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">
						Mensaje: 
					</label>
					<div class="col-sm-10">
						<?php
							if(!empty($_SESSION['value_mensaje'])){ ?>
								<textarea class="form-control" name="mensagem"><?php echo $_SESSION['value_mensaje']; ?></textarea>
								<?php
								unset($_SESSION['value_mensaje']);
							}else{ ?>
								<textarea class="form-control" name="mensaje"></textarea>
							<?php }
						?>
						 <?php
							if(!empty($_SESSION['baulphp_mensaje'])){
								echo "<p style='color: #f00; '>".$_SESSION['baulphp_mensaje']."</p>";
								unset($_SESSION['baulphp_mensaje']);
							}
						 ?>
					</div>
				</div>
				
				<input class="btn btn-success" type="submit" value="Enviar" onclick="return validar_form_contato()">
			</form>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
<!--Fin elementos contenedor-->
</div>
</div>
  </div>
</div>
<div class="panel-footer">
  <div class="container">
    <p>Códigos <a href="https://www.baulphp.com/" target="_blank">BaulPHP</a></p>
  </div>
</div>

</body>
</html>
