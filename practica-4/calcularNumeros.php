<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>practica-3</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Practica 4</h1>
    <p>
        Escribir un programa en HTML que pida dos números. El primero será un
        número entero que indica el número en base 10 (decimal) que vamos a querer
        convertir. El segundo número será la base (validar que sea entero de 1 a
        9) a la que queremos convertir el primer número ingresado. Luego llamar a
        un programa php con el método POST, que convierta el número en base 10, a
        la base que indica el segundo número. Hacerlo por medio de una función, y
        en el script principal que muestre: XXX en base 10 = YYY en base NN (donde
        XXX es el número que se quiere convertir, YYY es el número calculado en la
        función, y NN es la base que ingresó el usuario a la que se quería
        convertir).
    </p>
    <form action="calcularNumeros.php" onsubmit="return validacion()" method="POST">
        <div class="linea">
            <label>Ingrese un número entero en base 10:</label>
            <input type="number" id="numero1" name="numero1" />
        </div>
        <div class="linea">
            <label>Ingrese un número entero para utilizar como nueva base: (1 a
                9)</label>
            <input type="number" id="numero2" name="numero2" />
        </div>
        <input type="submit" value="Convertir" id="boton" />
    </form>

    <div class="result">
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
    </div>
    <script>
        function validacion() {
            const num1 = parseInt(document.getElementById("numero1").value);
            const num2 = parseInt(document.getElementById("numero2").value);

            if (Number.isInteger(num1) && Number.isInteger(num2)) {
                if (num1 >= 0 && num2 >= 1 && num2 <= 9) {
                    return true;
                }
            }
            alert("Número inválido.");
            return false;
        }
    </script>
</body>

</html>