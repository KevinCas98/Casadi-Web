<?php require "../src/app/users/controller/list.php";
require "../src/app/stores/view/contentModal.php" ?>
<link href="../../src/app/users/web/css/users.css" rel="stylesheet">

<section class="section-title">
    <div class="abm-title">
        <span>
            <span class="text-style-1">ABM USUARIOS</span>
            TOTAL USUARIOS - <span class="text-style-2"></span> <?php echo $users->getCount() ?>
        </span>
        <form action="" method="GET">
            <div class="input-group" style="padding-top: 25px; width: 255px;">
                <span class="input-group-append">
                    <button class="btn btn-outline-secondary bg-white border-end-0 border ms-n5" type="submit" name="send">
                        <i class="bi bi-search"></i>
                    </button>
                </span>
                <input class="form-control border-star-0 border" name="search" type="text" id="example-search-input" placeholder="Buscar usuario">
            </div>  
        </form>
    </div>    
</section>   

<section class="section-body">
    <div class="table-responsive">
        <div class="conteiner mf-5">
            <ul class="pagination pagination-sm justify-content-end">
                <?php if($page > 1): ?>
                    <li class="page-item"><a href="?page=<?php echo 1;?>" class="page-link"><<</a></li>
                    <li class="page-item"><a href="?page=<?php echo $page-1;?>" class="page-link"><</a></li>
                <?php endif ?>
                
                <?php if($totalPages > 1): ?>
                    <?php  for($i=1;$i<=$totalPages;$i++): ?>
                        <li class='page-item'>
                        <a href='?page=<?php echo $i ?>' class='page-link <?php if($page==$i): echo "actived-select"; else: echo ""; endif?>'><?php echo $i ?></a>
                        </li>
                    <?php endfor?>
                <?php endif ?>

                <?php if($page+1 <= $totalPages): ?>
                    <li class="page-item"><a href="?page=<?php echo $page+1;?>" class="page-link">></a></li>
                    <li class="page-item"><a href="?page=<?php echo $totalPages?>" class="page-link">>></a></li>
                <?php endif ?>
            </ul>
        </div>
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">USUARIOS</th>
                <th scope="col">DNI</th>
                <th scope="col">VACUNACÍON</th>
                <th scope="col">LOCALIDAD</th>
                <th scope="col">BENEFICIOS</th>
                <th scope="col">SEXO</th>
                <th scope="col">TIPO</th>
                <th scope="col">ESTADO</th>
                <th scope="col">VALIDAR</th>
            </tr>
        </thead>
        <tbody>
            <?php if($users->getCount()>0): ?>
                <?php $listUsers = $users->getAllUser($page,$search) ?> 
                <?php foreach ($listUsers as $s): ?>
                    <tr>
                        <td><?php echo $s->getName() ?>
                        <td><?php echo $s->getDni() ?></td>
                        <td><?php echo $s->getDoseQuantity() ?></td>
                        <td><?php echo $s->getProvince() ?> </td>
                        <td><button type="button" class="btn btn-link btn-sm open-modal" data-src="../users/_contentBenefit?id=<?php echo $s->getId() ?>">VER</button></td>
                        <td><?php echo $s->getSex() ?> </td>
                        <td><?php echo $s->getTypeOfCard() ?> </td>
                        <td><?php echo $s->getNameStatus($s->getChecked()) ?> </td>
                        <td>
                            <?php if($s->getChecked() == 0 ): ?> <i class="bi bi-person-dash-fill incomplete"></i> <?php endif ?>
                            <?php if($s->getChecked() == 1 ): ?> <a href= "../users/check?id_user=<?php echo $s->getId() ?>" ><i class="bi bi-person-plus-fill verify"></i></a> <?php endif ?>
                            <?php if($s->getChecked() == 2 ): ?> <i class="bi bi-person-check-fill verified"></i> <?php endif ?> 
                        </td>
                    </tr>
                <?php endforeach; ?> 
            <?php endif; ?>
        </tbody>
        </table>
        <div class="conteiner mf-5">
            <ul class="pagination pagination-sm justify-content-end">
                <?php if($page > 1): ?>
                    <li class="page-item"><a href="?page=<?php echo 1;?>" class="page-link"><<</a></li>
                    <li class="page-item"><a href="?page=<?php echo $page-1;?>" class="page-link"><</a></li>
                <?php endif ?>
                <?php if($totalPages > 1): ?>
                    <?php  for($i=1;$i<=$totalPages;$i++): ?>
                            <li class='page-item'>
                            <a href='?page=<?php echo $i ?>' class='page-link <?php if($page==$i): echo "actived-select"; else: echo ""; endif?>'><?php echo $i ?></a>
                            </li>
                    <?php endfor?>
                <?php endif ?>
                <?php if($page+1 <= $totalPages): ?>
                    <li class="page-item"><a href="?page=<?php echo $page+1;?>" class="page-link">></a></li>
                    <li class="page-item"><a href="?page=<?php echo $totalPages?>" class="page-link">>></a></li>
                <?php endif ?>
            </ul>
        </div>
    </div>    
</section>