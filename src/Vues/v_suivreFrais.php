<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<div class="container">
    <form method="get" action="index.php?uc=suivreFrais">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <label for="typeFiche" class="me-2 mb-0">Choisir le type de fiche :</label>
                    <select id="typeFiche" name="typeFiche" class="custom-select" onchange="this.form.submit()">
                        <option value="">Commencer par choisir un type</option>
                        <option value="VA">Fiche validée</option>
                        <option value="CL">Fiche clôturée</option>
                    </select>
                </div>
            </div>

<!--            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <label for="lstMois" class="me-2 mb-0">Fiches :</label>
                    <select id="lstMois" name="lstMois" class="custom-select" onchange="this.form.submit()">
                        <option value="">Choisir une fiche</option>
                        <?php
                        if (!empty($lesMois)) {
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
            </div>-->
        </div>
        <input type="hidden" name="uc" value="suivreFrais"> <!-- Ajout de l'UC dans l'URL -->
    </form>
</div>