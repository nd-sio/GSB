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
        
//    case 'validerMajFraisHorsForfait':
//        $lesFraisHorsForfait[$id] = ['dateFrais' => $date, 'libelleFrais' => $libelle, 'montantFrais' => $montant];
//        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//        var_dump($lesFraisHorsForfait[$id]);
//        if (Utilitaires::valideInfosFrais($date, $libelle, $montant)) {
//            $pdo->majFraisHorsForfait($idVisiteur, $mois, $lesFraisHorsForfait[$id]);
//            header('Location: index.php?lstVisiteurs=' . urlencode($idVisiteur) . '&lstMois=' . urlencode($mois) . '&uc=validerFrais');
//        } else {
//            Utilitaires::ajouterErreur('Les valeurs des frais sont invalides');
//            include PATH_VIEWS . 'v_erreurs.php';
//        }
//        break;
//        
        case 'validerMajFraisHorsForfait':
    $id = filter_input(INPUT_POST, 'corriger', FILTER_SANITIZE_NUMBER_INT);
    $date = Utilitaires::dateFrancaisVersAnglais(filter_input(INPUT_POST, 'dateFrais[' . $id . ']', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $libelle = filter_input(INPUT_POST, 'libelleFrais[' . $id . ']', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $montant = filter_input(INPUT_POST, 'montantFrais[' . $id . ']', FILTER_VALIDATE_FLOAT);

    if ($id && $date && $libelle && $montant) {
        $lesFraisHorsForfait[$id] = ['dateFrais' => $date, 'libelleFrais' => $libelle, 'montantFrais' => $montant];
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (Utilitaires::valideInfosFrais($date, $libelle, $montant)) {
            $pdo->majFraisHorsForfait($idVisiteur, $mois, $lesFraisHorsForfait[$id]);
            header('Location: index.php?lstVisiteurs=' . urlencode($idVisiteur) . '&lstMois=' . urlencode($mois) . '&uc=validerFrais');
        } else {
            Utilitaires::ajouterErreur('Les valeurs des frais sont invalides');
            include PATH_VIEWS . 'v_erreurs.php';
        }
    } else {
        Utilitaires::ajouterErreur('Données manquantes ou incorrectes');
        include PATH_VIEWS . 'v_erreurs.php';
    }
    break;
        
//        case 'validerMajFraisHorsForfait':
//    // Récupération de l'identifiant du frais sélectionné
//    $id = filter_input(INPUT_POST, 'corriger', FILTER_SANITIZE_NUMBER_INT);
//    
//    // Récupération des champs spécifiques au frais hors forfait directement via $_POST
//    if ($id) {
////        $date = Utilitaires::dateFrancaisVersAnglais(filter_input(INPUT_POST, 'dateFrais'[$id], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
//        $date = Utilitaires::dateAnglaisVersFrancais(isset($_POST['dateFrais'][$id])) ? Utilitaires::dateFrancaisVersAnglais(htmlspecialchars($_POST['dateFrais'][$id])) : null;
//        $libelle = isset($_POST['libelleFrais'][$id]) ? htmlspecialchars($_POST['libelleFrais'][$id]) : null;
//        $montant = isset($_POST['montantFrais'][$id]) ? filter_var($_POST['montantFrais'][$id], FILTER_VALIDATE_FLOAT) : null;
//        Utilitaires::valideInfosFrais($dateFrais, $libelle, $montant);
//        var_dump($id);
//        var_dump($date, $libelle, $montant); // Vérification des valeurs récupérées
//
//        // Vérifiez que chaque donnée a bien été récupérée
//        if ($date && $libelle && $montant !== null) {
//            // Stockage des frais dans le tableau
//            $lesFraisHorsForfait[$id] = ['dateFrais' => $date, 'libelleFrais' => $libelle, 'montantFrais' => $montant];
//            
//            // Récupération des autres informations nécessaires
//            $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//            $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//            var_dump($mois, $idVisiteur);
//            
//            // Validation des informations
//            if (Utilitaires::valideInfosFrais($date, $libelle, $montant)) {
//                // Mise à jour des frais hors forfait dans la base de données
//                $pdo->majFraisHorsForfait($idVisiteur, $mois, $lesFraisHorsForfait[$id]);
//                header('Location: index.php?lstVisiteurs=' . urlencode($idVisiteur) . '&lstMois=' . urlencode($mois) . '&uc=validerFrais');
//            } else {
//                Utilitaires::ajouterErreur('Les valeurs des frais sont invalides');
//                include PATH_VIEWS . 'v_erreurs.php';
//            }
//        } else {
//            Utilitaires::ajouterErreur('Données manquantes ou incorrectes');
//            include PATH_VIEWS . 'v_erreurs.php';
//        }
//    } else {
//        Utilitaires::ajouterErreur('Frais sélectionné incorrect');
//        include PATH_VIEWS . 'v_erreurs.php';
//    }
//    break;

    case 'validerFicheFrais':
        $pdo->majEtatFicheFrais($idVisiteurSelectionne, $moisSelectionne, 'VA');
        break;
        
}
      
require PATH_VIEWS . 'v_listeVisiteurMois.php';       
require PATH_VIEWS . 'v_listeFraisForfait.php';
require PATH_VIEWS . 'v_listeFraisHorsForfait.php';