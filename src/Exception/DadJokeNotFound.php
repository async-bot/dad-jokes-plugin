<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Exception;

class DadJokeNotFound extends Exception
{
    public function __construct()
    {
        parent::__construct('Could not find a joke');
    }
}