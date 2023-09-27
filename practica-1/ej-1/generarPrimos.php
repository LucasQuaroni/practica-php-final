<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1-1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_POST['numero'])) {
        $numero = (int) $_POST['numero'];

        if ($numero > 0) {
            $vec = array();
            $num = 2;

            while (count($vec) < $numero) {
                $isPrime = true;
                for ($i = 2; $i <= sqrt($num); $i++) {
                    if ($num % $i == 0) {
                        $isPrime = false;
                        break;
                    }
                }
                if ($isPrime) {
                    $vec[] = $num;
                }
                $num++;
            }

            echo '<h2>Números primos generados:</h2>';
            echo '<ul>';
            foreach ($vec as $prime) {
                echo '<li>' . $prime . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>El número debe ser mayor que 0</p>';
        }
    } else {
        echo '<p>El parámetro "numero" no se proporcionó</p>';
    }
    ?>
    <a href="index.html" id="volver">VOLVER</a>
</body>

</html>