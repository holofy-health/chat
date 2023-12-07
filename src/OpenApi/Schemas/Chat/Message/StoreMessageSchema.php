<?php

namespace Musonza\Chat\OpenApi\Schemas\Chat\Message;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class StoreMessageSchema extends SchemaFactory implements Reusable
{

    /**
     * @inheritDoc
     */
    public function build(): SchemaContract
    {
        return Schema::object('Message')
            ->properties(
                Schema::integer('participation_id'),
                Schema::string('participant_type'),
                Schema::array('message')->items(
                    Schema::string('body'),
                )
            );
    }
}