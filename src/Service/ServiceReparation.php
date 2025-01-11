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


    public function connect()
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
            $reparation = new Reparation($row["uuid"], $row["id"], $row["Name_workshop"], $row["Register_date"], $row["License_plate"], $row["imagen"]);
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

        $managerImage = new \Intervention\Image\ImageManager();

        $imageObject = $managerImage->make(data: $_FILES['imageFile']["tmp_name"]);

        echo "<b>" . __LINE__ . "</b>";

        $imageObject->text($uuid . $matricula, 0, 0, function ($imagen) {
            $imagen->color('#fdf6e3');
            $imagen->size(28);
            $imagen->align('center');
            $imagen->valign('top');
        });

        echo "<b>" . __LINE__ . "</b>";

        var_dump($imageObject);

        echo "<b>" . __LINE__ . "</b>";

        echo "<br><br><br>";

        $imageObject->save("../output/" . $idWorkshop . "-" . $_FILES['imageFile']["name"]);
        echo "<b>" . __LINE__ . "</b>";

        $sql_query = "INSERT INTO `workshop`(`uuid`, `id`, `Name_workshop`, `Register_date`, `License_plate`, `imagen`) VALUES ('$uuid', '$idWorkshop', '$nombre', '$fechaRegistro', '$imageObject')";

        try {
            $mysqli->query($sql_query);
            $log->info("Se ha realizado el INSERT Correctamente!");
        } catch (mysqli_sql_exception $e) {
            $log->error("Error al realizar la consulta (INSERT) en la BBDD");
        }


        $reparation = new Reparation($uuid, $idWorkshop, $nombre, $fechaRegistro, $matricula, $imageObject);

        return $reparation;

    }
}
