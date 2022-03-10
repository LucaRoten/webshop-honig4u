<!DOCTYPE html>
<html lang="en">
  <!-- 
    Honigshop -Check Login-
    Luca Roten
  -->
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Anmelden/Registrieren- Firma Honig4U</title>
  </head>
  <body>
    <h1>Anmelden oder Registrieren</h1>
    <?php
        session_start();

        // Überprüfen ob in Session angemeldet
        if (isset($_SESSION['username']))
        {

          if (isset($_SESSION["Akazienhonig"]) OR  isset($_SESSION["Heidehonig"]) OR isset($_SESSION["Kleehonig"]) OR isset($_SESSION["Tannenhonig"]))
          {
            // Fals Angemeldet
            echo "Sie sind Angemeldet als: ";
            print($_SESSION['username']);
            echo "<br><br> <button class='button' onclick='window.location.href = \"index.php\";'>Startseite</button>";
            echo " <button class='button' onclick='window.location.href = \"u_bestellung.php\";'>Zurück zum Warenkorb</button>";
            echo "<form action='u_abschluss.php' method='POST'>";
            echo "<br><input class='button' type='submit' value='Bestellung abschliessen'>";
            echo "</form>";
          }
          // Bei leerem Warenkorb -> formular.php
          else
          {
            header("Location: index.php");
          }
            
        } 
        else 
        {
            // Anmelden
            echo "<form action='anmelden.php' method='POST'>";
                echo "Bitte zuerst Anmelden.<br>";
                echo "<br><input class='button' type='submit' value='Anmelden'>";
            echo "</form>";
            // Registrieren
            echo "<form action='registrieren.php' method='POST'>";
                echo "<br>Haben Sie noch kein Konto?<br>";
                echo "<br><input class='button' type='submit' value='Registrieren'>";
            echo "</form>";
        }  
    ?>
  </body>
</html>