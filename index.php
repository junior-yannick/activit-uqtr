<!--
    TCHL82330400 Tchoutang Yi Tchuigoua Lyblassa Archange
    AGOY65270300 Agokeng Choundong Yannick Junior
    BOBR14309900 Rousselle Sandra Bobda Massu
    TAMG84340500 Tamba Wakou Grace Andrea 
    
          
TP2
Groupe 11
INF1001
Vendredi 29 Decembre 2023    
-->

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="Style.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Yatra+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqZsyu9Q79wE57t5fOrX5v4_wGZLM1m6Q&callback=initMap">
</script>
    </head>

    <body>

        <header>
            <img src="Images/uqtr.png" width="300px" alt="logo uqtr">
            <p>Loisir pour les <br><span>étudiants!</span></p>
        </header>

        
        <nav>
            <ul>
                
                <li onclick="showSection(0)">Accueil
                      
                </li>
                <li onclick="showSection(1)">S'inscrire</li>
                <li onclick="showSection(2)">Authentification</li>
                <li onclick="showSection(3)">Localiser une activité</li>
                
                
                
            </ul>
        </nav>

        <!-- Section Accueil -->
        <section>
            <div>
                <h3>Notre but:</h3>
                <p> Notre site propose aux étudiants désireux de réaliser une ou plusieurs activités de loisir de rejoindre les différentes activités proposées dans la liste suivantes en 3 étapes </p>
                    <ul>
                        <li>S'inscrire</li>
                        <li>Choisir une ou plusieurs activités</li>
                        <li>Commencer les activités en groupe</li>
                    </ul>
        <p>Les différences activités des groupes sont la responsabilité des professionnelles. Il s'agit de passionnés de domaine qui vous feront découvrir des pans inédits de vos loisirs préfèrés. Qu'attendez-vous...?. Rejoignez-nous!</p>
                <h3>Liste des activités disponibles</h3> 
        
            </div>
            
                
            <div>
        <table id="activite">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Activité</th>
                    <th>Responsable</th>
                    <th>Nombre d'inscrits</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connexion à la base de données
                $db_username = 'root';
                $db_password = '';
                $db_name = 'base';
                $db_host = 'localhost';

                $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

                if ($conn->connect_error) {
                    die("Erreur de connexion à la base de données: " . $conn->connect_error);
                }

                // Requête SQL pour obtenir les activités et le nombre d'inscrits
                $sql = "SELECT a.nom, a.responsable, COUNT(i.id) as nb_inscrits 
                        FROM activite a
                        LEFT JOIN inscription i ON a.nom = i.activ
                        GROUP BY a.nom, a.responsable";

                $result = $conn->query($sql);

                if ($result) {
                    $counter = 1;
                    while ($donnees = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $donnees['nom'] . "</td>";
                        echo "<td>" . $donnees['responsable'] . "</td>";
                        echo "<td>" . $donnees['nb_inscrits'] . "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
        </section>
        <!-- Section Inscription -->
        <section>
            <h3>Inscrivez vous</h3>
            <form name="form" action="inscription.php" method="post" onsubmit="return validateForm()">
                <div class="form-row">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-row">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-row">
                <label for="date_naissance">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" required>
            </div>
            <div class="form-row">
                <label>Sexe</label>
                <input type="radio" id="homme" name="sexe" value="homme" required> 
                <label for="homme">Homme</label>
                <input type="radio" id="femme" name="sexe" value="femme" required>
                <label for="femme">Femme</label>
            </div>
            <div class="form-row">
                <label for="activite">Activité</label>
        <select id="activite" name="activite" required>
        <?php
        // Connexion à la base de données
        $db_username = 'root';
        $db_password = '';
        $db_name = 'base';
        $db_host = 'localhost';

        $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données: " . $conn->connect_error);
        }

        // Requête SQL pour obtenir les noms d'activités depuis la table 'activite'
        $sql = "SELECT nom FROM activite";
        $result = $conn->query($sql);

        if ($result) {
            while ($activite = $result->fetch_assoc()) {
                echo "<option value='" . $activite['nom'] . "'>" . $activite['nom'] . "</option>";
            }
        }

        $conn->close();
        ?>
    </select>
            </div>
                <div class="form-row">
                <label for="motivation">Motivation</label>
                <textarea id="motivation" name="motivation"></textarea>
            </div>
                <button type="reset">Réinitialiser</button>
                <button type="submit">Valider</button>
            </form>
        </section>
        <section style="display:none;">

            <!--authentification--> 
            <h3>Connexion</h3>
            <p>Veuillez renseigner vos identifiants pour vous connecter.</p>
            <form method="POST" action="authentification.php" name="Form"form onsubmit="return validate();">
                <div class="form-row">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" id="identifiant" name="identifiant" required>
                </div>
                <div class="form-row">
    <label for="password">Mot de passe</label>
    <div class="password-container">
        <input type="password" id="password" name="password" required>
        <span toggle="#password" class="eye toggle-password"></span>
    </div>
</div>
                <div class="form-row">
                    <button type="submit">Connexion</button>
                </div>
            </form>
        </section>
        <!-- Affichage du message d'erreur -->
    <div id="errorMessage"></div>
        
        <!-- Section Carte -->
        <section>
            <div id="map"></div>
        </section>
        <script src="script.js"></script>
    </body>
</html>

