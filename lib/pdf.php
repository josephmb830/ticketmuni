<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');

$sql = Mysql::consulta("SELECT * FROM ticket INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE id = '$id'");
$regall = mysqli_fetch_array($sql, MYSQLI_ASSOC);

if ($regall['id_cliente']== !null) {
    $sql = Mysql::consulta("SELECT * FROM ticket INNER JOIN cliente ON ticket.id_cliente = cliente.id_cliente INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE id = '$id'");
    $reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);
} elseif ($regall['id_admin'] == !null) {
    $sql = Mysql::consulta("SELECT * FROM ticket INNER JOIN administrador ON ticket.id_admin = administrador.id_admin INNER JOIN tecnico ON ticket.id_tecnico = tecnico.id_tecnico WHERE id = '$id'");
    $reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);
}

class PDF extends FPDF
{
    function Header()
    {
        // Agregar logo a la izquierda del título
        $this->Image('../img/logomuni.png', 10, 10, 40, 30);

        // Agregar FST   en el encabezado (marca de agua)
        $this->SetFont('Helvetica', 'B', 40);
        $this->Cell(0, 0, 'FST', 0, 1, 'R');

        // Obtener las coordenadas y dimensiones del texto "FST" en la página actual
        $x = $this->GetX();
        $y = $this->GetY();
        $width = $this->GetStringWidth('FST');
        $height = 40;  // Altura fija para el rectángulo

        // Dibujar el rectángulo alrededor de "FST"
        $this->Rect($x + 154.5, $y - 10, $width + 7, $height-22);

        // Agregar título centrado
        $this->SetFont('Helvetica', 'B', 14);
        $this->Cell(0, 0, 'MUNICIPALIDAD DISTRITAL MAGDALENA', 0, 1, 'C');

        // Cambiar a fuente normal antes de imprimir el subtítulo
        $this->SetFont('Helvetica', '', 10);

        // Agregar subtítulo
        $this->Cell(0, 9, utf8_decode('OFICINA DE TECNOLOGIA DE LA INFORMACIÓN'), 0, 1, 'C');

        // Cambiar a negrita para el nuevo título
        $this->SetFont('Helvetica', 'B', 13);

        // Agrega Título Ficha
        $this->Cell(0, 10, utf8_decode('FICHA DE SERVICIO DE SOPORTE TÉCNICO'), 0, 1, 'C');

        // Restaurar a fuente normal para la tabla
        $this->SetFont('Helvetica', '', 10);

        // Agregar fecha actual abajo a la derecha
        $this->Cell(120, 10, 'Fecha:', 0, 0, 'R');
        $this->Cell(20, 10, date('d/m/Y'), 0, 0, 'R');

        $id = MysqlQuery::RequestGet('id');
        $sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
        $reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        // Agregar texto "Reporte de Servicio No:" al lado derecho
        $this->Cell(-10); // Ajustar para alinearlo al margen derecho
        $this->Cell(55, 10, 'Reporte de Servicio No:' . ' ' . utf8_decode($reg['id']), 0, 1, 'R');
       
    }

    function Footer()
    {
        // Nada en el pie de página por ahora
    }

}

function obtenerSolucion($solucion) {
    $maxCaracteres = 100;

    // Inicializar variables para las dos partes de la solución
    $parte1 = '';
    $parte2 = '';

    // Verificar si la longitud de la solución es mayor que 150
    if (strlen($solucion) > $maxCaracteres) {
        // Obtener la primera parte de la solución (caracteres 0 a 150)
        $parte1 = substr($solucion, 0, $maxCaracteres) . '-';

        // Obtener la segunda parte de la solución (caracteres 150 en adelante)
        $parte2 = substr($solucion, $maxCaracteres);
    } else {
        // Si la solución tiene 150 caracteres o menos, asignarla a la parte1
        $parte1 = $solucion;
    }

    // Devolver las dos partes de la solución
    return array('parte1' => $parte1, 'parte2' => $parte2);
}

// Uso de la función

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,128);
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->Ln(4);

