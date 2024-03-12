<?php require "../src/app/home/controller/dashboard.php" ?>
<link href="../../src/app/home/web/css/home.css" rel="stylesheet">
<section>
    <div class="row row-cols-1 row-cols-md-3 g-5 mx-auto my-auto">
        <div class="col">
            <div class="card">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <p class="card-text">USUARIOS</p>
                    <a href="../users/list" class="btn btn-danger stretched-link"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                <p class="card-text">COMERCIOS PROMOTORES</p>
                <a href="../stores/list" class="btn btn-danger stretched-link"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <p class="card-text">NOVEDADES DEL MUNICIPIO</p>
                    <a href="../news/list" class="btn btn-danger stretched-link"></a>
                </div>
            </div>
        </div>
        <?php if($rol == "super_admin"): ?>
            <div class="col">
                <div class="card">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">COLABORADORES</p>
                        <a href="../collaborators/list" class="btn btn-danger stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">ESTADISTICAS</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">CUENTA CORRIENTE (próx.)</p>
                    </div>
                </div>
            </div>
        <?php endif ?>    
    </div>
</section>