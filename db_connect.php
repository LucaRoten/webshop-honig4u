<?php
    // Honigshop -Database connection-
    // Luca Roten

    function pdo_connect_mysql() {
        try {
            $db = new PDO("mysql:host=localhost;dbname=honig4u", "root", "");
            return $db;
        } catch (PDOException $exception) {
            die ('Keine Verbindung zu Datenbank hergestellt!');
        }
    }
?>