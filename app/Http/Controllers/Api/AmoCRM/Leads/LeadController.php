<?php

namespace App\Http\Controllers\Api\AmoCRM\Leads;

use AmoCRM\Core\Facades\Amo;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMMissedTokenException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmoCRM\Api\GetLeadRequest;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    /**
     * Получить сделки из аккаунта амосрм по домену
     */
    public function __invoke(GetLeadRequest $request): JsonResponse
    {
        $data = $request->validated();
        $domain = $data['domain'];

        try {
            $leads = Amo::domain($domain)->api()->leads()->get()->toArray();

            return response()->json($leads);
        } catch (AmoCRMMissedTokenException|AmoCRMoAuthApiException|AmoCRMApiException $e) {
            logger()->error($e->getMessage(), $e->getTrace());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
