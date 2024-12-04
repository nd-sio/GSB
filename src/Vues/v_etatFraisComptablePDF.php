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


<?php $userType = $_SESSION['user_type'] ?? '';
?>  

<hr>
<div class="panel panel-primary <?php echo $userType == 'comptable' ? "panel-comptable border-comptable" : "" ;?>">
         
      <div class="panel-heading">Fiche de frais du mois 
        <?php echo $numMois . '-' . $numAnnee ?>  pour le visiteur  <?php echo $prenomNom; ?></div>
          
    <div class="panel-body">
        <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
        depuis le <?php echo $dateModif ?> <br> 
        <strong><u>Montant validé :</u></strong> <?php echo $lesInfosFicheFrais['montantValide'] ?>
    </div>
</div>


  

<div class="panel panel-info <?php echo $userType == 'comptable' ? 'panel-light-comptable border-comptable':'';?>">
    <div class="panel-heading">REMBOURSEMENT DE FRAIS ENGAGES</div>
    
    <table class="table table-bordered table-responsive">
       <tr>
           <td  class="">Visiteur</td>
           <td  class=""><?php echo $idVisiteurSelectionne ?></td>
           <td colspan="2" class=""><?php echo $prenomNom ?></td> 
       </tr>   
        <tr>
           <td  class="">Mois</td>
           <td  class=""><?php echo $leMoisAVoir ?></td>
           <td colspan="2" class=""></td> 
       </tr>
        
      <tr><th colspan="4" class="text-center light-comptable">Eléments forfaitisés</th></tr>  
    <tr><th>Frais Forfaitaires</th><th>Quantité</th><th>Montant unitaire</th><th>Total</th></tr>

    
    <!--c'est ici que va servir le tableau des indemnités avec la clé qui est id cad ETP KM NUI au lieu de 0 1 2 3-->
    <?php
    
    
    for ($i = 0, $size = count($lesFraisForfait); $i < $size; ++$i) {
        $idFraisForfait = $lesFraisForfait[$i]["idfrais"];
        $libelleFraisForfait = $lesFraisForfait[$i]["libelle"];
        $quantite = $lesFraisForfait[$i]["quantite"];
        $montantUnitaire = $lesIndemnites[$idFraisForfait]["montant"]; //ici la clé est l'id vient de pdo restructured
        $totalLigne = $quantite * $montantUnitaire; // Calcul du total pour la ligne actuelle

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

    
    
 <tr>
            <th colspan="4" class="text-center light-comptable">Autres Frais</th>
                          
        </tr>
    
    <tr>
            <th class="date">Date</th>
            <th colspan="2" class="libelle">Libellé</th>
            <th class='montant'>Montant</th>                
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant']; ?>
            <tr>
                <td><?php echo $date ?></td>
                <td colspan="2" ><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
            </tr>
            
            <?php
        }
        ?>
            
            <tr >
                <td colspan="2" class='text-center'><?php if (in_array($lesInfosFicheFrais['idEtat'], $arrayGenererPDFAutorise)) : ?>
                        <?php if ($existePDF) { ?>
                            <a href="index.php?uc=suivreFrais&action=visualiserPDF&idVisiteurSelectionne=<?php echo $idVisiteurSelectionne; ?>&moisSelectionne=<?php echo $leMoisAVoir; ?>"
                               class= "btn btn-primary" >
                                visualiser PDF
                            </a>
                            <?php
                        } else {
                            ?>
                      <a href="index.php?uc=suivreFrais&action=genererPDF&idVisiteurSelectionne=<?php echo $idVisiteurSelectionne; ?>&moisSelectionne=<?php echo $leMoisAVoir; ?>"
                               class= "btn btn-primary" >
                                générer PDF
                            </a> 

                        <?php } ?> 

                    <?php endif; ?></td>      
                <td   class="text-right"><strong>TOTAL   <?php echo $leMoisAVoir ?></strong></td>
                <td><strong><?php echo $lesInfosFicheFrais['montantValide'] ?></strong></td>
            </tr>
    
    
    
    
   
</table>
    
     
    
</div>

    