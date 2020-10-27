<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Exception;

class DadJokeAlreadyExists extends Exception
{
    public function __construct(string $key)
    {
        parent::__construct("I already know a joke about {$key}! Tell me a new one.");
    }
}
