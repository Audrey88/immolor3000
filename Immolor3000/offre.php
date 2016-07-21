<?php
// l'id est envoyé dans la requête
if (!isset($_GET['id'])) {
    exit("Le paramètre id est manquant dans l'url");
}
$offer_id = $_GET['id'];

$page_title = "Offres " . $offer_id;

include 'header.php';
$offre = "SELECT 
o.id,
o.description, 
o.ridge_height, 
o.address AS bienAdresse, 
o.postal_code, 
o.city,
o.affilate_id,
o.price,
o.surface,
o.commission_included,
o.subdividable,
ot.name AS bien,
tt.name AS transactions,
a.type,
a.name AS vendeur,
a.address AS adresseV,
a.phone,
a.contact_name,
a.email,
d.name
FROM offers as o 
INNER JOIN offers_types as ot ON o.offer_types_id= ot.id
INNER JOIN transactions_types as tt ON o.transaction_types_id= tt.id
LEFT JOIN affilates as a ON o.affilate_id= a.id
INNER JOIN departments as d ON o.departement_id= d.id
WHERE o.id = '$offer_id'";
foreach ($bdd->query($offre) as $row) {

    ?>
    <div><h2><?php echo $row['bien'] . "&nbsp;" . $row['transactions'] . "&nbsp;" . $row['price'] . "€"; ?></h2></div>

    <table>
            <h3>Information du bien :</h3>
            <tr><label>Offre numéro <?= $offer_id ?></label></tr> <br>
            <tr><label>Lieu : <?php echo $row['bienAdresse'] . "&nbsp;" . $row['postal_code']; ?> </label></tr><br>
            <tr><label>Ville : <?php echo $row['city']; ?>  </label></tr><br>
        <tr><label>Description :<br> <?php echo $row['description']; ?></label> <br></tr>
      <br>


        <tr>Hauteur sous-faîtage : <?php echo $row['ridge_height']; ?><br></tr>
        <tr>Surface: <?php echo $row['surface']; ?><br></tr>
        <tr> Prix: <?php echo $row['price'] . "€" ?></tr>
        <br>
        <tr>Commission comprise: <?php if ($row['subdividable'] == 1) {echo "oui";} else {echo "non";} ?></tr> <br>
        <tr>Nom du contact de l'agence: <?php $row['contact_name']; ?></tr>
    </table>
    <table>
        <h3> Information du vendeur:</h3>
        <tr> Type: <?php echo $row['type'] ?></tr> <br>
        <tr> Nom: <?php echo $row['vendeur'] ?></tr><br>
        <tr> Adresse: <?php echo $row['adresseV'] ?></tr><br>
        <tr> Tel: <?php echo $row['phone'] ?></tr> <br>
        <tr> Email: <?php echo $row['email']; ?></tr>
    </table>
    <?php
}
include 'footer.php';