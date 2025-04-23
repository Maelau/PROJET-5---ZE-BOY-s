<?php
include 'connexion.php';

$query = "SELECT * FROM clients";
$result = pg_query($conn, $query);

if ($result) {
    echo "<h2>Liste des clients</h2>";
    echo "<a href='create.php'>Ajouter un client</a><br><br>";
    echo "<ul>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<li>" . htmlspecialchars($row['nom']) . " - " . htmlspecialchars($row['email']) . " <a href='update.php?id=" . $row['id'] . "'>Modifier</a> <a href='delete.php?id=" . $row['id'] . "'>Supprimer</a></li>";
    }
    echo "</ul>";
    echo "<a href='search.php'>Rechercher un client</a>";
} else {
    echo "Erreur lors de la récupération des clients : " . pg_last_error($conn);
}
?>
