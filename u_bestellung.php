<?php
  // Honigshop -Warenkorb-
  // Luca Roten

  session_start();
  $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", ""); 
  $sql = "SELECT * FROM produkte";
  $ergebnis = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Warenkorb - Firma Honig4U</title>
  </head>
  <body>

  <?php include 'header.php'; ?>

    <h1>Warenkorb</h1>
    <form action='u_bestellung.php' method='POST'>
      <table class="styled-table" align="center">

        <?php

          // Falls eine Anzahl eigegeben wurde, Wert in jeweiliger Variable speichern.
          // Falls keine Anzahl eigegeben wurde, Wert auf '0' setzten um fehler zu vermeiden.
          // (Bei Anzahl '0' findet keine Ausgabe statt)
          if (isset($_POST['Akazienhonig']) and $_POST['Akazienhonig'] <> null)
          {

            if (isset($_SESSION["Akazienhonig"]) AND !isset($_POST["refresh"]))
            {
              $_SESSION["Akazienhonig"] = $_SESSION["Akazienhonig"] + $_POST["Akazienhonig"];
            }
            else
            {
              $_SESSION["Akazienhonig"] = $_POST["Akazienhonig"];
            }
            
            $akazie = $_SESSION["Akazienhonig"];
            
          } 
          else if (isset($_SESSION["Akazienhonig"]))
          {
            $akazie = $_SESSION["Akazienhonig"];
          }
          else
          {
            $akazie = 0;
          }


          if (isset($_POST['Heidehonig']) and $_POST['Heidehonig'] <> null)
          {

            if(isset($_SESSION["Heidehonig"]) AND !isset($_POST["refresh"]))
            {
              $_SESSION["Heidehonig"] = $_SESSION["Heidehonig"] + $_POST["Heidehonig"];
            }
            else
            {
              $_SESSION["Heidehonig"] = $_POST["Heidehonig"];
            }

            $heide = $_SESSION["Heidehonig"];

          } 
          else if (isset($_SESSION["Heidehonig"]))
          {
            $heide = $_SESSION["Heidehonig"];
          }
          else 
          {
            $heide = 0;
          }


          if (isset($_POST['Kleehonig']) and $_POST['Kleehonig'] <> null)
          {

            if (isset($_SESSION["Kleehonig"]) AND !isset($_POST["refresh"]))
            {
              $_SESSION["Kleehonig"] = $_SESSION["Kleehonig"] + $_POST["Kleehonig"];
            }
            else
            {
              $_SESSION["Kleehonig"] = $_POST["Kleehonig"];
            }

            $klee = $_SESSION["Kleehonig"];

          } 
          else if (isset($_SESSION["Kleehonig"]))
          {
            $klee = $_SESSION["Kleehonig"];
          }
          else
          {
            $klee = 0;
          }


          if (isset($_POST['Tannenhonig']) and $_POST['Tannenhonig'] <> null)
          {
            if (isset($_SESSION["Tannenhonig"]) AND !isset($_POST["refresh"]))
            {
              $_SESSION["Tannenhonig"] = $_SESSION["Tannenhonig"] + $_POST["Tannenhonig"];
            }
            else
            {
              $_SESSION["Tannenhonig"] = $_POST["Tannenhonig"];
            }

            $tanne = $_SESSION["Tannenhonig"];

          } 
          else if (isset($_SESSION["Tannenhonig"])) 
          {
            $tanne = $_SESSION["Tannenhonig"];
          }
          else
          {
            $tanne = 0;
          }
          
          // Berechnungen der einzelnen Gesamtpreise
          while ($zeile = $ergebnis->fetchObject()){
            $zeile->Produkt_Name;
            $zeile->Produkt_Preis;
            if ($zeile->Produkt_Name == 'Akazienhonig'){
              $gesamtkosten_akazie = $akazie * $zeile->Produkt_Preis;
            } else if ($zeile->Produkt_Name == 'Heidehonig'){
              $gesamtkosten_heide = $heide * $zeile->Produkt_Preis;
            } else if ($zeile->Produkt_Name == 'Kleehonig'){
              $gesamtkosten_klee = $klee * $zeile->Produkt_Preis;
            } else if ($zeile->Produkt_Name == 'Tannenhonig'){
              $gesamtkosten_tanne = $tanne * $zeile->Produkt_Preis;
            }
          }
      
          // Tabelle
          echo "<tr><th>Honigsorte</th><th>Anzahl Gläser</th><th>Kosten</th></tr>";
            if ($akazie > 0 and $akazie <> null) {
              echo "<tr><td>Akazienhonig: </td><td><input type='number' size='4' min='0' name='Akazienhonig' value=$akazie></td> <td>" . $gesamtkosten_akazie . " CHF</td></tr>";  
            }
            if ($heide > 0 and $heide <> null) {
              echo "<tr><td>Heidehonig: </td><td><input type='number' size='4' min='0' name='Heidehonig' value=$heide></td> <td>" . $gesamtkosten_heide . " CHF</td></tr>"; 
            }
            if ($klee > 0 and $klee <> null) {
              echo "<tr><td>Kleehonig: </td><td><input type='number' size='4' min='0' name='Kleehonig' value=$klee></td> <td>" . $gesamtkosten_klee . " CHF</td></tr>"; 
                }
            if ($tanne > 0 and $tanne <> null) {
              echo "<tr><td>Tannenhonig: </td><td><input type='number' size='4' min='0' name='Tannenhonig' value=$tanne></td> <td>" . $gesamtkosten_tanne . " CHF</td></tr>"; 
            }

          $gesamteanzahl = $akazie + $heide + $klee + $tanne;

          $gesamtpreis = $gesamtkosten_akazie + $gesamtkosten_heide + $gesamtkosten_klee + $gesamtkosten_tanne;
          
          echo "<tr><td>Total: </td><td>" . $gesamteanzahl . "</td><td>" . $gesamtpreis . " CHF</td></tr>";
  
        ?>
  
      </table>
        <br>
        <input type='submit' class="button" name="refresh" value='Warenkorb aktualisieren'>
          
    </form>
    <form action='checkLogin.php' method='POST'>
      <br>
      <input type='submit' class="button" value='Bestellen'>
    </form> 
  </body> 
</html>




