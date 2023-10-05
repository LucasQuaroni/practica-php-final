<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>2-2</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Práctica 2 - Ej. 4</h1>
    <p>
        Escribir un programa en PHP que cargue en un array las notas de 30 alumnos
        de un curso (hacerlo con números al azar entre 0 y 10). Luego deberá armar
        una función llamada Abanderado que devolverá la nota de los 3 mejores
        alumnos. Fuera de la función, deberá imprimir las 3 notas y la ubicación
        de cada una dentro del array.
    </p>
    <form action="" method="POST">
        <label><b>Calcular los abanderados</b></label>
        <input type="submit" value="Calcular" />
    </form>
    <div class="container">

        <?php
        function abanderado($array)
        {
            $maxValues = array();

            foreach ($array as $alumno => $nota) {
                echo "$nota, ";
            }

            echo "<br>";

            for ($i = 0; $i < 3; $i++) {
                $maxValue = max($array);
                $maxKey = array_search($maxValue, $array);
                $maxValues[$maxKey] = $maxValue;
                unset($array[$maxKey]);
            }

            foreach ($maxValues as $key => $value) {
                echo "Nota: $value --- Posicion: $key<br>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $notas = array();
            for ($i = 0; $i < 30; $i++) {
                $notas[] = rand(0, 10);
            }
            abanderado($notas);
        }

        ?>
    </div>
</body>

</html>