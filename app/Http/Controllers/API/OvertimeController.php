<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\OvertimePaysRequest;
use App\Http\Requests\OvertimeRequest;
use App\Interfaces\OvertimeRepositoryInterface;

class OvertimeController extends Controller
{
    private OvertimeRepositoryInterface $overtimeRepository;

    public function __construct(OvertimeRepositoryInterface $overtimeRepository) 
    {
        $this->overtimeRepository = $overtimeRepository;
    }

    /**
    *    @OA\Post(
    *       path="/overtimes",
    *       tags={"Overtime"},
    *       operationId="overtimes",
    *       summary="Adding Overtime",
    *       description="Membuat data waktu lembur",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="employee_id",
    *                     type="integer"
    *                 ),
    *                 @OA\Property(
    *                     property="date",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="time_started",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="time_ended",
    *                     type="string"
    *                 ),
    *                 example={"employee_id": 1, "date": "2022-01-02", "time_started": "12:00", "time_ended": "14:00"}
    *             )
    *         )
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "body": {
    *                    "id": 1,
    *                    "employee_id": 1,
    *                    "date": "2022-01-05",
    *                    "time_started": "12:00",
    *                    "time_ended": "14:00",
    *                }
    *           }
    *       )
    *    )
    * )
    */
    public function overtime(OvertimeRequest $request)
    {
        $request->validated();

        return response()->json([
            'body' => $this->overtimeRepository->createOvertime($request->all())
        ]);
    }

    /**
    *    @OA\Get(
    *       path="/overtimes-pays/calculate",
    *       tags={"Overtime"},
    *       operationId="overtimes-pays",
    *       summary="Detail List Overtime by Employee",
    *       description="Melihat biaya lembur pegawai",
    *        @OA\Parameter(
    *            name="month",
    *            in="query",
    *            required=false,
    *            description= "Ex: 2022-01, Format: YYYY-MM",
    *            @OA\Schema(type="string")
    *        ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "body": {
    *                    "id": 1,
    *                    "name": "Yovie Alfaguistuta",
    *                    "salary": 6000000,
    *                    "overtime_duration_total": 2,
    *                    "amount": 104046.24277456649,
    *                    "overtime": {
    *                           {
    *                                "id": 1,
    *                                "employee_id": 1,
    *                                "date": "2022-01-01",
    *                                "time_started": "17:00",
    *                                "time_ended": "19:00",
    *                                "overtime_duration": 2
    *                           },
    *                           {
    *                                "id": 2,
    *                                "employee_id": 1,
    *                                "date": "2022-01-02",
    *                                "time_started": "17:00",
    *                                "time_ended": "19:00",
    *                                "overtime_duration": 2
    *                           },
    *                    },
    *                }
    *           }
    *       )
    *   )
    *)
    */
    public function overtime_pays(OvertimePaysRequest $request)
    {
        $request->validated();
        
        return response()->json([
            'body' => $this->overtimeRepository->calculateOvertimePays($request->all())
        ]);
    }
}
