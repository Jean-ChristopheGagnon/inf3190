<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Recherche</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php include ('../HTML/navigation.html');?>
    <link rel="stylesheet" type="text/css" href="../CSS/recherche.css">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <?php include ('../PHP/fonctions.php'); ?>
    <h1>Recherche</h1>
    <p>Voici les résultats de votre recherche.</p>
    <?php
    if (!isset($_GET['inputRecherche'])) {
      exit;
    }
    if ($_GET['inputRecherche'] == "") {
      exit;
    }
    if (!file_exists('../STORAGE/animaux.csv')) {
      file_put_contents('../STORAGE/animaux.csv', 'id,nom,type,race,age,desc,courriel,adresse,ville,cp');
    }
    $tousLesAnimaux = array_filter(explode("\n", file_get_contents('../STORAGE/animaux.csv')));
    $inputRecherche = $_GET['inputRecherche'];
    $sautePremiereLigne = True;
    foreach ($tousLesAnimaux as $csvLigne) {
      if ($sautePremiereLigne) {
        $sautePremiereLigne = False;
      } else {
        $sautePremierChamp = True;
        $trouve = False;
        $arrayLigne = array_filter(explode(",", $csvLigne));
        foreach ($arrayLigne as $champ){
          if ($sautePremierChamp) {
            $sautePremierChamp = False;
          } elseif (strpos(strtolower($champ), strtolower($inputRecherche)) !== false) {
            $trouve = True;
          }
        }
        if ($trouve) {
          creerCarte($csvLigne);
        }
      }
    }
    ?>
  </body>
</html>
