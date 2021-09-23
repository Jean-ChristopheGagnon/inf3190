function clearUneErreur (spanId) {
  document.getElementById(spanId).innerHTML = "";
  document.getElementById(spanId).style.color = "";
}

function clearToutesErreurs(){
  clearUneErreur("erreur-nom");
  clearUneErreur("erreur-type");
  clearUneErreur("erreur-race");
  clearUneErreur("erreur-age");
  clearUneErreur("erreur-description");
  clearUneErreur("erreur-courriel");
  clearUneErreur("erreur-adresse");
  clearUneErreur("erreur-ville");
  clearUneErreur("erreur-code-postal");
}

function validerChampRempli(inputId, spanId) {
    var champ = document.getElementById(inputId).value;

    if(champ == null || champ === ""){
        document.getElementById(spanId).innerHTML = document.getElementById(spanId).innerHTML + "Ce champ est obligatoire. ";
        document.getElementById(spanId).style.color = "red";
        return false;
    }
    return true;
}

function validerPasVirgule (inputId, spanId) {
  if (document.getElementById(inputId).value.includes(",")) {
    document.getElementById(spanId).innerHTML = document.getElementById(spanId).innerHTML + "Aucun champ ne doit contenir de virgule. ";
    document.getElementById(spanId).style.color = "red";
    return false;
  } else {
    return true;
  }
}

function validerLongeurNom () {
  var nom = document.getElementById("inputNom").value;
  if (nom.length < 3 || nom.length > 20) {
    document.getElementById("erreur-nom").innerHTML = document.getElementById("erreur-nom").innerHTML + "Le nom de l'animal doit comporter de 3 à 20 charactères. ";
    document.getElementById("erreur-nom").style.color = "red";
    return false;
  } else {
    return true;
  }
}

function validerFormatCourriel () {
  var re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  if (re.test(document.getElementById("inputCourriel").value)) {
    return true;
  } else {
    document.getElementById("erreur-courriel").innerHTML = document.getElementById("erreur-courriel").innerHTML + "Le courriel doit être correctement formaté. ";
    document.getElementById("erreur-courriel").style.color = "red";
    return false;
  }
}

function validerFormatCodePostal() {
  var re = /^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i;
  if (re.test(document.getElementById("inputCodePostal").value)) {
    return true;
  } else {
    document.getElementById("erreur-code-postal").innerHTML = document.getElementById("erreur-code-postal").innerHTML + "Le code postal doit être correctement formaté. ";
    document.getElementById("erreur-code-postal").style.color = "red";
    return false;
  }
}

function validerNom () {
  var boolRempli =  validerChampRempli("inputNom", "erreur-nom");
  var boolVirgule = validerPasVirgule ("inputNom", "erreur-nom");
  var boolLongueur = validerLongeurNom();
  return boolRempli && boolVirgule && boolLongueur;
}

function validerType () {
  var boolRempli =  validerChampRempli("inputType", "erreur-type");
  var boolVirgule = validerPasVirgule ("inputType", "erreur-type");
  return boolRempli && boolVirgule;
}

function validerRace () {
  var boolRempli =  validerChampRempli("inputRace", "erreur-race");
  var boolVirgule = validerPasVirgule ("inputRace", "erreur-race");
  return boolRempli && boolVirgule;
}

function validerAge () {
  var age = Number(document.getElementById("inputAge").value);
  if (Number.isInteger(age) && age >= 0 && age <= 30) {
    return true;
  } else {
    document.getElementById("erreur-age").innerHTML = document.getElementById("erreur-age").innerHTML + "L'âge de l'animal doit se situer entre 0 et 30 inclusivement. ";
    document.getElementById("erreur-age").style.color = "red";
    return false;
  }
}

function validerDescription () {
  var boolRempli = validerChampRempli("inputDescription", "erreur-description");
  var boolVirgule = validerPasVirgule ("inputDescription", "erreur-description");
  return boolRempli && boolVirgule;
}

function validerCourriel () {
  var boolRempli = validerChampRempli("inputCourriel", "erreur-courriel");
  var boolVirgule = validerPasVirgule ("inputCourriel", "erreur-courriel");
  var boolFormat = validerFormatCourriel();
  return boolRempli && boolVirgule && boolFormat;
}

function validerAdresse () {
  var boolRempli = validerChampRempli("inputAdresse", "erreur-adresse");
  var boolVirgule = validerPasVirgule ("inputAdresse", "erreur-adresse");
  return boolRempli && boolVirgule;
}

function validerVille () {
  var boolRempli = validerChampRempli("inputVille", "erreur-ville");
  var boolVirgule = validerPasVirgule ("inputVille", "erreur-ville");
  return boolRempli && boolVirgule;
}

function validerCodePostal () {
  var boolRempli = validerChampRempli("inputCodePostal", "erreur-code-postal");
  var boolVirgule = validerPasVirgule ("inputCodePostal", "erreur-code-postal")
  var boolFormat = validerFormatCodePostal();
  return boolRempli && boolVirgule && boolFormat;
}

function validerFormulaire(){
  clearToutesErreurs();
  var nomValide = validerNom();
  var typeValide = validerType();
  var raceValide = validerRace();
  var ageValide = validerAge();
  var descriptionValide = validerDescription();
  var courrielValide = validerCourriel();
  var adresseValide =  validerAdresse();
  var villeValide = validerVille ();
  var codePostalValide =  validerCodePostal ();
  return nomValide && typeValide && raceValide && ageValide && descriptionValide && courrielValide && adresseValide && villeValide && codePostalValide;
}
