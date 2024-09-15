<?php

/**
 * Gestion de la connexion
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
 */

use Outils\Utilitaires;

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeConnexion':
        include PATH_VIEWS . 'v_connexion.php';
        break;
    case 'valideConnexion':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $comptable = $pdo->getInfosComptable($login, $mdp);
        if (empty($comptable)) {
        $visiteur = $pdo->getInfosVisiteur($login, $mdp);}

        if (!empty($comptable)) {
            // Comptable trouvé
            $_SESSION['user_type'] = 'comptable';
            $_SESSION['user_info'] = $comptable;
            $id = $comptable['id'];
            $nom = $comptable['nom'];
            $prenom = $comptable['prenom'];
            Utilitaires::connecter($id, $nom, $prenom);
            header('Location: index.php');
        } elseif (!empty($visiteur)) {
            // Visiteur trouvé
            $_SESSION['user_type'] = 'visiteur';
            $_SESSION['user_info'] = $visiteur;
            $id = $visiteur['id'];
            $nom = $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            Utilitaires::connecter($id, $nom, $prenom);
            header('Location: index.php');
        } else {
            // Ni visiteur ni comptable trouvé
            Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
            include PATH_VIEWS . 'v_erreurs.php';
            include PATH_VIEWS . 'v_connexion.php';
        }

        break;
    default:
        include PATH_VIEWS . 'v_connexion.php';
        break;
}