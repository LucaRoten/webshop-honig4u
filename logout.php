<?php
    // Honigshop -logout-
    // Luca Roten

    session_start();

    unset($_SESSION['username']);
    unset($_SESSION['Kunden_ID']);

    header("Location: index.php");
?>