<?php
  if (validerDonnees()) {
    sauverPlainte();
    echo "Plainte envoyée avec succès.";
  }

  function sauverPlainte() {
    $plaintes = fopen('../STORAGE/plaintes.txt', 'a+');
    fwrite($plaintes, $_POST["nom"]."|".$_POST["prenom"]."|".$_POST["email"]."|".$_POST["telephone"]."|".$_POST["commentaire"]."\n");
    fclose($plaintes);
  }

  function trouveBar($string) {
    if (strpos($string, "|") !== FALSE) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function validerNom(){
    $longueurMax = 40;
    if (empty($_POST["nom"])) {
      echo "Veuillez entrer un nom.<br>";
      return FALSE;
    } elseif (strlen($_POST["nom"]) > $longueurMax) {
      echo "Veuillez entrer un nom d'au plus ".$longueurMax." charactères.<br>";
      return FALSE;
    } elseif (trouveBar($_POST["nom"])) {
      echo "L'utilisation du charactère '|' n'est pas permise dans le nom.<br>";
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function validerPrenom(){
    $longueurMax = 40;
    if (empty($_POST["prenom"])) {
      echo "Veuillez entrer un prénom.<br>";
      return FALSE;
    } elseif (strlen($_POST["prenom"]) > $longueurMax) {
      echo "Veuillez entrer un prénom d'au plus ".$longueurMax." charactères.<br>";
      return FALSE;
    } elseif (trouveBar($_POST["prenom"])) {
      echo "L'utilisation du charactère '|' n'est pas permise dans le prénom.<br>";
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function validerEmail() {
    $longueurMin = 5;
    $longueurMax = 100;
    if (strlen($_POST["email"]) < $longueurMin) {
      echo "Veuillez entrer un e-mail d'au moins ".$longueurMin." charactères.<br>";
      return FALSE;
    } elseif (strlen($_POST["email"]) > $longueurMax) {
      echo "Veuillez entrer un e-mail d'au plus ".$longueurMax." charactères.<br>";
      return FALSE;
    } elseif (trouveBar($_POST["email"])) {
      echo "L'utilisation du charactère '|' n'est pas permise dans le e-mail.<br>";
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function validerTelephone() {
    $longueurMin = 5;
    $longueurMax = 40;
    if (strlen($_POST["telephone"]) < $longueurMin) {
      echo "Veuillez entrer un numéro de téléphone d'au moins ".$longueurMin." charactères.<br>";
      return FALSE;
    } elseif (strlen($_POST["telephone"]) > $longueurMax) {
      echo "Veuillez entrer un numéro de téléphone d'au plus ".$longueurMax." charactères.<br>";
      return FALSE;
    } elseif (trouveBar($_POST["telephone"])) {
      echo "L'utilisation du charactère '|' n'est pas permise dans le numéro de téléphone.<br>";
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function validerCommentaire() {
    $longueurMax = 400;
    if (empty($_POST["commentaire"])) {
      echo "Veuillez entrer un commentaire.<br>";
      return FALSE;
    } elseif (strlen($_POST["commentaire"]) > $longueurMax) {
      echo "Veuillez entrer un commentaire d'au plus ".$longueurMax." charactères.<br>";
      return FALSE;
    } elseif (trouveBar($_POST["commentaire"])) {
      echo "L'utilisation du charactère '|' n'est pas permise dans le commentaire.<br>";
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function validerDonnees(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['commentaire'])) {
        $nom = validerNom();
        $prenom = validerPrenom();
        $email = validerEmail();
        $telephone = validerTelephone();
        $commentaire = validerCommentaire();
        return $nom && $prenom && $email && $telephone && $commentaire;
      } else {
        echo "Il manque une partie du formulaire. Veuillez réessayer.<br>";
        return FALSE;
      }
    } else {
      echo "Une erreur est survenue. Veuillez réessayer.<br>";
      return FALSE;
    }
  }
?>
