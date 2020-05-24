
<div id="contenu">
    <h2>Validation des fiches frais</h2>
    <h3>Visiteur et Mois à sélectionner : </h3>
    <form action="index.php?uc=validerFicheFrais&action=LaFicheduVisiteur" method="post">
        <div class="corpsForm">

            <p>
                <label for="lstVisiteur" accesskey="l">Visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur">
                    <?php 
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $selectionnerVisiteur) {
                            ?>

                            <option selected value="<?php echo $id ?>"><?php echo $nom . " " . $prenom ?> </option>
                        <?php } else {
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $nom . " " . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>
                </select>

                <div>
                    <label for="lstMois">Mois : </label>

                    <select id="lstMois" name="lstMois">
                        <?php
                        //liste des six derniers mois
                        $tableauMois = getSixDernierMois();
                        for ($i = 0; $i < count($tableauMois); $i++) {
                            $numMois = substr($tableauMois[$i], 4, 2);
                            $numAnnee = substr($tableauMois[$i], 0, 4);
                            ?>
                            <option value=<?php echo $tableauMois[$i]; ?>><?php echo $numMois . "/" . $numAnnee; ?></option>
                            <?php
                        }
                        ?>
                    </select>

                </div>
                <div>
                    <p>
                    <div class="piedForm">
                        <input id="ok" type="submit" value="Valider" size="20" />
                    </div>
                    </p>
                </div>
            </p>
        </div>
    </form> 


