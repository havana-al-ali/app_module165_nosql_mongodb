<?php
// Chargement de l'autoloader Composer (driver MongoDB)
require __DIR__ . '/../vendor/autoload.php';

// Connexion au conteneur MongoDB (service "mongo" dans docker-compose)
$client = new MongoDB\Client(
    "mongodb://myUserAdmin:myPassword123@mongo:27017",
    [
        "authSource" => "admin" // Base d'authentification
    ]
);

// Sélection de la base de données et de la collection principale
$collection = $client->my_data_Havana_Maryam->open_data;
?>
