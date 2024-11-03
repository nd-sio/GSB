<?php

/* 
 * Suivi du paiement des fiches de frais par le comptabel
 * 
 */

use Outils\Utilitaires;

$idVisiteurSelectionne = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$moisSelectionne = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lesVisiteurs = $pdo->getAllVisiteurs();


if ($idVisiteurSelectionne) {
    $lesFiches = $pdo->getLastFichesFrais($idVisiteurSelectionne, 5);
}

/*
         * Recherche du mois selectionne correspondant au premier mois "VA"
         * issu du tableau LesFiches, on cherche à l'intérieur du tableau
         * dans la colonne intitulée idEtat, parcours de sous-tableau
         * Array search renvoie la première clé
        */
if ($lesFiches) {
    $key = array_search('VA', array_column($lesFiches, 'idEtat'));
}

if ($key) {
    $leMoisAVoir = $lesFiches[$key]["mois"];
    $pasDeFicheValidee = false;
} else {
    $leMoisAVoir = "pas de mois correspondant à une fiche validée";
    $pasDeFicheValidee = true;
}


if ($moisSelectionne) {
      $leMoisAVoir = $moisSelectionne;}
                   
        /*
         * Reprise du code du contrôleur etat de frais pour avoir la vue correspondante
        */
if ($pasDeFicheValidee === false) {
        $idVisiteur=$idVisiteurSelectionne;
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMoisAVoir);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMoisAVoir);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMoisAVoir);
        $numAnnee = substr($leMoisAVoir, 0, 4);
        $numMois = substr($leMoisAVoir, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = Utilitaires::dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);  
        }


            
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($action) {
    
    case 'choisirVisiteur':      
        $keyVisiteurPardéfaut = 0;
        header('Location: index.php?idVisiteurSelectionne=' .  urlencode($lesVisiteurs[$keyVisiteurPardéfaut]['id'])  . '&uc=suivreFrais');
        break;
    
    case 'mettreEnPaiementFiche':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pdo->majEtatFicheFrais($idVisiteur, $mois, 'MP');
         header('Location: index.php?idVisiteurSelectionne=' . urlencode($idVisiteur)  . '&uc=suivreFrais');

    break;
    
    case 'paiementEffectueFiche':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pdo->majEtatFicheFrais($idVisiteur, $mois, 'RB');
         header('Location: index.php?idVisiteurSelectionne=' . urlencode($idVisiteur)  . '&uc=suivreFrais');

    break;

    
}
    
    
    
    require PATH_VIEWS . 'v_listeVisiteur.php';
    require PATH_VIEWS . 'v_listeFiches.php';
    require PATH_VIEWS . 'v_etatFrais.php';
    

    
    
    
    
    
             
         
         

    