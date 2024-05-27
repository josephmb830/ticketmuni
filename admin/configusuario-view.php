<? 


  
  
  ?>
<!--inicio de carrucel-->
<div class="container hidden-xs">
    <div class="col-xs-12">
<div id="carousel-example-generic" class="carousel slide">

  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>
    <div class="carousel-inner">
       <div class="item active">
           <img src="img/banner3.jpg" alt="">
          <div class="carousel-caption">
              
          </div>
       </div>
       <div class="item">
          <img src="img/banner6.jpg" alt="">
          <div class="carousel-caption">
              
          </div>
       </div>
       <div class="item ">
          <img src="img/banner7.jpg" alt="">
          <div class="carousel-caption">
              
          </div>
        </div>
        <div class="item ">
          <img src="img/banner3.jpg" alt="">
          <div class="carousel-caption">
              
          </div>
        </div>
   </div>
   <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
       <span class="icon-prev"></span>
   </a>
   <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
     <span class="icon-next"></span>
   </a>
</div>
        </div>
     <div class="col-sm-2">&nbsp;</div>
</div>

<!--fin de carrucel-->



<?php if(!$_SESSION['nombre']==""&&!$_SESSION['tipo']==""){ 

        /*Script para eliminar cuenta
        if(isset($_POST['usuario_delete']) && isset($_POST['clave_delete'])){
          $usuario_delete=MysqlQuery::RequestPost('usuario_delete');
          $clave_delete=md5(MysqlQuery::RequestPost('clave_delete'));
         
          $sql=Mysql::consulta("SELECT * FROM cliente WHERE nombre_usuario= '$usuario_delete' AND clave='$clave_delete'");

          if(mysqli_num_rows($sql)>=1){
             MysqlQuery::Eliminar("cliente", "clave='$clave_delete'");
             echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
          }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido eliminar la cuenta por que los datos son incorrectos
                    </p>
                </div>
            '; 
          }
        }*/
         
         
        /*Script para actualizar datos de cuenta*/
        if(isset($_POST['old_pass_update']) && isset($_POST['new_pass_update'])){

          $nombre_complete_update=utf8_encode(MysqlQuery::RequestPost('name_complete_update'));
          $old_user_update=MysqlQuery::RequestPost('old_user_update');
          $new_user_update=MysqlQuery::RequestPost('new_user_update');
          $old_pass_update=md5(MysqlQuery::RequestPost('old_pass_update'));
          $new_pass_update=md5(MysqlQuery::RequestPost('new_pass_update'));
          $email_update=MysqlQuery::RequestPost('email_update');
          $a_paterno=utf8_encode(MysqlQuery::RequestPost('a_paterno'));
          $a_materno=utf8_encode(MysqlQuery::RequestPost('a_materno'));
          
           $sql=Mysql::consulta("SELECT * FROM cliente WHERE id_cliente=".$_GET['id']);
           
          if(mysqli_num_rows($sql)>=1){
            if(Mysql::consulta("UPDATE cliente SET nombres='$nombre_complete_update', a_paterno='$a_paterno', a_materno='$a_materno', nombre_usuario='$new_user_update', clave='$new_pass_update', email_cliente='$email_update'  WHERE id_cliente=".$_GET['id'])){
            echo '
              <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="text-center">CUENTA ACTUALIZADA</h4>
                  <p class="text-center">
                    ¡Tus datos han sido actualizados correctamente!
                  </p>
              </div>
            ';
            }
          }else{
            echo '
              <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4 class="text-center">OCURRIO UN ERROR</h4>
                  <p class="text-center">
                    Asegurese que los datos ingresados son validos. Por favor intente nuevamente</p>
                  </p>
              </div>
            '; 
          }
        }
        ?>
        <div class="container">
          <div class="row well">
            <div class="col-sm-2">
              <img src="img/logomuni.png"  class="img-responsive"  width="190" height="150">
            </div>
            <div class="col-sm-9 lead">
            <?php
            if(isset($_GET['id'])){
              $variable = $_GET['id'];
              $idu=$variable;
              $sqlu=Mysql::consulta("SELECT * FROM cliente WHERE id_cliente='$idu'");
              $regu=mysqli_fetch_array($sqlu, MYSQLI_ASSOC);
            echo '<h2 class="text-info">Bienvenido a la configuración de cuenta ' . $regu['nombre_usuario'] . '</h2> ';
            }else{

            echo 'no hay una variable';
            }?>

              



              <p>Puedes <strong>actualizar la contraseña </strong> de tu cuenta , recuerda poner una contraseña que puedas recordar  </p>
            </div>
          </div><!--Fin row well-->
          <div class="container">
          <div class="row">
           <div class="col-sm-8">
              <div class="panel panel-info">
               <div class="panel-heading text-center"><i class="fa fa-retweet"></i>&nbsp;&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                <div class="panel-body text-center well">
                  <form action="" method="post" role="form">
                    <div class="form-group">
                      
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Nombre completo</label>
                      <input type="text" class="form-control" value="<?php echo $regu['nombres'];?>" autocomplete="off" placeholder="Nombres " name="name_complete_update"  title="Nombre Apellido" maxlength="60">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Apellido Paterno</label>
                      <input type="text" class="form-control" value="<?php echo $regu['a_paterno'];?>" autocomplete="off" placeholder="Apellido Paterno" name="a_paterno"  title="Nombre Apellido" maxlength="60">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Apellido Materno</label>
                      <input type="text" class="form-control" value="<?php echo $regu['a_materno']; ?>" autocomplete="off" placeholder="Apellido Materno" name="a_materno"  title="Nombre Apellido" maxlength="60">
                    </div>
                    <div class="form-group">
                      <label class="text-danger"><i class="fa fa-user"></i>&nbsp;&nbsp;Nombre de usuario actual</label>
                      <input type="text" class="form-control" value="<?php echo $regu['nombre_usuario'] ?>" placeholder="Nombre de usuario actual" autocomplete="off" name="old_user_update" title="Solo es validos letras y numeros no caracteres especiales" maxlength="20" pattern="[a-zA-Z0-9 ]{1,30}">
                    </div>
                    <div class="form-group  has-success has-feedback">
                      <label class="text-primary"><i class="fa fa-user"></i>&nbsp;&nbsp;Nombre de usuario nuevo</label>
                      <input type="text" class="form-control" id="input_user" placeholder="Nombre de usuario nuevo" name="new_user_update" pattern="[a-zA-Z0-9 ]{1,30}" title="Ejemplo7" maxlength="20">
                      <div id="com_form"></div>
                    </div>-->
                    <div class="form-group">
                      <label class="text-danger"><i class="fa fa-key"></i>&nbsp;&nbsp;Contraseña actual</label>
                      <input type="password" class="form-control" placeholder="Contraseña actual" name="old_pass_update">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Contraseña nueva</label>
                      <input type="password" class="form-control" placeholder="Nueva Contraseña" name="new_pass_update" >
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Email</label>
                      <input type="email" class="form-control"  placeholder="Escriba su email" autcomplete="off" value="<?php echo $regu['email_cliente'] ?>" name="email_update">
                    </div>
                    <button type="submit" class="btn btn-info">Actualizar datos</button>
                  </form>
                </div>
              </div>
            </div><!--Fin col 8--> 
            </div>
     <!--    <div class="col-sm-4 text-center well">
              <br><br><br><br><br><br><br><br>
              <img src="img/logomuni.png" alt="Image"><br><br><br>
           <button class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar cuenta</button>
              <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title text-center text-danger" id="myModalLabel">¿Deseas eliminar tu cuenta?</h4>
                    </div>
                    <form action="" method="post" role="form" style="padding:20px;">
                      <p class="text-warning">Si estas seguro que deseas eliminar tu cuenta por favor introduce tu nombre de usuario y contraseña</p>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="usuario_delete" placeholder="Nombre de usuario" required="">
                      </div><br>
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="clave_delete" placeholder="Contraseña" required="">
                      </div><br>
                      
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar cuenta</button>
                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancelar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>-->
              <br><br><br><br><br><br><br>
            </div>
          </div>
        </div>
<?php
}else{
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
                <img src="img/SadTux.png" alt="Image" class="img-responsive"/>
                
            </div>
            <div class="col-sm-7 animated flip">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados</h1>
                <h3 class="text-info text-center">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function(){
        $("#input_user").keyup(function(){
          $.ajax({
            url:"./process/val.php?id="+$(this).val(),
            success:function(data){
              $("#com_form").html(data);
            }
          });
        });
    });
</script>