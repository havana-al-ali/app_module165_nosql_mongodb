<?php
// Chargement du driver MongoDB
require __DIR__ . '/../vendor/autoload.php';

// Connexion MongoDB (Docker)
require __DIR__ . '/connect.php';

// Réponse JSON
header('Content-Type: application/json; charset=utf-8');

// Récupération du champ à trier (math ou writing)
$field = $_GET['field'] ?? 'math';

// Mapping des champs MongoDB
$map = [
    'math' => 'math score',
    'writing' => 'writing score'
];

// Vérification du champ
if (!isset($map[$field])) {
    echo json_encode(['error' => 'Champ invalide']);
    exit;
}

// Récupération du meilleur élève selon le champ choisi
$result = $collection->find(
    [],
    [
        'sort' => [$map[$field] => -1], // tri décroissant
        'limit' => 1
    ]
)->toArray();

// Si un élève est trouvé, calcul de la moyenne
$student = $result[0] ?? null;

if ($student) {
    $student['average'] = round(
        ($student['math score'] + $student['reading score'] + $student['writing score']) / 3,
        1
    );
}

// Renvoi JSON
echo json_encode($student, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