$pdf->SetFont('Helvetica', 'b', 10);
$pdf->Cell(185.9, 7, utf8_decode('SOPORTE TÉCNICO A EQUIPOS INFORMÁTICOS'), 1, 1, 'C', true);
$pdf->Ln(2);
$pdf->SetFont('Helvetica', 'b', 9);
$pdf->Cell(185.9, 7, 'DATOS DEL USUARIO DEL EQUIPO', 1, 1, 'C', true);
    $pdf->SetDrawColor(255, 255, 255, 0); // Establecer el color de los bordes como transparente
    $pdf->SetFillColor(255, 255, 255, 0); // Establecer el color del fondo como transparente
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(35, 5.5, 'Gerencia:      ', 1, 0, 'L');
$pdf->Cell (0,5.5,utf8_decode($reg['area']),1,1,'L');
$pdf->Cell(35, 5.5, 'Departamento:      ', 1, 0, 'L');
$pdf->Cell (0,5.5,utf8_decode($reg['departamento']),1,1,'L');
$pdf->Cell(35, 5.5, 'Nombre del usuario:      ', 1, 0, 'L');
//$pdf->Cell (0,5.5,utf8_decode($reg['nombre_usuario']),1,1,'L');
$pdf->Cell(35, 5.5, 'Email:      ', 1, 0, 'L');
//$pdf->Cell (0,5.5,utf8_decode($reg['email_cliente']),1,1,'L');
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->Rect(15,  69,  185.9, 22);
$pdf->Ln(2);
$pdf->SetFont("Arial","b",9);
$pdf->Cell(185.9, 7, 'TIPO DE SERVICIO', 1, 1, 'C', true);
$pdf->SetFont("Arial","",9);
$pdf->Cell (185.9,7,utf8_decode($reg['departamento']),1,1,'C');
$pdf->Ln(2);
$pdf->SetFont("Arial","b",9);
$pdf->Cell(185.9, 7, 'DATOS DEL EQUIPO/COMPONENTE', 1, 1, 'C', true);
$pdf->Cell (35,7,'CANTIDAD',1,0,'C');
$pdf->Cell (57.95,7,'01',1,0,'L');
$pdf->Cell (35,7,'Estado',1,0,'C');
$pdf->Cell (57.95,7,utf8_decode($reg['estado_ticket']),1,1,'L');
$pdf->Cell (35,7, utf8_decode('DESCRIPCIÓN'),1,0,'C');
$pdf->Cell (0,7,utf8_decode($reg['asunto']),1,1,'L');
$pdf->SetFont("Arial","b",8.5);
$pdf->Cell (35,7,utf8_decode('CÓDIGO PATRIMONIAL'),1,0,'C');
$pdf->SetFont("Arial","b",9);
$pdf->Cell (57.95,7,utf8_decode($reg['codequipo']),1,0,'L');
$pdf->Cell (35,7,'No. DE SERIE',1,0,'C');
$pdf->Cell (57.95,7,utf8_decode($reg['serie']),1,1,'L');
$partesSolucion = obtenerSolucion(utf8_decode($reg['mensaje']));
$parte1 = $partesSolucion['parte1'];
$parte2 = $partesSolucion['parte2'];
$pdf->SetDrawColor(255, 255, 255, 0);
$pdf->SetFillColor(255, 255, 255, 0);
$pdf->Cell (35,7,'FALLA PRESENTADA',1,0,'C');
$pdf->Cell (0,7,utf8_decode($parte1),1,1,'L');
$pdf->Cell (35,7,'',1,0,'C');
$pdf->Cell (0,7,utf8_decode($parte2),1,1,'L');

function obtenerTextoPartido($texto, $maxCaracteres = 100) {
    // Convertir el texto a UTF-8 si no lo está
    $texto = utf8_encode($texto);

    // Inicializar variables para las dos partes del texto
    $parte1 = '';
    $parte2 = '';

    // Verificar si la longitud del texto es mayor que el máximo
    if (mb_strlen($texto, 'UTF-8') > $maxCaracteres) {
        // Obtener la primera parte del texto (caracteres 0 a $maxCaracteres)
        $parte1 = mb_substr($texto, 0, $maxCaracteres) . '-';

        // Obtener la segunda parte del texto (caracteres $maxCaracteres en adelante)
        $parte2 = mb_substr($texto, $maxCaracteres);
    } else {
        // Si el texto tiene $maxCaracteres o menos, asignarlo a la parte1
        $parte1 = $texto;
    }

    // Devolver las dos partes del texto
    return array('parte1' => $parte1, 'parte2' => $parte2);
}

