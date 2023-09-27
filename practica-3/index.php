<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>practica-3</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Practica 3</h1>
    <p>Crearemos una tabla de valores de seno y coseno de 0 a 2 en incrementos de 0.01. Los valores negativos que
        resulten los queremos mostrar en rojo, y los valores positivos en azul. Un color diferente cada fila que se
        imprima.</p>
    <ul class="container">
        <?php
        $incremento = 0.01;
        $inicio = 0.00;
        $fin = 2;

        for ($i = $inicio; $i <= $fin + 0.01; $i += $incremento) {
            $seno = sin($i);
            $coseno = cos($i);
            $class = ($seno >= 0 && $coseno >= 0) ? "positive" : "negative";
            $formato_i = number_format($i, 2);

            echo "<li class='$class'><b>Ángulo:</b> $formato_i ---  <b>Seno:</b> $seno ---  <b>Coseno:</b> $coseno</li>";
        }
        ?>
    </ul>

</body>

</html>