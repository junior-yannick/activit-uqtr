<?php
session_start();

// Vérifier si le formulaire d'authentification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs identifiant et mot de passe sont définis
    if (isset($_POST['identifiant']) && isset($_POST['password'])) {
        // Récupérer les données du formulaire
        $identifiant_saisi = $_POST['identifiant'];
        $mot_de_passe_saisi = $_POST['password'];

        // Connexion à la base de données
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $database = "base";

        // Créer une connexion
        $conn = new mysqli($servername, $username_db, $password_db, $database);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données: " . $conn->connect_error);
        }

        // Préparer la requête SQL avec une déclaration préparée
        $query = "SELECT * FROM utilisateurs WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);

        // Vérifier la préparation de la requête
        if (!$stmt) {
            die("Erreur de préparation de la requête: " . $conn->error);
        }

        // Liage des paramètres
        $bind_result = $stmt->bind_param("ss", $identifiant_saisi, $mot_de_passe_saisi);

        // Vérifier le liage des paramètres
        if (!$bind_result) {
            die("Erreur de liage des paramètres: " . $stmt->error);
        }

        // Exécution de la requête
        $execute_result = $stmt->execute();

        // Vérifier l'exécution de la requête
        if (!$execute_result) {
            die("Erreur d'exécution de la requête: " . $stmt->error);
        }

        // Récupération du résultat
        $result = $stmt->get_result();

        // Vérifier si l'authentification a réussi
        if ($result->num_rows > 0) {
            // Authentification réussie
            $_SESSION['identifiant'] = $identifiant_saisi; // Stocker l'identifiant dans la session
            header('Location: afficheDonnees.php'); // Rediriger vers afficheDonnees.php après l'authentification réussie
            
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            // Authentification échouée
    echo "Identifiant ou mot de passe incorrect";
    exit();
        }

        
    }
}

// Rediriger vers index.html si le formulaire n'a pas été soumis
header('Location: index.html');
exit();
?>
