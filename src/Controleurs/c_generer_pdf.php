<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */
use Outils\Utilitaires;
ob_start();
// Include the main TCPDF library (search for installation path).

require_once(__DIR__ . '/../libs/TCPDF/tcpdf.php');

//// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
//// set document information
//$pdf->setCreator(PDF_CREATOR);
//$pdf->setAuthor('Nicola Asuni');
//$pdf->setTitle('TCPDF Example 001');
//$pdf->setSubject('TCPDF Tutorial');
//$pdf->setKeywords('TCPDF, PDF, example, test, guide');
//
//// set default header data
//$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
//
//// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set default font subsetting mode
//$pdf->setFontSubsetting(true);
//
//// Set font
//// dejavusans is a UTF-8 Unicode font, if you only need to
//// print standard ASCII chars, you can use core fonts like
//// helvetica or times to reduce file size.
//$pdf->setFont('dejavusans', '', 14, '', true);
//
//// Add a page
//// This method has several options, check the source code documentation for more information.
//$pdf->AddPage();
//
//// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
//
//// Set some content to print
//
//
//$idVisiteurSelectionne='a118y';
//$leMoisAVoir='202410';
//$lesVisiteurs = $pdo->getAllVisiteurs();
//$lesFiches = $pdo->getLastFichesFrais($idVisiteurSelectionne, 5);
//
//$idVisiteur = $idVisiteurSelectionne;
//$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMoisAVoir);
//$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMoisAVoir);
//$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMoisAVoir);
//$lesIndemnites = $pdo->getLesIndemnitesFrais($idVisiteur);
//$numAnnee = substr($leMoisAVoir, 0, 4);
//$numMois = substr($leMoisAVoir, 4, 2);
//$libEtat = $lesInfosFicheFrais['libEtat'];
//$montantValide = $lesInfosFicheFrais['montantValide'];
//$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
//$dateModif = Utilitaires::dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
//
//
//
//$html = <<<EOD
//        
//<h1>Welcome to PPPPPPPZZZZ<a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
//<i>This is the first example of TCPDF library.</i>
//<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
//<p>Please check the source code documentation and other examples for further information.</p>
//<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
//     
//        
//EOD;
//
//// Print text using writeHTMLCell()
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//
//// ---------------------------------------------------------
//
//// Close and output PDF document
//// This method has several options, check the source code documentation for more information.
//$pdf->Output('/var/www/html/GSB/src/PDFgeneres/groZZ.pdf', 'F');
//$pdf->Output('/var/www/html/GSB/src/PDFgeneres/groZZ.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

//$idVisiteurSelectionne='a118y';
//$leMoisAVoir='202410';
//$lesVisiteurs = $pdo->getAllVisiteurs();
//$lesFiches = $pdo->getLastFichesFrais($idVisiteurSelectionne, 5);
//
//$idVisiteur = $idVisiteurSelectionne;
//$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMoisAVoir);
//$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMoisAVoir);
//$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMoisAVoir);
//$lesIndemnites = $pdo->getLesIndemnitesFrais($idVisiteur);
//$numAnnee = substr($leMoisAVoir, 0, 4);
//$numMois = substr($leMoisAVoir, 4, 2);
//$libEtat = $lesInfosFicheFrais['libEtat'];
//$montantValide = $lesInfosFicheFrais['montantValide'];
//$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
//$dateModif = Utilitaires::dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);

// Créer une nouvelle instance TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configuration du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GSB');
$pdf->SetTitle('Remboursement Frais');
$pdf->SetSubject('Rapport Frais');
$pdf->SetKeywords('Frais, PDF, TCPDF');

// En-tête et pied de page désactivés (personnalisable)
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Définit les marges
$pdf->SetMargins(15, 15, 15);

// Ajouter une page
$pdf->AddPage();

// Contenu HTML pour le PDF
$html = <<<EOD
<h1 style="text-align: center;">REMBOURSEMENT DE FRAIS ENGAGÉS</h1>
<br><br>
<table>
    <tr>
        <td><strong>Visiteur :</strong></td>
        <td>$idVisiteur - $prenomNom</td>
    </tr>
    <tr>
        <td><strong>Mois :</strong></td>
        <td>$mois</td>
    </tr>
</table>
<br><br>
<h2>Frais Forfaitaires</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Type</th>
        <th>Quantité</th>
        <th>Montant Unitaire</th>
        <th>Total</th>
    </tr>
EOD;

// Boucle pour les frais forfaitaires
for ($i = 0, $size = count($lesFraisForfait); $i < $size; ++$i) {
    $idFraisForfait = $lesFraisForfait[$i]["idfrais"];
    $libelleFraisForfait = $lesFraisForfait[$i]["libelle"];
    $quantite = $lesFraisForfait[$i]["quantite"];
    $montantUnitaire = $lesIndemnites[$idFraisForfait]["montant"]; 
    $totalLigne = $quantite * $montantUnitaire;

    // Ajouter une ligne dynamique au tableau
    $html .= <<<EOD
    <tr>
        <td>$libelleFraisForfait</td>
        <td>$quantite</td>
        <td>$montantUnitaire</td>
        <td>$totalLigne</td>
    </tr>
EOD;
}

// Continuer avec les autres frais
$html .= <<<EOD
</table>
<br><br>
<h2>Autres Frais</h2>
<table border="1" cellpadding="5">      
    <tr>
        <th>Date</th>
        <th>Libellé</th>
        <th>Montant</th>
    </tr>
EOD;

// Boucle pour les frais hors forfait
foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
    $date = $unFraisHorsForfait['date']; 
    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
    $montant = $unFraisHorsForfait['montant'];

    // Ajouter une ligne dynamique au tableau
    $html .= <<<EOD
    <tr>
        <td>$date</td>
        <td>$libelle</td>
        <td>$montant</td>
    </tr>
EOD;
}

// Fin du tableau et contenu fixe
$html .= <<<EOD
</table>
<br><br>
<p><strong>Total $numMois/$numAnnee :</strong> $montantValide €</p>
<br><br>
<p style="text-align: right;">Fait à Paris, $dateModif</p>
<p style="text-align: right;">Vu l'agent comptable</p>
EOD;


// Ajouter le contenu HTML au PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Sortie du fichier PDF
//$pdf->Output('Remboursement_Frais_202407.pdf', 'I');
$pdf->Output('/var/www/html/GSB/src/PDFgeneres/groZZ.pdf', 'F');
?>