// Uso de la función para DIAGNÓSTICO
$partesDiagnostico = obtenerTextoPartido(utf8_decode($reg['diagnostico']));
$parte1 = $partesDiagnostico['parte1'];
$parte2 = $partesDiagnostico['parte2'];
$pdf->Cell(35, 7, utf8_decode('DIAGNÓSTICO'), 1, 0, 'C');
$pdf->Cell(0, 7, utf8_decode($parte1), 1, 1, 'L');
$pdf->Cell(35, 7, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(0, 7, utf8_decode($parte2), 1, 1, 'L');


// Uso de la función para SOLUCIÓN
$partesSolucion = obtenerTextoPartido(utf8_decode($reg['solucion']));
$parte1 = $partesSolucion['parte1'];
$parte2 = $partesSolucion['parte2'];
$pdf->Cell(35, 7, utf8_decode('SOLUCIÓN'), 1, 0, 'C');
$pdf->Cell(0, 7, utf8_decode($parte1), 1, 1, 'L');
$pdf->Cell(35, 7, utf8_decode(''), 1, 0, 'C');
$pdf->Cell(0, 7, utf8_decode($parte2), 1, 1, 'L');
$pdf->Ln(2);

$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->Rect(15,  137,  185.9, 14);
$pdf->Rect(15,  137,  35, 14);
$pdf->Rect(15,  151,  185.9, 14);
$pdf->Rect(15,  151,  35, 14);
$pdf->Rect(15,  165,  185.9, 14);
$pdf->Rect(15,  165,  35, 14);
// Uso de la función para OBSERVACIONES
$partesObservaciones = obtenerTextoPartido(utf8_decode($reg['observaciones']));
$parte1 = $partesObservaciones['parte1'];
$parte2 = $partesObservaciones['parte2'];
$pdf->Cell(185.9, 7, 'OBSERVACIONES', 1, 1, 'C', true);
$pdf->SetFont("Arial","",9);
$pdf->SetDrawColor(255, 255, 255, 0); // Establecer el color de los bordes como transparente
$pdf->SetFillColor(255, 255, 255, 0); // Establecer el color del fondo como transparente
$pdf->Cell (185.9,7,utf8_decode($parte1),1,1,'C');
$pdf->Cell (185.9,7,utf8_decode($parte2),1,1,'C');
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->Rect(15,  188,  185.9, 14);
$pdf->Cell (92.95,40,utf8_decode(''),1,0,'C');
$pdf->Cell (92.95,40,utf8_decode(''),1,1,'C');

// Obtener las coordenadas actuales para la celda principal
$xCeldaPrincipal = $pdf->GetX();
$yCeldaPrincipal = $pdf->GetY();

// Nested Cell con texto (transparente)
$pdf->SetDrawColor(255, 255, 255, 0); // Establecer el color de los bordes como transparente
$pdf->SetFillColor(255, 255, 255, 0); // Establecer el color del fondo como transparente
$pdf->Text($xCeldaPrincipal + 31, $yCeldaPrincipal - 35.5, utf8_decode('SOPORTE TÉCNICO')); // Texto dentro de la celda principal
$pdf->Text($xCeldaPrincipal + 19, $yCeldaPrincipal - 23, utf8_decode('_______________________________')); // Texto dentro de la celda principal
$pdf->Text($xCeldaPrincipal + 42, $yCeldaPrincipal - 15, utf8_decode('FIRMA'));
$pdf->Text($xCeldaPrincipal + 1, $yCeldaPrincipal - 7.5, utf8_decode('NOMBRE:'));
$pdf->SetFont("Arial","B",9);
$pdf->Text($xCeldaPrincipal + 17, $yCeldaPrincipal - 7.5, utf8_decode($reg['nombres_tecnico'] . " " . $reg['a_paterno_tecnico'] . " " . $reg['a_materno_tecnico']));
$pdf->SetFont("Arial","",9);
$pdf->Text($xCeldaPrincipal + 1, $yCeldaPrincipal - 1, utf8_decode('FECHA:'));
$pdf->Text($xCeldaPrincipal + 14, $yCeldaPrincipal - 1, utf8_decode($reg['fecha']));
//
$pdf->Text($xCeldaPrincipal + 118, $yCeldaPrincipal - 35.5, utf8_decode('CONFORMIDAD DE USUARIO'));
$pdf->Text($xCeldaPrincipal + 113, $yCeldaPrincipal - 23, utf8_decode('_______________________________'));
$pdf->Text($xCeldaPrincipal + 135, $yCeldaPrincipal - 15, utf8_decode('FIRMA'));
$pdf->Text($xCeldaPrincipal + 94, $yCeldaPrincipal - 7.5, utf8_decode('NOMBRE:'));
$pdf->SetFont("Arial","B",9);
//$pdf->Text($xCeldaPrincipal + 110, $yCeldaPrincipal - 7.5, utf8_decode($reg['nombre_usuario'] . ' ' . $reg['a_paterno'] . ' ' . $reg['a_materno']));
$pdf->SetFont("Arial","",9);
$pdf->Text($xCeldaPrincipal + 94, $yCeldaPrincipal - 1, utf8_decode('FECHA:'));
$pdf->Text($xCeldaPrincipal + 107, $yCeldaPrincipal - 1, utf8_decode($reg['fecha']));
// Restaurar configuraciones
$pdf->SetDrawColor(0); // Restaurar el color de los bordes al valor predeterminado
$pdf->SetFillColor(255, 255, 255); // Restaurar el color de fondo al valor predeterminado

// Restaurar las coordenadas para la celda principal
$pdf->SetXY($xCeldaPrincipal, $yCeldaPrincipal);

$pdf->Ln(2);

$pdf->cell(0,5,utf8_decode("Oficina General de Tecnología de la Información"),0,0,'C');

// $pdf->AddPage(); // Agregar una nueva página
/*$pdf->Cell(185.9, 7, 'DATOS DEL EQUIPO/COMPONENTE', 1, 1, 'C', true);
$pdf->Cell (9,7,'No.',1,0,'C');
$pdf->Cell (35,7,'DESCRIPCION',1,0,'C');
$pdf->Cell (40,7,'CODIGO PATRIMONIAL',1,0,'C');
$pdf->Cell (40,7,'No. DE SERIE',1,0,'C');
$pdf->Cell (61.9,7,'CARACTERISTICAS/PROBLEMA',1,1,'C');
$pdf->Cell (9,21,'No.',1,0,'C');
$pdf->Cell (35,21,'DESCRIPCION',1,0,'C');
$pdf->Cell (40,21,'CODIGO PATRIMONIAL',1,0,'C');
$pdf->Cell (40,21,'No. DE SERIE',1,0,'C');
$pdf->Cell (61.9,21,'CARACTERISTICAS/PROBLEMA',1,1,'C');*/

/*$pdf->Cell (35,10,'Fecha',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fecha']),1,1,'L');
$pdf->Cell (35,10,'Serie',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['serie']),1,1,'L');
$pdf->Cell (35,10,'Estado',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['estado_ticket']),1,1,'L');
$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['nombre_usuario']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['email_cliente']),1,1,'L');
$pdf->Cell (35,10,'Departamento',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['departamento']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['asunto']),1,1,'L');
$pdf->Cell (35,15,'Problema',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['mensaje']),1,1,'L');
$pdf->Cell (35,15,'Solucion',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['solucion']),1,1,'L');
$pdf->Cell (35,15,'tecnico',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['tecnico']),1,1,'L');

$pdf->Ln();*/

//$pdf->Cell (0,5,utf8_decode('Información de Ticket #'.utf8_decode($reg['serie'])),0,1,'C');

$pdf->Output();
?>