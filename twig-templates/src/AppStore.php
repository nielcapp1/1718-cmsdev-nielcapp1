<?php

class AppStore
{
    private $appTitle;
    private $appDescription;
    private $appImageUrl;

    public function __construct($appTitle = null, $appDescription = null, $appImageUrl = null)
    {
        $this->setTitle($appTitle);
        $this->setDescription($appDescription);
        $this->setImageUrl($appImageUrl);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($appTitle)
    {
        $this->title = $appTitle;
    }

    public function getDescription()
    {
        return $this->appDescription;
    }

    public function setDescription($appDescription)
    {
        $this->description = $appDescription;
    }

    public function getImageUrl()
    {
        return $this->appImageUrl;
    }

    public function setImageUrl($appImageUrl)
    {
        $this->imageUrl = $appImageUrl;
    }
}