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
    <p>Cargar dos vectores con números al azar de 6 elementos cada uno. El primer vector se llama $origen y el segundo
        $destino. Debe realizar una función que informe la cantidad de elementos repetidos que hay en cada vector, y
        además la posición que ocupa en ambos vectores. </p>
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

            $repetidosOrigen = [];
            $repetidosDestino = [];

            foreach ($origen as $numero) {
                if (in_array($numero, $destino)) {
                    $repetidosOrigen[$numero] = array_keys($origen, $numero);
                    $repetidosDestino[$numero] = array_keys($destino, $numero);
                }
            }

            echo "<h2>Vectores:</h2>";
            echo "<h3>Vector Origen (Elementos repetidos: " . count($repetidosOrigen) . "):</h3>";
            echo "[" . implode(", ", $origen) . "]<br>";
            echo "<h3>Vector Destino (Elementos repetidos: " . count($repetidosDestino) . "):</h3>";
            echo "[" . implode(", ", $destino) . "]<br>";

            echo "<h2>Resultados:</h2>";

            if (empty($repetidosOrigen)) {
                echo "<p>No hay elementos repetidos entre los vectores Origen y Destino.</p>";
            } else {
                echo "<h3>Elementos Repetidos:</h3>";
                foreach ($repetidosOrigen as $numero => $posicionesOrigen) {
                    $posicionesDestino = $repetidosDestino[$numero];
                    echo "Número $numero se repite en el vector Origen en las posiciones: " . implode(", ", $posicionesOrigen) . " y en el vector Destino en las posiciones: " . implode(", ", $posicionesDestino) . "<br>";
                }
            }
        }
        ?>
    </div>
</body>

</html>