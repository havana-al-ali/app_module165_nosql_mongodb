<?php
require __DIR__ . '/../vendor/autoload.php';


$client = new MongoDB\Client(
    "mongodb://myUserAdmin:motdepasse1@localhost:27020/?authSource=admin"
);

$collection = $client->my_data_Havana_Maryam->open_data;
?>
