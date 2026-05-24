<?php
require __DIR__ . '/../vendor/autoload.php';

$client = new MongoDB\Client(
    "mongodb://myUserAdmin:myPassword123@mongo:27017",
    [
        "authSource" => "admin"
    ]
);

$collection = $client->my_data_Havana_Maryam->open_data;
?>
