<?php require "../src/app/stores/controller/_contentBenefit.php" ?>

<div class="modal-header">
  <h4 class="modal-title">BENEFICIOS</h4>
</div>
<div class="modal-body">
  <label>BENEFICIO</label>
    <p>
      <?php echo $benefits->getName()." - Pin: ".$benefits->getPin()?>
    </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">ACEPTAR</button>
</div>