<?php
$page_title = "Liste des offres";

include 'header.php';

// Liste des offres (par défaut sous forme de tableau)
?>
<?php
            //ON Récupère l'id si l'utilisateur a cliqué sur la carte de l'accueil et on affiche les offres correspondantes
if (isset($_GET['id']) or isset($_GET['vil'])){
    $id= $_GET['id'];
    $ids= $_GET['vil'];
    $dep = "select * from departments";
    $department = $bdd->query($dep);
    $b = "select * from offers_types";
    $bi = $bdd->query($b);
    $tran = "select * from transactions_types";
    $t = $bdd->query($tran);
    ?>
    <form method="post" action="?r=">
        <table style="border: 1px solid black;">
            <tr>
                <th>
                    Département:<br> <select name="department">
                        <?php while ($depa = mysqli_fetch_object($department)) { ?>
                            <option value="<?php echo($depa->id); ?>">
                                <?php echo($depa->name) ?> </option>
                        <?php } ?>
                    </select></th>
                <th>Code-postal:<br> <input type="number" name="cp" id="recherche"></th>
                <th>Ville:<br> <input type="text" name="ville" id="recherche"></th>
                <th>Type bien: <br><select name="bien" multiple>
                        <?php while ($bien = mysqli_fetch_object($bi)) { ?>
                            <option value="<?php echo($bien->id); ?>">
                                <?php echo($bien->name) ?> </option>
                        <?php } ?>
                    </select></th> <br>
            </tr>
            <tr style="border-bottom: 1px solid black; ">
                <th> Type transactions:<br><select name="transaction">

                        <?php while ($trans = mysqli_fetch_object($t)) { ?>
                            <option value="<?php echo($trans->id); ?>">
                                <?php echo($trans->name) ?> </option>
                        <?php } ?>
                    </select></th>
                <th>Divisible: <br> oui: &nbsp;<input type="radio" name="div" value="oui"/> non: &nbsp;<input
                        type="radio" name="div" value="non" checked/></th>
                <th>Affichage photo: <br> oui: &nbsp;<input type="radio" name="aff" value="oui"/> non: &nbsp;<input
                        type="radio" name="aff" value="non" checked/></th>
                <!-- <div data-role="rangeslider">
                     <b>0</b> <input id="ex2" type="range" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>1000</b>

                 </div> -->
            </tr>
        </table>
        <button type="submit" name="submit">Rechercher</button>
    </form>
    <!-- AFFICHAGE DE LA LISTE -->
    <table class="table">
        <thead>
        <?php
        if (isset($_GET['tri'])){
            $tri = $_GET['tri'];

            $sql = "
SELECT o.id as oid,o.picture_url, ot.name as bien, tt.name as transa, o.city, o.postal_code, o.surface, o.subdividable, o.price
FROM offers AS o
INNER JOIN offers_types AS ot ON o.offer_types_id = ot.id
INNER JOIN transactions_types AS tt ON o.transaction_types_id = tt.id
ORDER BY $tri ASC 
";} else {
            $sqli = "
SELECT o.id AS oid, o.picture_url, ot.name AS bien, tt.name AS transa, o.city, o.postal_code, o.surface, o.subdividable, o.price
FROM offers AS o
INNER JOIN offers_types AS ot ON o.offer_types_id = ot.id
LEFT JOIN transactions_types AS tt ON o.transaction_types_id = tt.id
LEFT JOIN departments AS d ON o.departement_id = d.id
WHERE d.id = $id
ORDER BY o.id ASC 
";
        }?>
        <tr>
            <th><a href="?tri=ot.name"> Type bien</a></th>
            <th><a href="?tri=tt.name">Type transaction </a></th>
            <th><a href="?tri=o.city"> Ville</a></th>
            <th><a href="?tri=o.postal_code"> Code postal</a></th>
            <th><a href="?tri=o.surface"> Surface</a></th>
            <th><a href="?tri=o.subdividable">Divisible</a></th>
            <th><a href="?tri=o.price">Prix</a></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($bdd->query($sqli) as $row) { ?>
            <!-- Comme dans cette ligne d'exemple, utilisez l'attribut spécial Simplon "data-href"
            pour mettre un lien en dehors des balises <a> -->
            <tr <?php echo 'data-href="offre.php?id=' . $row['oid'] . '"' ?>>
                <th><?php echo $row['bien'] ?></th>
                <th><?php echo $row['transa'] ?></th>
                <th><?php echo $row['city'] ?></th>
                <th><?php echo $row['postal_code'] ?></th>
                <th><?php echo $row['surface'] ?></th>
                <th><?php if ($row['subdividable'] == 1) {
                        echo "oui";
                    } else {
                        echo "non";
                    } ?></th>
                <th><?php echo $row['price'] ?></th>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php }
                        // Si l'utilisateur a rempli les critères
elseif (isset($_POST['submit'])) {

    $biens = ($_POST['bien']);
    $trans = ($_POST['transaction']);
    $afficher = ($_POST['aff'] == 'oui') ? true : false;
    $depa = ($_POST['department']);
    $cp = ($_POST['cp']);
    $ville = ($_POST['ville']);
    $divisible = ($_POST['div'] == 'oui') ? true : false;

    $array= [];
    if (!empty($biens)){
    $type_b= "ot.id=".$biens;
        array_push($array, $type_b);
    }
    if (!empty($trans)){
    $type_trans= "tt.id=".$trans;
        array_push($array, $type_trans);
    }
    if (!empty($depa)){
    $departement= "d.id=".$depa;
        array_push($array, $departement);
    }
    if (!empty($cp)){
    $codep= "o.postal_code=".$cp;
        array_push($array, $codep);
    }
    if (!empty($ville)){
        $villes= "o.city='$ville'";
        array_push($array, $villes);
    }
    if($divisible!= false){
        $divi= "o.subdividable=".$divisible;
        array_push($array, $divi);
    }
    $sql= "WHERE ".implode(" AND ", $array). " ";

    $filtre = "
SELECT o.id as oid, ot.name as bien, tt.name as transa, o.city, o.postal_code, o.surface, o.subdividable, o.price, d.name as department 
FROM offers AS o 
INNER JOIN offers_types AS ot ON o.offer_types_id = ot.id 
LEFT JOIN transactions_types AS tt ON o.transaction_types_id = tt.id 
LEFT JOIN departments as d ON o.departement_id= d.id 
$sql 
 ORDER BY o.id ASC
";
    $dep = "select * from departments";
    $department = $bdd->query($dep);
    $b = "select * from offers_types";
    $bi = $bdd->query($b);
    $tran = "select * from transactions_types";
    $t = $bdd->query($tran);
    ?>
    <form method="post" action="?r=">
        <table style="border: 1px solid black;">
            <tr>
                <th>
                    Département:<br> <select name="department">
                        <?php while ($depa = mysqli_fetch_object($department)) { ?>
                            <option value="<?php echo($depa->id); ?>">
                                <?php echo($depa->name) ?> </option>
                        <?php } ?>
                    </select></th>
                <th>Code-postal:<br> <input type="number" name="cp" id="recherche"></th>
                <th>Ville:<br> <input type="text" name="ville" id="recherche"></th>
                <th>Type bien: <br><select name="bien" multiple>
                        <?php while ($bien = mysqli_fetch_object($bi)) { ?>
                            <option value="<?php echo($bien->id); ?>">
                                <?php echo($bien->name) ?> </option>
                        <?php } ?>
                    </select></th> <br>
            </tr>
            <tr style="border-bottom: 1px solid black; ">
                <th> Type transactions:<br><select name="transaction">

                        <?php while ($trans = mysqli_fetch_object($t)) { ?>
                            <option value="<?php echo($trans->id); ?>">
                                <?php echo($trans->name) ?> </option>
                        <?php } ?>
                    </select></th>
                <th>Divisible: <br> oui: &nbsp;<input type="radio" name="div" value="oui"/> non: &nbsp;<input
                        type="radio" name="div" value="non" checked/></th>
                <th>Affichage photo: <br> oui: &nbsp;<input type="radio" name="aff" value="oui"/> non: &nbsp;<input
                        type="radio" name="aff" value="non" checked/></th>
                <!-- <div data-role="rangeslider">
                     <b>0</b> <input id="ex2" type="range" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>1000</b>

                 </div> -->
            </tr>
        </table>
        <button type="submit" name="submit">Rechercher</button>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th><a href="?tri=bien"> Type bien</a></th>
            <th><a href="?tri=trans">Type transaction </a></th>
            <th><a href="?tri=ville"> Ville</a></th>
            <th><a href="?tri=cp"> Code postal</a></th>
            <th><a href="?tri=surface"> Surface</a></th>
            <th><a href="?tri=div">Divisible</a></th>
            <th><a href="?tri=prix">Prix</a></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($bdd->query($filtre) as $row) { ?>
            <!-- Comme dans cette ligne d'exemple, utilisez l'attribut spécial Simplon "data-href"
            pour mettre un lien en dehors des balises <a> -->
            <tr <?php echo 'data-href="offre.php?id=' . $row['oid'] . '"' ?>>
                <th><?php echo $row['bien'] ?></th>
                <th><?php echo $row['transa'] ?></th>
                <th><?php echo $row['city'] ?></th>
                <th><?php echo $row['postal_code'] ?></th>
                <th><?php echo $row['surface'] ?></th>
                <th><?php if ($row['subdividable'] == 1) {
                        echo "oui";
                    } else {
                        echo "non";
                    } ?></th>
                <th><?php echo $row['price'] ?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } else {
                // ON affiche les offres sans filtre
    ?>
                <!-- FORMULAIRE DE RECHERCHE DE CRITERE -->
    <?php
    $dep = "select * from departments";
    $department = $bdd->query($dep);
    $b = "select * from offers_types";
    $bi = $bdd->query($b);
    $tran = "select * from transactions_types";
    $t = $bdd->query($tran);
    ?>
    <form method="post" action="?r=">
        <table style="border: 1px solid black;">
            <tr>
                <th>
                    Département:<br> <select name="department">
                        <?php while ($depa = mysqli_fetch_object($department)) { ?>
                            <option value="<?php echo($depa->id); ?>">
                                <?php echo($depa->name) ?> </option>
                        <?php } ?>
                    </select></th>
                <th>Code-postal:<br> <input type="number" name="cp" id="recherche"></th>
                <th>Ville:<br> <input type="text" name="ville" id="recherche"></th>
                <th>Type bien: <br><select name="bien" multiple>
                        <?php while ($bien = mysqli_fetch_object($bi)) { ?>
                            <option value="<?php echo($bien->id); ?>">
                                <?php echo($bien->name) ?> </option>
                        <?php } ?>
                    </select></th> <br>
            </tr>
            <tr style="border-bottom: 1px solid black; ">
                <th> Type transactions:<br><select name="transaction">
                        <?php while ($trans = mysqli_fetch_object($t)) { ?>
                            <option value="<?php echo($trans->id); ?>">
                                <?php echo($trans->name) ?> </option>
                        <?php } ?>
                    </select></th>
                <th>Divisible: <br> oui: &nbsp;<input type="radio" name="div" value="oui"/> non: &nbsp;<input
                        type="radio" name="div" value="non" checked/></th>
                <th>Affichage photo: <br> oui: &nbsp;<input type="radio" name="aff" value="oui"/> non: &nbsp;<input
                        type="radio" name="aff" value="non" checked/></th>
                <!-- <div data-role="rangeslider">
                     <b>0</b> <input id="ex2" type="range" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>1000</b>

                 </div> -->
            </tr>
        </table>
        <button type="submit" name="submit">Rechercher</button>
    </form>
    <!-- AFFICHAGE DE LA LISTE -->
    <table class="table">
        <thead>
        <?php
        if (isset($_GET['tri'])){
            $tri = $_GET['tri'];

                $sql = "
SELECT o.id as oid,o.picture_url, ot.name as bien, tt.name as transa, o.city, o.postal_code, o.surface, o.subdividable, o.price
FROM offers AS o
INNER JOIN offers_types AS ot ON o.offer_types_id = ot.id
INNER JOIN transactions_types AS tt ON o.transaction_types_id = tt.id
ORDER BY $tri ASC 
";} else{
            $sql = "
SELECT o.id as oid,o.picture_url, ot.name as bien, tt.name as transa, o.city, o.postal_code, o.surface, o.subdividable, o.price
FROM offers AS o
INNER JOIN offers_types AS ot ON o.offer_types_id = ot.id
INNER JOIN transactions_types AS tt ON o.transaction_types_id = tt.id
ORDER BY oid ASC ";
        }
        ?>
        <tr>
            <th><a href="?tri=ot.name"> Type bien</a></th>
            <th><a href="?tri=tt.name">Type transaction </a></th>
            <th><a href="?tri=o.city"> Ville</a></th>
            <th><a href="?tri=o.postal_code"> Code postal</a></th>
            <th><a href="?tri=o.surface"> Surface</a></th>
            <th><a href="?tri=o.subdividable">Divisible</a></th>
            <th><a href="?tri=o.price">Prix</a></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($bdd->query($sql) as $row) { ?>
            <!-- Comme dans cette ligne d'exemple, utilisez l'attribut spécial Simplon "data-href"
            pour mettre un lien en dehors des balises <a> -->
            <tr <?php echo 'data-href="offre.php?id=' . $row['oid'] . '"' ?>>
                <th><?php echo $row['bien'] ?></th>
                <th><?php echo $row['transa'] ?></th>
                <th><?php echo $row['city'] ?></th>
                <th><?php echo $row['postal_code'] ?></th>
                <th><?php echo $row['surface'] ?></th>
                <th><?php if ($row['subdividable'] == 1) {
                        echo "oui";
                    } else {
                        echo "non";
                    } ?></th>
                <th><?php echo $row['price'] ?></th>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php } ?>
<script>
    var liste = [
        "Epinal",
        "Bar-Le-Duc",
        "Chaumont",
        "Châlons En-Champagne",
        "Charleville Mézières",
        "Ludres",
        "Mulhouse",
        "Metz",
        "Nancy",
        "Strasbourg",
        "Troyes",
        "Verdun"

    ];

    $('#recherche').autocomplete({
        source : liste
    });
</script>
<?php

include 'footer.php';