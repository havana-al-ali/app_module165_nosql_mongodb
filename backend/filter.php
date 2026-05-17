<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/connect.php';

header('Content-Type: application/json; charset=utf-8');

$type = $_GET['type'] ?? '';

if ($type === 'female') {
    // Filtrer les étudiantes
    $filter = ['gender' => 'female'];
}

elseif ($type === 'bachelor') {
    // Filtrer les étudiants dont le niveau est EXACTEMENT "bachelor's degree"
    $filter = ['parental level of education' => "bachelor's degree"];
}

else {
    echo json_encode(['error' => 'Filtre inconnu']);
    exit;
}

$result = $collection->find($filter)->toArray();

// Afficher seulement le nombre de résultats
echo json_encode(count($result), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
