<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT * FROM ticket WHERE id= '$id'");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF
{
    function Header()
    {
        // Agregar logo a la izquierda del título
        $this->Image('../img/logomuni.png', 10, 10, 40, 30);

        // Agregar logo en el encabezado (marca de agua)
        $this->Image('../img/logomuni.png', $this->GetPageWidth() - 50, 10, 40, 30);

        // Agregar título centrado
        $this->SetFont('Helvetica', 'B', 14);
        $this->Cell(0, 0, 'MUNICIPALIDAD DISTRITAL MAGDALENA', 0, 1, 'C');

        // Cambiar a fuente normal antes de imprimir el subtítulo
        $this->SetFont('Helvetica', '', 10);

        // Agregar subtítulo
        $this->Cell(0, 9, 'OFICINA DE TECNOLOGIA DE LA INFORMACION', 0, 1, 'C');

        // Cambiar a negrita para el nuevo título
        $this->SetFont('Helvetica', 'B', 13);

        // Agrega Título Ficha
        $this->Cell(0, 10, 'FICHA DE SERVICIO DE SOPORTE TECNICO', 0, 1, 'C');

        // Restaurar a fuente normal para la tabla
        $this->SetFont('Helvetica', '', 10);

        // Agregar fecha actual abajo a la derecha
        $this->Cell(120, 10, 'Fecha:', 0, 0, 'R');
        $this->Cell(20, 10.2, date('d/m/Y'), 0, 0, 'R');

        // Agregar texto "Reporte de Servicio No:" al lado derecho
        $this->Cell(-10); // Ajustar para alinearlo al margen derecho
        $this->Cell(0, 10, 'Reporte de Servicio No:', 0, 1, 'R');
    }

    function Footer()
    {
        // Nada en el pie de página por ahora
    }
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,128);
$pdf->SetFillColor(0,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/logomuni.png',60,20,-800);
$pdf->Cell (0,5,utf8_decode('Municipalidad de Magdalena del Mar'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Reporte de problema mediante Ticket'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,5,utf8_decode('Información de Ticket #'.utf8_decode($reg['serie'])),0,1,'C');



$pdf->Cell(190, 10, 'SOPORTE TÉCNICO A EQUIPOS INFORMÁTICOS', 1, 1, 'A');
$pdf->Cell (35,10,'Fecha',1,0,'C',true);
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

$pdf->Ln();

$pdf->cell(0,5,"Oficina General de x Tecnologia de la Información",0,0,'C');

$pdf->Output();
?>