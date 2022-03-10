<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <!-- 
      Honigshop -Admin Control Panel-
      Luca Roten
  -->
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/style.css">
    <title>Backend - Honig4U</title>
  </head>
  <body>
    <?php include 'header.php'; ?>

    <h1>Admin Controll Panel</h1>

    <h2>Bestellte Artikel</h2>

    <?php
        if (isset($_SESSION["IsAdmin"]))
        {

            // SQL
            $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", ""); 
            $sql = "SELECT a.Bestell_ID   AS BestellNr
                        ,d.Kunden_ID      AS KundenNr
                        ,d.Kunden_Name    AS Nachname
                        ,d.Kunden_Vorname AS Vorname
                        ,c.Produkt_ID     AS ArtikelNr
                        ,c.Produkt_Name   AS Artikel
                        ,c.Produkt_Preis  AS Preis
                        ,b.Anzahl         AS Anzahl
                FROM bestellungen AS a
                LEFT JOIN bestellteArtikel AS b
                    ON a.Bestell_ID = b.FK_Bestell_ID
                INNER JOIN produkte AS c
                    ON b.FK_Produkt_ID = c.Produkt_ID
                INNER JOIN kunden AS d
                    ON d.Kunden_ID = a.FK_Kunden_ID";
            $ergebnis = $db->query($sql);

        echo "<table class='styled-table' align='center'>";
        echo "<tr><th>BestellNr</th><th>KundenNr</th><th>Nachname</th><th>Vorname</th><th>ArtikelNr</th><th>Artikel</th><th>Preis</th><th>Anzahl</th></tr>";
        // Datensätze aus Tabelle 'produkte' auslesen
        while ($zeile = $ergebnis->fetchObject()){
          echo "<tr><td>$zeile->BestellNr</td>
                    <td>$zeile->KundenNr</td>
                    <td>$zeile->Nachname</td>
                    <td>$zeile->Vorname</td>
                    <td>$zeile->ArtikelNr</td>
                    <td>$zeile->Artikel</td>
                    <td>$zeile->Preis</td>
                    <td>$zeile->Anzahl</td></tr>";               
        }
        echo "</tr></table><br>" ;

            if ($_SESSION["IsAdmin"] == 0)
            {
                header("Location: index.php");
            } 
        }
        else
        {
            header("Location: index.php");
        }
    ?>
  </body> 
</html>




