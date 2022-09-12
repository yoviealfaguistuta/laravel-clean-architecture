<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Interfaces\SettingRepositoryInterface;

class SettingController extends Controller
{
    private SettingRepositoryInterface $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository) 
    {
        $this->settingRepository = $settingRepository;
    }

    /**
    *    @OA\Patch(
    *       path="/settings",
    *       tags={"Setting"},
    *       operationId="settings",
    *       summary="Update Setting",
    *       description="Merubah Pengaturan Metode Uang Lembur.",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="key",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="value",
    *                     type="string"
    *                 ),
    *                 example={"key": "overtime_method", "value": 1}
    *             )
    *         )
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "body": 1
    *           }
    *       )
    *   )
    *)
    */

    public function index(SettingRequest $request)
    {
        $request->validated();
        
        return response()->json([
            'body' => $this->settingRepository->updateSetting($request->all())
        ]);
    }
}
