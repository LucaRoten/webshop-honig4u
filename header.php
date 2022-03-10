<!DOCTYPE html>
<html lang="en">
    <!-- 
        Honigshop -Header-
        Luca Roten
    -->
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php

            echo "<div class='header'>";
            echo "<span id='honig4u'>Honig4U </span><p>";

            if (isset($_SESSION["username"])) 
            {
                echo "Angemeldet als: " . $_SESSION["username"];
                echo " <button class='button' onclick='window.location.href = \"logout.php\";'>Abmelden</button>";

                if (isset($_SESSION["IsAdmin"]))
                {
                    if ($_SESSION["IsAdmin"] == 1)
                    {
                        echo " <button class='button' onclick='window.location.href = \"admin.php\";'>Admin Control Panel</button>";
                    }
                }

                if (basename($_SERVER['PHP_SELF']) <> "index.php")
                {
                    echo " <button class='button' onclick='window.location.href = \"index.php\";'>Startseite</button>";
                }

                if (basename($_SERVER['PHP_SELF']) <> "u_bestellung.php")
                {
                    echo " <button class='button' onclick='window.location.href = \"u_bestellung.php\";'>Warenkorb</button>";
                }
                echo "</p><div>";
            }
            else
            {
                echo "<button class='button' onclick='window.location.href = \"anmelden.php\";'>Anmelden</button> <button class='button' onclick='window.location.href = \"registrieren.php\";'>Registrieren</button>";
                
                if (basename($_SERVER['PHP_SELF']) <> "index.php")
                {
                    echo " <button class='button' onclick='window.location.href = \"index.php\";'>Startseite</button>";
                }

                if (basename($_SERVER['PHP_SELF']) <> "u_bestellung.php")
                {
                    echo " <button class='button' onclick='window.location.href = \"u_bestellung.php\";'>Warenkorb</button>";
                }
                echo "</p><div>";
            }
            
        ?>
    </body>
</html>