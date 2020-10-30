<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Retriever;

use Amp\Promise;
use AsyncBot\Core\Storage\KeyValue\FileSystem;
use AsyncBot\Plugin\DadJokes\Exception\UnexpectedResponse;
use AsyncBot\Plugin\DadJokes\Exception\DadJokeNotFound;
use AsyncBot\Plugin\DadJokes\Parser\ParseStorageResult;
use AsyncBot\Plugin\DadJokes\ValueObject\Result\DadJoke;
use function Amp\call;

final class GetFromStorage
{
    private FileSystem $storage;

    public function __construct(FileSystem $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return Promise<DadJoke>
     * @throws DadJokeNotFound
     */
    public function retrieve(): Promise
    {
        return call(function () {
            try {
                return (new ParseStorageResult())->parse(
                    yield $this->storage->get('DadJokes'),
                );
            } catch (UnexpectedResponse $e) {
                throw new DadJokeNotFound();
            }
        });
    }
}
