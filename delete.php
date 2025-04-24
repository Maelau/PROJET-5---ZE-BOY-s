<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = pg_escape_string($conn, $_GET['id']);

    $query = "DELETE FROM clients WHERE id = $id";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Client supprimé avec succès. <a href='read.php'>Retour à la liste</a>";
    } else {
        echo "Erreur lors de la suppression du client : " . pg_last_error($conn);
    }
}
?>

<h2>Supprimer un client</h2>
<p>Êtes-vous sûr de vouloir supprimer ce client ?</p>
<a href="delete.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">Supprimer</a>
