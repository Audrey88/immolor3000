<?php
// connection à la base (l'objet bdd est utilisé dans tout le site pour les opérations sur la base)
$bdd = mysqli_connect("127.0.0.1", "Toussaint", "253253","bourse_grand_est"/*"Jqbq2!40", "bourse_grand_est"*/);

if (!$bdd) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
