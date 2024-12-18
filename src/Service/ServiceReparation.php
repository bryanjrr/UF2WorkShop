<?php

namespace App\Service;

use mysqli;

use App\Model\Reparation;

require '../../vendor/autoload.php';


class ServiceReparation
{

    public function getReparacion($rol, $id)
    {

        $bbdd = parse_ini_file('../../cfg/config.ini');

        $mysqli = new mysqli($bbdd["host"], $bbdd["user"], $bbdd["pwd"], $bbdd["db_name"]);

        $sql_query = "SELECT * FROM workshop WHERE id =" . $id;

        $result = $mysqli->query($sql_query);

        while ($row = $result->fetch_assoc()) {
            $reparation = new Reparation($row["id"], $row["Name_workshop"], $row["Register_date"], $row["License_plate"]);
        }
        
        return $reparation;
    }
}
