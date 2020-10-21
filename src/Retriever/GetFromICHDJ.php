<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Retriever;

use Amp\Promise;
use AsyncBot\Core\Http\Client;
use AsyncBot\Plugin\DadJokes\Exception\UnexpectedResponse;
use AsyncBot\Plugin\DadJokes\Exception\DadJokeNotFound;
use AsyncBot\Plugin\DadJokes\Parser\ParseICHDJResult;
use AsyncBot\Plugin\DadJokes\Validation\ICHDZResult;
use AsyncBot\Plugin\DadJokes\ValueObject\Result\DadJoke;
use function Amp\call;

final class GetFromICHDJ
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
    public function retrieve(): Promise
    {
        return call(function () {
            try {
                return (new ParseICHDJResult())->parse(
                    yield $this->httpClient->requestJson('https://icanhazdadjoke.com/', new ICHDZResult),
                );
            } catch (UnexpectedResponse $e) {
                throw new DadJokeNotFound();
            }
        });
    }
}