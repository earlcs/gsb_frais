<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
</h3>
<div class="encadre">
    <p>
        Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?> €


    </p>
    
    <table class="listeLegere">
        <caption>Eléments forfaitisés </caption>
        <tr>
            <?php
            foreach ($lesFraisForfait as $unFraisForfait) {
                $libelle = $unFraisForfait['libelle'];
                ?>	
                <th> <?php echo $libelle ?></th>
                <?php
            }
            ?>
        </tr>
        <tr>
        <form action="index.php?uc=validerFicheFrais&action=ModifFiche" method="post">  
            <?php
            
            foreach ($lesFraisForfait as $unFraisForfait) {
                $idFrais = $unFraisForfait['idFrais'];
                $quantite = $unFraisForfait['quantite'];
                ?>
        
            <td class="qteForfait"><input type="text"  name="lesFrais[<?php echo $idFrais?>]" value="<?php echo $quantite ?>" size="10" /></td>
                <?php
            }
            ?>
        </tr>
    </table>
    <p>
    <div class="piedForm">
        <input id="ok" type="submit" value="Valider" size="20" />
    </div>
    </p> 
    </br>
</form> 
        
<div>    
    <form action="index.php?uc=validerFicheFrais&action=validerFrais" method="post">
    <table class="listeLegere">
        <caption>Descriptif des éléments hors forfait - <input type="text" name="nbJustificatifs" 
	value=<?php echo $nbJustificatifs;?> /> justificatifs reçus -
        </caption>
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th> 
            <th class='Action' colspan="2">Action</th>                

        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = $unFraisHorsForfait['libelle'];
            $montant = $unFraisHorsForfait['montant'];
            $id = $unFraisHorsForfait['id'];
            
            if (strstr($libelle,"REFUSE")){
                ?>
                <tr style='background:red'>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=validerFicheFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer</td>
                    <td><a href="index.php?uc=validerFicheFrais&action=reporterFrais&idFrais=<?php echo $id ?>" 
				onclick="return confirm('Voulez-vous vraiment reporter ce frais?');">Reporter</td>
                </tr>
            <?php  } else{ ?>
                <tr >
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=validerFicheFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer</td>
                    <td><a href="index.php?uc=validerFicheFrais&action=reporterFrais&idFrais=<?php echo $id ?>" 
                                    onclick="return confirm('Voulez-vous vraiment reporter ce frais?');">Reporter</td>
                </tr>
            <?php } 
            } ?>
    </table>
</div>
<div class="piedForm">
    <input id="ok" type="submit" value="Valider la Fiche" size="20" />
</div>
</form>
</div>
