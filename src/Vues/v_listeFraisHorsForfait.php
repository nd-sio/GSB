<?php

/**
 * Vue Liste des frais hors forfait
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
<?php
$userType = $_SESSION['user_type'] ?? '';
            if ($userType === 'visiteur') {
                ?>
<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <?php echo $date ?></td>
                    <td> <?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td>
                        <a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">
                            Supprimer ce frais
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>
<div class="row">
    <h3>Nouvel élément hors forfait</h3>
    <div class="col-md-4">
        <form action="index.php?uc=gererFrais&action=validerCreationFrais" 
              method="post" role="form">
            <div class="form-group">
                <label for="txtDateHF">Date (jj/mm/aaaa): </label>
                <input type="date" id="txtDateHF" name="dateFrais" 
                       class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="txtLibelleHF">Libellé</label>             
                <input type="text" id="txtLibelleHF" name="libelle" class="form-control" id="text">
            </div> 
            <div class="form-group">
                <label for="txtMontantHF">Montant : </label>
                <div class="input-group">
                    <span class="input-group-addon">€</span>
                    <input type="text" id="txtMontantHF" name="montant" class="form-control" value="">
                </div>
            </div>
            <button class="btn btn-success" type="submit">Ajouter</button>
            <button class="btn btn-danger" type="reset">Effacer</button>
        </form>
    </div>
</div>
<?php
} else {
?>
<hr>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading" class="background-comptable">Descriptif des éléments hors forfait</div>
        <form action="index.php?uc=validerFrais&action=validerMajFraisHorsForfait" method="post" role="form">
            <table class="table table-bordered table-responsive">
                <thead>  
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">&nbsp;</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date = $unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id']; ?>           
                        <tr>
                            <td>
                                <input type="text" name="dateFrais[<?php echo $id; ?>]" 
                                       class="form-control" value="<?php echo $date; ?>" />
                            </td>
                            <td>
                                <input type="text" name="libelleFrais[<?php echo $id; ?>]" 
                                       class="form-control" value="<?php echo $libelle; ?>" />
                            </td>
                            <td>
                                <div class="input-group">
                                    <span class="input-group-addon">€</span>
                                    <input type="text" name="montantFrais[<?php echo $id; ?>]" 
                                           class="form-control" value="<?php echo $montant; ?>" />
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-success" type="submit" name="corriger" value="<?php echo $id; ?>">Corriger</button>
                                <button class="btn btn-danger" type="reset" value="<?php echo $id; ?>">Réinitialiser</button>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <input type="hidden" name="lstVisiteurs" value="<?php echo $idVisiteurSelectionne; ?>">
            <input type="hidden" name="lstMois" value="<?php echo $moisSelectionne; ?>">
<!--            <input type="hidden" name="uc" value="validerFrais">-->
        </form>
    </div>
    <div class="col-md-4">Nombre de justificatifs :
        <input type="text" name="nbJustificatifs" class="form-inline" value="<?php echo $nbJustificatifs; ?>">
    </div>
    <div class="col-md-4">
        <button class="btn btn-success" type="submit" name="valider">Valider</button>
        <button class="btn btn-danger" type="reset">Réinitialiser</button>
    </div>
</div>

<?php
            }
                   
                