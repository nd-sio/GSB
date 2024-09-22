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

//filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$lesVisiteurs = $pdo->getAllVisiteurs();
$idVisiteurSelectionne = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($idVisiteurSelectionne) {
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionne);
            
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
 }
 
 

$moisSelectionne = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($moisSelectionne) {
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionne, $moisSelectionne);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteurSelectionne, $moisSelectionne);
        $numAnnee = substr($moisSelectionne, 0, 4);
        $numMois = substr($moisSelectionne, 4, 2);
        
        }
require PATH_VIEWS . 'v_listeVisiteurMois.php';       
require PATH_VIEWS . 'v_listeFraisForfait.php';
require PATH_VIEWS . 'v_listeFraisHorsForfait.php';