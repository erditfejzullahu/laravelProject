<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\postServiceInterface;

class postsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     operationId="getAllPosts",
     *     tags={"Posts"},
     *     summary="Get posts",
     *     @OA\Response(response="200", description="Successful operation"),
     * )
     */

    private $posts;

    public function __construct(postServiceInterface $posts)
    {
        $this->posts = $posts;
    }

    public function getAllPosts()
    {
        $getPosts = $this->posts->getPosts();

        if($getPosts->isEmpty()){
            $response = response()->json(['message' => 'No posts found'], 404);
            return $response;
        }

        $response = response()->json(['posts' => $getPosts, 'message' => 'Resource retrieved successfully'], 200);
        return $response;
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     operationId="makePost",
     *     tags={"Posts"},
     *     summary="Create a new post",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="post_title", type="string"),
     *             @OA\Property(property="post_content", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Post created successfully"),
     * )
     */


    public function makePost(Request $request)
    {
        $request->validate([
            'post_title' => 'string',
            'post_content' => 'string',
        ]);

        // Extract relevant data from the request
        $postData = [
            'title' => $request->input('post_title'),
            'content' => $request->input('post_content'),
        ];

        $createdPost = $this->posts->postPost($postData);

        if ($createdPost) {
            // Return a success response
            return response()->json(['message' => 'Post created successfully', 'data' => $createdPost], 201);
        } else {
            // Return an error response
            return response()->json(['message' => 'Failed to create post'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
