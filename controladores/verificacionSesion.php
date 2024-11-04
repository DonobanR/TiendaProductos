<?php
session_start();

if (!isset($_SESSION['usuario']) && !isset($_SESSION['contrasena'])) {
    header("Location: /pantallas/index.php");
    exit;
}
?>