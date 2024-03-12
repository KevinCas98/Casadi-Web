<?php require "../src/app/news/controller/_contentForm.php";
?>

<div class="modal-header text-center">
    <h4 class="modal-title w-100" id="modalHeaderLabel">
        <i class="bi bi-newspaper header-icon" style="color:#eb5e6c;"></i><br/>
        <?php print $titleNews ?> NOVEDADES
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <form class="row g-3" action="../news/list" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <label for="inputTitle" class="form-label">TÍTULO</label>
                <input type="text" name="title" class="form-control" id="inputTitle" value="<?php echo $news->getTitle() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputDescription" class="form-label" >DESCRIPCIÓN</label>
                <textarea class="form-control" name="description" id="inputDescription" required><?php echo $news->getDescription() ?></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Elija una imágen (Cuadrada)</label>
                <input class="form-control" type="file" id="formFile" name="image" onChange="upload('formFile', 'img', 'imagen_hidden')">
                <br/><img src=<?php echo $news->getImage() ?> alt="image" id="img" <?php if($news->getImage() == ""): ?> style="display: none" <?php endif ?> class="img-fluid avatar-md" width="50" height="50">&nbsp;&nbsp;
                <input type="hidden" id="imagen_hidden" name="imagen_hidden" value="<?php echo $news->getImage() ?>" />
            </div>

            <input type="hidden" name="id_news" value="<?php echo $news->getId() ?>" /> 
            
            <div class="col-12" style="text-align: center";>
                <button type="submit" class="btn btn-outline-success submit-btn">CONFIRMAR</button>
            </div>
        </form>
    </div>
</div>