<?php

/**
 * Vue Liste des mois
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

<link rel="stylesheet" href="../public/styles/style.css">

<div class="container">
    <form method="get" action="index.php?uc=validerFrais">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <label for="lstVisiteurs" class="me-2 mb-0">Choisir le visiteur :</label>
                    <select id="lstVisiteurs" name="lstVisiteurs" class="custom-select" onchange="this.form.submit()">
                        <option value="">Commencer par choisir le visiteur</option>
                        <?php foreach ($lesVisiteurs as $unVisiteur) {
                            $idVisiteur = $unVisiteur['id'];
                            $prenom = $unVisiteur['prenom'];
                            $nom = $unVisiteur['nom'];
                            $selected = ($idVisiteur == $idVisiteurSelectionne) ? 'selected' : ''; ?>
                            <option value="<?php echo $idVisiteur; ?>" <?php echo $selected; ?>>
                                <?php echo $nom . ' ' . $prenom; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <label for="lstMois" class="me-2 mb-0">Mois :</label>
                    <select id="lstMois" name="lstMois" class="custom-select" onchange="this.form.submit()">
                        <option value="">Choisir le mois</option>
                        <?php if (!empty($lesMois)) {
                            foreach ($lesMois as $unMois) {
                                $mois = $unMois['mois'];
                                $numAnnee = $unMois['numAnnee'];
                                $numMois = $unMois['numMois'];
                                $selected = ($mois == $moisSelectionne) ? 'selected' : ''; ?>
                                <option value="<?php echo $mois; ?>" <?php echo $selected; ?>>
                                    <?php echo $numMois . '/' . $numAnnee; ?>
                                </option>
                            <?php } 
                        } ?>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="uc" value="validerFrais"> <!-- Ajout de l'UC dans l'URL -->
    </form>
</div>



   
                


           
    
   