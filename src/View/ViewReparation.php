<?php

namespace App\View;

require '../../vendor/autoload.php';

use App\Model\Reparation;

if (isset($_GET['puesto'])) {
    session_start();
    $_SESSION['puesto1'] = $_GET['puesto'];
?>
    <link rel="stylesheet" href="../../public/styles.css">
    <h2>Welcome <?php echo $_SESSION['puesto1'] ?> </h2>
    <form action="../Controller/control" method="GET">
        <input type="text" name="idReparacion" placeholder="Introduce el id de la Reparacion..">
        <input name="enviar" type="submit" value="enviar">
    </form>


    <?php
    switch ($_SESSION['puesto1']) {
        case "employer":
    ?>
            <h2 class="titulo">Insertar una Reparacion</h2>
            <div class=contenedorRegistro>
            <form action="../../src/Controller/controllerReparation.php">
                <label>
                    Id Workshop:
                </label>
                <input type=number name=idWorkshop>

                <label>
                    Nombre WorkShop:
                </label>
                <input type=text name=nombreWorkshop>


                <label>
                    Fecha de Registro:
                </label>
                <input type=text name=fechaRegistro>

                <label>
                    Matricula:
                </label>
                <input type=text name=matricula>

                <input type="submit" value="Registrar" value="Registrar">
            </div>
            </form>

            <!-- Introducir imagen -->
            </body>

            </html>

        <?php

            break;
    }
}

class ViewReparation
{

    public function render(Reparation $reparacion)
    {
        ?>
        <link rel="stylesheet" href="../../public/styles.css">
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <h2 class="mensaje">Vehiculo Encontrado <ion-icon class="icono" name="car-sport-sharp"></ion-icon></h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name Workshop</th>
                <th>Register Date</th>
                <th>License Plate</th>
                <th>Photo Damaged Vehicle</th>
            </tr>
            <tr>
                <td><?php echo $reparacion->getIdReparation();  ?></td>
                <td><?php echo $reparacion->getNameWorkshop(); ?></td>
                <td><?php echo $reparacion->getRegisterDate();  ?></td>
                <td><?php echo $reparacion->getLicense_plate();  ?></td>
                <td></td>
            </tr>
        </table>



<?php



    }
}

?>

</body>

</html>