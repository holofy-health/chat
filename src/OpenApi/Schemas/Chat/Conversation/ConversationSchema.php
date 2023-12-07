<?php

namespace Musonza\Chat\OpenApi\Schemas\Chat\Conversation;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class ConversationSchema extends SchemaFactory implements Reusable
{

    /**
     * @inheritDoc
     */
    public function build(): SchemaContract
    {
        return Schema::object('Conversation')
            ->properties(
                Schema::integer('id'),
                Schema::array('data'),
                Schema::boolean('direct_message'),
                Schema::boolean('private'),
            );
    }
}