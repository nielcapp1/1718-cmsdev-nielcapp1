<?php

class Car
{
    private $carName;
    private $carDescription;
    private $carImageUrl;

    public function __construct($carName = null, $carDescription = null, $carImageUrl = null)
    {
        $this->setName($carName);
        $this->setDescription($carDescription);
        $this->setImageUrl($carImageUrl);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($carName)
    {
        $this->name = $carName;
    }

    public function getDescription()
    {
        return $this->carDescription;
    }

    public function setDescription($carDescription)
    {
        $this->description = $carDescription;
    }
    public function getImageUrl()
    {
        return $this->carImageUrl;
    }

    public function setImageUrl($carImageUrl)
    {
        $this->imageUrl = $carImageUrl;
    }
}