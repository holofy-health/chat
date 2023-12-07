<?php

namespace Musonza\Chat\OpenApi\Schemas\Chat\Message;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class MessageSchema extends SchemaFactory implements Reusable
{

    /**
     * @inheritDoc
     */
    public function build(): SchemaContract
    {
        return Schema::object('Message')
            ->properties(
                Schema::integer('id'),
                Schema::integer('participation_id'),
                Schema::object('sender'),
                Schema::string('body'),
                Schema::string('type'),
                Schema::array('data'),
            );
    }
}