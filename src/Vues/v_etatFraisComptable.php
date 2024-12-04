<?php

/**
 * Vue État de Frais
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
 * @link      https://getbootstrap.com/docs/3.3/ Documentation Bootstrap v3
 */

?>


<?php $userType = $_SESSION['user_type'] ?? '';?>  

<hr>
<div class="panel panel-primary <?php echo $userType == 'comptable' ? "panel-comptable border-comptable" : "" ;?>">
         
      <div class="panel-heading">Fiche de frais du mois 
        <?php echo $numMois . '-' . $numAnnee ?> : </div>
          
    <div class="panel-body">
        <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
        depuis le <?php echo $dateModif ?> <br> 
        <strong><u>Montant validé :</u></strong> <?php echo $montantValide ?>
    </div>
</div>


  

<div class="panel panel-info <?php echo $userType == 'comptable' ? 'panel-light-comptable border-comptable':'';?>">
    <div class="panel-heading">Eléments forfaitisés</div>
    
    <table class="table table-bordered table-responsive">
    <tr><th>Frais Forfaitaires</th><th>Quantité</th><th>Montant unitaire</th><th>Total</th></tr>

    
    <!--c'est ici que va servir le tableau des indemnités avec la clé qui est id cad ETP KM NUI au lieu de 0 1 2 3-->
    <?php
    $totalGeneralForfait = 0; // Variable pour accumuler le total
    
    for ($i = 0, $size = count($lesFraisForfait); $i < $size; ++$i) {
        $idFraisForfait = $lesFraisForfait[$i]["idfrais"];
        $libelleFraisForfait = $lesFraisForfait[$i]["libelle"];
        $montantUnitaire = $lesIndemnites["$idFraisForfait"]["montant"];
        $quantite = $lesFraisForfait[$i]["quantite"];
        $totalLigne = $quantite * $montantUnitaire; // Calcul du total pour la ligne actuelle

//        $totalGeneralForfait += $totalLigne; // Ajouter au total général
        
        ?>
        <tr>
            <td> <?php echo htmlspecialchars($libelleFraisForfait) ?></td>
            <td> <?php echo htmlspecialchars($quantite) ?></td>
            <td> <?php echo htmlspecialchars($montantUnitaire) ?></td>
            <td> <?php echo htmlspecialchars($totalLigne) ?></td>
        </tr>
    <?php
    }
    ?>

    <!-- Affichage du total forfait -->
<!--    <tr>
        <td colspan="3" class="text-right"><strong>Total Frais Forfait</strong></td>
        <td><strong><?php echo number_format($totalGeneralForfait, 2, ',', ' ') ?></strong></td>
    </tr>-->
    
    
</table>
    
     
    
</div>
<div class="panel panel-info <?php echo $userType == 'comptable' ? 'panel-light-comptable border-comptable':'';?>">
    <div class="panel-heading">Descriptif des éléments hors forfait - 
        <?php echo $nbJustificatifs ?> justificatifs reçus</div>
    <table class="table table-bordered table-responsive">
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>                
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant']; ?>
            <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
            </tr>
            
            <?php
        }
        ?>
            
            <tr >
        <td  colspan="2" class="text-right"><strong>TOTAL   <?php echo $mois ?></strong></td>
        <td><strong><?php echo $montantValide ?></strong></td>
    </tr>
    </table>
</div>