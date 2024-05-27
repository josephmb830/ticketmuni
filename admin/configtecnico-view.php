<?php if($_SESSION['nombre']!="" && $_SESSION['tipo']=="admin"){ 

/* Guardar nuevo admin */
if(isset($_POST['nom_admin_reg']) && isset($_POST['admin_reg']) && isset($_POST['admin_clave_reg'])){

    $nom_complete_save=MysqlQuery::RequestPost('nom_admin_reg');
    $nom_admin_save=MysqlQuery::RequestPost('admin_reg');
    $pass_save=md5(MysqlQuery::RequestPost('admin_clave_reg'));
    $email_save=MysqlQuery::RequestPost('admin_email_reg');
    $cargo_save=MysqlQuery::RequestPost('admin_cargo_reg');

   if(MysqlQuery::Guardar("administrador", "nombre_completo, nombre_admin, clave, email_admin,cargo", "'$nom_complete_save', '$nom_admin_save', '$pass_save', '$email_save','$cargo_save'")){
       echo '
            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">ADMINISTRADOR REGISTRADO</h4>
                <p class="text-center">
                    El administrador se registro con exito en el sistema
                </p>
            </div>
        ';
   }else{
       echo '
            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">ADMINISTRADOR REGISTRADO</h4>
                <p class="text-center">
                    El administrador se registro con exito en el sistema
                </p>
            </div>
        ';
   } 
}


    
    
   /* Actualizar cuenta admin */
    
    if( isset($_POST['old_nom_admin_up'])){
        $sql = "UPDATE tecnico SET ";
        $nom_complete_update=utf8_encode(MysqlQuery::RequestPost('name_complete_update'));
        $tx = [];
        if ( $nom_complete_update ){
            array_push($tx, "nombres_tecnico='$nom_complete_update'");
        }
        $nom_admin_update=utf8_encode(MysqlQuery::RequestPost('admin_up'));
        if ( $nom_admin_update ){
            array_push($tx, "nombre_tecnico='$nom_admin_update'");
        }
        $pass_admin_update=md5(MysqlQuery::RequestPost('admin_clave_up'));
        if ( $pass_admin_update ){
            array_push($tx, "clave='$pass_admin_update'");
        }
        $old_pass_admin_uptade=md5(MysqlQuery::RequestPost('old_admin_clave_up'));
        $email_admin_update=MysqlQuery::RequestPost('admin_email_up');
        if ( $email_admin_update ){
            array_push($tx, "email_tecnico='$email_admin_update'");
        }
        $a_paterno=utf8_encode(MysqlQuery::RequestPost('a_paterno'));
        if ( $a_paterno ){
            array_push($tx, "a_paterno_tecnico='$a_paterno'");
        }
        $a_materno=utf8_encode(MysqlQuery::RequestPost('a_materno'));
        if ( $a_materno ){
            array_push($tx, "a_materno_tecnico='$a_materno'");
        }
        foreach( $tx as $field){
            if ( end($tx) != $field ){
                $sql .= $field . ', '; 
            }else{
                $sql .= $field . " WHERE id_tecnico=".$_GET['id'];
            }
        }
        $tecnico =Mysql::consulta("SELECT * FROM tecnico WHERE id_tecnico=".$_GET['id']);
        if(mysqli_num_rows($tecnico)>=1){
          try{
            //if(MysqlQuery::Actualizar("tecnico", "nombres_tecnico='$nom_complete_update', nombre_tecnico='$nom_admin_update', clave='$pass_admin_update', email_tecnico='$email_admin_update'")){
              if(Mysql::consulta($sql)){
                echo '
                    <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">ADMINISTRADOR ACTUALIZADO</h4>
                        <p class="text-center">
                            El administrador se actualizo con exito
                        </p>
                    </div>
                ';
              
              
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido actualizar el administrador
                        </p>
                    </div>
                ';
            }
          }
          catch( Exception $e){
            echo var_dump($e);
          }
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
       }
    }
    
    /*Script para eliminar cuenta*/
     if(isset($_POST['nom_admin_delete']) && isset($_POST['admin_clave__delete'])){
         $nom_admin_delete=MysqlQuery::RequestPost('nom_admin_delete');
         $clave_admin_delete=md5(MysqlQuery::RequestPost('admin_clave__delete'));
         $sql=Mysql::consulta("SELECT * FROM administrador WHERE nombre_admin= '$nom_admin_delete' AND clave='$clave_admin_delete'");
         if(mysqli_num_rows($sql)>=1){
            if(MysqlQuery::Eliminar("administrador", "nombre_admin='$nom_admin_delete' and clave='$clave_admin_delete'")){
                echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido eliminar el administrador
                        </p>
                    </div>
                ';
            }
         }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
         }
     }
    ?>
    <div class="container">
      <br><br>        
      
      <div class="flex">
          <div class="col-sm-8">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-info">
                     <div class="panel-heading text-center"><i class="fa fa-refresh"></i>&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                     <div class="panel-body">
                        <?php
                            $idad=$_GET['id'];
                            $sql1=Mysql::consulta("SELECT * FROM tecnico WHERE id_tecnico=".$_GET['id']);
                            $reg1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);
                            
                        ?>
                         <form role="form" action="" method="POST">
                         <div class="form-group">
                      
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Nombres</label>
                      <input type="text" class="form-control" value="<?php echo $reg1['nombres_tecnico'];?>" autocomplete="off" placeholder="Nombres " name="name_complete_update"  title="Nombre Apellido" maxlength="60">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Apellido Paterno</label>
                      <input type="text" class="form-control" value="<?php echo $reg1['a_paterno_tecnico'];?>" autocomplete="off" placeholder="Apellido Paterno" name="a_paterno"  title="Nombre Apellido" maxlength="60">
                    </div>
                    <div class="form-group">
                      <label class="text-primary"><i class="fa fa-male"></i>&nbsp;&nbsp;Apellido Materno</label>
                      <input type="text" class="form-control" value="<?php echo $reg1['a_materno_tecnico']; ?>" autocomplete="off" placeholder="Apellido Materno" name="a_materno"  title="Nombre Apellido" maxlength="60">
                    </div>
                         <div class="form-group">
                           <label><i class="fa fa-user"></i>&nbsp;Nombre de administrador anterior</label>
                           <input type="text" class="form-control" autocomplete="off" value="<?php echo $reg1['nombre_tecnico']; ?>" name="old_nom_admin_up" placeholder="Nombre anterior de administrador" title="Solo es validos letras y numeros no caracteres especiales" maxlength="20" pattern="[a-zA-Z0-9 ]{1,30}">
                         </div>
                         <div class="form-group has-success has-feedback">
                           <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nuevo nombre de tecnico</label>
                           <input type="text" id="input_user2" autocomplete="off" class="form-control" name="admin_up" placeholder="Nombre de administrador" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                           <div id="com_form2"></div>
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Contraseña anterior</label>
                           <input type="password" class="form-control" autocomplete="off" name="old_admin_clave_up" placeholder="Contraseña anterior">
                         </div>
                             <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Nueva contraseña</label>
                           <input type="password" class="form-control" autocomplete="off" name="admin_clave_up" placeholder="Nueva contraseña">
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                           <input type="email" class="form-control" autocomplete="off" value="<?php echo $reg1['email_tecnico']; ?>" name="admin_email_up"  placeholder="Email administrador" required="">
                         </div><button type="submit" class="btn btn-info">Actualizar datos</button>
                       </form>
                     </div>
                   </div>
                   </div>
              </div><!--Fin row-->
          </div><!--Fin class col-md-4-->
      </div><!-- Fin row-->
      
    </div>
<?php
}else{
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
            <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
            
        </div>
        <div class="col-sm-7 animated flip">
            <h1 class="text-danger">Lo sentimos esta página es solamente para administradores de LinuxStore</h1>
            <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
        </div>
        <div class="col-sm-1">&nbsp;</div>
    </div>
</div>
<?php
}
?>