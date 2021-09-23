<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Adopter</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php include ('../HTML/navigation.html');?>
    <link rel="stylesheet" type="text/css" href="../CSS/adopter.css">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <?php include ('../PHP/fonctions.php'); ?>
    <h1>Adopter</h1>
    <p>
      Voici la liste de tous nos animaux disponibles pour l'adoption.
    </p>
    <?php
    if (!file_exists('../STORAGE/animaux.csv')) {
      file_put_contents('../STORAGE/animaux.csv', 'id,nom,type,race,age,desc,courriel,adresse,ville,cp');
    }
    $tousLesAnimaux = array_filter(explode("\n", file_get_contents('../STORAGE/animaux.csv')));
    $sautePremiereLigne = True;
    foreach ($tousLesAnimaux as $csvLigne) {
      if ($sautePremiereLigne) {
        $sautePremiereLigne = False;
      } else {
        creerCarte($csvLigne);
      }
    }
    ?>
  </body>
</html>
