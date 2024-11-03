<?php

/**
 * Vue Liste des frais au forfait
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


<div class="row">
    <?php if($pasDeFicheValidee) : ?>
      <H2 class="panel-heading bold text-danger">Pas de Fiche de frais validée à mettre en paiement </H2>
      
    <?php endif; ?>
    
    
    
    <div class="panel panel-info panel-light-comptable border-comptable">
        <?php if($pasDeFicheValidee) : ?>
      <div class="panel-heading bold text-danger">Pas de Fiche de frais validée à mettre en paiement </div>
        <?php else : ?>
       <div class="panel-heading">Voici les 5 dernières fiches de frais</div>
        
        <?php endif; ?>
        
        
        <table class="table table-bordered table-responsive ">
            <thead>
                <tr>
                    <th class="mois">Mois</th>
                    <th class="nbJustificatifs">nombre de justificatifs</th>  
                    <th class="montantValide">Montant validé</th>
                    <th class="dateModif">Date de modification</th>
                    <th class="idEtat">Etat de la fiche</th>
                    <th class="action">Action sur la fiche</th>
                   
                </tr>
            </thead>  
            <tbody>
            <?php
                foreach ($lesFiches as $uneFiche) {
                    $mois = $uneFiche['mois'];
                    $nbJustificatifs = $uneFiche['nbJustificatifs'];
                    $montantValide= $uneFiche['montantValide'];
                    $dateModif= $uneFiche['dateModif'];
                    $idEtat= $uneFiche['idEtat'];
                    $libEtat= $uneFiche['libEtat'];
                    $couleurs= ['CR'=>"light-red",'CL'=>"light-yellow" ,'VA'=>"light-blue", 'RB'=> 'vlight-green','MP'=>'text-success'];
  
                     ?>           
                        
                <tr class="<?php echo $couleurs[$idEtat] ?><?php echo $mois == $leMoisAVoir ? " border-focus" : "" ?>" >   

                        <td> <?php echo $mois ?></td>
                        <td> <?php echo $nbJustificatifs ?></td>
                        <td><?php echo $montantValide ?></td>
                        <td><?php echo $dateModif ?></td>
                        <td><?php echo $libEtat ?></td>
                        <td>

                            <?php if ($mois !== $leMoisAVoir AND $pasDeFicheValidee == false) : ?>
                                <a href="index.php?uc=suivreFrais&action=voirFiche&idVisiteurSelectionne=<?php echo $idVisiteurSelectionne; ?>&moisSelectionne=<?php echo $mois; ?>"
                                   class= "btn btn-primary" >
                                    voir
                                </a>                    
                            <?php endif; ?>

                            <?php if ($idEtat == 'VA') : ?>

                                <a href="index.php?uc=suivreFrais&action=mettreEnPaiementFiche&idVisiteurSelectionne=<?php echo $idVisiteurSelectionne; ?>&moisSelectionne=<?php echo $mois; ?>"
                                   class= "btn btn-light-green"       
                                   onclick="return confirm('Voulez-vous mettre en paiement ?');">
                                    mettre en paiement
                                </a>      
                            <?php endif; ?>

                            <?php if ($idEtat == 'MP') : ?>
                                <a href="index.php?uc=suivreFrais&action=paiementEffectueFiche&idVisiteurSelectionne=<?php echo $idVisiteurSelectionne; ?>&moisSelectionne=<?php echo $mois; ?>"
                                   class= "btn btn-success" >
                                    paiement effectué
                                </a>   
                            <?php endif; ?>


                        </td>
                    </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>