<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Page d'un animal</title>
    <meta charset="utf-8">

  </head>
  <body>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <link rel="stylesheet" type="text/css" href="../CSS/animal.css">
    <?php include ('../HTML/navigation.html');
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
      $id = $_GET["id"];
      $tousLesAnimaux = array_filter(explode("\n", file_get_contents('../STORAGE/animaux.csv')));
      $bonArrayAnimal = [];
      foreach ($tousLesAnimaux as $ligneAnimal) {
        $arrayAnimal = explode(",", $ligneAnimal);
        if ($id == $arrayAnimal[0]) {
          $bonArrayAnimal = $arrayAnimal;
          break;
        }
      }
      if (sizeof($bonArrayAnimal) > 0) {?>
        <dl class="row">
          <dt class="text-right col-sm-6">Nom:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[1]; ?></dd>

          <dt class="text-right col-sm-6">Type:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[2]; ?></dd>

          <dt class="text-right col-sm-6">Race:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[3]; ?></dd>

          <dt class="text-right col-sm-6">Âge:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[4]; ?></dd>

          <dt class="text-right col-sm-6">Description:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[5]; ?></dd>

          <dt class="text-right col-sm-6">Courriel:</dt>
          <dd class="col-sm-6"><a href = "mailto: <?php echo $bonArrayAnimal[6]; ?>"><?php echo $bonArrayAnimal[6]; ?></a></dd>

          <dt class="text-right col-sm-6">Adresse:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[7]; ?></dd>


          <dt class="text-right col-sm-6">Ville:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[8]; ?></dd>

          <dt class="text-right col-sm-6">Code Postal:</dt>
          <dd class="col-sm-6"><?php echo $bonArrayAnimal[9]; ?></dd>
        </dl>
      <?php } else { ?>
             <h1>Cette page n'existe pas.</h1>
      <?php }
      } else {?>
        <h1>Cette page n'existe pas.</h1>
<?php }?>
  </body>
</html>
