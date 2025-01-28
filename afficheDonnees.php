<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="afficheDonnees.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    
    
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['identifiant']) && $_SESSION['identifiant'] !== "") {
        $user = $_SESSION['identifiant'];
        // Afficher un message
        echo "<strong> Bonjour $user </strong>";
    }

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

    // Affichage du tableau des activités
    $sql_activite = "SELECT * FROM activite";
    $result_activite = $conn->query($sql_activite);

    if ($result_activite) {
    ?>
        <br /><br />

        <table>
            <caption>Détails des activités</caption>
            <tr>
                <th>Nom</th>
                <th>Responsable</th>
                <th>Maximum</th>
            </tr>
            <?php
            while ($donnees = $result_activite->fetch_assoc()) {
            ?>
                <tr>
                    <td><?= $donnees['nom']; ?></td>
                    <td><?= $donnees['responsable']; ?></td>
                    <td><?= $donnees['maximum']; ?></td>
                    <td><button class="btnSupprimer" onclick="supprimerActivite(<?= $donnees['id']; ?>)">Supprimer</button></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "Erreur d'exécution de la requête: " . $conn->error;
    }

    // Affichage du tableau du pourcentage
    $sql_pourcentage = "SELECT nom, places_restantes, (places_restantes / maximum) * 100 AS pourcentage FROM activite";
    $result_pourcentage = $conn->query($sql_pourcentage);

    if ($result_pourcentage) {
    ?>
        <table>
        
            <tr>
                <th>Nom</th>
                <th>Places restantes</th>
                <th>Pourcentage</th>
            </tr>
            <?php
           while ($donnees_pourcentage = $result_pourcentage->fetch_assoc()) {
            $pourcentage = number_format($donnees_pourcentage['pourcentage'], 1);
            ?>
                <tr>
                    <td><?= $donnees_pourcentage['nom']; ?></td>
                    <td><?= $donnees_pourcentage['places_restantes']; ?></td>
                    <!-- Ajoutez une cellule pour le graphique et le pourcentage -->
                    <td class="pourcentageCell">
    <canvas class="pourcentageChart" width="30" height="30" data-pourcentage="<?= $pourcentage; ?>"></canvas>
    <div class="pourcentageLabel"><?= $pourcentage; ?>%</div>
</td>
    </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
        echo "Erreur d'exécution de la requête: " . $conn->error;
    }

    // Boîte de dialogue pour l'ajout d'une nouvelle activité
    ?>
    <!--boite de dialogue-->
    <div class="overlay" id="modalOverlay">
        <div class="modal" id="myModal">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <div class="header-buttons">
        <form action="deconnexion.php" method="post">
            <input type="submit" name="deconnexion" value="Deconnexion" class="btnDeconnexion">
        </form>
        <a href="#" onclick="openModal()" class="btnAjouterActivite">+ Ajouter une nouvelle activité</a>
    </div>

    <?php
    // Fermer la connexion
    $conn->close();
    ?>
    <script src="script.js"></script>

</body>

</html>
