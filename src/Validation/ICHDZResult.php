<?php declare(strict_types=1);

namespace AsyncBot\Plugin\DadJokes\Validation;

use AsyncBot\Core\Http\Validation\JsonSchema;

final class ICHDZResult extends JsonSchema
{
    public function __construct()
    {
        parent::__construct([
            '$id'     => null,
            '$schema' => 'http://json-schema.org/draft-07/schema#',
            'title'   => 'icanhazdadjoke result',
            'type'    => 'object',  
            "properties"=> [
                "id"=> [
                  "type"=> "string"
                ],
                "joke"=> [
                  "type"=> "string"
                ],
                "status"=> [
                  "type"=> "integer"
                ]
              ],
              "required"=> [
                "id",
                "joke",
                "status"
              ]
        ]);
    }
}