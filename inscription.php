<?php
// Récupération des données du formulaire
$nom = filter_input(INPUT_POST, 'nom');
$prenom = filter_input(INPUT_POST, 'prenom');
$date_naissance = filter_input(INPUT_POST, 'date_naissance');
$sexe = filter_input(INPUT_POST, 'sexe');
$activite = filter_input(INPUT_POST, 'activite');
$motivation = filter_input(INPUT_POST, 'motivation');

// Configuration de la connexion à la base de données
$db_username = 'root';
$db_password = '';
$dbname = 'base';
$dbhost = 'localhost';

// Création de la connexion
$conn = new mysqli($dbhost, $db_username, $db_password, $dbname);

// Vérification de la connexion
if (mysqli_connect_error()) {
    die('Erreur de connexion ('. mysqli_connect_errno() .') '. mysqli_connect_error());
} else {
    // Récupérer le nombre de places disponibles
    $sql = "SELECT maximum, nb_inscrits FROM activite WHERE nom = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $activite);
    $stmt->execute();
    $stmt->bind_result($places_max, $nb_inscrits);
    $stmt->fetch();
    $stmt->close();

    // Vérifier si des places sont disponibles
    if ($nb_inscrits < $places_max) {
        // Préparation de la requête SQL pour l'insertion
        $sql_insert = "INSERT INTO inscription (name, surname, date, sex, activ, motivation)
                       VALUES ('$nom', '$prenom', '$date_naissance', '$sexe', '$activite', '$motivation')";

        // Exécution de la requête d'insertion
        if ($conn->query($sql_insert)) {
            echo "Nouvel enregistrement inséré avec succès";

            // Mise à jour du nombre d'inscrits
            $nb_inscrits++;

            // Mise à jour des places restantes
            $places_restantes = $places_max - $nb_inscrits;

            $sql_update = "UPDATE activite SET nb_inscrits = ?, places_restantes = ? WHERE nom = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("iis", $nb_inscrits, $places_restantes, $activite);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            echo "Erreur : " . $sql_insert . " " . $conn->error;
        }
    } else {
        echo "Désolé, plus de places disponibles pour cette activité.";
    }

    // Fermeture de la connexion
    $conn->close();
}
?>