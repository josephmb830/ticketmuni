<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Report Sistema de Ticket MDMM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="shortcut icon" href="../img/logomuni.png">

<?php
//Incluimos el fichero de conexion
include_once("dbconect.php");
$mysqli = new mysqli('localhost', 'root', '', 'ticket');
$where="";
//.......................................................

?>

</head>
<body>

<div class="container" style="padding-top:50px">
<h2>REPORTE DE ATENCIONES REALIZADAS"</h2>


<!--botones-->
<form action="index.php" method="post">
<table class="table">
<thead class="thead-dark">
<tr>
<th>
<?php
//boton generar pdf
if(isset($_POST['tecnico'])){
  
  
  $tecnico = $_POST['tecnico'];
  echo "<a href='crear_pdf.php?buscar=buscar&tecnico=$tecnico' >GENERAR REPORTE EN  PDF</a></align>";
    
  } else{
    echo "<a  href='crear_pdf.php?'>GENERAR REPORTE EN  PDF</a></align>"; 
  }
//boton generar archivo excel
?>

<a href='../\excel\crear\GenerarExcel.php'><i class="fa fa-pdf" aria-hidden="true">GENERAR REPORTE EXCEL</a>
</th>
<th>

</tr>
<!--fin de los botones-->


<!-- cuadro de filtros -->
 
<table class="table">
<thead class="thead-dark">

<tr>
<!--................................................................................................-->
<th>
<div align="left">                        
    <p>Seleccione una opcion:</p>
    <p>Tecnico
       <select name="tecnico" type ="text" >
        <option value="0" >Seleccione:</option>
        <?php
          $query = $mysqli -> query ("SELECT distinct tecnico FROM ticket");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["tecnico"].'">'.$valores["tecnico"].'</option>';
          }
        ?>
       </select>
    </p>
  </div>
</th>
<!--....................................................................................................-->
<th>
  <div align="left">                        
     <p>ticket
      <select name="ticket">
        <option value="0">Seleccione:</option>
        <?php
          $query2= $mysqli -> query ("SELECT distinct estado_ticket FROM ticket");
          while ($valores2 = mysqli_fetch_array($query2)) {
            echo '<option value="'.$valores2["estado_ticket"].'">'.$valores2["estado_ticket"].'</option>';
          }
        ?>
      </select>
    </p>
  </div>
</th>
<!--....................................................................................................-->
 <th> <div align="left">                        
    <p>mes
     <select name="mes">
        <option value="0">Seleccione:</option>
        <?php
          $query3= $mysqli -> query ("SELECT DISTINCT mes FROM ticket");
          while ($valores3 = mysqli_fetch_array($query3)) {
            echo '<option value="'.$valores3["mes"].'">'.$valores3["mes"].'</option>';
          }
        ?>
      </select>
    </p>
  </div>
  </th>
<!--....................................................................................................-->
  <th> 
  <div align="left">                        
    <p>Area
        <select name="area">
        <option value="0">Seleccione:</option>
        <?php
          $query4= $mysqli -> query ("SELECT DISTINCT area FROM ticket");
          while ($valores4 = mysqli_fetch_array($query4)) {
            echo '<option value="'.$valores4["area"].'">'.$valores4["area"].'</option>';
          }
        ?>
      </select>
    </p>
  </div>
 </th>
<!--....................................................................................................-->
 <th> 
 <left><button type="submit"  method="post" id="buscar" name="buscar" class="btn btn-primary"><i class="fa fa-pdf" aria-hidden="true"></i>filtrar</button></left>
       
</th>

</thead>

<!--fin de cuadro de  filtros-->

</fieldset>
<hr>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <!--<th scope="col">#</th>-->
      <th scope="col">FECHA</th>
      <th scope="col">TICKET</th>
      <th scope="col">AREA SOLICITANTE</th>
      <th scope="col">ESPECIALISTA ASIGNADO</th>
      <th scope="col">ESTADO DEL TICKET</th>
      <th scope="col">FECHA DE ATENCION</th>
    </tr>
  </thead>
  <tbody>

<?php
$db = new dbConexion();
$connString =  $db->getConexion();

//variables de busqueda//////////////////////////// 

$i="";
if (isset($_POST['buscar']))
{
  if($i=$_POST["area"]){
      $nombre=$_POST["area"];
  
		  $where="where area = '$nombre'";
    
 } elseif($i=$_POST["tecnico"]){
     
      $nombre=$_POST["tecnico"];
  
      $where="where tecnico = '$nombre'";

  }elseif($i=$_POST["mes"]){
     
    $nombre=$_POST["mes"];

    $where="where mes = '$nombre'";

  }elseif($i=$_POST["estado_ticket"]){
     
  $nombre=$_POST["estado_ticket"];

  $where="where estado_ticket= '$nombre'";
  }
  else{
    $nombre="";
    $where="";
  }
}

//FIN DE CONSULTA IF///////////////////////////////

 
$result = mysqli_query($connString, "SELECT * FROM ticket $where") or die("database error:". mysqli_error($connString));

foreach($result as $row)
    {
   echo '<tr>
      
      <td>'.$row['fecha'].'</td>
      <td>'.$row['serie'].'</td>
      <td>'.$row['area'].'</td>
      <td>'.$row['tecnico'].'</td>
      <td>'.$row['estado_ticket'].'</td>
      <td>'.$row['fecha_solucion'].'</td>
    </tr>';
    }
   
?>
  </tbody>
</table>
</div>
</form>
</body>

</html>
