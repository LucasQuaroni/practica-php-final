<?php
function convertirBase($numeroDecimal, $baseFinal)
{
    return base_convert($numeroDecimal, 10, $baseFinal); //base_convert es una función incorporada de PHP que convierte un número de una base a otra. Aquí lo usamos para convertir de la base 10 a la base ingresada por el usuario.
}

$numeroDecimal = $_POST['numero1'];
$baseFinal = $_POST['numero2'];
$resultado = convertirBase($numeroDecimal, $baseFinal);
echo $numeroDecimal . " en base 10 = " . $resultado . " en base " . $baseFinal;
?>