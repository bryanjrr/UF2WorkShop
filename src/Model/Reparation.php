<?php

namespace App\Model;

require '../../vendor/autoload.php';

class Reparation
{

    private $idReparation;
    private $nameWorkshop;

    private $registerDate;

    private $uuid;
    private $license_plate;

    public function __construct($uuid, $idReparation, $nameWorkshop, $registerDate, $license_plate)
    {
        $this->uuid = $uuid;
        $this->idReparation = $idReparation;
        $this->nameWorkshop = $nameWorkshop;
        $this->registerDate = $registerDate;
        $this->license_plate = $license_plate;
    }



    /**
     * Get the value of license_plate
     */
    public function getLicense_plate()
    {
        return $this->license_plate;
    }

    /**
     * Set the value of license_plate
     *
     * @return  self
     */
    public function setLicense_plate($license_plate)
    {
        $this->license_plate = $license_plate;

        return $this;
    }

    /**
     * Get the value of registerDate
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set the value of registerDate
     *
     * @return  self
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get the value of nameWorkshop
     */
    public function getNameWorkshop()
    {
        return $this->nameWorkshop;
    }

    /**
     * Set the value of nameWorkshop
     *
     * @return  self
     */
    public function setNameWorkshop($nameWorkshop)
    {
        $this->nameWorkshop = $nameWorkshop;

        return $this;
    }

    /**
     * Get the value of idReparation
     */
    public function getIdReparation()
    {
        return $this->idReparation;
    }

    /**
     * Get the value of uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
