<?php

namespace Musonza\Chat\OpenApi\Responses\Chat\Conversation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\ConversationSchema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ConversationResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->content(
                MediaType::json()->schema(ConversationSchema::ref())
            )
            ->description('Successful response');
    }
}
