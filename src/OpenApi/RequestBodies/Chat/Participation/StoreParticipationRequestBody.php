<?php

namespace Musonza\Chat\OpenApi\RequestBodies\Chat\Participation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\StoreConversationSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Participation\StoreParticipationSchema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreParticipationRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(StoreParticipationSchema::ref())
            );
    }
}
