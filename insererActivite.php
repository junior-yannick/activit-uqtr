<?php
// Connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name = 'base';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Récupérer les valeurs
    $nom = $_POST['nom'];
    $responsable = $_POST['responsable'];
    $maximum = $_POST['maximum'];

    // Requête MySQLi pour insérer des données
    $sql = "INSERT INTO `activite`(`nom`, `responsable`, `maximum`, `places_restantes`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Vérifier la préparation de la requête
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liage des paramètres
    $stmt->bind_param("ssii", $nom, $responsable, $maximum, $maximum);

    // Exécution de la requête
    $exec = $stmt->execute();

    // Vérifier si la requête d'insertion a réussi
    if ($exec) {
        header('Location: afficheDonnees.php');
    } else {
        echo "Échec de l'opération d'insertion : " . $stmt->error;
    }

    // Fermer la déclaration préparée
    $stmt->close();
}

// Fermer la connexion à la base de données
$conn->close();
?>
