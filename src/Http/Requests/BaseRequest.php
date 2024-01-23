<?php

namespace Musonza\Chat\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function getParticipant()
    {
        return app(User::class)->find($this->participant_id);
    }
}
