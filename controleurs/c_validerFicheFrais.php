<?php

include("vues/v_sommaireC.php");

$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

switch ($action) {
    //sélectionner un visiteur dans la liste des visiteurs
    case 'voirVisiteur': { 
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $key = array_keys($lesVisiteurs);
            $selectionnerVisiteur = $key[0];
            include("vues/v_voirVisiteur.php");
            break;
        }
    //afficher fiche de frais du visiteur sélectionné
    case 'LaFicheduVisiteur': {
            $leVisiteur = $_REQUEST['lstVisiteur'];
            $_SESSION['leVisiteur'] = $leVisiteur;
            $leMois = $_POST['lstMois'];
            $_SESSION['leMois'] = $leMois;
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $selectionnerVisiteur = $leVisiteur;
            include("vues/v_voirVisiteur.php");

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $idEtat=$lesInfosFicheFrais['idEtat'];
           
	    /*if ($lesFraisForfait == NULL & $lesFraisHorsForfait == NULL & $lesInfosFicheFrais == NULL ) {
                ajouterErreur("Ce visiteur n'a pas remplit de fiche frais le " . $numMois . "/". $numAnnee);
                include("vues/v_erreurs.php");
                break;
            
            }*/
            //renvoie un message d'erreur quand l'état de la fiche de frais est différent de 'CL'
            if ($idEtat!='CL'){
                //renvoie un message d'erreur ci-dessous quand l'état de la fiche de frais est validée
                if($idEtat =='VA'){
                    ajouterErreur("Ce visiteur a déjà validé la fiche de frais du " . $numMois . "/". $numAnnee );
                    include("vues/v_erreurs.php");
                    break;
                }
            	ajouterErreur("Ce visiteur n'a pas remplit de fiche frais le " . $numMois . "/". $numAnnee);
                include("vues/v_erreurs.php");
                break;    
            }
            
            else{
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif = $lesInfosFicheFrais['dateModif'];
                $dateModif = dateAnglaisVersFrancais($dateModif);
                $tabMontant = $pdo->getLesMontants();
                $leVisiteur = $_SESSION['leVisiteur'];
                $leMois = $_SESSION['leMois'];
            
                $tabQuantites = $pdo->getLesQuantites($leVisiteur, $leMois);
                $montant = 0;
                for ($i = 0; $i < 4; $i++) {
                    $montant += ($tabMontant[$i][0] * $tabQuantites[$i][0]);
                }
                $montantHorsForfait = $pdo->getMontantHorsForfait($leVisiteur, $leMois);
            
                $montant += $montantHorsForfait[0];
                $pdo->majMontantValide($leVisiteur, $leMois, $montant);
                include("vues/v_voirFiche.php");
                break;
            }
        }
    case 'ModifFiche': {
            $leVisiteur = $_SESSION['leVisiteur'];
            $leMois = $_SESSION['leMois'];
            $lesFrais = $_REQUEST['lesFrais'];
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $selectionnerVisiteur = $leVisiteur;
            include("vues/v_voirVisiteur.php");
            
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);

             if (lesQteFraisValides($lesFrais)) {
                $pdo->majFraisForfait($leVisiteur, $leMois, $lesFrais);
                ajouterErreur("Informations mises à jour");
                include("vues/v_erreurs.php");
            } else {
                ajouterErreur("Les valeurs des frais doivent être numériques");
                include("vues/v_erreurs.php");
            }

	    $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_voirFiche.php");
	    break;
        }
    //modifie frais hors forfait en ajoutant devant le libellé le mot REFUSE
    case 'supprimerFrais': {
	    $leVisiteur = $_SESSION['leVisiteur'];
            $leMois = $_SESSION['leMois'];
            $lesVisiteurs = $pdo->getLesVisiteurs();
            $selectionnerVisiteur = $leVisiteur;
            include("vues/v_voirVisiteur.php");

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);

	    $idFrais = $_REQUEST['idFrais'];
	    $rs=$pdo->ModifFraisHorsForfait($idFrais);

	    if($rs == 0){
		ajouterErreur("Le frais hors forfait a bien été supprimé");
		include("vues/v_erreurs.php");
	    }

	    else{
		ajouterErreur("Ce frais hors forfait a déjà été supprimé");
		include("vues/v_erreurs.php");
	    }

	    $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_voirFiche.php");
	    break;
    }
    
    case "reporterFrais": {

        $mois = $_SESSION['leMois'];
        $leVisiteur = $_SESSION['leVisiteur'];
        $idFrais = $_REQUEST['idFrais'];
        $rs = $pdo->reporterFrais($idFrais, $mois, $leVisiteur);
        if ($rs == 1) {
            ajouterErreur("Le Frais est déjà supprimé il ne peut pas être reporter");
            include("vues/v_erreurs.php");
        }
        if ($rs == NULL) {
            ajouterErreur("Le Frais a bien été reporter");
            $type = 1;
            
            include("vues/v_erreurs.php");
        }
        break;
    }

    case "validerFrais": {
        $leVisiteur = $_SESSION['leVisiteur'];
        $leMois = $_SESSION['leMois'];
        $nbJustificatifs = $_REQUEST['nbJustificatifs'];
        $rs = $pdo->majEtatFicheFrais2($leVisiteur, $leMois, "VA", $nbJustificatifs);

        $tabMontant = $pdo->getLesMontants();
        
        $tabQuantites = $pdo->getLesQuantites($leVisiteur, $leMois);
        $montant = 0;
        for ($i = 0; $i < 4; $i++) {
            $montant += ($tabMontant[$i][0] * $tabQuantites[$i][0]);
        }
        $montantHorsForfait = $pdo->getMontantHorsForfait($leVisiteur, $leMois);
       
        $montant += $montantHorsForfait[0];
        $pdo->majMontantValide($leVisiteur, $leMois, $montant);
        if ($rs == 0) {
            ajouterErreur('La Fiche frais a bien été validé!');
            $type = 1;
            include("vues/v_erreurs.php");
        } else {
            ajouterErreur("La Fiche frais n'a pas été validé!");
            include("vues/v_erreurs.php");
        }
        break;
    }

    /*case 'reporterFrais':{
            $idVisiteur = $_SESSION['leVisiteur'];
            $mois = $_SESSION['leMois'];
            $idFrais = $_REQUEST['idFrais'];
            $lesVisiteurs = $pdo->reporterFrais($idFrais, $mois, $idVisiteur);
            if(){
                
        
	    break;
	}*/
   /*case 'validerFrais':{
    *       break;
    *   }*/

}
?>
