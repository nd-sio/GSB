<?php

/**
 * Gestion de la validation des frais par le comptable
 *
 * PHP Version 8
 *
 * 
 */
use Outils\Utilitaires;

$idVisiteurSelectionne = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$moisSelectionne = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$correctionFraisForfait = filter_input(INPUT_GET, 'correctionFraisForfait', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$validationCas = filter_input(INPUT_GET, 'validationCas', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$validationInfo = filter_input(INPUT_GET, 'validationInfo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lesVisiteurs = $pdo->getAllVisiteurs();
$lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionne);

//on vérifie que le mois courant forcé dans action et selectionné par défaut est dans la liste des mois des fiches du visiteur sinon erreur
//arraycolumn permet de fabriquer un tableau avec seulement les mois en aaaamm, on extrait la colonne "mois" (suite analyse retour pbo getlesmois avec vardump
// grâce à l'erreur on le dit dans le viewer pas de fiche pour le mois et à selectionner à la main
if (in_array($moisSelectionne, array_column($lesMois, "mois"))) {
    $erreurMois = false;
} else {
    $erreurMois = true;
}

//on recherche les informations dans la bdd si le mois existe et on les prépare pour la vue comme pour visiteur

if ($erreurMois == false) {
    $infoFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteurSelectionne, $moisSelectionne);
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionne, $moisSelectionne);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteurSelectionne, $moisSelectionne);
    $numAnnee = substr($moisSelectionne, 0, 4);
    $numMois = substr($moisSelectionne, 4, 2);
    $nbJustificatifs = $pdo->getNbjustificatifs($idVisiteurSelectionne, $moisSelectionne);

    $arrayValidationFicheFraisInterdite = [];//['VA', 'RB', 'MP'];  // à définir
    $validationInterdite = in_array($infoFicheFrais['idEtat'], $arrayValidationFicheFraisInterdite);

    $arrayModificationFraisInterdite = []; //['VA','RB', 'MP']; // à définir plus finement car non explicité en détail, peut-on modifier si fiche validée par ex ?
    $modificationFraisInterdite = in_array($infoFicheFrais['idEtat'], $arrayModificationFraisInterdite);
} else {
    $validationInterdite = true;
    $modificationFraisInterdite = true;
}

//
//if ($lesFraisHorsForfait) {
//
//
////echo '<pre>' , var_dump("TYPE les Frais HF l",$lesFraisHorsForfait) , '</pre>';
////echo '<pre>' , var_dump("les Frais HF REFUSES",$lesFraisHorsForfaitRefuses) , '</pre>';
//    echo '<pre>', var_dump("les Frais HF", implode(" ", array_column($lesFraisHorsForfait, "libelle"))), '</pre>';
//    echo '<pre>', var_dump("contient refusé", str_contains(implode(" ", array_column($lesFraisHorsForfait, "libelle")), "REFUSE")), '</pre>';
//}



