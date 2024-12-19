<?php

namespace App\Service;

use mysqli;

use App\Model\Reparation;
use mysqli_sql_exception;
use Ramsey\Uuid\Uuid;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../../vendor/autoload.php';


class ServiceReparation
{


    public function connect(): mysqli
    {
        $log = new Logger("LogWorkerDB");
        $log->pushHandler(new StreamHandler("../logs/WorkerDB.log", Level::Info));

        try {
            $bbdd = parse_ini_file('../../cfg/config.ini');

            $mysqli = new mysqli($bbdd["host"], $bbdd["user"], $bbdd["pwd"], $bbdd["db_name"]);

            $log->info("Se ha conectado correctamente a la BBDD");

            return $mysqli;
        } catch (mysqli_sql_exception $e) {
            $log->error("Error al conectar a la BBDD");
        }
    }

    public function getReparacion($rol, $uuid)
    {
        $log = new Logger("LogWorkerDB");
        $log->pushHandler(new StreamHandler("../logs/WorkerDB.log", Level::Info));


        $mysqli = $this->connect();


        $sql_query = "SELECT * FROM workshop WHERE uuid =" . $uuid;

        try {
            $result = $mysqli->query($sql_query);
            $log->info("Se ha realizado el SELECT Correctamente!");
        } catch (mysqli_sql_exception $e) {
            $log->error("Error al realizar la consulta (SELECT) en la BBDD");
        }

        while ($row = $result->fetch_assoc()) {
            $reparation = new Reparation($row["uuid"], $row["id"], $row["Name_workshop"], $row["Register_date"], $row["License_plate"]);
        }

        return $reparation;
    }

    public function generateUUID()
    {
        $uuid = Uuid::uuid4();
        return $uuid;
    }

    public function insertReparation($idWorkshop, $nombre, $fechaRegistro, $matricula)
    {

        $log = new Logger("LogWorkerDB");
        $log->pushHandler(new StreamHandler("../logs/WorkerDB.log", Level::Info));

        $mysqli = $this->connect();

        $uuid = $this->generateUUID();

        $sql_query = "INSERT INTO `workshop`(`uuid`, `id`, `Name_workshop`, `Register_date`, `License_plate`) VALUES ('$uuid', '$idWorkshop', '$nombre', '$fechaRegistro', '$matricula')";

        try {
            $mysqli->query($sql_query);
            $log->info("Se ha realizado el INSERT Correctamente!");
        } catch (mysqli_sql_exception $e) {
            $log->error("Error al realizar la consulta (INSERT) en la BBDD");
        }


        $reparation = new Reparation($uuid, $idWorkshop, $nombre,  $fechaRegistro, $matricula);

        return $reparation;
    }
}
