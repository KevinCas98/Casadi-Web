<!-- <link href="../../src\app\home\web\css\home.css" rel="stylesheet"> -->
<?php if(!empty($_SESSION["user_id"])):?>
<header id="header" class="menu">
    <nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-3">
            <a class="navbar-brand" href="#">
            <img src="../img/logo_muni_blanco_(1)@3x.png" alt="" class="d-inline-block align-text-bottom">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" style="color:white" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left: 5%;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 barra">
                    <li class="nav-item">
                        <a class="nav-link <?php if($folderPath == "home"): ?> active-menu <?php endif ?>" aria-current="page" href="../home/dashboard">INICIO</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($folderPath == "users"): ?> active-menu <?php endif ?>" aria-current="page" href="../users/list">USUARIOS</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($folderPath == "collaborators"): ?> active-menu <?php endif ?>" aria-current="page" href="../collaborators/list">COLABORADORES</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($folderPath == "stores"): ?> active-menu <?php endif ?>" aria-current="page" href="../stores/list">COMERCIOS</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($folderPath == "news"): ?> active-menu <?php endif ?>" aria-current="page" href="../news/list">NOVEDADES</a> 
                    </li>
                </ul> 
                <a href="../login/logout">Cerrar Sesión</a>  
            </div>    
    </div>
    </nav>
</header>
<?php endif; ?>  