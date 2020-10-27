<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Core\Storage\KeyValue\FileSystem;
use AsyncBot\Plugin\DadJokes\Exception\DadJokeNotFound;
use AsyncBot\Plugin\DadJokes\Pusher\PushToStorage;
use AsyncBot\Plugin\DadJokes\Retriever\GetFromICHDJ;
use AsyncBot\Plugin\DadJokes\Retriever\GetFromStorage;
use AsyncBot\Plugin\DadJokes\ValueObject\Input\DadJoke as DadJokeInput;
use AsyncBot\Plugin\DadJokes\ValueObject\Result\DadJoke;

final class Plugin
{
    private Client $httpClient;

    private FileSystem $storage;

    public function __construct(Client $httpClient, FileSystem $storage)
    {
        $this->httpClient = $httpClient;
        $this->storage = $storage;
    }

    /**
     * @return Promise<DadJoke>
     * @throws DadJokeNotFound
     */
    public function getDadJokeFromICHDJ(): Promise
    {
        return (new GetFromICHDJ($this->httpClient))->retrieve();
    }

    /**
     * @return Promise<DadJoke>
     * @throws DadJokeNotFound
     */
    public function getDadJokeFromStorage(): Promise
    {
        return (new GetFromStorage($this->storage))->retrieve();
    }

    /**
     * @return Promise<DadJoke>
     * @throws DadJokeNotFound
     */
    public function addDadJokeToStorage(DadJokeInput $joke): Promise
    {
        return (new PushToStorage($this->storage))->set($joke);
    }
}
