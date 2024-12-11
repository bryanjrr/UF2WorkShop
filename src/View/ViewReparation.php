<?php

if (isset($_GET['enviar'])) {
    session_start();

    $puesto = $_SESSION['puesto'] = $_GET['puesto'];

?>
    <h2>Welcome <?php echo $puesto ?> </h2>
    <form action="../Controller/controllerReparation.php" method="get">
        <input type="text" name="idReparacion" placeholder="Introduce el id de la Reparacion..">
        <input name="enviar" type="submit" value="enviar">
    </form>


<?php
    switch ($puesto) {
        case "client":

            break;

        case "employer":

            break;
    }


    /*     $reparacion = new controllerReparation();
 */
}

?>

</body>

</html>