$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($action) {

    case 'choisirVisiteurMois':
        //signifie que c'est la première fois qu'on arrive sur la page, on met par défaut premier visiteur 0 et mois courant avec date
        header('Location: index.php?idVisiteurSelectionne=' . urlencode($lesVisiteurs[0][0])
                . '&moisSelectionne=' . urlencode(date('Ym'))
                . '&uc=validerFrais');
        break;

    case 'validerMajFraisForfait':
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (Utilitaires::lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
            $correctionFraisForfait = true;
            header('Location: index.php?idVisiteurSelectionne=' . urlencode($idVisiteurSelectionne)
                    . '&moisSelectionne=' . urlencode($moisSelectionne)
                    . '&correctionFraisForfait=' . urlencode($correctionFraisForfait)
                    . '&uc=validerFrais');
        } else {
            Utilitaires::ajouterErreur('Les valeurs des frais doivent être numériques');
            include PATH_VIEWS . 'v_erreurs.php';
            $correctionFraisPriseEnCompte = false;
        }
        break;

    case 'validerMajFraisHorsForfait':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idFrais = filter_input(INPUT_POST, 'corriger', FILTER_SANITIZE_NUMBER_INT);

        $dateFraisArray = filter_input(INPUT_POST, 'dateFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $libelleArray = filter_input(INPUT_POST, 'libelleFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $montantArray = filter_input(INPUT_POST, 'montantFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
       
        Utilitaires::valideInfosFrais($dateFraisArray[$idFrais], $libelleArray[$idFrais], $montantArray[$idFrais]);
        if (Utilitaires::nbErreurs() != 0) {
            include PATH_VIEWS . 'v_erreurs.php';
        } else {
            $pdo->majFraisHorsForfait($idVisiteur, $idFrais, $mois, $dateFraisArray[$idFrais], $libelleArray[$idFrais], $montantArray[$idFrais]);
            header('Location: index.php?idVisiteurSelectionne=' . urlencode($idVisiteur) . '&moisSelectionne=' . urlencode($mois) . '&uc=validerFrais');
        }
        break;

    case 'refuserFraisHorsForfait':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idFrais = filter_input(INPUT_GET, 'idFraisHorsForfait', FILTER_SANITIZE_NUMBER_INT);
        $libelleArray = filter_input(INPUT_POST, 'libelleFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $pdo->refuserFraisHorsForfait($idVisiteur, $idFrais, $mois);
        header('Location: index.php?idVisiteurSelectionne=' . urlencode($idVisiteur) . '&moisSelectionne=' . urlencode($mois) . '&uc=validerFrais');

        break;

    case 'validerFicheFrais':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $nbJustificatifs = filter_input(INPUT_POST, 'nbJustificatifs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pdo->majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs);
        $tousLesLibellesHorsForfait = implode(" ", array_column($lesFraisHorsForfait, "libelle"));
        $contientFraisRefuses = str_contains($tousLesLibellesHorsForfait, "REFUSE");
        $moisSuivant = Utilitaires::ajouteUnMois(date('Ym'));
        $ficheMoisSuivantNonCreee = !in_array($moisSuivant, array_column($lesMois, "mois"));
        $informationValidation = ['cas1' => "mois suivant créé et fiches REFUSEES déplacées", 'cas2' => "fiches REFUSEES déplacées", 'cas3' => "fiche validée"];
        //ce qui suit est plus joli que des if imbriqués ce que l'on déteste tous !!!
        switch (true) {
            case ($contientFraisRefuses === true && $ficheMoisSuivantNonCreee === true) :
                $pdo->creerFicheFrais($idVisiteur, $moisSuivant);
                $pdo->deplacerFraisHorsForfaitsRefusesMoisSuivant($idVisiteur, $mois, $moisSuivant);
                $keyValidation = 'cas1';
                break;
            case ($contientFraisRefuses === true && $ficheMoisSuivantNonCreee === false) :
                echo '<pre>', var_dump("les frais sont sensés être reportés", $moisSuivant), '</pre>';
                echo '<pre>', var_dump("id vis", $idVisiteur), '</pre>';
                echo '<pre>', var_dump("mois", $mois), '</pre>';
                echo '<pre>', var_dump("mois suivant", $moisSuivant), '</pre>';
                $pdo->deplacerFraisHorsForfaitsRefusesMoisSuivant($idVisiteur, $mois, $moisSuivant);
                $keyValidation = 'cas2';
                break;

            default:
                $keyValidation = 'cas3';
        }
        //var_dump("va passer par ici !", $keyValidation);
        $pdo->majEtatFicheFrais($idVisiteur, $mois, 'VA');
        header('Location: index.php?idVisiteurSelectionne=' . urlencode($idVisiteur)
                . '&moisSelectionne=' . urlencode($mois)
                . '&validationCas=' . urlencode($keyValidation)
                . '&validationInfo=' . urlencode($informationValidation[$keyValidation])
                . '&uc=validerFrais');

        break;
}

require PATH_VIEWS . 'v_listeVisiteurMois.php';
require PATH_VIEWS . 'v_listeFraisForfait.php';
require PATH_VIEWS . 'v_listeFraisHorsForfait.php';
