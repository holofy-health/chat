<?php

namespace Musonza\Chat\OpenApi\RequestBodies\Chat\Message;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Musonza\Chat\OpenApi\Schemas\Chat\Conversation\StoreConversationSchema;
use Musonza\Chat\OpenApi\Schemas\Chat\Message\DeleteAllMessageSchema;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class DeleteAllMessageRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create()
            ->content(
                MediaType::json()->schema(DeleteAllMessageSchema::ref())
            );
    }
}
