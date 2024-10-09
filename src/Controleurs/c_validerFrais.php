<?php

/**
 * Gestion de l'affichage des frais
 *
 * PHP Version 8
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

use Outils\Utilitaires;

$lesVisiteurs = $pdo->getAllVisiteurs();

$idVisiteurSelectionne = filter_input(INPUT_GET, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($idVisiteurSelectionne) {
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionne);
            
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
 }
 
 $moisSelectionne = filter_input(INPUT_GET, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($moisSelectionne) {
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionne, $moisSelectionne);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteurSelectionne, $moisSelectionne);
        $numAnnee = substr($moisSelectionne, 0, 4);
        $numMois = substr($moisSelectionne, 4, 2);
        $nbJustificatifs = $pdo->getNbjustificatifs($idVisiteurSelectionne, $moisSelectionne);
        }
        
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
switch ($action) {   
    
    case 'validerMajFraisForfait':
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (Utilitaires::lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
            header('Location: index.php?lstVisiteurs=' . urlencode($idVisiteur) . '&lstMois=' . urlencode($mois) . '&uc=validerFrais');
        } else {
            Utilitaires::ajouterErreur('Les valeurs des frais doivent être numériques');
            include PATH_VIEWS . 'v_erreurs.php';
        }
        break;    
        
    case 'validerMajFraisHorsForfait':
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idFrais = filter_input(INPUT_POST, 'corriger', FILTER_SANITIZE_NUMBER_INT);
       
        $dateFraisArray = filter_input(INPUT_POST, 'dateFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $libelleArray = filter_input(INPUT_POST, 'libelleFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $montantArray = filter_input(INPUT_POST, 'montantFrais', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        
        Utilitaires::valideInfosFrais($dateFraisArray[$idFrais], $libelleArray[$idFrais], $montantArray[$idFrais]);
        if (Utilitaires::nbErreurs() != 0) {
            include PATH_VIEWS . 'v_erreurs.php';
        } else {
            $pdo->majFraisHorsForfait($idVisiteur, $idFrais, $mois, $dateFraisArray[$idFrais], $libelleArray[$idFrais], $montantArray[$idFrais]);
            header('Location: index.php?lstVisiteurs=' . urlencode($idVisiteur) . '&lstMois=' . urlencode($mois) . '&uc=validerFrais');
        }
         break;

    case 'validerFicheFrais':
        $pdo->majEtatFicheFrais($idVisiteurSelectionne, $moisSelectionne, 'VA');
        break;
        
}
      
require PATH_VIEWS . 'v_listeVisiteurMois.php';       
require PATH_VIEWS . 'v_listeFraisForfait.php';
require PATH_VIEWS . 'v_listeFraisHorsForfait.php';