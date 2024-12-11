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
        // hasher les mdp
//        $pdo->transformComptableMdp();
//        $pdo->transformVisiteurMdp();
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//        $comptable = $pdo->getInfosComptable($login, $mdp);
        // on cherche d'abord comptable car la base est + petite et on économise les requêtes :D
        $comptable = $pdo->getInfosComptable2($login);
        if (empty($comptable)) {
//        $visiteur = $pdo->getInfosVisiteur($login, $mdp);
        $visiteur = $pdo->getInfosVisiteur2($login);
        }
        

//        if (!empty($comptable)) {
//            // Comptable trouvé
//            $_SESSION['user_type'] = 'comptable';
//            $_SESSION['user_info'] = $comptable;
//            $id = $comptable['id'];
//            $nom = $comptable['nom'];
//            $prenom = $comptable['prenom'];
//            Utilitaires::connecter($id, $nom, $prenom);
//            header('Location: index.php');
//        } elseif (!empty($visiteur)) {
//            // Visiteur trouvé
//            $_SESSION['user_type'] = 'visiteur';
//            $_SESSION['user_info'] = $visiteur;
//            $id = $visiteur['id'];
//            $nom = $visiteur['nom'];
//            $prenom = $visiteur['prenom'];
//            Utilitaires::connecter($id, $nom, $prenom);
//            header('Location: index.php');
//        } else {
//            // Ni visiteur ni comptable trouvé
//            Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
//            include PATH_VIEWS . 'v_erreurs.php';
//            include PATH_VIEWS . 'v_connexion.php';
//        }
        
        
        switch (true) {
            case $pdo->getInfosVisiteur2($login) != null and password_verify($mdp, $pdo->getMdpVisiteur($login)):
                $_SESSION['user_type'] = 'visiteur';
                $_SESSION['user_info'] = $visiteur;
                $id = $visiteur['id'];
                $nom = $visiteur['nom'];
                $prenom = $visiteur['prenom'];
                Utilitaires::connecter($id, $nom, $prenom);
                header('Location: index.php');
                break;
            
            case $pdo->getInfosComptable2($login) != null and password_verify($mdp, $pdo->getMdpComptable($login)):
                $_SESSION['user_type'] = 'comptable';
                $_SESSION['user_info'] = $comptable;
                $id = $comptable['id'];
                $nom = $comptable['nom'];
                $prenom = $comptable['prenom'];
                Utilitaires::connecter($id, $nom, $prenom);
                header('Location: index.php');

            default:
                Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
                include PATH_VIEWS . 'v_erreurs.php';
                include PATH_VIEWS . 'v_connexion.php';
        }





//                
//        if (password_verify($mdp,$pdo->getMdpVisiteur($login))) {
//            // Visiteur trouvé
//            $_SESSION['user_type'] = 'visiteur';
//            $_SESSION['user_info'] = $visiteur;
//            $id = $visiteur['id'];
//            $nom = $visiteur['nom'];
//            $prenom = $visiteur['prenom'];
//            $email = $visiteur['email'];
//            Utilitaires::connecter($id, $nom, $prenom);
//            header('Location: index.php');
//        } elseif (password_verify($mdp,$pdo->getMdpComptable($login))) {
//            // Comptable trouvé
//            $_SESSION['user_type'] = 'comptable';
//            $_SESSION['user_info'] = $comptable;
//            $id = $comptable['id'];
//            $nom = $comptable['nom'];
//            $prenom = $comptable['prenom'];
//            $email = $comptable['email'];
//            Utilitaires::connecter($id, $nom, $prenom);
//            header('Location: index.php');
//        } else {
//            // Ni visiteur ni comptable trouvé
//            Utilitaires::ajouterErreur('Login ou mot de passe incorrect');
//            include PATH_VIEWS . 'v_erreurs.php';
//            include PATH_VIEWS . 'v_connexion.php';
//        }

        break;
    default:
        include PATH_VIEWS . 'v_connexion.php';
        break;
}