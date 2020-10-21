<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\DadJokes\Exception\DadJokeNotFound;
use AsyncBot\Plugin\DadJokes\Retriever\GetFromICHDJ;
use AsyncBot\Plugin\DadJokes\ValueObject\Result\DadJoke;

final class Plugin
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Promise<DadJoke>
     * @throws DadJokeNotFound
     */
    public function getDadJoke(): Promise
    {
        return (new GetFromICHDJ($this->httpClient))->retrieve();
    }
}