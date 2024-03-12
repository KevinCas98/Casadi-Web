<?php require "../src/app/stores/controller/_contentHistory.php" ?>

<div class="modal-header">
  <h4 class="modal-title">HISTORIAL</h4>
</div>
<div class="modal-body">
  <ul class="list-group-flush" id="recordList">
    <?php foreach ($arrayBenefit as $ab): ?>
      <li id="listItem"><?php echo $ab->getDateRecord(); ?> -- <?php echo $ab->getBenefit()->getName(); ?></li>
    <?php endforeach ?>  
  </ul>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">ACEPTAR</button>
</div>