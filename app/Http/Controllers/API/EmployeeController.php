<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository) 
    {
        $this->employeeRepository = $employeeRepository;
    }
    
    /**
    *    @OA\Post(
    *       path="/employees",
    *       tags={"Employee"},
    *       operationId="employees",
    *       summary="Adding Employee",
    *       description="Menambah Pegawai",
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="name",
    *                     type="string"
    *                 ),
    *                 @OA\Property(
    *                     property="salary",
    *                     type="integer"
    *                 ),
    *                 example={"name": "Yovie Alfaguistuta", "salary": 6000000}
    *             )
    *         )
    *     ),
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "body": {
    *                    "name": "Yovie Alfaguistuta",
    *                    "salary": "6000000",
    *                    "id": 1,
    *                }
    *           }
    *       )
    *   )
    *)
    */
    public function index(EmployeeRequest $request)
    {
        $request->validated();

        return response()->json([
            'body' => $this->employeeRepository->createEmployee($request->all())
        ]);
    }
}
