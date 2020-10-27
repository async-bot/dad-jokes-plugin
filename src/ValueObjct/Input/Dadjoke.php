<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\ValueObject\Input;

class DadJoke
{
    private string $joke;

    private string $name;

    public function __construct(string $name, string $joke)
    {
        $this->joke = trim($joke);
        $this->name = trim($name);
    }


    public function getJoke(): string
    {
        return $this->joke;
    }


    public function getName(): string
    {
        return $this->name;
    }
}
