<!DOCTYPE html>
<html lang="en">
    <!-- 
        Honigshop -Registrieren-
        Luca Roten
    -->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css">
        <title>Registrieren- Firma Honig4U</title>
    </head>
    <body>
        <?php
            session_start();

            if (isset($_POST['submit']))
            {
                $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", "");
                $stmt = $db->prepare("SELECT * FROM kunden WHERE Kunden_Benutzername = :user"); 
                $stmt->bindParam(":user", $_POST["username"]);
                $stmt->execute();
                $count = $stmt->rowCount();

                if ($count == 0)
                {
                    // Username ist frei
                    if ($_POST["pw"] == $_POST["pw2"])
                    {
                        // User anlegen
                        $stmt = $db->prepare("INSERT INTO kunden (Kunden_Benutzername, Kunden_Passwort, Kunden_Name, Kunden_Vorname) VALUES (:user, :pw, :name, :vorname)");
                        $stmt->bindParam(":user", $_POST["username"]);
                        $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
                        $stmt->bindParam(":pw", $hash);
                        $stmt->bindParam(":name", $_POST["Nachname"]);
                        $stmt->bindParam(":vorname", $_POST["Vorname"]);
                        $stmt->execute();

                        // Benutzer direkt nach der Registration anmelden 
                        $stmt = $db->prepare("SELECT * FROM kunden WHERE Kunden_Benutzername = :user"); // Username überprüfen
                        $stmt->bindParam(":user", $_POST["username"]);
                        $stmt->execute();
                        $row = $stmt->fetch();

                        $_SESSION["username"] = $_POST["username"];
                        $_SESSION["Kunden_ID"] = $row["Kunden_ID"];
                        header("Location: checkLogin.php");
                    }
                    else 
                    {
                        echo "Die Passwörter stimmen nicht überein";
                    }
                } 
                else 
                {
                    echo "Der Username ist bereits vergeben";
                }
            }
        ?>

        <h1>Konto erstellen</h1>
        <form action="registrieren.php" method="POST">
            <input type="text" name="username" placeholder="Benutzername" required><br>
            <input type="text" name="Vorname" placeholder="Vorname" required><br>
            <input type="text" name="Nachname" placeholder="Nachname" required><br>
            <input type="password" name="pw" placeholder="Passwort" required><br>
            <input type="password" name="pw2" placeholder="Passwort wiederholen" required><br>
            <button class="button" type="submit" name="submit">Erstellen</button>
        </form> 
        <br>
        <a href="anmelden.php">Hast du bereits einen Account?</a>
    </body>
</html>