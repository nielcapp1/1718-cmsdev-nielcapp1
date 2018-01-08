<?php

class Experience
{
    private $experienceTitle;
    private $experienceDescription;
    private $experienceName;
    private $experienceImageUrl;

    public function __construct($experienceTitle = null, $experienceDescription = null, $experienceName = null, $experienceImageUrl = null)
    {
        $this->setTitle($experienceTitle);
        $this->setDescription($experienceDescription);
        $this->setName($experienceName);
        $this->setImageUrl($experienceImageUrl);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($experienceTitle)
    {
        $this->title = $experienceTitle;
    }

    public function getDescription()
    {
        return $this->experienceDescription;
    }

    public function setDescription($experienceDescription)
    {
        $this->description = $experienceDescription;
    }

    public function getName()
    {
        return $this->experienceName;
    }

    public function setName($experienceName)
    {
        $this->name = $experienceName;
    }

    public function getImageUrl()
    {
        return $this->experienceImageUrl;
    }

    public function setImageUrl($experienceImageUrl)
    {
        $this->imageUrl = $experienceImageUrl;
    }
}