<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Pusher;

use Amp\Promise;
use AsyncBot\Core\Storage\KeyValue\FileSystem;
use AsyncBot\Plugin\DadJokes\Exception\DadJokeAlreadyExists;
use AsyncBot\Plugin\DadJokes\Exception\InvalidDadJoke;
use AsyncBot\Plugin\DadJokes\ValueObject\Input\DadJoke;
use function Amp\call;

final class PushToStorage
{
    private FileSystem $storage;

    public function __construct(FileSystem $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return Promise
     * @throws InvalidDadJoke
     * @throws DadJokeAlreadyExists
     */
    public function set(DadJoke $joke): Promise
    {
        return call(function ()  use ($joke) {
            $this->throwIfJokeInvalid($joke);

            $jokes = yield $this->storage->get('DadJokes') ?: [];
            $this->throwIFJokeAlreadyExists($joke->getName(), $jokes);

            $jokes[$joke->getName()] = $jokes[$joke->getJoke()];
            $this->storage->set('DadJokes', $jokes);
        });
    }

    private function throwIfJokeInvalid(DadJoke $joke) {
        if(!$joke->getName() || !$joke->getJoke()) {
            throw new InvalidDadJoke();
        }
    }

    private function throwIFJokeAlreadyExists(string $name, array $jokes) {
        if(array_key_exists($name, $jokes)) {
            throw new DadJokeAlreadyExists($name);
        }
    }
}
