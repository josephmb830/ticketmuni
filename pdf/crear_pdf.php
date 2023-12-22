

<?php
//Incluimos el fichero de conexion
include_once("dbconect.php");
//Incluimos la libreria PDF
include_once('libs/fpdf.php');

// $nombre="";
// $where="";

if (isset($_GET['buscar']))
 {
 
  $nombre=$_GET['tecnico'];
	
 $where="where tecnico = '$nombre'";
  } else {
     
   $where="";

  }   

    
   

class PDF extends FPDF
{
// Funcion encargado de realizar el encabezado
function Header()
{
    // Logo
    $this->Image('logomuni.png',8,5,15);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(90);
    // Title
    $this->Cell(95,10,'Lista de Atenciones realizadas',1,0,'C');
    // Line break
    $this->Ln(20);
}


// Funcion pie de pagina
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$db = new dbConexion();
$connString =  $db->getConexion();
$display_heading = array();
 
$result = mysqli_query($connString, "SELECT * FROM ticket $where") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM ticket");
 
$pdf = new PDF();
//$pdf=new FPDF('L','mm','A4');
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',6);
// Declaramos el ancho de las columnas
$w = array(0,30,20,60,40,20); 
//$w=array ( 'id' , 'fecha' ,'ticket', 'area', 'tecnico','estado_ticket'); //tomar en cuenta que comienza a contar desde el cero
//Declaramos el encabezado de la tabla

//<!--$pdf->Cell(15,10,'ID',1);
$pdf->Cell($w[1],5,'Fecha',1);
$pdf->Cell($w[2],5,'N° de ticket',1);
//$pdf->Cell(30,12,'Usuario',1);
$pdf->Cell($w[3],5,'Area',1);
//$pdf->Cell(30,12,'Asunto',1);
$pdf->Cell($w[4],5,'Especialista asignado',1);
$pdf->Cell($w[5],5,'Estado',1);
$pdf->Cell($w[5],5,'Fecha de Atencion ',1);
$pdf->Ln();
$pdf->SetFont('Arial','B',6);



//Mostramos el contenido de la tabla
 foreach($result as $row)
    {
       // $pdf->Cell($w[0],8,$row['id'],1);
        $pdf->Cell($w[1],5,$row['fecha'],1);
       // $pdf->Cell($w[0],8,$row[''],1);
        $pdf->Cell($w[2],5,$row['serie'],1);
        //$pdf->Cell($w[1],6,$row['nombre_usuario'],1);
       // $pdf->Cell($w[3],6,number_format($row['personal_salario']),1);
        $pdf->Cell($w[3],5,$row['area'],1);
       // $pdf->Cell($w[1],6,$row['asunto'],1);
        $pdf->Cell($w[4],5,$row['tecnico'],1);
       $pdf->Cell($w[5],5,$row['estado_ticket'],1);
        $pdf->Cell($w[5],5,$row['fecha_solucion'],1);
      $pdf->Ln();
      
    }
$pdf->Output();
?>

