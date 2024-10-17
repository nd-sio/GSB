<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

use Outils\Utilitaires;
$etatSelectionne = filter_input(INPUT_GET, 'etatFiche', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($etatSelectionne) {
        $lesFiches = $pdo->getAllFichesFrais($etatSelectionne);}
        


echo '<pre>' , var_dump('état sélectionné',$etatSelectionne) , '</pre>';
echo '<pre>' , var_dump($lesFiches) , '</pre>';
//echo '<pre>' , var_dump($lesFichesBis) , '</pre>';


require PATH_VIEWS . 'v_suivreFrais.php';