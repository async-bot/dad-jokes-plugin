<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Parser;

use AsyncBot\Plugin\DadJokes\Exception\UnexpectedResponse;
use AsyncBot\Plugin\DadJokes\ValueObject\Result\DadJoke;

class ParseStorageResult 
{
    /**
     * @throws UnexpectedResponse
     */
    public function parse(array $jokes): DadJoke
    {
        return new DadJoke(
            $this->getJoke($jokes)
        );
    }

    /**
     * @throws UnexpectedResponse
     */
    private function getJoke(array $jokes): string
    {
        if(empty($jokes)) {
            throw new UnexpectedResponse('joke');
        }
        return trim($jokes[array_rand($jokes)]);
    }
}
