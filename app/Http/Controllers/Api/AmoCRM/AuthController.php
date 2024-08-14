<?php

namespace App\Http\Controllers\Api\AmoCRM;

use AmoCRM\Core\Facades\Amo;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmoCRM\Oauth\CallbackRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function callback(CallbackRequest $request): JsonResponse
    {
        $domain = $request->validated("referer");
        $code = $request->validated("code");
        logger()->notice("$domain was triggered");

        $token = Amo::domain($domain)->authenticator()->exchangeCodeWithAccessToken($code);

        Amo::domain($domain)->tokenizer()->saveAccessToken($token);

        logger()->info("$domain was authenticated successfully");

        return response()->json(['success' => true]);
    }
}