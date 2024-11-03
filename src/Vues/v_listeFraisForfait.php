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
    <?php
$userType = $_SESSION['user_type'] ?? '';
            if ($userType === 'visiteur') {
                ?>  
    <h2>Renseigner ma fiche de frais du mois 
        <?php echo $numMois . '-' . $numAnnee ?>
    </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
              role="form">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Ajouter</button>
                <button class="btn btn-danger" type="reset">Effacer</button>
            </fieldset>
        </form>
    </div>
</div>
<?php
    } 
    
//  Partie comptable, trop de différence de code et de conditions pour faire "mélanger" les deux versions qui serait trop dure à lire
    else
    {            
        ?>
<h2 class="text-comptable"><?php echo $erreurMois ? " Pas de fiche pour le mois courant, choisir un mois dans la liste des mois disponibles" :"" ?>
                        
                        
</h2>

<h2 class="text-comptable">Valider la fiche de frais,
                        <?php echo $validationInterdite ? " : INTERDIT" :"" ?>
                        état : <?php echo $infoFicheFrais["libEtat"]; ?>
                        
</h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4 <?php echo $correctionFraisForfait ? "light-yellow" :"" ?>" >
        <form method="post" 
              action="index.php?uc=validerFrais&action=validerMajFraisForfait&idVisiteurSelectionne=<?php echo $idVisiteurSelectionne; ?>&moisSelectionne=<?php echo $moisSelectionne; ?>" 
              role="form">
            <fieldset>       
                <?php
                $hasNonNullInput = false; // Variable pour vérifier les inputs non nuls
                
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; 
                    
                    // Vérifier si la quantité est non nulle
                if (!empty($quantite)) {
                    $hasNonNullInput = true; // Attribuer true si au moins un input n'est pas vide
                }
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                
                <?php
            if ($hasNonNullInput) { // Vérifier si au moins un input est non vide
                ?>
                <button class="btn btn-success" type="submit" <?php echo $modificationFraisInterdite ? 'disabled':''; ?>>Corriger</button>
                <button class="btn btn-danger" type="reset" <?php echo $modificationFraisInterdite ? 'disabled':''; ?>>Réinitialiser</button>
                <?php echo $correctionFraisForfait ? "FRAIS ENREGISTRE" :"" ?>
            <?php
            }
            ?>
            </fieldset>
<!--            <input type="hidden" name="idVisiteurSelectionne" value="<?php echo $idVisiteurSelectionne; ?>">
            <input type="hidden" name="moisSelectionne" value="<?php echo $moisSelectionne; ?>">-->
        </form>
    </div>
</div>
<?php
    }
    