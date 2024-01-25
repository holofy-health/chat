<?php

namespace Musonza\Chat\OpenApi\Schemas\Chat\Participation;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;

class ParticipationSchema extends SchemaFactory implements Reusable
{

    /**
     * @inheritDoc
     */
    public function build(): SchemaContract
    {
        return Schema::object('Participation')
            ->properties(
                Schema::integer('id'),
                Schema::integer('conversation_id'),
                Schema::array('settings'),
            );
    }
}