<?php

namespace Musonza\Chat\OpenApi\Parameters\Message;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class DeleteAllMessageParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [
            Parameter::query()
                ->name('conversationId')
                ->description('Conversation ID')
                ->required(),
        ];
    }
}
