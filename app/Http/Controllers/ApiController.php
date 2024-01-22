<?php

namespace App\Http\Controllers;
use App\Services\userServiceInterface;
use App\Repositories\UserRepository;



use Illuminate\Http\Request;

    /**
     * @OA\Info(
     * title="TEST API",
     * version="1.0.0",
     * description="TEST API",
     * )
     */


class ApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/resource",
     *     operationId="getResource",
     *     tags={"Resource"},
     *     summary="Get a resource",
     *     @OA\Response(response="200", description="Successful operation"),
     * )
     */
    private $UserRepository;

    public function __construct(userServiceInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function getResource()
    {

        $users = $this->UserRepository->getAllUsers();

    if ($users->isEmpty()) {

        // Handle the case when no users are found
        return response()->json(['message' => 'No users found'], 404);
    }

    // Continue processing the response with $users
    $response = response()->json(['data' => $users, 'message' => 'Resource retrieved successfully'], 200);
    return $response;

    }


    public function createResource(Request $request)
    {
        // Logic to create a resource
    }

    public function updateResource(Request $request, $id)
    {
        // Logic to update a resource
    }

    public function deleteResource($id)
    {
        // Logic to delete a resource
    }
}
