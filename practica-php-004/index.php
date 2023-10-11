<!DOCTYPE html>
<html>

<head>
  <title>Consulta de Empleado</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="estilos.css">
</head>

<body>
  <h1>Consulta de Empleado</h1>
  <form method="POST">
    <div class="linea">
      <label>Número de Empleado:</label>
      <input type="number" name="num_empleado" id="num_empleado" />
    </div>
    <button type="button" id="btn" onclick="validarYEnviar()">Consultar</button>
  </form>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numEmpleado = $_POST["num_empleado"];

    $conexion = new mysqli("localhost", "root", "", "fabrica");

    if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
    }

    $query = "SELECT empleado.nombre, SUM(trabajo.horas) AS HorasTrabajadas, empleado.valorHora, empleado.actualizado 
              FROM empleado
              LEFT JOIN trabajo ON empleado.NumEmpleado = trabajo.NumEmpleado
              WHERE empleado.NumEmpleado = $numEmpleado
              GROUP BY empleado.NumEmpleado";

    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $nombre = $row["nombre"];
      $horasTrabajadas = $row["HorasTrabajadas"];
      $valorHora = $row["valorHora"];
      $actualizado = $row["actualizado"];

      if ($actualizado == "NO") {
        echo '<table>';
        echo '<tr><th>Nombre</th><th>Horas Trabajadas</th><th>Importe Neto</th></tr>';
        $importeNeto = $horasTrabajadas * $valorHora;

        $updateQuery = "UPDATE EMPLEADO SET Actualizado = 'SI' WHERE NumEmpleado = $numEmpleado";
        $conexion->query($updateQuery);
        echo "<tr><td>$nombre</td><td>$horasTrabajadas</td><td>$importeNeto</td></tr>";
        echo '</table>';
      } else {
        // echo "<div class='result'><span>Ya actualizado</span></div>"; //no hacer nada?? se borra
      }
    } else {
      echo "<div class='result'><span>No se encontró al empleado con el número de empleado proporcionado.</span></div>";
    }

    $conexion->close();
  }
  ?>
  <script>
    function validarYEnviar() {
      if (validarNumeroEmpleado()) {
        document.querySelector('form').submit();
      }
    }

    function validarNumeroEmpleado() {
      var numEmpleado = document.getElementById("num_empleado").value;
      if (!/^\d+$/.test(numEmpleado) || parseInt(numEmpleado) <= 0) {
        alert("Por favor, ingresa un número de empleado válido (entero positivo).");
        return false;
      }
      return true;
    }
  </script>
</body>

</html>