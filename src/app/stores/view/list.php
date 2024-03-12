<?php require "../src/app/stores/controller/list.php";
require "../src/app/stores/view/contentModal.php" ?>
<link href="../../src/app/stores/web/css/stores.css" rel="stylesheet">

<section class="section-title">
    <div class="row">
        <div class="col-sm">
            <div class="abm-title" style="width: 260px;">
                <span>
                    <span class="text-style-1">COMERCIOS PROMOTORES </span>
                    TOTAL COMERCIOS - <span class="text-style-2"><?php echo $stores->getCount() ?></span>
                </span>
                <form action="" method="GET">
                    <div class="input-group" style="padding-top: 25px; width: 255px;">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary bg-white border-end-0 border ms-n5" type="submit" name="send">
                                <i class="bi bi-search"></i>
                            </button>
                        </span>
                        <input class="form-control border-star-0 border" name="search" type="text" id="example-search-input" placeholder="Buscar comercio">
                    </div>  
                </form>
            </div>
        </div>
        <div class="col-sm">
            <div class="store-group">
                <div class="add-store">
                    <button type="button" class="btn btn-danger modal-btn open-modal" data-src="../stores/_contentForm" >
                        <i class="bi bi-shop user-icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-body">
    <?php if($show_alert == 1): ?>
        <div class="alert alert-success" role="alert">
            Los cambios se realizaron correctamente!
        </div>
    <?php elseif($show_alert == 0): ?>
        <div class="alert alert-danger" role="alert">
            No se pudieron realizar los cambios correctamente!
        </div>
    <?php endif; ?>   
    
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
                <th scope="col"></th>
                <th scope="col">COMERCIO</th>
                <th scope="col">CUIT</th>
                <th scope="col">DIRECCIÓN</th>
                <th scope="col">HISTORIAL</th>
                <th scope="col">RUBRO</th>
                <th scope="col">BENEFICIO</th>
                <th scope="col">CONTACTO</th>
            </tr>
        </thead>
        <tbody>
            <?php if($stores->getCount()>0): ?>
                <?php $listStores = $stores->getAllStores($page,$search) ?> 
                <?php foreach ($listStores as $s): ?>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-success edit-btn open-modal" data-src="../stores/_contentForm?id=<?php echo $s->getId() ?>"> 
                              <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        <td>
                            <img src=<?php echo $s->getImage1() ?> alt="image" class="img-fluid avatar-md rounded-circle" width="50">&nbsp;&nbsp;
                            <?php echo $s->getName() ?>
                        </td>
                        <td><?php echo $s->getCuit() ?></td>
                        <td><?php echo $s->getAddress() ?> </td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm open-modal" data-src="../stores/_contentHistory?id=<?php echo $s->getId() ?>">VER</button>
                        </td>
                        <td><?php echo $s->getCategory()->getName() ?></td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm open-modal" data-src="../stores/_contentBenefit?id=<?php echo $s->getId() ?>">VER</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-link btn-sm open-modal" data-src="../stores/_contentContact?id=<?php echo $s->getId() ?>">VER</button>
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