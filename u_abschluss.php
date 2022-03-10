<!DOCTYPE html>
<html lang="en">
    <!-- 
      Honigshop -Bestellübersicht-
      Luca Roten
    -->
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Bestellübersicht- Firma Honig4U</title>
  </head>
  <body>
    <h1>Bestellübersicht - Abschluss</h1>
    <?php
      session_start();

      // Überprüfen ob Login OK
      if (!isset($_SESSION['username'])){
        header('Location: checkLogin.php');
        exit;
      }

      // Insert Bestellung in DB
      $bestellNr = random_int(1000, 9999);

      // Insert in Bestellungen table
      $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", "");
      $sql = "INSERT INTO bestellungen (Bestell_ID, Bestell_Preis, FK_Kunden_ID) VALUES (?,?,?)";
      $stmt= $db->prepare($sql);
      $stmt->execute([$bestellNr, 10, $_SESSION["Kunden_ID"]]);

      // Insert in BestellteArtikel table
      $sql = "INSERT INTO bestellteArtikel (FK_Bestell_ID, FK_Produkt_ID, Anzahl) VALUES (?,?,?)";

      if (isset($_SESSION["Akazienhonig"]))
      {
        if ($_SESSION["Akazienhonig"] <> null AND $_SESSION["Akazienhonig"] <> 0)
        {
          $stmt= $db->prepare($sql);
          $stmt->execute([$bestellNr, 1, $_SESSION["Akazienhonig"]]);
        }
      }

      if (isset($_SESSION["Heidehonig"]))
      {
        if ($_SESSION["Heidehonig"] <> null AND $_SESSION["Heidehonig"] <> 0)
        {
          $stmt= $db->prepare($sql);
          $stmt->execute([$bestellNr, 2, $_SESSION["Heidehonig"]]);
        }
      }

      if (isset($_SESSION["Kleehonig"]))
      {
        if ($_SESSION["Kleehonig"] <> null AND $_SESSION["Kleehonig"] <> 0)
        {
          $stmt= $db->prepare($sql);
          $stmt->execute([$bestellNr, 3, $_SESSION["Kleehonig"]]);
        }
      }

      if (isset($_SESSION["Tannenhonig"]))
      {
        if ($_SESSION["Tannenhonig"] <> null AND $_SESSION["Tannenhonig"] <> 0)
        {
          $stmt= $db->prepare($sql);
          $stmt->execute([$bestellNr, 4, $_SESSION["Tannenhonig"]]);
        }
      }

      echo "<p>Bestellung Erfolgreich</p><br>";
      echo "Ihre Bestell Nummer: " . $bestellNr . "<br><br>";
      echo "Bestellte Artikel:<br>";

      $gesamtPreis = 0;

      if (isset($_SESSION["Akazienhonig"]))
      {
        if ($_SESSION["Akazienhonig"] <> null AND $_SESSION["Akazienhonig"] <> 0)
        {
          echo "Akazienhonig: " . $_SESSION["Akazienhonig"] . "<br>";
          $gesamtPreis += $_SESSION["Akazienhonig"] * 10;
          $_SESSION["Akazienhonig"] = 0;
        }     
      }

      if (isset($_SESSION["Heidehonig"]))
      {
        if ($_SESSION["Heidehonig"] <> null AND $_SESSION["Heidehonig"] <> 0)
        {
          echo "Heidehonig: " . $_SESSION["Heidehonig"]  . "<br>";
          $gesamtPreis += $_SESSION["Heidehonig"] * 20;
          $_SESSION["Heidehonig"] = 0;
        }  
      }

      if (isset($_SESSION["Kleehonig"]))
      {
        if ($_SESSION["Kleehonig"] <> null AND $_SESSION["Kleehonig"] <> 0)
        {
          echo "Kleehonig: " . $_SESSION["Kleehonig"]  . "<br>";
          $gesamtPreis += $_SESSION["Kleehonig"] * 30;
          $_SESSION["Kleehonig"] = 0;
        }       
      }

      if (isset($_SESSION["Tannenhonig"]))
      {
        if ($_SESSION["Tannenhonig"] <> null AND $_SESSION["Tannenhonig"] <> 0)
        {
          echo "Tannenhonig: " . $_SESSION["Tannenhonig"]  . "<br><br>";
          $gesamtPreis += $_SESSION["Tannenhonig"] * 40;
          $_SESSION["Tannenhonig"] = 0;
        }      
      }

      echo "Gesamtpreis: " . $gesamtPreis . " CHF <br><br>";
      echo "<button class='button' onclick='window.location.href = \"index.php\";'>zurück zur Startseite</button>";
  
    ?>
  </body>
</html>