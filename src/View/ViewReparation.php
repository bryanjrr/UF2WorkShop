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
    <form action="../Controller/controllerReparation.php" method="GET">
        <input type="text" name="idReparacion" placeholder="Introduce el id de la Reparacion..">
        <input name="enviar" type="submit" value="enviar">
    </form>


    <?php
    switch ($_SESSION['puesto1']) {
        case "employer":
    ?>
            <h2 class="titulo">Insertar una Reparacion</h2>
            <div class=contenedorRegistro>
                <form action="../Controller/controllerReparation.php" method="POST" enctype="multipart/form-data">
                    <label>
                        Id Workshop:
                    </label>
                    <input type=number name=idWorkshop pattern="^\d{4,4}$" required>

                    <label>
                        Nombre WorkShop:
                    </label>
                    <input type=text name=nombreWorkshop required>


                    <label>
                        Fecha de Registro:
                    </label>
                    <input type=date name=fechaRegistro required>

                    <label>
                        Matricula:
                    </label>
                    <input type=text name=matricula pattern="^\d{4}-[A-Z]{3}$" required>

                    <br>

                    <input type="file" name="imageFile">
                    <br>
                    <br>


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

    public function render(Reparation $reparacion, String $mensaje)
    {
        ?>
        <link rel="stylesheet" href="../../public/styles.css">
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <h2 class="mensaje"><?php echo $mensaje ?><ion-icon class="icono" name="car-sport-sharp"></ion-icon></h2>
        <table>
            <tr>
                <th>UUID</th>
                <th>ID</th>
                <th>Name Workshop</th>
                <th>Register Date</th>
                <th>License Plate</th>
                <th>Photo Damaged Vehicle</th>
            </tr>
            <tr>
                <td><?php echo $reparacion->getUuid();  ?></td>
                <td><?php echo $reparacion->getIdReparation();  ?></td>
                <td><?php echo $reparacion->getNameWorkshop(); ?></td>
                <td><?php echo $reparacion->getRegisterDate();  ?></td>
                <td><?php echo $reparacion->getLicense_plate();  ?></td>
                <td><img src="data-image/jpg;base64, <?php base64_encode($reparacion->getImagen())?> set="">?></td>
            </tr>
        </table>



<?php



    }
}

?>

</body>

</html>