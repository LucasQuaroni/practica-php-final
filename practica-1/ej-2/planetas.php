<?php
function planeta_con_mas_particulasH($particulas) {
    $max_particulas = max($particulas);
    return array_search($max_particulas, $particulas);
}

function planeta_con_menos_particulasH($particulas) {
    $min_particulas = min($particulas);
    return array_search($min_particulas, $particulas);
}

function promedio_particulasH($particulas) {
    $total_particulas = array_sum($particulas);
    $promedio = $total_particulas / count($particulas);
    return $promedio;
}

$planetas = [
    "Mercurio",
    "Venus",
    "Tierra",
    "Marte",
    "Júpiter",
    "Saturno",
    "Urano",
    "Neptuno",
    "Plutón"
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['particulas'])) {
        $particulas = (int) $_POST['particulas'];

        $planeta_mas_particulas = planeta_con_mas_particulasH($particulas);
        $planeta_menos_particulas = planeta_con_menos_particulasH($particulas);
        $promedio = promedio_particulasH($particulas);

        echo "El planeta {$planetas[$planeta_mas_particulas]} es donde se detectaron más partículas H.<br>";
        echo "El planeta {$planetas[$planeta_menos_particulas]} es donde se detectaron menos partículas H.<br>";
        echo "El promedio de partículas H es $promedio.";
    }
}
?>
