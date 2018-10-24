<?php

namespace App\Http\Controllers;

use App\Weather\Services\IpInfoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\Factory;

class ShowWelcomeController extends Controller
{
    /**
     * @var Factory
     */
    private $viewFactory;

    /**
     * @var IpInfoService
     */
    private $ipInfoService;
    /**
     * @var Request
     */
    private $request;

    /**
     * @param Factory $viewFactory
     * @param IpInfoService $ipInfoService
     * @param Request $request
     */
    public function __construct(Factory $viewFactory, IpInfoService $ipInfoService, Request $request)
    {
        $this->viewFactory = $viewFactory;
        $this->ipInfoService = $ipInfoService;
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $host = $this->ipInfoService->getDefaultHostForRequest($this->request);

        $view = $this->viewFactory->make('welcome')->with('host', $host);

        return new Response($view->render());
    }
}
