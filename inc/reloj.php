<style>
    .contenedor {
  width: 90%;
  height: 100%;
  position: relative;
  max-width: 1000px;
  margin: auto;
  display: block;
}
.widget {
  width: 40%;
  height: 40%;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
z-index: 10;
}
.widget p {
  display: inline-block;
  line-height: 1em;
}
.fecha {
  font-family: arial;
  text-align: center;
  font-size: 1.5em;
  font-weight:bold;
  margin-bottom: 5px;
  padding: 20px;
  width: 100%;
}
.reloj {
  font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
  width: 100%;
  padding: 20px;
  font-size: 4em;
  text-align: center;
  border: 1px solid;
}
.reloj .cajaSegundos {
  display: inline-block;  
}
.reloj .ampm, .reloj .segundos{
  display: block;
  font-size: 2rem;
}
</style>
<div class="contenedor">
  <div class="widget">
    <div class="fecha">
      <p id="diaSemana" class="diaSemana"></p>
      <p id="dia" class="dia"></p>
      <p>de</p>
      <p id="mes" class="mes"></p>
      <p>del</p>
      <p id="anio" class="anio"></p>
    </div>
    <div class="reloj">
      <p id="horas" class="horas"></p>
      <p>:</p>
      <p id="minutos" class="minutos"></p>
      <p>:</p>
      <div class="cajaSegundos">
        <p id="ampm" class="ampm"></p>
        <p id="segundos" class="segundos"></p>
      </div>
    </div>
  </div>
</div>
<script>
    $(function(){
  var actualizarHora = function(){
    var fecha = new Date(),
        hora = fecha.getHours(),
        minutos = fecha.getMinutes(),
        segundos = fecha.getSeconds(),
        diaSemana = fecha.getDay(),
        dia = fecha.getDate(),
        mes = fecha.getMonth(),
        anio = fecha.getFullYear(),
        ampm;
    
    var $pHoras = $("#horas"),
        $pSegundos = $("#segundos"),
        $pMinutos = $("#minutos"),
        $pAMPM = $("#ampm"),
        $pDiaSemana = $("#diaSemana"),
        $pDia = $("#dia"),
        $pMes = $("#mes"),
        $pAnio = $("#anio");
    var semana = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $pDiaSemana.text(semana[diaSemana]);
    $pDia.text(dia);
    $pMes.text(meses[mes]);
    $pAnio.text(anio);
    if(hora>=12){
      hora = hora - 12;
      ampm = "PM";
    }else{
      ampm = "AM";
    }
    if(hora == 0){
      hora = 12;
    }
    if(hora<10){$pHoras.text("0"+hora)}else{$pHoras.text(hora)};
    if(minutos<10){$pMinutos.text("0"+minutos)}else{$pMinutos.text(minutos)};
    if(segundos<10){$pSegundos.text("0"+segundos)}else{$pSegundos.text(segundos)};
    $pAMPM.text(ampm);
    
  };
  
  
  actualizarHora();
  var intervalo = setInterval(actualizarHora,1000);
});
</script>