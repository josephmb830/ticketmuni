
<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: 45px;height: 100vh;background-color: #27AFD7;padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700; font-size:20px;}.nav_link{position: relative;color: white;font-size:15px;margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}
</style>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="./img/avatar.png" alt=""> 
        <p><b><?php echo $_SESSION['nombre'];?></b></p>
        </div>
        
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"><img class="img_logo" src="./img/logo_magda.png" alt=""></a>
                <div class="nav_list"> <a href="./index.php" class="nav_link active"> <i class="fa fa-house"></i><span class="nav_name">Inicio</span> </a> 
                <?php if($_SESSION['tipo']=="user"){?>
                <a href="./ticketusuario.php" class="nav_link"> <i class="fa fa-ticket"></i> <span class="nav_name">Tickets</span> </a>                 
                <a href="./configuracion-user.php" class="nav_link"> <i class="fas fa-cog"></i> <span class="nav_name">Configuracion</span> </a> 
                <?php }if($_SESSION['tipo']=="tecnico"){?>
                <!-- <a href="./ticketusuario.php" class="nav_link"> <i class="fa fa-ticket"></i> <span class="nav_name">Tickets</span> </a> -->
                <a href="admin.php?view=ticketasig" class="nav_link"> <i class='fas fa-check'></i> <span class="nav_name">Mis Tickets</span> </a>                 
                <a href="./configuracion-user.php" class="nav_link"> <i class="fas fa-cog"></i> <span class="nav_name">Configuracion</span> </a> 
                <!-- <a href="./index.php?view=ticket" class="nav_link"> <i class="fa-solid fa-plus"></i> <span class="nav_name">Nuevo Ticket</span> </a>  -->
                <?php }if($_SESSION['tipo']=="admin"){?>
                <a href="admin.php?view=ticketadmin" class="nav_link"> <i class='fas fa-ticket'></i> <span class="nav_name">Tickets</span> </a>                 
                <a href="admin.php?view=ticketasig" class="nav_link"> <i class='fas fa-check'></i> <span class="nav_name">Mis Tickets</span> </a>                 
                <!-- <a href="/pdf" target="_blank" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Reportes</span> </a>           -->
                <a href="registro.php" class="nav_link"> <i class='fas fa-user'></i> <span class="nav_name">Registro de Usuario</span> </a> 
                <a href="registro_tecnico.php" class="nav_link"> <i class='fas fa-user'></i> <span class="nav_name">Registro de Técnico</span> </a> 
                <a href="admin.php?view=config" class="nav_link"> <i class='fas fa-cog'></i> <span class="nav_name">Registro de Administrador</span> </a> 
                <div class="dropdown">
                    <button class="bg-transparent border-none f-15"  id="menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-address-book"></i><span class="ml-2"> Administrar de Usuarios</span>
                    </button>
                    <div id="admin" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./admin.php?view=admin">Administrador</a>
                        <a class="dropdown-item" href="./admin.php?view=users">Usuario</a>
                        <a class="dropdown-item" href="./admin.php?view=tech">Técnico</a>
                    </div>
                </div>      
                
                <?php } ?>
            </div>
            </div>
            <a href="./process/logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Salir</span> </a>
        </nav>
    </div>
   
    <!--Container Main end-->
    <script type="text/javascript">
        $(document).ready(function(){
            var flag = false;
            $('#admin').hide();
            $('#menu').click(function(){
                if ( flag ){
                    $('#admin').show();
                }else{
                    $('#admin').hide();
                }
                flag = !flag;
            })
            document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) =>{
            const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)
            let icon= document.getElementsByClassName("img_logo");
                
            // Validate that all variables exist
            if(toggle && nav && bodypd && headerpd){
            toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            
            // add padding to header
            headerpd.classList.toggle('body-pd')
            })
            }
            }
            
            showNavbar('header-toggle','nav-bar','body-pd','header')
            
            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')
            
            function colorLink(){
            if(linkColor){
            linkColor.forEach(l=> l.classList.remove('active'))
            this.classList.add('active')
            }
            }
            linkColor.forEach(l=> l.addEventListener('click', colorLink))
            
                // Your code to run since DOM is loaded and ready
            });
        });
    </script>