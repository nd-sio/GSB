<?php

ob_start();
// Include the main TCPDF library (search for installation path).

require_once(__DIR__ . '/../libs/TCPDF/tcpdf.php');

// Créer une nouvelle instance TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configuration du document
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('GSB');
$pdf->SetTitle('Remboursement Frais');
$pdf->SetSubject('Rapport Frais');
$pdf->SetKeywords('Frais, PDF, TCPDF');

// En-tête et pied de page désactivés
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Définit les marges
$pdf->SetMargins(15, 15, 15);

// Associer la fonction à l'événement Header
//$pdf->setHeaderCallback('customHeader');
//// Fonction pour personnaliser l'en-tête
//
//
//function customHeader($pdf) {
//    // Positionnement de l'image
//    $imageWidth = 50;
//    $pageWidth = $pdf->getPageWidth();
//    $xPosition = ($pageWidth - $imageWidth) / 2;
//    $pdf->Image('/var/www/html/GSB/public/images/logo.jpg', $xPosition, 10, $imageWidth, 0, 'JPG', '', 'T', true, 300);
//}

// Ajouter une page
$pdf->AddPage();

// Ajouter une image d'en-tête centrée
$imageWidth = 50; // Largeur de l'image en millimètres
$pageWidth = $pdf->getPageWidth(); // Largeur totale de la page
$xPosition = ($pageWidth - $imageWidth) / 2; // Calcul de la position centrée
$imageFile = '/var/www/html/GSB/public/images/logo.jpg';
$pdf->Image($imageFile, $xPosition, 10, 50, 0, 'JPG', '', 'T', true, 300);

// Déplacer le curseur en y après l'image
$pdf->SetY(10 + 40); // 10 est la position de l'image, 50 est sa hauteur

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
        <td>$leMoisAVoir</td>
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
$montantValide = $lesInfosFicheFrais['montantValide'];

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


// Ajouter une image juste en dessous du texte "Vu l'agent comptable"
$imageFile2 = '/var/www/html/GSB/public/images/signature.png';
$pdf->Image($imageFile2, 140, $pdf->GetY() + 5, 50, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


// Sortie du fichier PDF
$fichier = '/var/www/html/GSB/src/PDFgeneres/'. $prenomNom . '_' . $leMoisAVoir .'.pdf';
$pdf->Output($fichier, 'D');
$permissions = 0755;
chmod($fichier, $permissions);
//$fichier = $_FILES[]; // Supposons que le fichier a été uploadé
$contenu = file_get_contents($fichier);
$pdo->creerFichierPDF($idVisiteur, $leMoisAVoir, $fichier);
