<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Parser;

use AsyncBot\Plugin\DadJokes\Exception\UnexpectedResponse;
use AsyncBot\Plugin\DadJokes\ValueObject\Result\DadJoke;

class ParseICHDJResult
{
    /**
     * @throws UnexpectedResponse
     */
    public function parse(array $jsonResponse): DadJoke
    {
        return new DadJoke(
            $this->getJoke($jsonResponse),
        );
    }

    /**
     * @throws UnexpectedResponse
     */
    private function getJoke(array $jsonResponse): string
    {

        if (!$jsonResponse['joke']) {
            throw new UnexpectedResponse('joke');
        }

        return trim($jsonResponse['joke']);
    }
}