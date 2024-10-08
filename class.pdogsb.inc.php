<?php
    $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
    $requetePrepare->bindParam(':unMdp', md5($mdp), PDO::PARAM_STR);
    ?>

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

