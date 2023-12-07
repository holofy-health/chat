<?php

namespace Musonza\Chat\OpenApi\Responses\Chat\Message;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\ConversationSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Message\MessageSchema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class MessageResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->content(
                MediaType::json()->schema(MessageSchema::ref())
            )
            ->description('Successful response');
    }
}
