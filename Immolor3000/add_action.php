<?php
include_once 'config.php';
// script d'ajout de l'offre dans la base MySQL
$bien= ($_POST['bien']);
$trans= ($_POST['transaction']);
$prix= ($_POST['price']);
$commission = ( $_POST['com'] == 'oui' ) ? true : false; // contien true si le choix "oui" a été sélectionné, false dans les autres cas
$dep= ($_POST['department']);
$addr= ($_POST['adresse']);
$cp= ($_POST['cp']);
$ville= ($_POST['ville']);
$description= ($_POST['description']);
$hauteur= ($_POST['hf']);
$surface= ($_POST['surface']);
$divisible = ( $_POST['div'] == 'oui' ) ? true : false;
$vendeur=($_POST['type-vendeur']);
$deposeur=($_POST['nom-vendeur']);
$nom=($_POST['nom-contact']);
$adrVendeur=($_POST['adresse-vendeur']);
$villeVendeur=($_POST['ville-vendeur']);
$cpVendeur= ($_POST['cp-vendeur']);
$tel=($_POST['tel-vendeur']);
$email=($_POST['email']);
$photo=($_POST['photo']);
$urlPhoto= '/var/www/lion/'.$photo;
$pdf= $_POST['pdf'];

$uploaddir = '/var/www/lion';
$uploadfile = $uploaddir . basename($_FILES[$pdf]['name']);

echo '<pre>';
if (move_uploaded_file($_FILES[$pdf]['tmp_name'], $uploadfile)) {
    echo "Le fichier est valide, et a été téléchargé
           avec succès. Voici plus d'informations :\n";
} else {
    echo "Attaque potentielle par téléchargement de fichiers.";
}

echo '</pre>';
exit();


$vendeur= "INSERT INTO `affilates`( `name`, `type`, `address`, `phone`, `contact_name`, `email`) 
VALUES('$deposeur','$vendeur','$adrVendeur$cpVendeur$villeVendeur','$tel','$nom', '$email');";
$vend= $bdd->query($vendeur);

$vId= "SELECT LAST_INSERT_ID(id) as dernier FROM affilates ORDER BY id DESC Limit 1";
$donne= $bdd->query($vId);
$n= mysqli_fetch_object($donne);
$nid= $n->dernier;
$offre="INSERT INTO `offers`(`description`, `ridge_height`, `address`, 
`city`, `postal_code`, `subdividable`, `surface`, `price`, `commission_included`, `departement_id`, `transaction_types_id`, `offer_types_id`,affilate_id) 
VALUES('$description','$hauteur','$addr','$ville','$cp', '$divisible','$surface','$prix', '$commission','$dep', '$trans', '$bien', '$nid');";
$query= $bdd->query($offre);

if (!$query) {
    echo "Erreur lors de la requête : $bdd->error";
    exit();
} elseif (!$vend){
    echo "error vend: $bdd->error";
    exit();
}

$lid= "SELECT LAST_INSERT_ID(id) as der FROM offers ORDER BY id DESC Limit 1";
$donn= $bdd->query($lid);
$ni= mysqli_fetch_object($donn);
$id = $ni->der;
header("location: ./offre.php?id=".$id);