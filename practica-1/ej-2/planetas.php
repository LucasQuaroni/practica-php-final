<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-2</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="results">
        <div class="php">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $particulas = [];

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

                $valido = true; 
            
                for ($i = 0; $i < 9; $i++) {
                    if (isset($_POST["particulas$i"])) {
                        $cantidad = intval($_POST["particulas$i"]);
                        if ($cantidad >= 0) {
                            $particulas[$i] = $cantidad;
                        } else {
                            $valido = false;
                            break;
                        }
                    } else {
                        $particulas[$i] = 0;
                    }
                }

                if ($valido) {
                    function planeta_con_mas_particulasH($particulas)
                    {
                        $max_particles = max($particulas);
                        return array_search($max_particles, $particulas);
                    }

                    function planeta_con_menos_particulasH($particulas)
                    {
                        $min_particles = min($particulas);
                        return array_search($min_particles, $particulas);
                    }

                    function calculate_average($particulas)
                    {
                        $total = array_sum($particulas);
                        return $total / count($particulas);
                    }

                    $planeta_mas = planeta_con_mas_particulasH($particulas);
                    $planeta_menos = planeta_con_menos_particulasH($particulas);
                    $promedio = round(calculate_average($particulas), 2);

                    echo "El planeta <span class='planet'>$planetas[$planeta_mas]</span> es donde se detectaron más partículas H.<br>";
                    echo "El planeta <span class='planet'>$planetas[$planeta_menos]</span> es donde se detectaron menos partículas H.<br>";
                    echo "El promedio de partículas H es <span class='planet'>$promedio</span>.<br>";
                } else {
                    echo "¡Se detectó una cantidad negativa de partículas en uno de los planetas!";
                }
            }
            ?>
        </div>
        <br>
        <a href="index.html">Volver</a>
    </div>
</body>

</html>