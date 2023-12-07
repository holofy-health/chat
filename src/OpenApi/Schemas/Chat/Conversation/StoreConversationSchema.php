<?php

namespace Musonza\Chat\OpenApi\Schemas\Chat\Conversation;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class StoreConversationSchema extends SchemaFactory implements Reusable
{

    /**
     * @inheritDoc
     */
    public function build(): SchemaContract
    {
        return Schema::object('Conversation')
            ->properties(
                Schema::array('participants')->items(
                    Schema::object()->properties(
                        Schema::string('id'),
                        Schema::string('type'),
                    )
                ),
                Schema::array('data'),
            );
    }
}