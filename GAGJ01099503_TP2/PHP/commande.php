<?php
  function trouverVirgule($input){
    if (strpos($input, ',') !== false){
      return true;
    } else {
      return false;
    }
  }

  function verifierNomParent($nomParent, $message){
    if (empty($nomParent)) {
      $message = $message . "Le nom complet du parent est obligatoire.<br>";
    } else if (trouverVirgule($nomParent)) {
      $message = $message . "Le nom complet du parent ne peut pas contenir de virgule.<br>";
    }
    return $message;
  }

  function verifierNomEnfant($nomEnfant, $message){
    if (empty($nomEnfant)) {
      $message = $message . "Le nom complet de l'enfant est obligatoire.<br>";
    } else if (trouverVirgule($nomEnfant)) {
      $message = $message . "Le nom complet de l'enfant ne peut pas contenir de virgule.<br>";
    }
    return $message;
  }

  function verifierNomEcole($ecole, $message){
    if (empty($ecole)) {
      $message = $message . "Le nom de l'école est obligatoire.<br>";
    } else if (trouverVirgule($ecole)) {
      $message = $message . "Le nom de l'école ne peut pas contenir de virgule.<br>";
    }
    return $message;
  }

  function verifierAge($age, $message){
    if (empty($age)) {
      $message = $message . "L'âge de l'enfant est obligatoire.<br>";
    } else if (!is_int($age) || $age < 4 || $age > 12) {
      $message = $message . "Veuillez entrer un âge entre 4 et 12 inclusivement.<br>";
    }
    return $message;
  }

  function sauverCommande($nomParent, $nomEnfant, $ecole, $age, $nomLundi, $nomMardi, $nomMercredi, $nomJeudi, $nomVendredi) {
    $commandes = fopen('../STORAGE/commandes.txt', 'a+');
    fwrite($commandes, "Parent:" . $nomParent . ", Enfant:" . $nomEnfant . ", Age:" . $age . ", Ecole:" . $ecole . ", Lundi:" . $nomLundi . ", Mardi:" . $nomMardi . ", Mercredi:" . $nomMercredi . ", Jeudi:" . $nomJeudi . ", Vendredi:" . $nomVendredi . "\n");
    fclose($commandes);
  }

  $menuLundi = ["Spaghetti", "Omelette"];
  $menuMardi = ["Salade de quinoa", "Salade de poulet"];
  $menuMercredi = ["Pain de viande", "Chili"];
  $menuJeudi = ["Lasagne", "Salade végétarienne"];
  $menuVendredi = ["Cannelloni au fromage", "Gaspacho"];

  $message = "";
  $nomParent = "";
  $nomEnfant = "";
  $ecole = "";
  $age = 0;
  $repasLundi = 0;
  $repasMardi = 0;
  $repasMercredi = 0;
  $repasJeudi = 0;
  $repasVendredi = 0;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["nom-parent"]) || !isset($_POST["nom-enfant"]) || !isset($_POST["ecole"]) ||  !isset($_POST["age"])) {
      http_response_code(400);
      exit;
    }
    $nomParent = $_POST["nom-parent"];
    $nomEnfant = $_POST["nom-enfant"];
    $ecole = $_POST["ecole"];
    $age = intval($_POST["age"]);
    $message = verifierNomParent($nomParent, $message);
    $message = verifierNomEnfant($nomEnfant, $message);
    $message = verifierNomEcole($ecole, $message);
    $message = verifierAge($age, $message);
    if (isset($_POST['repas-lundi'])) {
      $repasLundi = $_POST["repas-lundi"];
    } else {
      $message = $message . "Veuillez sélectionner un repas pour le lundi.<br>";
    }
    if (isset($_POST['repas-mardi'])) {
      $repasMardi = $_POST["repas-mardi"];
    } else {
      $message = $message . "Veuillez sélectionner un repas pour le mardi.<br>";
    }
    if (isset($_POST['repas-mercredi'])) {
      $repasMercredi = $_POST["repas-mercredi"];
    } else {
      $message = $message . "Veuillez sélectionner un repas pour le mercredi.<br>";
    }
    if (isset($_POST['repas-jeudi'])) {
      $repasJeudi = $_POST["repas-jeudi"];
    } else {
      $message = $message . "Veuillez sélectionner un repas pour le jeudi.<br>";
    }
    if (isset($_POST['repas-vendredi'])) {
      $repasVendredi = $_POST["repas-vendredi"];
    } else {
      $message = $message . "Veuillez sélectionner un repas pour le vendredi.<br>";
    }
    if (empty($message)) {
      sauverCommande($nomParent, $nomEnfant, $ecole, $age, $menuLundi[$repasLundi - 1], $menuMardi[$repasMardi - 1], $menuMercredi[$repasMercredi - 1], $menuJeudi[$repasJeudi - 1], $menuVendredi[$repasVendredi - 1]);
      header("Location: confirmation.php?nomParent={$nomParent}&nomEnfant={$nomEnfant}&ecole={$ecole}&age={$age}&nomLundi={$menuLundi[$repasLundi - 1]}&nomMardi={$menuMardi[$repasMardi - 1]}&nomMercredi={$menuMercredi[$repasMercredi - 1]}&nomJeudi={$menuJeudi[$repasJeudi - 1]}&nomVendredi={$menuVendredi[$repasVendredi - 1]}", true, 303);
      exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Commande</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <link rel="stylesheet" type="text/css" href="../CSS/commande.css">

  </head>
  <body>
    <?php include ('../HTML/navigation.html'); ?>
    <div id="container">
      <h1>Formulaire de commande</h1>
      <?php if (!empty($message)) {
              echo "<p class='message'>{$message}</p>";
            }
       ?>
      <form method="post" action="commande.php">
        <div class="ligne-form">
          <label class="enonce" for="nom-parent">Nom du parent: </label>
          <?php echo "<input type='text' name='nom-parent' class='champs-input' id='nom-parent' value='{$nomParent}'>"; ?>
        </div>
        <br>
        <div class="ligne-form">
          <label class="enonce" for="nom-enfant">Nom de l'enfant: </label>
          <?php echo "<input type='text' name='nom-enfant' class='champs-input' id='nom-enfant' value='{$nomEnfant}'>"; ?>
        </div>
        <br>
        <div class="ligne-form">
          <label class="enonce" for="ecole">École de l'enfant: </label>
          <?php echo "<input type='text' name='ecole' class='champs-input' id='ecole' value='{$ecole}'>"; ?>
        </div>
        <br>
        <div class="ligne-form">
          <label class="enonce" for="age">Âge de l'enfant : </label>
          <select class='champs-input' name="age" id="age">
            <?php
              for($i = 4; $i <= 12; $i++) {
                if ($i == $age) {
                  $selected = "selected='selected'";
                } else {
                  $selected = "";
                }
                echo "<option value='{$i}' {$selected}>{$i}</option>";
              }
            ?>
          </select>
        </div>
        <div class="rangee">
          <p class="journee">Lundi : </p>
          <div class="container-repas">
            <div class="repas">
              <?php
                if ($repasLundi == 1) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-lundi' value=1 id='repas-lundi-1' {$checked}>";
              ?>
              <label for="repas-lundi-1">
                <img src="../IMAGES/lundi1.jpg" />
              </label>
              <br>
              <label for="repas-lundi-1">Spaghetti: pâtes au boeuf haché et à la sauce tomate garnies de fromage.</label>
            </div>
            <div class="repas">
              <?php
                if ($repasLundi == 2) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-lundi' value=2 id='repas-lundi-2' {$checked}>";
              ?>
              <label for="repas-lundi-2">
                <img src="../IMAGES/lundi2.jpg" />
              </label>
              <br>
              <label for="repas-lundi-2">Omelette: omelette aux oeufs, jambon et fromage avec un accompagnement de laitue.</label>
            </div>
          </div>
        </div>
        <div class="rangee">
          <p class="journee">Mardi : </p>
          <div class="container-repas">
            <div class="repas">
              <?php
                if ($repasMardi == 1) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-mardi' value=1 id='repas-mardi-1' {$checked}>";
              ?>
              <label for="repas-mardi-1">
                <img src="../IMAGES/mardi1.jpg" />
              </label>
              <br>
              <label for="repas-mardi-1">Salade de quinoa: salade contenant du quinoa, des tomates, des oignons, des concombres et autres légumes.</label>
            </div>
            <div class="repas">
              <?php
                if ($repasMardi == 2) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-mardi' value=2 id='repas-mardi-2' {$checked}>";
              ?>
              <label for="repas-mardi-2">
                <img src="../IMAGES/mardi2.jpg" />
              </label>
              <br>
              <label for="repas-mardi-2">Salade de poulet: salade contenant des lanières de poulet, de l'ananas, des avocats et d'autres légumes.</label>
            </div>
          </div>
        </div>
        <div class="rangee">
          <p class="journee">Mercredi : </p>
          <div class="container-repas">
            <div class="repas">
              <?php
                if ($repasMercredi == 1) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-mercredi' value=1 id='repas-mercredi-1' {$checked}>";
              ?>
              <label for="repas-mercredi-1">
                <img src="../IMAGES/mercredi1.jpg" />
              </label>
              <br>
              <label for="repas-mercredi-1">Pain de viande: pain de viande à la sauce barbecue agrémenté d'une fine touche d'épices et de persil.</label>
            </div>
            <div class="repas">
              <?php
                if ($repasMercredi == 2) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-mercredi' value=2 id='repas-mercredi-2' {$checked}>";
              ?>
              <label for="repas-mercredi-2">
                <img src="../IMAGES/mercredi2.jpg" />
              </label>
              <br>
              <label for="repas-mercredi-2">Chili: chili au voeuf haché et aux fèves piquantes. Attention ce plat est épicé.</label>
            </div>
          </div>
        </div>
        <div class="rangee">
          <p class="journee">Jeudi : </p>
          <div class="container-repas">
            <div class="repas">
              <?php
                if ($repasJeudi == 1) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-jeudi' value=1 id='repas-jeudi-1' {$checked}>";
              ?>
              <label for="repas-jeudi-1">
                <img src="../IMAGES/jeudi1.jpg" />
              </label>
              <br>
              <label for="repas-jeudi-1">Lasagne: lanières de pâte séparant des couches de boeuf haché, sauce tomate et fromage.</label>
            </div>
            <div class="repas">
              <?php
                if ($repasJeudi == 2) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-jeudi' value=2 id='repas-jeudi-2' {$checked}>";
              ?>
              <label for="repas-jeudi-2">
                <img src="../IMAGES/jeudi2.jpg" />
              </label>
              <br>
              <label for="repas-jeudi-2">Salade végétarienne: salade contenant du tofu, des zucchinis et des épices.</label>
            </div>
          </div>
        </div>
        <div class="rangee">
          <p class="journee">Vendredi : </p>
          <div class="container-repas">
            <div class="repas">
              <?php
                if ($repasVendredi == 1) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-vendredi' value=1 id='repas-vendredi-1' {$checked}>";
              ?>
              <label for="repas-vendredi-1">
                <img src="../IMAGES/vendredi1.jpg" />
              </label>
              <br>
              <label for="repas-vendredi-1">Cannelloni au fromage: rouleaux de pâte contenant du fromage et recouvert d'une sauce aux légumes.</label>
            </div>
            <div class="repas">
              <?php
                if ($repasVendredi == 2) {
                  $checked = "checked='checked'";
                } else {
                  $checked = "";
                }
                echo "<input type='radio' name='repas-vendredi' value=2 id='repas-vendredi-2' {$checked}>";
              ?>
              <label for="repas-vendredi-2">
                <img src="../IMAGES/vendredi2.jpg" />
              </label>
              <br>
              <label for="repas-vendredi-2">Gaspacho: soupe de tomates froide contenant des crevettes et plusieurs épices.</label>
            </div>
          </div>
        </div>
        <br>
        <br>
        <input type="submit" value="Commander">
      </form>
    </div>
  </body>
</html>
