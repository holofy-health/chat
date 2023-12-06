<?php

namespace Musonza\Chat\Http\Controllers;

use Chat;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Musonza\Chat\Exceptions\DeletingConversationWithParticipantsException;
use Musonza\Chat\Http\Requests\DestroyConversation;
use Musonza\Chat\Http\Requests\StoreConversation;
use Musonza\Chat\Http\Requests\UpdateConversation;
use Musonza\Chat\Models\Conversation;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class ConversationController extends Controller
{
    protected $conversationTransformer;

    public function __construct()
    {
        $this->setUp();
    }

    private function setUp()
    {
        if ($conversationTransformer = config('musonza_chat.transformers.conversation')) {
            $this->conversationTransformer = app($conversationTransformer);
        }
    }

    private function itemResponse($conversation)
    {
        if ($this->conversationTransformer) {
            return fractal($conversation, $this->conversationTransformer)->respond();
        }

        return response($conversation);
    }

    /**
     * List Conversations
     *
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|Response
     */
    #[OpenApi\Operation(tags: ['Conversations'])]
    public function index()
    {
        $conversations = Chat::conversations()->conversation->all();

        if ($this->conversationTransformer) {
            return fractal()
                ->collection($conversations)
                ->transformWith($this->conversationTransformer)
                ->respond();
        }

        return response($conversations);
    }

    /**
     * Store Conversation
     *
     * @param  StoreConversation  $request
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|Response
     */
    #[OpenApi\Operation(tags: ['Conversations'])]
    public function store(StoreConversation $request)
    {
        $participants = $request->participants();
        $conversation = Chat::createConversation($participants, $request->input('data', []));

        return $this->itemResponse($conversation);
    }

    /**
     * Show Conversation
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|Response
     */
    #[OpenApi\Operation(tags: ['Conversations'])]

    public function show($id)
    {
        $conversation = Chat::conversations()->getById($id);

        return $this->itemResponse($conversation);
    }

    /**
     * @param UpdateConversation $request
     * @param $id
     *
     * @return ResponseFactory|Response
     */
    #[OpenApi\Operation(tags: ['Conversations'])]
    public function update(UpdateConversation $request, $id)
    {
        /** @var Conversation $conversation */
        $conversation = Chat::conversations()->getById($id);
        $conversation->update(['data' => $request->validated()['data']]);

        return $this->itemResponse($conversation);
    }

    /**
     * @param DestroyConversation $request
     * @param $id
     *
     * @throws Exception
     *
     * @return ResponseFactory|Response
     */
    #[OpenApi\Operation(tags: ['Conversations'])]
    public function destroy(DestroyConversation $request, $id): Response
    {
        /** @var Conversation $conversation */
        $conversation = Chat::conversations()->getById($id);

        try {
            $conversation->delete();
        } catch (Exception $e) {
            if ($e instanceof DeletingConversationWithParticipantsException) {
                abort(HttpResponse::HTTP_FORBIDDEN, $e->getMessage());
            }

            throw $e;
        }

        return response($conversation);
    }
}
