<?php

namespace App\Controller;

use App\View\ViewReparation;
use App\Service\ServiceReparation;

require '../../vendor/autoload.php';


if (isset($_GET['idReparacion'])) {
    $controlador = new controllerReparation();
    $controlador->getReparation();
}

if (isset($_GET['idWorkshop']) && isset($_GET['nombreWorkshop']) && isset($_GET['fechaRegistro']) && isset($_GET['matricula'])) {
    $controlador = new controllerReparation();
    $controlador->insertReparation();
}

class controllerReparation
{

    public function getReparation()
    {
        session_start();

        $service = new ServiceReparation();
        $_SESSION['idReparacion1'] = $_GET['idReparacion'];

        $reparation = $service->getReparacion($_SESSION['puesto1'],  $_SESSION['idReparacion1']);
        $view = new ViewReparation();
        $view->render($reparation);
    }

    public function insertReparation()
    {
        session_start();
        


    }
}
