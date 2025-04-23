<?php
include 'connexion.php';

if (isset($_GET['recherche'])) {
    $recherche = pg_escape_string($conn, $_GET['recherche']);

    $query = "SELECT * FROM clients WHERE nom LIKE '%$recherche%' OR email LIKE '%$recherche%'";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "<h2>Résultats de la recherche pour '" . htmlspecialchars($recherche) . "'</h2>";
        echo "<ul>";
        while ($row = pg_fetch_assoc($result)) {
            echo "<li>" . htmlspecialchars($row['nom']) . " - " . htmlspecialchars($row['email']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Erreur lors de la recherche : " . pg_last_error($conn);
    }
}
?>

<h2>Rechercher un client</h2>
<form method="get" action="search.php">
    Rechercher: <input type="text" name="recherche">
    <input type="submit" value="Rechercher">
</form>
