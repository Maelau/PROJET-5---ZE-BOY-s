<?php
$host = "localhost";
$port = "5432";
$dbname = "ma_base_de_donnees";
$user = "votre_utilisateur";
$password = "votre_mot_de_passe";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    echo "Erreur de connexion à la base de données : " . pg_last_error();
    exit;
}
?>
