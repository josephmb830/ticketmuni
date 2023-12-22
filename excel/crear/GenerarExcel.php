<?php
	session_start();
	include_once('db.php');
?>
<!DOCTYPE html>
<html lang="es-es">
	<head>
		<meta charset="utf-8">
		<title>REPORTE DE ATENCIONES</title>
	<head>
	<body>
		<?php
		// Definimos el archivo exportado
		$arquivo = 'msgREPORTES.xls';
		
		// Crear la tabla HTML
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5"><b>REPORTES DE ATENCIONES</b></tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>FECHA</b></td>';
		$html .= '<td><b>N TICKET</b></td>';
		$html .= '<td><b>AREA</b></td>';
		$html .= '<td><b>TECNICO</b></td>';
		$html .= '<td><b>ESTADO</b></td>';
		$html .= '<td><b>FECHA ATENCION</b></td>';
		$html .= '</tr>';
		
		//Seleccionar todos los elementos de la tabla
		$result_msg_contatos = "SELECT * FROM ticket";
		$resultado_msg_contatos = mysqli_query($conectar , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';
			//$html .= '<td>'.$row_msg_contatos["feha"].'</td>';
			$html .= '<td>'.$row_msg_contatos["fecha"].'</td>';
			$html .= '<td>'.$row_msg_contatos["serie"].'</td>';
			$html .= '<td>'.$row_msg_contatos["area"].'</td>';
			$html .= '<td>'.$row_msg_contatos["tecnico"].'</td>';
			$html .= '<td>'.$row_msg_contatos["estado_ticket"].'</td>';
			$html .= '<td>'.$row_msg_contatos["fecha_solucion"].'</td>';
			//$data = date('d/m/Y H:i:s',strtotime($row_msg_contatos["fcreacion"]));
			//$html .= '<td>'.$data.'</td>';
			$html .= '</tr>';
			;
		}
		// Configuración en la cabecera
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generado Data" );
		// Envia contenido al archivo
		echo $html;
		exit; ?>
	</body>
</html>