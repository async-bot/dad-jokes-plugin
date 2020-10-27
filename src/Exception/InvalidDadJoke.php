<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Exception;

class InvalidDadJoke extends Exception
{
    public function __construct()
    {
        parent::__construct('Sorry, I don\'t get that joke, I need `name / joke`.');
    }
}
