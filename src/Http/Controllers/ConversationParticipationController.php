<?php

namespace Musonza\Chat\Http\Controllers;

use Chat;
use Musonza\Chat\Http\Requests\StoreParticipation;
use Musonza\Chat\Http\Requests\UpdateParticipation;
use Musonza\Chat\Models\Conversation;
use Musonza\Chat\Models\Participation;
use Musonza\Chat\OpenApi\Parameters\Participation\DestroyParticipationParameters;
use Musonza\Chat\OpenApi\Parameters\Participation\ListParticipationParameters;
use Musonza\Chat\OpenApi\Parameters\Participation\ShowParticipationParameters;
use Musonza\Chat\OpenApi\RequestBodies\Chat\Participation\StoreParticipationRequestBody;
use Musonza\Chat\OpenApi\RequestBodies\Chat\Participation\UpdateParticipationRequestBody;
use Musonza\Chat\OpenApi\Responses\Chat\Participation\ParticipationResponse;
use Symfony\Component\HttpFoundation\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ConversationParticipationController extends Controller
{
    /**
     * Add participants to a conversation.
     *
     * @param  StoreParticipation  $request
     * @param $conversationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Participation'])]
    #[OpenApi\RequestBody(factory: StoreParticipationRequestBody::class)]
    public function store(StoreParticipation $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        Chat::conversation($conversation)->addParticipants($request->participants());

        return response($conversation->participants);
    }

    /**
     * Show all participants of a conversation.
     *
     * @param $conversationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Participation'])]
    #[OpenApi\Parameters(factory: ListParticipationParameters::class)]
    #[OpenApi\Response(factory: ParticipationResponse::class)]
    public function index($conversationId)
    {
        /** @var Conversation $conversation */
        $conversation = Chat::conversations()->getById($conversationId);

        return response($conversation->getParticipants());
    }

    /**
     * Show a single participant of a conversation.
     *
     * @param $conversationId
     * @param $participationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Participation'])]
    #[OpenApi\Parameters(factory: ShowParticipationParameters::class)]
    #[OpenApi\Response(factory: ParticipationResponse::class)]
    public function show($conversationId, $participationId)
    {
        $participation = Participation::find($participationId);

        return response($participation);
    }

    /**
     * @param  UpdateParticipation  $request
     * @param $conversationId
     * @param $participationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Participation'])]
    #[OpenApi\RequestBody(factory: UpdateParticipationRequestBody::class)]
    #[OpenApi\Response(factory: ParticipationResponse::class)]
    public function update(UpdateParticipation $request, $conversationId, $participationId)
    {
        $participation = Participation::find($participationId);

        if ($participation->conversation_id != $conversationId) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $participation->update($request->validated());

        return response($participation);
    }

    /**
     * Remove a participant from a conversation.
     *
     * @param $conversationId
     * @param $participationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Participation'])]
    #[OpenApi\Parameters(factory: DestroyParticipationParameters::class)]
    #[OpenApi\Response(factory: ParticipationResponse::class)]
    public function destroy($conversationId, $participationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        $participation = Participation::find($participationId);
        $conversation = Chat::conversation($conversation)->removeParticipants([$participation->messageable]);

        return response($conversation->participants);
    }
}
