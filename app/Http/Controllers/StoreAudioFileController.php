<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAudioFileRequest;
use App\Jobs\PrepareAudioFileForTranscription;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;

class StoreAudioFileController extends ApiBaseController
{
    /**
     * @var Factory
     */
    private $viewFactory;

    /**
     * @var StoreAudioFileRequest
     */
    private $request;

    /**
     * @var Dispatcher
     */
    private $commandDispatcher;

    /**
     * @param Factory               $viewFactory
     * @param StoreAudioFileRequest $request
     * @param Dispatcher            $commandDispatcher
     */
    public function __construct(Factory $viewFactory, StoreAudioFileRequest $request, Dispatcher $commandDispatcher)
    {
        $this->viewFactory = $viewFactory;
        $this->request = $request;
        $this->commandDispatcher = $commandDispatcher;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        $fileName = $this->request->file('file')->store('');

        $this->commandDispatcher->dispatch(new PrepareAudioFileForTranscription($fileName));

        return $this->generateOkResponse([
            'success' => true,
            'filename' => $fileName,
        ]);
    }
}
