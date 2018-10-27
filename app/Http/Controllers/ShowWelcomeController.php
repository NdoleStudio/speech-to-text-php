<?php

namespace App\Http\Controllers;

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
     * @var Request
     */
    private $request;

    /**
     * @param Factory $viewFactory
     * @param Request $request
     */
    public function __construct(Factory $viewFactory, Request $request)
    {
        $this->viewFactory = $viewFactory;
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $view = $this->viewFactory->make('welcome');

        return new Response($view->render());
    }
}
