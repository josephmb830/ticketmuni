<?php 
    $nombre=MysqlQuery::RequestPost("nombre_login");
    $clave=md5(MysqlQuery::RequestPost("contrasena_login"));
    $radio=MysqlQuery::RequestPost('optionsRadios');
    if($nombre!="" && $clave!="" && $radio!=""){
        if($radio=="admin"){
            $sql=Mysql::consulta("SELECT * FROM administrador WHERE nombre_admin= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_admin'];
                $_SESSION['id']=$reg['id_admin'];
                $_SESSION['dni']=$reg['id_admin'];
                $_SESSION['nombre_completo']=$reg['nombre_completo'];
                $_SESSION['email']=$reg['email_admin'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="admin";
                $_SESSION['cargo']=$reg['cargo'];
                $_SESSION['type'] = 'admin';

            }else{
               echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }elseif($radio=="user"){
            $sql=Mysql::consulta("SELECT * FROM cliente WHERE nombre_usuario= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_usuario'];
                $_SESSION['id']=$reg['id_cliente'];
                $_SESSION['dni']=$reg['dni'];
                $_SESSION['nombre_completo'] = $reg['nombres'] . ' ' . $reg['a_paterno'] . ' ' . $reg['a_materno'];
                $_SESSION['email']=$reg['email_cliente'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="user";
                $_SESSION['cargo']=$reg['cargo'];
                $_SESSION['area']=$reg['area'];
                $_SESSION['type'] = 'user';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }elseif($radio=="tecnico"){
            $sql=Mysql::consulta("SELECT * FROM tecnico WHERE nombre_tecnico= '$nombre' AND clave='$clave'");
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_tecnico'];
                $_SESSION['id']=$reg['id_tecnico'];
                $_SESSION['dni']=$reg['dni'];
                $_SESSION['nombre_completo'] = $reg['nombres_tecnico'] . ' ' . $reg['a_paterno_tecnico'] . ' ' . $reg['a_materno_tecnico'];
                $_SESSION['email']=$reg['email_tecnico'];
                $_SESSION['clave']=$clave;
                $_SESSION['tipo']="tecnico";
                $_SESSION['cargo']=$reg['cargo'];
                $_SESSION['area']=$reg['area'];
                $_SESSION['type'] = 'tecnico';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
                        </p>
                    </div>
                '; 
            }
        }else if ( $radio === 'sadmin'){
            $sql=Mysql::consulta("SELECT * FROM superadmins WHERE nombre_admin= '$nombre' AND clave='$clave'"); 
            if(mysqli_num_rows($sql)>=1){
                $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
                $_SESSION['nombre']=$reg['nombre_completo'];
                $_SESSION['id']=$reg['id'];
                $_SESSION['dni']=$reg['dni'];
                $_SESSION['nombre_completo'] = $reg['nombre_completo'];
                $_SESSION['nombre_admin']=$reg['nombre_admin'];
                $_SESSION['clave']=$clave;
                $_SESSION['email_admin']=$reg['email_admin'];
                $_SESSION['cargo']=$reg['cargo'];
                $_SESSION['clave']=$reg['clave'];
                $_SESSION['tipo']="admin";
                $_SESSION['type'] = 'sadmin';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            Nombre de usuario o contraseña incorrectos
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
                        No has seleccionado un usuario valido
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
                    No puedes dejar ningún campo vacío
                </p>
            </div>
        ';
    }