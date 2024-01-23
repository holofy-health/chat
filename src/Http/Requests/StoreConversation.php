<?php

namespace Musonza\Chat\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreConversation extends FormRequest
{
    public function authorized()
    {
        return true;
    }

    public function rules()
    {
        return [
            'participants'        => 'array',
            'participants.*.id'   => 'required',
            'participants.*.type' => 'optional|string',
            'data'                => 'array',
        ];
    }

    public function participants()
    {
        $participantModels = [];
        $participants = $this->input('participants', []);
        foreach ($participants as $participant) {
            $participantModels[] = app(User::class)->find($participant['id']);
        }

        return $participantModels;
    }
}
