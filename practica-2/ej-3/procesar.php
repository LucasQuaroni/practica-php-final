<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2-1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Práctica 2 - Ej. 3</h1>
    <p>Cargar dos vectores con números al azar de 6 elementos cada uno. El primer vector se llama $origen y el segundo $destino. Debe realizar una función que informe la cantidad de elementos repetidos que hay en cada vector, y además la posición que ocupa en ambos vectores. </p>
    <form action="procesar.php" method="post">
        <label for="origen">Vector Origen (separados por comas):</label>
        <input type="text" name="origen" id="origen" pattern="(\d+,\s*){5}\d+" required>
        <br>
        <label for="destino">Vector Destino (separados por comas):</label>
        <input type="text" name="destino" id="destino" pattern="(\d+,\s*){5}\d+" required>
        <br>
        <input type="submit" value="Calcular">
    </form>
    <div class="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $origen = explode(",", $_POST["origen"]);
            $destino = explode(",", $_POST["destino"]);

            $origen = array_map("trim", $origen);
            $destino = array_map("trim", $destino);
            $origen = array_map("intval", $origen);
            $destino = array_map("intval", $destino);

            $repetidosOrigen = array_count_values($origen);
            $repetidosDestino = array_count_values($destino);

            $hayRepeticionesOrigen = false;
            $hayRepeticionesDestino = false;

            foreach ($repetidosOrigen as $cantidad) {
                if ($cantidad > 1) {
                    $hayRepeticionesOrigen = true;
                    break;
                }
            }

            foreach ($repetidosDestino as $cantidad) {
                if ($cantidad > 1) {
                    $hayRepeticionesDestino = true;
                    break;
                }
            }

            echo "<h2>Resultados:</h2>";

            if (!$hayRepeticionesOrigen) {
                echo "<p>Vector Origen: Sin repeticiones</p>";
            } else {
                echo "<h3>Vector Origen:</h3>";
                foreach ($repetidosOrigen as $numero => $cantidad) {
                    if ($cantidad > 1) {
                        echo "Número $numero se repite $cantidad veces en el vector Origen. Posiciones: ";
                        $posiciones = array_keys($origen, $numero);
                        echo implode(", ", $posiciones);
                        echo "<br>";
                    }
                }
            }

            if (!$hayRepeticionesDestino) {
                echo "<p>Vector Destino: Sin repeticiones</p>";
            } else {
                echo "<h3>Vector Destino:</h3>";
                foreach ($repetidosDestino as $numero => $cantidad) {
                    if ($cantidad > 1) {
                        echo "Número $numero se repite $cantidad veces en el vector Destino. Posiciones: ";
                        $posiciones = array_keys($destino, $numero);
                        echo implode(", ", $posiciones);
                        echo "<br>";
                    }
                }
            }
        }
        ?>
    </div>
</body>

</html>