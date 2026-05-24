<?php
// Chargement du driver MongoDB
require __DIR__ . '/../vendor/autoload.php';

// Connexion MongoDB (Docker)
require __DIR__ . '/connect.php';

// Réponse JSON
header('Content-Type: application/json; charset=utf-8');

// Type d'agrégation demandé
$type = $_GET['type'] ?? '';

/* 1) Moyenne des scores par genre */
if ($type === 'avgByGender') {

    $pipeline = [
        [
            '$group' => [
                '_id' => '$gender',               // Regroupement par genre
                'count' => ['$sum' => 1],         // Nombre d'élèves
                'avg_math' => ['$avg' => '$math score'],
                'avg_reading' => ['$avg' => '$reading score'],
                'avg_writing' => ['$avg' => '$writing score']
            ]
        ]
    ];

    $result = $collection->aggregate($pipeline)->toArray();

    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

/* 2) Meilleur élève (moyenne totale) */
if ($type === 'topStudent') {

    $pipeline = [
        [
            '$addFields' => [
                'average' => [
                    '$avg' => [
                        '$math score',
                        '$reading score',
                        '$writing score'
                    ]
                ]
            ]
        ],
        ['$sort' => ['average' => -1]], // Tri décroissant
        ['$limit' => 1]                 // On garde le meilleur
    ];

    $result = $collection->aggregate($pipeline)->toArray();

    echo json_encode($result[0], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Si aucun type valide n'est fourni
echo json_encode(['error' => 'Agrégation inconnue']);
