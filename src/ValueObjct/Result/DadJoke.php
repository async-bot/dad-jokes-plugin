<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\ValueObject\Result;

class DadJoke
{
    private string $joke;

    public function __construct(string $joke)
    {
        $this->joke = $joke;
    }


    public function getJoke(): string
    {
        return $this->joke;
    }
}