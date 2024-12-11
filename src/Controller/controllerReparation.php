<?php
namespace Src\Controller;
require '../../vendor/autoload.php';


if (isset($_GET['idReparacion'])) {
    session_start();


}

class controllerReparation
{

    public function getReparation()
    {
        $puesto = $_SESSION['puesto'];
        $service = new ServiceReparation();
        $idReparacion = $_POST['idReparacion'];

        $service->getReparacion($puesto, $idReparacion);
    }
}
