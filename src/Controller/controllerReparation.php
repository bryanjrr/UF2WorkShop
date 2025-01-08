<?php

namespace App\Controller;
 
use App\View\ViewReparation;
use App\Service\ServiceReparation;

require '../../vendor/autoload.php';



if (isset($_GET['idReparacion'])) {
    $controlador = new controllerReparation();
    $controlador->getReparation();
}

if (isset($_POST['idWorkshop']) && isset($_POST['nombreWorkshop']) && isset($_POST['fechaRegistro']) && isset($_POST['matricula'])) {
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
        $view->render($reparation, "Vehiculo Encontrado");
    }

    public function insertReparation()
    {
        session_start();        

        /* Informacion Reparacion */
        $service = new ServiceReparation();
        $reparation = $service->insertReparation($_POST['idWorkshop'], $_POST['nombreWorkshop'], $_POST['fechaRegistro'], $_POST['matricula'], $_FILES['imageFile']);
        $view = new ViewReparation();
        $view->render($reparation, "Vehiculo Insertado Correctamente");
    }
}
