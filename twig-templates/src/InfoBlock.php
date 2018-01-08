<?php

class InfoBlock
{
    private $infoTitle;
    private $infoDescription;
    private $infoImageUrl;

    public function __construct($infoTitle = null, $infoDescription = null, $infoImageUrl = null)
    {
        $this->setTitle($infoTitle);
        $this->setDescription($infoDescription);
        $this->setImageUrl($infoImageUrl);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($infoTitle)
    {
        $this->title = $infoTitle;
    }

    public function getDescription()
    {
        return $this->infoDescription;
    }

    public function setDescription($infoDescription)
    {
        $this->description = $infoDescription;
    }

    public function getImageUrl()
    {
        return $this->infoImageUrl;
    }

    public function setImageUrl($infoImageUrl)
    {
        $this->imageUrl = $infoImageUrl;
    }
}