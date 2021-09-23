<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Donner</title>
    <meta charset="utf-8">
  </head>
  <body>
    <?php include ('../HTML/navigation.html');?>
    <link rel="stylesheet" type="text/css" href="../CSS/donner.css">
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <script src="../JS/donner.js"></script>
    <?php
    $nomAvant = "";
    $typeAvant = "";
    $raceAvant = "";
    $ageAvant = 0;
    $descriptionAvant = "";
    $courrielAvant = "";
    $adresseAvant = "";
    $villeAvant = "";
    $codePostalAvant = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!isset($_POST["inputNom"]) || !isset($_POST["inputType"]) || !isset($_POST["inputRace"]) || !isset($_POST["inputAge"])
       || !isset($_POST["inputDescription"]) || !isset($_POST["inputCourriel"]) || !isset($_POST["inputAdresse"]) || !isset($_POST["inputVille"]) || !isset($_POST["inputCodePostal"])) {
        // TODO Valider que la valeur de l'âge est numérique et dans les valeurs
        // acceptées.
        http_response_code(400);
        exit;
      }
      $nomAvant = $_POST["inputNom"];
      $typeAvant = $_POST["inputType"];
      $raceAvant = $_POST["inputRace"];
      $ageAvant = $_POST["inputAge"];
      $descriptionAvant = $_POST["inputDescription"];
      $courrielAvant = $_POST["inputCourriel"];
      $adresseAvant = $_POST["inputAdresse"];
      $villeAvant = $_POST["inputVille"];
      $codePostalAvant = $_POST["inputCodePostal"];

      if (validerFormulaireBackend()) {
        $idNouveau = sauvegarderAnimal ();
        header("Location: animal.php?id=" . $idNouveau, true, 303);
        exit;
      }
    }
    function validerChampRempli($input) {
      if ($input == "") {
        return false;
      } else {
        return true;
      }
    }

    function validerSansVirgule ($input) {
      if (strpos($input, ',') !== false) {
        return false;
      } else {
        return true;
      }
    }

    function validerNomAnimal () {
      $nomAnimal = $_POST["inputNom"];
      if (strlen($nomAnimal) >= 3 && strlen($nomAnimal) <= 20) {
        return true;
      } else {
        return false;
      }
    }

    function validerAgeAnimal () {
      $input = $_POST["inputAge"];
      return ((string)(int)$input == $input && (int)$input >= 0 && (int)$input <= 30);
    }

    function validerFormatCourriel() {
      return filter_var($_POST["inputCourriel"], FILTER_VALIDATE_EMAIL);
    }

    function validerFormatCodePostal() {
      $exp = "/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i";
      return preg_match($exp, $_POST["inputCodePostal"]);
    }

    function validerTousChampsRemplis () {
      return validerChampRempli($_POST["inputNom"]) && validerChampRempli($_POST["inputType"]) && validerChampRempli($_POST["inputRace"]) && validerChampRempli($_POST["inputAge"]) && validerChampRempli($_POST["inputDescription"]) && validerChampRempli($_POST["inputCourriel"]) && validerChampRempli($_POST["inputAdresse"]) && validerChampRempli($_POST["inputVille"]) && validerChampRempli($_POST["inputCodePostal"]);
    }

    function validerTousChampsSansVirgule () {
      return validerSansVirgule ($_POST["inputNom"]) && validerSansVirgule ($_POST["inputType"]) && validerSansVirgule ($_POST["inputRace"]) && validerSansVirgule ($_POST["inputAge"]) && validerSansVirgule ($_POST["inputDescription"]) && validerSansVirgule ($_POST["inputCourriel"]) && validerSansVirgule ($_POST["inputAdresse"]) && validerSansVirgule ($_POST["inputVille"]) && validerSansVirgule ($_POST["inputCodePostal"]);
    }

    function validerFormulaireBackend() {
      return validerTousChampsRemplis() && validerTousChampsSansVirgule() && validerNomAnimal() && validerAgeAnimal() && validerFormatCourriel() && validerFormatCodePostal();
    }

    function sauvegarderAnimal () {
      $tousLesAnimaux = array_filter(explode("\n", file_get_contents('../STORAGE/animaux.csv')));
      array_shift ($tousLesAnimaux);
      $idIntMax = 0;
      foreach ($tousLesAnimaux as $csvLigne) {
        $arrayLigne = array_filter(explode(",", $csvLigne));
        $idInt = (int)substr($arrayLigne[0], 1);
        $idIntMax = max($idIntMax, $idInt);
      }
      $idFinal = "X" . (string)($idIntMax + 1);
      $csvString = "\n" . $idFinal . "," . $_POST["inputNom"] . "," . $_POST["inputType"] . "," . $_POST["inputRace"] . "," . $_POST["inputAge"] . "," . $_POST["inputDescription"] . "," . $_POST["inputCourriel"] . "," . $_POST["inputAdresse"] . "," . $_POST["inputVille"] . "," . standardiseCodePostal($_POST["inputCodePostal"]);
      $fichier = fopen("../STORAGE/animaux.csv", "a+") or die("Impossible de sauvegarder l'animal.");
      fwrite($fichier, $csvString);
      fclose($fichier);
      return $idFinal;
    }

    function standardiseCodePostal ($input) {
      return strtoupper(substr($input,0,3) . " " . substr($input,strlen($input)-3,3));
    }
    ?>

    <h1>Donner</h1>
    <p>Vous pouvez inscrire un de vos animaux pour l'adoption.</p>
    <form method="post" onsubmit="return validerFormulaire();">
      <div class="form-container w-50">
        <div class="form-group">
          <label for="inputNom">Nom</label>
          <input class="form-control" id="inputNom" name="inputNom" aria-describedby="nomAide" placeholder="Nom de l'animal" <?php echo "value='{$nomAvant}'"?>>
          <span id="erreur-nom"></span>
        </div>
        <div class="form-group">
          <label for="inputType">Type</label>
          <input class="form-control" id="inputType" name="inputType" placeholder="Type de l'animal" <?php echo "value='{$typeAvant}'"?>>
          <span id="erreur-type"></span>
        </div>
        <div class="form-group">
          <label for="inputRace">Race</label>
          <input class="form-control" id="inputRace" name="inputRace" placeholder="Race de l'animal" <?php echo "value='{$raceAvant}'"?>>
          <span id="erreur-race"></span>
        </div>
        <div class="form-group">

          <label for="inputAge">Âge</label>
          <select name="inputAge" id="inputAge" placeholder="Âge de l'animal">
            <?php
            for($i = 0; $i <= 30; $i++){
              if ($i == $ageAvant) {
                $selected = "selected='selected'";
              } else {
                $selected = "";
              }
              echo "<option value='{$i}' {$selected}>{$i}</option>";
            }
            ?>
          </select>
          <span id="erreur-age"></span>
        </div>
        <div class="form-group">
          <label for="inputDescription">Description</label>
          <textarea class="form-control" id="inputDescription" name="inputDescription" placeholder="Description de l'animal" rows="3"><?php echo "{$descriptionAvant}"?></textarea>
          <span id="erreur-description"></span>
        </div>
        <div class="form-group">
          <label for="inputCourriel">Courriel</label>
          <input class="form-control" id="inputCourriel" name="inputCourriel" placeholder="Votre courriel" <?php echo "value='{$courrielAvant}'"?>>
          <span id="erreur-courriel"></span>
        </div>
        <div class="form-group">
          <label for="inputAdresse">Adresse</label>
          <input class="form-control" id="inputAdresse" name="inputAdresse" placeholder="Adresse de l'animal" <?php echo "value='{$adresseAvant}'"?>>
          <span id="erreur-adresse"></span>
        </div>
        <div class="form-group">
          <label for="inputVille">Ville</label>
          <input class="form-control" id="inputVille" name="inputVille" placeholder="Ville" <?php echo "value='{$villeAvant}'"?>>
          <span id="erreur-ville"></span>
        </div>
        <div class="form-group">
          <label for="inputCodePostal">Code Postal</label>
          <input class="form-control" id="inputCodePostal" name="inputCodePostal" placeholder="Code Postal" <?php echo "value='{$codePostalAvant}'"?>>
          <span id="erreur-code-postal"></span>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
      </div>
    </form>
  </body>
</html>
