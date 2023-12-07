<?php

namespace Musonza\Chat\OpenApi\Parameters\Message;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class DeleteMessageParameters extends ParametersFactory
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
            Parameter::query()
                ->name('messageId')
                ->description('Message ID')
                ->required(),
            Parameter::query()
                ->name('participant_id')
                ->description('Participant ID')
                ->required(),
            Parameter::query()
                ->name('participant_type')
                ->description('Participant type')
                ->required(),
        ];
    }
}
