<?php

namespace Musonza\Chat\OpenApi\Parameters\Message;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ListMessageParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [
            Parameter::query()
                ->name('participant_id')
                ->description('Participant ID')
                ->required(),
            Parameter::query()
                ->name('participant_type')
                ->description('Participant type')
                ->required(),
            Parameter::query()
                ->name('page')
                ->description('Page number'),
            Parameter::query()
                ->name('per_page')
                ->description('Number of items per page'),
            Parameter::query()
                ->name('columns')
                ->description('Columns to return'),
            Parameter::query()
                ->name('pageName')
                ->description('Page name'),
        ];
    }
}
