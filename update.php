<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = pg_escape_string($conn, $_POST['id']);
    $nom = pg_escape_string($conn, $_POST['nom']);
    $email = pg_escape_string($conn, $_POST['email']);

    $query = "UPDATE clients SET nom = '$nom', email = '$email' WHERE id = $id";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Client mis à jour avec succès. <a href='read.php'>Retour à la liste</a>";
    } else {
        echo "Erreur lors de la mise à jour du client : " . pg_last_error($conn);
    }
} else {
    $id = pg_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM clients WHERE id = $id";
    $result = pg_query($conn, $query);
    $client = pg_fetch_assoc($result);

    if (!$client) {
        echo "Client non trouvé.";
        exit;
    }
}
?>

<h2>Modifier un client</h2>
<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['id']); ?>">
    Nom: <input type="text" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>"><br>
    Email: <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>"><br>
    <input type="submit" value="Mettre à jour">
</form>
