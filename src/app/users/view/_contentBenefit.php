<?php require "../src/app/users/controller/_contentBenefit.php";?>

<div class="modal-header text-center">
  <h4 class="modal-title text-center">BENEFICIOS</h4>
</div>
<div class="modal-body">
  <label>BENEFICIO</label>
    <p>
      <?php
          foreach ($listRecordBenefit as $r):
            echo $r->getBenefit()->getName();
            echo "<br>";
          endforeach;
      ?>
    </p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">ACEPTAR</button>
</div>