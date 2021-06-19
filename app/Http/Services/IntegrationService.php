<?php

namespace App\Http\Services;

use App\Models\Integration;
use Illuminate\Http\JsonResponse;

class IntegrationService
{
    /**
     * Entegrasyon ekleme servis
     *
     * @param $data
     * @return JsonResponse
     */
    public function store($data): JsonResponse
    {
      $integration = new Integration();

      $integration->marketplace = $data["marketplace"];
      $integration->username = $data["username"];
      $integration->password = $data["password"];

      //save integration to database
      if(auth()->user()->integrations()->save($integration)){
          return response()->json(['status' => true, 'integration' => $integration->toArray()], 201);
      }

      return response()->json(['status' => false, 'message' => 'Integration ekleme tamamlanamadı'], 400);
    }

    /**
     * Entegrasyon güncelleme servis
     *
     * @param $data
     * @param $id
     * @return JsonResponse
     */
    public function update($data, $id): JsonResponse
    {
        $integration = auth()->user()->integrations()->find($id);

        if(!$integration) {
            return response()->json(['status' => false, 'message' => 'Integration bulunamadı'], 400);
        }

        $updatedIntegration = $integration->fill($data)->save();

        if($updatedIntegration) {
            return response()->json(['status' => true], 204);
        }

        return response()->json(['status' => false, 'message' => 'Integration güncellenemedi'], 500);
    }

    /**
     * Entegrasyon silme servis
     *
     * @param $id
     * @return JsonResponse
     */
    public function remove($id): JsonResponse
    {
        $integration = auth()->user()->integrations()->find($id);

        if(!$integration) {
            return response()->json(['status' => false, 'message' => 'Integration bulunamadı'], 400);
        }

        if($integration->delete()) {
            return response()->json(['status' => true], 204);
        }

        return response()->json(['status' => false, 'message' => 'Integration silinemedi'], 500);
    }
}
