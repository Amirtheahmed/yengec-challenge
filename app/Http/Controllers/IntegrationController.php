<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntegrationRequestValidator;
use App\Http\Requests\IntegrationUpdateRequestValidator;
use App\Http\Services\IntegrationService;
use Illuminate\Http\JsonResponse;

class IntegrationController extends Controller
{
    /**
     * @param IntegrationRequestValidator $validator
     * @param IntegrationService $integrationService
     * @return JsonResponse
     */
    public function store(IntegrationRequestValidator $validator, IntegrationService $integrationService): JsonResponse
    {
        //validate coming request
        $validatedRequest = $validator->validated();

        return $integrationService->store($validatedRequest);
    }

    /**
     * @param IntegrationUpdateRequestValidator $validator
     * @param IntegrationService $integrationService
     * @param $id
     * @return JsonResponse
     */
    public function update(IntegrationUpdateRequestValidator $validator, IntegrationService $integrationService, $id): JsonResponse
    {
        //validate coming request
        $validatedRequest = $validator->validated();

        return $integrationService->update($validatedRequest, $id);
    }

    /**
     * @param IntegrationService $integrationService
     * @param $id
     * @return JsonResponse
     */
    public function destroy(IntegrationService $integrationService,$id): JsonResponse
    {
        return $integrationService->remove($id);
    }
}
