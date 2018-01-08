<?php

class FAQ
{
    private $faqQuestion;
    private $faqAnswer;

    public function __construct($faqQuestion = null, $faqAnswer = null)
    {
        $this->setQuestion($faqQuestion);
        $this->setAnswer($faqAnswer);
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($faqQuestion)
    {
        $this->question = $faqQuestion;
    }

    public function getAnswer()
    {
        return $this->faqAnswer;
    }

    public function setAnswer($faqAnswer)
    {
        $this->answer = $faqAnswer;
    }
}