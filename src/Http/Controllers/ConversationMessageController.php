<?php

namespace Musonza\Chat\Http\Controllers;

use Chat;
use Musonza\Chat\Http\Requests\ClearConversation;
use Musonza\Chat\Http\Requests\DeleteMessage;
use Musonza\Chat\Http\Requests\GetParticipantMessages;
use Musonza\Chat\Http\Requests\StoreMessage;
use Musonza\Chat\OpenApi\Parameters\Message\DeleteAllMessageParameters;
use Musonza\Chat\OpenApi\Parameters\Message\DeleteMessageParameters;
use Musonza\Chat\OpenApi\Parameters\Message\ListMessageParameters;
use Musonza\Chat\OpenApi\RequestBodies\Chat\Message\DeleteAllMessageRequestBody;
use Musonza\Chat\OpenApi\RequestBodies\Chat\Message\StoreMessageRequestBody;
use Musonza\Chat\OpenApi\Responses\Chat\Message\MessageResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ConversationMessageController extends Controller
{
    protected $messageTransformer;

    public function __construct()
    {
        $this->setUp();
    }

    private function setUp()
    {
        if ($messageTransformer = config('musonza_chat.transformers.message')) {
            $this->messageTransformer = app($messageTransformer);
        }
    }

    private function itemResponse($message)
    {
        if ($this->messageTransformer) {
            return fractal($message, $this->messageTransformer)->respond();
        }

        return response($message);
    }

    /**
     * Get all messages for a conversation
     *
     * @param  GetParticipantMessages  $request
     * @param $conversationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Messages'])]
    #[OpenApi\Parameters(factory: ListMessageParameters::class)]
    #[OpenApi\Response(factory: MessageResponse::class)]
    public function index(GetParticipantMessages $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        $message = Chat::conversation($conversation)
            ->setParticipant($request->getParticipant())
            ->setPaginationParams($request->getPaginationParams())
            ->getMessages();

        if ($this->messageTransformer) {
            return fractal($message, $this->messageTransformer)->respond();
        }

        return response($message);
    }

    /**
     * Show a message
     *
     * @param  GetParticipantMessages  $request
     * @param $conversationId
     * @param $messageId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Messages'])]
    #[OpenApi\Parameters(factory: ListMessageParameters::class)]
    #[OpenApi\Response(factory: MessageResponse::class)]
    public function show(GetParticipantMessages $request, $conversationId, $messageId)
    {
        $message = Chat::messages()->getById($messageId);

        return $this->itemResponse($message);
    }

    /**
     * Store a message
     *
     * @param  StoreMessage  $request
     * @param $conversationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Messages'])]
    #[OpenApi\RequestBody(factory: StoreMessageRequestBody::class)]
    #[OpenApi\Response(factory: MessageResponse::class)]
    public function store(StoreMessage $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        $message = Chat::message($request->getMessageBody())
            ->from($request->getParticipant())
            ->to($conversation)
            ->send();

        return $this->itemResponse($message);
    }

    /**
     * Delete all messages in a conversation
     *
     * @param  ClearConversation  $request
     * @param $conversationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Messages'])]
    #[OpenApi\Parameters(factory: DeleteAllMessageParameters::class)]
    #[OpenApi\RequestBody(factory: DeleteAllMessageRequestBody::class)]
    public function deleteAll(ClearConversation $request, $conversationId)
    {
        $conversation = Chat::conversations()->getById($conversationId);
        Chat::conversation($conversation)
            ->setParticipant($request->getParticipant())
            ->clear();

        return response('');
    }

    /**
     * Delete a message
     *
     * @param  DeleteMessage  $request
     * @param $conversationId
     * @param $messageId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OpenApi\Operation(tags: ['Messages'])]
    #[OpenApi\Parameters(factory: DeleteMessageParameters::class)]
    public function destroy(DeleteMessage $request, $conversationId, $messageId)
    {
        $message = Chat::messages()->getById($messageId);
        Chat::message($message)
            ->setParticipant($request->getParticipant())
            ->delete();

        return response('');
    }
}
