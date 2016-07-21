<?php
$page_title = "Ajouter une offres";

include 'header.php';

// Ajouter une offres
?>
<?php
$dep = "select * from departments";
$department = $bdd->query($dep);
$b = "select * from offers_types";
$bi = $bdd->query($b);
$tran = "select * from transactions_types";
$t = $bdd->query($tran);

?>
    <form method="post" action="add_action.php">
        <table>
            <tr>
                <td style="padding-right: 200px;">
                    <h3>Information du bien:</h3>
                    <label>
                        Type bien: <br><select name="bien" required>
                            <?php while ($bien = mysqli_fetch_object($bi)) { ?>
                                <option value="<?php echo($bien->id); ?>">
                                    <?php echo($bien->name) ?> </option>
                            <?php } ?>
                            </select> <br>
                        Type transactions:<br><select name="transaction" required>
                            <?php while ($trans = mysqli_fetch_object($t)) { ?>
                                <option value="<?php echo($trans->id); ?>">
                                    <?php echo($trans->name) ?> </option>
                            <?php } ?>
                        </select> <br>
                        Prix: <br><input type="number" name="price" required><br>
                        Commission: <br> avec: <input type="radio" name="com" value="oui"/> &nbsp; sans:<input
                            type="radio" name="com" value="non"/>

                        <br>Département:<br> <select name="department" required>
                            <?php while ($depa = mysqli_fetch_object($department)) { ?>
                                <option value="<?php echo($depa->id); ?>">
                                    <?php echo($depa->name) ?> </option>
                            <?php } ?>
                        </select>
                        <br>
                        <p>Adresse:<br> <input type="text" name="adresse"></p>
                        <p>Code-postal:<br> <input type="number" name="cp"></p>
                        <p>Ville:<br> <input type="text" name="ville" required></p>
                        <p>Description: <br>
                            <textarea name="description" rows="6" cols="30"></textarea></p>
                        <p>Hauteur sous-faîtage(m): <br> <input type="number" name="hf"></p>
                        <p>Surface(m²): <br> <input name="surface" type="number"></p>
                        <p>Divisible: <br> oui: &nbsp;<input type="radio" name="div" value="oui"/> non: &nbsp;<input
                                type="radio" name="div" value="non"/></p>

                        <p><span style="font-weight: bold"> Photo:</span> <br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000"/>
                            <input type="file" name="photo">
                    </label>
                </td>
                <br>
                <td>
                    <h3> Informations du vendeur:</h3>
                    <label>
                        <p>Type (agence, particulier...):<br> <input type="text" name="type-vendeur"></p>
                        <p>Nom du déposeur de l'annonce: <br> <input type="text" name="nom-vendeur" required></p>
                        <p>Nom du contact de l'agence pour l'annonce: <br> <input type="text" name="nom-contact"
                                                                                  required></p>
                        <p>Adresse:<br> <input type="text" name="adresse-vendeur"></p>
                        <p>Code-postal:<br> <input type="number" name="cp-vendeur"></p>
                        <p>Ville:<br> <input type="text" name="ville-vendeur"></p>
                        <p>Tél:<br> <input type="tel" name="tel-vendeur" required></p>
                        <p>E-mail: <br><input type="text" name="email"></p>
                        <p><span style="font-weight: bold">annonce en pdf: </span>
                        <FORM ENCTYPE="multipart/form-data"  METHOD="POST">
                            <INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000">
                            Envoyez ce fichier : <INPUT NAME="pdf" TYPE="file">
                            <INPUT TYPE="submit" VALUE="Télécharger">
                        </FORM>
                    </label>
                </td>
            </tr>
        </table>
        <br>
    </form>
<?php

include 'footer.php';