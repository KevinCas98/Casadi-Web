<?php require "../src/app/collaborators/controller/_contentForm.php";?>

<div class="modal-header text-center">
    <h4 class="modal-title w-100" id="modalHeaderLabel">
        <i class="bi bi-person-plus header-icon" style="color:#eb5e6c;"></i><br/>
        <?php print $titleCollaborators ?> COLABORADOR
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <form class="row g-3" action="../collaborators/list" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <label for="inputName" class="form-label">NOMBRE</label>
                <input type="text" name="name" class="form-control" id="inputName" value="<?php echo $collaborators->getName() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputLastName" class="form-label" >APELLIDO</label>
                <input type="text" name="last_name" class="form-control" id="inputLastName" value="<?php echo $collaborators->getLastName() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputEmail" class="form-label" >CORREO ELECTRÓNICO</label>
                <input type="text" name="email" class="form-control" id="inputEmail" value="<?php echo $collaborators->getEmail() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputDni" class="form-label" >DNI</label>
                <input type="text" name="dni" class="form-control" id="inputDni" value="<?php echo $collaborators->getDni() ?>" required/>
            </div>
            <div class="col-md-6">
                <label for="inputInstitution" class="form-label">INSTITUCIÓN</label>
                <select name="institution" id="inputInstitution" class="form-select" required>
                        <option selected></option>
                    <?php foreach($listInstitution as $institution): ?>
                        <option value="<?php echo $institution->getId() ?>"><?php echo $institution->getName() ?> </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-12">
                <label for="inputUserName" class="form-label">NOMBRE DE USUARIO</label>
                <input type="text" name="user_name" class="form-control" id="inputUserName" value="<?php echo $collaborators->getUserName() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputPassword" class="form-label">CONTRASEÑA</label>
                <input type="text" name="password" class="form-control" id="inputPassword" value="<?php echo $collaborators->getPassword() ?>" required/>
            </div>

            <input type="hidden" name="id_collaborators" value="<?php echo $collaborators->getId() ?>" /> 
            
            <div class="col-12" style="text-align: center";>
                <button type="submit" class="btn btn-outline-success submit-btn">CONFIRMAR</button>
            </div>
        </form>
    </div>
</div>