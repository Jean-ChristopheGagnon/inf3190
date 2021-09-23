<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Plaintes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/plaintes.css">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
  </head>
  <body>
    <?php include ('../HTML/navbar.html'); ?>
    <h1>Faire une plainte</h1>
    <form action="action.php" method="post">
      <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" size="40" maxlength="40">
      </div>
      <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" size="40" maxlength="40">
      </div>
      <div>
        <label for="email">Adresse e-mail :</label>
        <input type="text" id="email" name="email" size="40" maxlength="100">
      </div>
      <div>
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" size="40" maxlength="40">
      </div>
      <div>
        <label for="commentaire">Commentaire :</label>
        <textarea id="commentaire" name="commentaire" cols="42" maxlength="400"></textarea>
      </div>
      <div class="boutons">
        <button type="reset">Vider</button>
        <button type="submit">Soumettre</button>
      </div>
    </form>
  </body>
</html>
