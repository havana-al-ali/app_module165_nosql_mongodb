<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/connect.php'; 

header('Content-Type: application/json; charset=utf-8');

// Récupérer le champ à trier depuis l'URL : ?field=math ou ?field=writing
$field = $_GET['field'] ?? 'math';

// Adapter le nom du champ MongoDB
if ($field === 'math') {
    $mongoField = 'math score';
} elseif ($field === 'writing') {
    $mongoField = 'writing score';
} else {
    echo json_encode(['error' => 'Champ de tri invalide']);
    exit;
}

// Récupérer le meilleur élève selon ce champ
$result = $collection->find(
    [],
    [
        'sort'  => [$mongoField => -1], // -1 = décroissant
        'limit' => 1
    ]
)->toArray();

// Si aucun résultat
if (count($result) === 0) {
    echo json_encode(['message' => 'Aucun résultat trouvé']);
    exit;
}

// Retourner le premier (et seul) document
echo json_encode($result[0], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
