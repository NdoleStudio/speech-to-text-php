<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use JsonSerializable;

class ApiBaseController extends Controller
{
    /**
     * @param array|JsonSerializable $payload
     *
     * @return JsonResponse
     */
    public function generateOkResponse($payload)
    {
        return new JsonResponse(
            [
                'code'    => Response::HTTP_OK,
                'payload' => $payload,
            ],
            Response::HTTP_OK
        );
    }
}
