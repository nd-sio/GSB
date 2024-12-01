<?php

/* 
 * Suivi du paiement des fiches de frais par le comptabel
 * 
 */

use Outils\Utilitaires;

$idVisiteurSelectionne = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$moisSelectionne = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lesVisiteurs = $pdo->getAllVisiteurs();
$existePDF = $pdo->existefichierPDF($idVisiteurSelectionne, $moisSelectionne);


if ($idVisiteurSelectionne) {
    $lesFiches = $pdo->getLastFichesFrais($idVisiteurSelectionne, 5); // je peux modifier à la main le nb de fiches
}
//var_dump($lesFiches);
/*
         * condition pas de mois selectionné dans la vue avec voir
         * Recherche du mois selectionne correspondant au premier mois "VA"
         * issu du tableau LesFiches, on cherche à l'intérieur du tableau
         * dans la colonne intitulée idEtat, parcours de sous-tableau
         * Array search renvoie la première clé
        */
if ($lesFiches and !$moisSelectionne) {
    $keyPremierVA = array_search('VA', array_column($lesFiches, 'idEtat')); //renvoie la première clé
}
if ($keyPremierVA) {
    $leMoisAVoir = $lesFiches[$keyPremierVA]["mois"];
    $pasDeFicheValidee = false;
} else {
    $leMoisAVoir = $lesFiches[2]['mois']; //sinon on voit la fiche 2+1=3 au milieu du tableau
    $pasDeFicheValidee = true;
}




if ($moisSelectionne) { // envoyé de la vue avec <a>Voir</a>
      $leMoisAVoir = $moisSelectionne;}

      
         /* Reprise du code du contrôleur etat de frais visiteur pour avoir la vue correspondante
        */
if ($idVisiteurSelectionne) {
        $idVisiteur=$idVisiteurSelectionne;
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMoisAVoir);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMoisAVoir);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMoisAVoir);
        $lesIndemnites = $pdo->getLesIndemnitesFrais($idVisiteur);
        $numAnnee = substr($leMoisAVoir, 0, 4);
        $numMois = substr($leMoisAVoir, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = Utilitaires::dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        $keyVisiteur = array_search($idVisiteurSelectionne, array_column($lesVisiteurs, 'id'));
        $prenomNom = $lesVisiteurs[$keyVisiteur]['prenom'] . ' ' . $lesVisiteurs[$keyVisiteur]['nom'];
        }

$arrayGenererPDFAutorise = ['VA','RB', 'MP'];       

echo '<pre>' , var_dump($lesInfosFicheFrais['idEtat']) , '</pre>'; 

        
  echo '<pre>' , var_dump($existePDF) , '</pre>';      
        
            
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

   case 'genererPDF':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       include PATH_CTRLS . 'c_generer_pdf.php';
        die();
        
    case 'visualiserPDF':
        $mois = filter_input(INPUT_GET, 'moisSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_GET, 'idVisiteurSelectionne', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pdfContent = $pdo->getFichierPDF($idVisiteur, $mois);
        var_dump($pdfContent);
        header('Content-Disposition: inline; filename=""');
        exit;
        
    break;

    
}
    
    
    
    require PATH_VIEWS . 'v_listeVisiteur.php';
    require PATH_VIEWS . 'v_listeFiches.php';
    require PATH_VIEWS . 'v_etatFraisComptablePDF.php';
    

    
    
    
    
    
             
         
         

    