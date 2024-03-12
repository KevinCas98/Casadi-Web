<?php require "../src/app/stores/controller/_contentContact.php" ?>

<div class="modal-header">
  <h4 class="modal-title">CONTACTO</h4>
</div>
<div class="modal-body">
  <label>NOMBRE Y APELLIDO</label>
    <p>
      <?php echo $contact->getName()." ".$contact->getLastName() ?>
    </p>
  <label>TELÉFONO</label>
    <p>
      <?php echo $contact->getCellPhone() ?>
    </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">ACEPTAR</button>
</div>