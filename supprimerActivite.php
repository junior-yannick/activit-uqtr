<?php
// supprimerActivite.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idActivite = $_POST['id'];

    // Configuration de la connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $dbname = 'base';
    $dbhost = 'localhost';

    // Création de la connexion
    $conn = new mysqli($dbhost, $db_username, $db_password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données: " . $conn->connect_error);
    }

    // Suppression de l'activité
    $sql = "DELETE FROM activite WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idActivite);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Success";
    } else {
        echo "Error";
    }

    $stmt->close();
    $conn->close();
}
?>