<?php
	session_start();
	include_once('db.php');
/*	if(empty($_POST['nombres'])){
		$_SESSION['vazio_nome'] = "Campo nombre obligatorio";
		$url = 'http://localhost/baulphp2/form_contacto.php';
		echo '<meta http-equiv=refresh content="0; url=$url">';
	}else{
		$_SESSION['value_nome'] = $_POST['nombres'];
	}
	
	if(empty($_POST['email'])){
		$_SESSION['vazio_email'] = "Campo e-mail obligatorio";
		$url = 'http://localhost/baulphp2/form_contacto.php';
		echo '<meta http-equiv=refresh content="0; url=$url">';
	}else{
		$_SESSION['value_email'] = $_POST['email'];
	}
	
	if(empty($_POST['asunto'])){
		$_SESSION['vazio_assunto'] = "Campo asunto obligatorio";
		$url = 'http://localhost/baulphp2/form_contacto.php';
		echo '<meta http-equiv=refresh content="0; url=$url">';
	}else{
		$_SESSION['value_assunto'] = $_POST['asunto'];
	}
	
	if(empty($_POST['mensaje'])){
		$_SESSION['vazio_mensagem'] = "Campo mensaje obligatorio";
		$url = 'http://localhost/baulphp2/form_contacto.php';
		echo '<meta http-equiv=refresh content="0; url=$url">';
	}else{
		$_SESSION['value_mensagem'] = $_POST['mensaje'];
	}*/

	
if (empty($_POST['nombres'])) { 
		$_SESSION['baulphp_nombres'] = "Campo nombre obligatorio";
		header('Location: form_contacto.php');
	
} elseif (empty($_POST['email'])) {
		$_SESSION['baulphp_email'] = "Campo e-mail obligatorio";
		header('Location: form_contacto.php');

		
} elseif (empty($_POST['asunto'])) {
		$_SESSION['baulphp_asunto'] = "Campo asunto obligatorio";
		header('Location: form_contacto.php');

		
} elseif (empty($_POST['mensaje'])) {
	
		$_SESSION['baulphp_mensaje'] = "Campo mensaje obligatorio";
		header('Location: form_contacto.php');
		
		} else {


	$nombres = mysqli_real_escape_string($conectar, $_POST['nombres']);
	$email = mysqli_real_escape_string($conectar, $_POST['email']);
	$asunto = mysqli_real_escape_string($conectar, $_POST['asunto']);
	$mensaje = mysqli_real_escape_string($conectar, $_POST['mensaje']);
	
	
	$result_msg_contato = "INSERT INTO contactos(nombres, email, asunto, mensajes, fcreacion) VALUES ('$nombres', '$email', '$asunto', '$mensaje', NOW())";
	$resultado_msg_contato= mysqli_query($conectar, $result_msg_contato);
	header('Location: ListaContacto.php');

}

?>