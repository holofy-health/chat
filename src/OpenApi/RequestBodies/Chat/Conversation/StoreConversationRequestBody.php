<?php

namespace Musonza\Chat\OpenApi\RequestBodies\Chat\Conversation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\StoreConversationSchema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreConversationRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(StoreConversationSchema::ref())
            );
    }
}
