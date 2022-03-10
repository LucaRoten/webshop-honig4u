<?php
  // Honigshop -Bestellformular-
  // Luca Roten

  // Datenbank einbinden 
  $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", "");
  $sql = "SELECT * FROM produkte";
  $ergebnis = $db->query($sql);

  // Header
  include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Honigbestellung - Firma Honig4U</title>
  </head>
  <body>
    <h1>Bestellformular</h1>
    <p>Bitte geben Sie die Bestellmenge an (Einheit: 500-g-Glas): </p>
    <form action="u_bestellung.php" method="POST">
      <table class="styled-table" align="center">
      <?php
        echo "<tr><th>Produkt ID</th><th>Honigsorte</th><th>Preis</th><th>Anzahl</th></tr>";
        // Datensätze aus Tabelle 'produkte' auslesen
        while ($zeile = $ergebnis->fetchObject()){
          echo "<tr><td>$zeile->Produkt_ID</td>
                    <td>$zeile->Produkt_Name</td>";
                    // Preis und Inputfeld dem jeweiligen Produkt in der Tabelle hinzufügen
                    if ($zeile->Produkt_Name == 'Akazienhonig'){
                      echo "<td>$zeile->Produkt_Preis CHF</td>";  
                      echo "<td><input type='number' min='0' name='Akazienhonig' size='4'></td>";
                    } else if ($zeile->Produkt_Name == 'Heidehonig'){
                      echo "<td>$zeile->Produkt_Preis CHF</td>";  
                      echo "<td><input type='number' min='0' name='Heidehonig' size='4'></td>";
                    } else if ($zeile->Produkt_Name == 'Kleehonig') {
                      echo "<td>$zeile->Produkt_Preis CHF</td>";  
                      echo "<td><input type='number' min='0' name='Kleehonig' size='4'></td>";
                    } else if ($zeile->Produkt_Name == 'Tannenhonig') {
                      echo "<td>$zeile->Produkt_Preis CHF</td>";  
                    echo "<td><input type='number' min='0' name='Tannenhonig' size='4'></td>";
                    }                 
        }
        echo "</tr></table><br>" ;

        echo "<input type='submit' class='button' name='warenkorb' value='Zum Warenkorb hinzufügen'>";
      ?>    
    </form>
  </body>
</html>