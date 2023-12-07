<?php

namespace Musonza\Chat\OpenApi\RequestBodies\Chat\Participation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\StoreConversationSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Participation\StoreParticipationSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Participation\UpdateParticipationSchema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateParticipationRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(UpdateParticipationSchema::ref())
            );
    }
}
