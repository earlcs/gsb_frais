    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>  
        <ul id="menuList">
			<li >
				
                               Comptable : <br>
                               
				<?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
			</li><br>
           <li class="smenu">
              <a href="index.php?uc=validerFicheFrais&action=voirVisiteur" title="Valider fiches de frais">Valider fiches de frais</a>
           </li><br>
           <li class="smenu">
              <a href="index.php?uc=suivieFicheFrais&action=selectionnerMoisVisiteur" title="Suivre le paiement fiche de frais ">Suivre le paiement fiche de frais</a>
           </li><br>
 	   <li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
         </ul>
        
    </div>
    