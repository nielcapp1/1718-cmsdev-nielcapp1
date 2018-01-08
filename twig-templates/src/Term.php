<?php

class Term
{
    private $termTitle;

    private $termDescription;

    public function __construct($termTitle = null, $termDescription = null)
    {
        $this->setTitle($termTitle);
        $this->setDescription($termDescription);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($termTitle)
    {
        $this->title = $termTitle;
    }

    public function getDescription()
    {
        return $this->termDescription;
    }

    public function setDescription($termDescription)
    {
        $this->description = $termDescription;
    }
}