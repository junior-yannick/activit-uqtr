
<!-- Ceci est la boîte de dialogue qui permet d'ajouter une nouvelle Activité-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>

<body>
    <div id="content">
        <!-- tester si l'utilisateur est connecté -->
        <?php
        session_start();
        if ($_SESSION['identifiant'] !== "") {
            $user = $_SESSION['identifiant'];
        }
        ?>
        <form action="insererActivite.php" method="post" name="formulaire">
            <strong>Ajouter une activité</strong>
            <br /><br />

            <div class="activite">
                <label for="nom">Activité : </label>
                <br />
                <input type="text" name="nom" id="nom" />
            </div>

            <div class="responsable">
                <label for="responsable">Responsable : </label><br />
                <input type="text" name="responsable" id="responsable" />
            </div>

            <div class="maximum">
                <label for="maximum">Maximum : </label><br />
                <input type="number" name="maximum" id="maximum" />
            </div>

            <br />
            <div>
                <button type="submit" name="submit" value="login" class="button">Soumettre</button>
                <button type="reset" name="reset" class="button2">Annuler</button>
            </div>


        </form>

    </div>
</body>

</html>