<?php

namespace Musonza\Chat\OpenApi\Parameters\Participation;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class DestroyParticipationParameters extends ParametersFactory
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
                ->name('participationId')
                ->description('Participation ID')
                ->required(),
        ];
    }
}
