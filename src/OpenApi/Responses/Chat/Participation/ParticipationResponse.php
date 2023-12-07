<?php

namespace Musonza\Chat\OpenApi\Responses\Chat\Participation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\ConversationSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Message\MessageSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Participation\ParticipationSchema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ParticipationResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->content(
                MediaType::json()->schema(ParticipationSchema::ref())
            )
            ->description('Successful response');
    }
}
