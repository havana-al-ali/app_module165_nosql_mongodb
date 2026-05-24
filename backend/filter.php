<?php
// Chargement du driver MongoDB
require __DIR__ . '/../vendor/autoload.php';

// Connexion MongoDB (Docker)
require __DIR__ . '/connect.php';

// Réponse JSON
header('Content-Type: application/json; charset=utf-8');

// Récupération du type de filtre
$type = $_GET['type'] ?? '';

// Filtre : étudiantes + parents niveau "high school"
if ($type === 'female_highschool') {
    $filter = [
        'gender' => 'female',
        'parental level of education' => 'high school'
    ];
} else {
    echo json_encode(['error' => 'Filtre inconnu']);
    exit;
}

// Exécution de la requête
$result = $collection->find($filter)->toArray();

// Renvoi JSON
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
