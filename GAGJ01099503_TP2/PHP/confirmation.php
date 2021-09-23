
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Commande placée</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <link rel="stylesheet" type="text/css" href="../CSS/confirmation.css">

  </head>
  <body>
    <h1>Commande placée</h1>
    <div class="containerPlein">
      <div class="containerMoitie containerGauche" >
        <div class="containerTexte">
          <p class="textInfo">Nom du parent :</p>
          <p class="textInfo">Nom de l'enfant :</p>
          <p class="textInfo">École :</p>
          <p class="textInfo">Age de l'enfant :</p>
          <p class="textInfo">Repas du lundi :</p>
          <p class="textInfo">Repas du mardi :</p>
          <p class="textInfo">Repas du mercredi :</p>
          <p class="textInfo">Repas du jeudi :</p>
          <p class="textInfo">Repas du vendredi :</p>
        </div>
      </div>
      <div class="containerMoitie">
        <div class="containerTexte">
          <?php
            echo "<p>" . $_GET["nomParent"] . "</p>";
            echo "<p>" . $_GET["nomEnfant"] . "</p>";
            echo "<p>" . $_GET["ecole"] . "</p>";
            echo "<p>" . $_GET["age"] . "</p>";
            echo "<p>" . $_GET["nomLundi"] . "</p>";
            echo "<p>" . $_GET["nomMardi"] . "</p>";
            echo "<p>" . $_GET["nomMercredi"] . "</p>";
            echo "<p>" . $_GET["nomJeudi"] . "</p>";
            echo "<p>" . $_GET["nomVendredi"] . "</p>";
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
