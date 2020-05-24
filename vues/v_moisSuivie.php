<div id="contenu">
    <h2>Suivi des fiches de frais</h2>
    <h3>Fiches des visiteurs et mois à sélectioner : </h3>
    <form action="index.php?uc=suivieFicheFrais&action=voirFrais" method="post">
        <div class="corpsForm">

            <p>

                <label for="lstVisiteurvalide" accesskey="n">Visiteur : </label>
                <select id="lstVisiteurvalide" name="lstVisiteurvalide">
                    <?php
		    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];                        
                        $numAnnee = $unMois['numAnnee'];                        
                        $numMois = $unMois['numMois'];
                        $nomDate = $unMois["nomMois"];
                        $prenomDate = $unMois["prenomMois"];                        
                        ?>
                        <option selected value="<?php echo $mois."/".$unMois['id']; ?>"><?php echo $numMois . "/" . $numAnnee." - ".$nomDate."  ".$prenomDate; ?> </option>
                        <?php } ?>
                </select>
            </p>
        </div>
        <div class="piedForm">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
            </p> 
        </div>
    </form>   
    
