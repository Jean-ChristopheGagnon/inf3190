<?php
function creerCarte ($csvLigne) {
  $arrayLigne = array_filter(explode(",", $csvLigne));
  ?>
  <div class="card w-50" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title"><?php echo $arrayLigne[1]; ?></h5>
      <h6 class="card-subtitle mb-2 text-muted"><?php echo $arrayLigne[2]; ?></h6>
      <p class="card-text"><?php echo $arrayLigne[5]; ?></p>
      <a href="<?php echo '../PHP/animal.php?id=' . $arrayLigne[0]; ?>" class="card-link">Visiter la page de cet animal</a>
    </div>
  </div>
  <?php
}
?>
