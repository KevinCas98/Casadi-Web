<?php 
    require "../src/app/collaborators/controller/list.php";
    require "../src/app/collaborators/view/contentModal.php" 
?>
<link href="../../src/app/collaborators/web/css/collaborators.css" rel="stylesheet">
<section class="section-title">
    <div class="row">
        <div class="col-sm">
            <div class="abm-title" style="width: 260px;">
                <span>
                    <span class="text-style-1">COLABORADORES</span>
                    TOTAL COLABORADORES - <span class="text-style-2"><?php echo $collaborators->getCount() ?></span>
                </span>
                <form action="" method="GET">
                    <div class="input-group" style="padding-top: 25px; width: 255px;">
                        <span class="input-group-append">
                            <button class="btn btn-outline-secondary bg-white border-end-0 border ms-n5" type="submit" name="send">
                                <i class="bi bi-search"></i>
                            </button>
                        </span>
                        <input class="form-control border-star-0 border" name="search" type="text" id="example-search-input" placeholder="Buscar colaborador">
                    </div>  
                </form>    
            </div>
        </div>
        <div class="col-sm">
            <div class="collaborators-group">
                <div class="add-collaborators">
                    <button type="button" class="btn btn-danger modal-btn open-modal" data-src="../collaborators/_contentForm" >
                        <i class="bi bi-person-plus user-icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-body">
    <?php if($show_alert == 1): ?>
        <div class="alert alert-success" role="alert">
            El registro de colaboradores se cargó correctamente!
        </div>
    <?php elseif($show_alert == 0): ?>
        <div class="alert alert-danger" role="alert">
            No se pudo crear el registro!
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
                <th scope="col">NOMBRE</th>
                <th scope="col">APELLIDO</th>
                <th scope="col">CORREO</th>
            </tr>
        </thead>

        <tbody>
            <?php if($collaborators->getCount()>0): ?>
                <?php $listCollaborators = $collaborators->getAllCollaborators($page,$search) ?> 
                <?php foreach ($listCollaborators as $collaborators): ?>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-success edit-btn open-modal" data-src="../collaborators/_contentForm?id=<?php echo $collaborators->getId() ?>"> 
                              <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                        <td>
                            <?php echo $collaborators->getName() ?>
                        </td>
                        <td>
                            <?php echo $collaborators->getLastName() ?>
                        </td>
                        <td>
                            <?php echo $collaborators->getEmail() ?>
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