<?php
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
    //affiche la page de connexion
    case 'demandeConnexion': {
        include("vues/v_connexion.php");
    break;
    }
    //vérifie si la connexion est valide (correct)
    case 'valideConnexion': {
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];            
        $visiteur = $pdo->getInfosVisiteur($login, $mdp);
        //si c'est un visiteur existant alors il se connecte
        //et affiche le sommaire pour les visiteurs
        if (is_array($visiteur)) {
            $id = $visiteur['id'];
            $nom = $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            connecter($id, $nom, $prenom);
		    include("vues/v_accueil.php");
            include("vues/v_sommaireV.php");
        }
        //si ce n'est pas un visiteur il vérifie si c'est un comptable
        elseif (!is_array($visiteur)) {
            $comptable = $pdo->getInfosComptable($login, $mdp);
            //si c'est un comptable il se connecte
            //et affiche le sommaire pour les comptables
            if(is_array($comptable)) {
		        $id = $comptable['id'];
		        $nom = $comptable['nom'];
		        $prenom = $comptable['prenom'];
		        connecter($id, $nom, $prenom);
			    include("vues/v_accueil.php");
		        include("vues/v_sommaireC.php");
            } 
            //sinon il renvoie un message d'erreur
            else {
		        ajouterErreur("Login ou mot de passe incorrect");
		        include("vues/v_erreurs.php");
		        include("vues/v_connexion.php");
            }
        }
        //renvoie un message d'erreur si la connexion est incorrect
        else {
            ajouterErreur("Login ou mot de passe incorrect");
            include("vues/v_erreurs.php");
            include("vues/v_connexion.php");
        }

    break;
    }

    default : {
            include("vues/v_connexion.php");
            break;
        }
}
?>
