<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Exception;

class UnexpectedResponse extends Exception
{
    public function __construct(string $key)
    {
        parent::__construct(sprintf('Could not find the "%s" key in the response', $key));
    }
}