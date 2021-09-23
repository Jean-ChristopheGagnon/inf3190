<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Accueil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/accueil.css">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
  </head>
  <body>
    <?php include ('../HTML/navigation.html');
    include ('../PHP/fonctions.php'); ?>

    <h1>Accueil</h1>
    <p>
      Bienvenue sur le site de Un Ami. Vous pouvez adopter un de nos animaux ou
      donner le vôtre en adoption.
    </p>
    <?php
      if (!file_exists('../STORAGE/animaux.csv')) {
        file_put_contents('../STORAGE/animaux.csv', 'id,nom,type,race,age,desc,courriel,adresse,ville,cp');
      }
      $tousLesAnimaux = array_filter(explode("\n", file_get_contents('../STORAGE/animaux.csv')));
      $tousLesAnimaux = array_values ($tousLesAnimaux);
      $quantiteAnimaux = count($tousLesAnimaux) - 1;
      $indexAnimauxChoisis = [];
      $quantiteAnimauxChoisis = min($quantiteAnimaux, 5);
      while (count($indexAnimauxChoisis) < $quantiteAnimauxChoisis) {
        $nombreAleatoire = rand(1, $quantiteAnimaux);
        if (!(in_array($nombreAleatoire, $indexAnimauxChoisis))) {
          array_push($indexAnimauxChoisis, $nombreAleatoire);
          creerCarte ($tousLesAnimaux[$nombreAleatoire]) ;
        }
      }
      ?>


  </body>
</html>
