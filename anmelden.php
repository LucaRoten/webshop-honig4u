<!DOCTYPE html>
<html lang="en">
    <!-- 
        Honigshop -Anmelden-
        Luca Roten
    -->
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/style.css"> 
        <title>Anmelden</title>
    </head>
    <body>
        <?php
            session_start();

            if(isset($_POST["submit"]))
            {

                $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", "");
                $stmt = $db->prepare("SELECT * FROM kunden WHERE Kunden_Benutzername = :user"); // Username überprüfen
                $stmt->bindParam(":user", $_POST["username"]);
                $stmt->execute();

                $count = $stmt->rowCount();

                if($count == 1)
                {
                    // Username ist frei
                    $row = $stmt->fetch();

                    if(password_verify($_POST["pw"], $row["Kunden_Passwort"]))
                    {
                        $_SESSION["username"] = $row["Kunden_Benutzername"];
                        $_SESSION["Kunden_ID"] = $row["Kunden_ID"];
                        $_SESSION["IsAdmin"] = $row["IsAdmin"];
                        header("Location: checkLogin.php");
                    } 
                    else 
                    {
                        echo "Falscher Benutzename oder Passwort.";
                    }
                } 
                else 
                {
                    echo "Das Login ist fehlgeschlagen";
                }
            }
        ?>

        <h1>Anmelden</h1>
        <form action="anmelden.php" method="post">
            <input type="text" name="username" placeholder="Benutzername" required><br>
            <input type="password" name="pw" placeholder="Passwort" required><br>
            <button class="button" type="submit" name="submit">Anmelden</button>
        </form>
        <br>
        <a href="registrieren.php">Haben Sie noch kein Konto?</a>
    </body>
</html>