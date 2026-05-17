<?php
require 'connect.php'; // Connexion MongoDB

$type = $_GET['type'] ?? ''; // Type d'opération

switch ($type) {

    case 'avgByGender':
        // Moyenne par genre
        $pipeline = [
            ['$match' => ['gender' => ['$in' => ['male', 'female']]]],
            ['$group' => [
                '_id' => '$gender',
                'avgMath' => ['$avg' => '$math score'],
                'avgReading' => ['$avg' => '$reading score'],
                'avgWriting' => ['$avg' => '$writing score']
            ]]
        ];
        break;

    case 'topStudent':
        // Meilleur élève (score total)
        $pipeline = [
            ['$addFields' => [
                'totalScore' => [
                    '$add' => ['$math score', '$reading score', '$writing score']
                ]
            ]],
            ['$sort' => ['totalScore' => -1]],
            ['$limit' => 1]
        ];
        break;

    default:
        echo "Commande inconnue";
        exit;
}

$result = $collection->aggregate($pipeline)->toArray(); // Exécuter pipeline

// Résumé pour la moyenne par genre
if ($type === 'avgByGender') {

    $output = "Moyenne des scores par genre :\n";

    foreach ($result as $row) {
        $gender = ucfirst($row['_id']);
        $avgMath = round($row['avgMath'], 2);
        $avgReading = round($row['avgReading'], 2);
        $avgWriting = round($row['avgWriting'], 2);

        $output .= "- $gender : Math $avgMath | Reading $avgReading | Writing $avgWriting\n";
    }

    header('Content-Type: text/plain; charset=utf-8');
    echo $output;
    exit;
}

// Résumé pour le meilleur élève
if ($type === 'topStudent') {

    $s = $result[0]; // Premier (et seul) résultat

    $output = "Meilleur élève :\n";
    $output .= "- Genre : " . ucfirst($s['gender']) . "\n";
    $output .= "- Score total : " . $s['totalScore'] . "\n";
    $output .= "- Math : " . $s['math score'];
    $output .= " | Reading : " . $s['reading score'];
    $output .= " | Writing : " . $s['writing score'] . "\n";

    header('Content-Type: text/plain; charset=utf-8');
    echo $output;
    exit;
}

// Sinon → JSON (sécurité)
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
