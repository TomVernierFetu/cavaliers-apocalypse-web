<?php

// Connexion à la base de données avec PDO
function getConnecteurBDD()
{
    $settings = include("settings.php");

    $pdo = new PDO("mysql:host=${settings['host']};dbname=${settings['dbname']};charset=utf8", $settings['user'], $settings['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
}