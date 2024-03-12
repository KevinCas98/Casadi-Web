<?php require "../src/app/stores/controller/_contentForm.php" ?>
<link href="../../src/app/stores/web/css/stores.css" rel="stylesheet">

<div class="modal-header text-center">
    <h4 class="modal-title w-100" id="modalHeaderLabel">
        <i class="bi bi-shop header-icon" style="color:#eb5e6c;"></i><br/>
        <?php print $titleStore ?> COMERCIO PROMOTOR
    </h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <form class="row g-3" action="../stores/list" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <label for="inputName" class="form-label">NOMBRE</label>
                <input type="text" name="name" class="form-control" id="inputName" value="<?php echo $store->getName() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputCuit" class="form-label">CUIT</label>
                <input type="text" name="cuit" class="form-control" id="inputCuit" value="<?php echo $store->getCuit() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">DIRECCIÓN</label>
                <input type="text" name="address" class="form-control" id="inputAddress" value="<?php echo $store->getAddress() ?>" required/>
            </div>
            <div class="col-md-6">
                <label for="inputRubro" class="form-label">RUBRO</label>
                <select name="category" id="inputRubro" class="form-select" required>
                        <option selected></option>
                    <?php foreach($listCategories as $lc): ?>
                        <option value="<?php echo $lc->getId() ?>" <?php echo $store->getIdCategory()==$lc->getId()?"selected":"" ?>><?php echo $lc->getName() ?> </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-12">
                <label for="inputBenefit" class="form-label">BENEFICIO</label>
                <input type="text" name="benefit_name" class="form-control" id="inputBenefit" value="<?php echo $benefit->getName() ?>" required/>
            </div>
            <div class="col-12">
                <label for="inputConditions" class="form-label" >CONDICIONES</label>
                <textarea class="form-control" name="benefit_conditions" id="inputConditions" required><?php echo $benefit->getConditions() ?></textarea>
            </div>
            <div class="col-md-12">
                <label for="inputWeb" class="form-label">SITIO WEB</label>
                <input type="text" name="web" class="form-control" id="inputWeb" value="<?php echo $store->getWeb() ?>"/>
            </div>
            <div class="col-md-12">
                <label for="inputInstagram" class="form-label">INSTAGRAM</label>
                <input type="text" name="instagram" class="form-control" id="inputInstagram" value="<?php echo $store->getInstagram() ?>"/>
            </div>
            <div class="col-md-12">
                <label for="inputWhatsapp" class="form-label">WHATSAPP</label>
                <input type="text" name="whatsapp" class="form-control" id="inputWhatsapp" value="<?php echo $store->getWhatsapp() ?>"/>
            </div>
            <div class="col-md-12">
                <label for="inputPhone" class="form-label">TELÉFONO</label>
                <input type="text" name="phone" class="form-control" id="inputPhone" value="<?php echo $store->getPhone() ?>"/>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Elija una imágen (Cuadrada)</label>
                <input class="form-control" type="file" id="formFile1" onChange="upload('formFile1', 'img1', 'imagen1_hidden')">
                <br/><img src=<?php echo $store->getImage1() ?> alt="image" id="img1" <?php if($store->getImage1() == ""): ?> style="display: none" <?php endif ?> class="img-fluid avatar-md" width="50" height="50">&nbsp;&nbsp;
                <input type="hidden" id="imagen1_hidden" name="imagen1_hidden" value="<?php echo $store->getImage1() ?>" />
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Elija una segunda imágen (Rectangular)</label>
                <input class="form-control" type="file" id="formFile2" onChange="upload('formFile2', 'img2', 'imagen2_hidden')">
                <br/><img src=<?php echo $store->getImage1() ?> alt="image" id="img2" <?php if($store->getImage1() == ""): ?> style="display: none" <?php endif ?> class="img-fluid avatar-md" width="50" height="50">&nbsp;&nbsp;
                <input type="hidden" id="imagen2_hidden" name="imagen2_hidden" value="<?php echo $store->getImage1() ?>" />
            </div>
            <div>
                <h6 class="modal-subtitle" id="contact">CONTACTO</h6> 
            </div>
            <div class="col-md-12">
                <label for="inputContactName" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" name="contact_name" id="inputContactName" value="<?php echo $contact->getName() ?>" required/>
            </div>
            <div class="col-md-12">
                <label for="inputContactLastName" class="form-label">APELLIDO</label>
                <input type="text" class="form-control" name="contact_last_name" id="inputContactLastName" value="<?php echo $contact->getLastName() ?>" required/>
            </div>
            <div class="col-md-12">
                <label for="inputPhone" class="form-label">CELULAR</label>
                <input type="text" class="form-control" name="contact_cellphone" id="inputPhone" value="<?php echo $contact->getCellPhone() ?>" required/>
            </div>
            <div class="col-md-12">
                <label for="inputPhone" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo $contact->getEmail() ?>" required/>
            </div>
            <input type="hidden" name="id_store" value="<?php echo $store->getId() ?>" /> 
            <input type="hidden" name="id_benefit" value="<?php echo $benefit->getId() ?>" /> 
            <input type="hidden" name="id_contact" value="<?php echo $contact->getId() ?>" /> 
            <input type="hidden" name="benefit_pin" value="<?php echo $benefit->getPin() ?>" /> 
            <div class="col-12" style="text-align: center";>
                <button type="submit" class="btn btn-outline-success submit-btn">CONFIRMAR</button>
            </div>
        </form>
    </div>
</div>