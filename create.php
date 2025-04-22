<?php
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = pg_escape_string($conn, $_POST['nom']);
    $email = pg_escape_string($conn, $_POST['email']);

    $query = "INSERT INTO clients (nom, email) VALUES ('$nom', '$email')";
    $result = pg_query($conn, $query);

    if ($result) {
        echo "Client ajouté avec succès. <a href='read.php'>Retour à la liste</a>";
    } else {
        echo "Erreur lors de l'ajout du client : " . pg_last_error($conn);
    }
}
?>

<h2>Ajouter un client</h2>
<form method="post" action="create.php">
    Nom: <input type="text" name="nom"><br>
    Email: <input type="email" name="email"><br>
    <input type="submit" value="Ajouter">
</form>
