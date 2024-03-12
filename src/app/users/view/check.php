<?php require "../src/app/users/controller/check.php" ?>
<link href="../../src/app/users/web/css/users.css" rel="stylesheet">
<section>
    <div class="row">
        <div class="col-sm-1">
            <div class="input-group" style="text-align: center">
                <span class="input-group-append">
                    <button onclick="location.href='../users/list'" class="btn" type="button">
                        <i class="bi bi-x-circle-fill icon-uncheck"></i>
                    </button>
                    <span class="uncheck">RECHAZAR</span>
                </span>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="user-title">
                <span class="user-text-style-1">USUARIO: <?php echo $users->getName()?> <?php echo $users->getLastName()?> </span>
                <br/>
                <span class="user-text-style-1">DNI: <?php echo $users->getDni() ?></span>
            </div>

            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                <?php $d = 0 ?>
                    <?php foreach ($arrayFilesByUser as $af): ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $d ?>" <?php if($d == 0): ?> class="active" aria-current="true" <?php endif ?>></button>
                        <?php $d++ ?>
                    <?php endforeach; ?>  
                </div>
                <div class="carousel-inner">
                    <?php $x = 1 ?>
                    <?php foreach ($arrayFilesByUser as $af): ?>
                        <div class="carousel-item <?php if($x == 1): ?> active <?php endif ?> ">
                            <img src="<?php echo "../upload/users/".$af->getIdUser()."/".$af->getPath() ?>" class="d-block w-100" styles>
                        </div>
                        <?php $x++ ?>
                    <?php endforeach; ?>    
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="container-data my-3">
                <form id="basic-form" action="../users/list" method="post"> 
                    <input type="hidden" name="id_users" value="<?php print $userId ?>">
                    
                    <div class="row gx-4 mt-4 mx-5">
                        <p class="text-center fs-3">COMPLETAR PREGUNTAS</p>
                        <p class="text-center form-subtitle">¿El nombre, apellido y DNI coinciden con el usuario?</p>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <input class="btn-check" type="radio" name="data_match" id="radio1" value="1" required>
                        <label for="radio1" class="btn btn-danger">SI</label>
                        
                        <input class="btn-check" type="radio" name="data_match" id="radio2" value="0" required>
                        <label for="radio2" class="btn btn-danger">NO</label>
                    </div>

                    <p class="text-center form-subtitle">¿Cuántas Dosis tiene aplicadas el usuario?</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <input class="btn-check" type="radio" name="doses_applied" id="radio3" value="1" required>
                        <label for="radio3" class="btn btn-danger">1°</label>
                        <input class="btn-check" type="radio" name="doses_applied" id="radio4" value="2" required>
                        <label for="radio4" class="btn btn-danger">2°</label>
                        <input class="btn-check" type="radio" name="doses_applied" id="radio5" value="3" required>
                        <label for="radio5" class="btn btn-danger">3°</label>
                        <input class="btn-check" type="radio" name="doses_applied" id="radio6" value="4" required>
                        <label for="radio6" class="btn btn-danger">4°</label>
                    </div>

                    <div> 
                        <?php $x = 1;?>
                        <?php while($x <= $users->getDoseQuantity()): ?> 
                            <?php $vaccines = new Vaccines()?>
                            <?php $vaccines->countVaccines()?>
                            <div class="row gx-4 mt-4 mx-5">
                                <div class="col">
                                        <label for="Dose" class="form-label"><?php echo $x ?>° DOSIS</label>
                                        <p class="fs-6">Vacuna</p>
                                        <select name="<?php print "vaccines_sel_".$x  ?>" class="form-select" aria-label="vaccineSelect" required> 
                                            <option selected></option>
                                            <?php if($vaccines->getCount()>0): ?>
                                                <?php $listVaccines = $vaccines->getAllVaccines()?> 
                                                    <?php foreach ($listVaccines as $vaccines):?>
                                                        <option value="<?php echo $vaccines->getId() ?>"><?php echo $vaccines->getName() ?></option>
                                                    <?php endforeach;?>
                                            <?php endif; ?>
                                        </select>
                                </div>
                                <div class="col">
                                    <label for="date" class="form-label formDate">FECHA</label>
                                    <p class="fs-6">Fecha</p>
                                    <input type="date" name=<?php print "date_vaccines_".$x ?> class="form-control" required>
                                </div>
                            </div>
                            <?php $x++; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="d-grid gap-2 my-5 mx-5 submitValidation">
                        <input type="submit" id="basic-form" name=validar value="VALIDAR" class="btn btn-success btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>    
</section> 