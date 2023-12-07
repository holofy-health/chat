<?php

namespace Musonza\Chat\OpenApi\RequestBodies\Chat\Conversation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\UpdateConversationSchema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class UpdateConversationRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(UpdateConversationSchema::ref()));
    }
}
