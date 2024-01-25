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
     *             @OA\Property(property="post_author", type="integer"),
     *             @OA\Property(property="post_content", type="string"),
     *             @OA\Property(property="post_title", type="string"),
     *             @OA\Property(property="post_excerpt", type="string"),
     *             @OA\Property(property="post_status", type="string"),
     *             @OA\Property(property="post_type", type="string"),
     *             @OA\Property(property="post_mime_type", type="string"),
     *             @OA\Property(property="post_guid", type="string"),
     *             @OA\Property(property="post_img", type="string"),
     *             @OA\Property(property="job_salary", type="string"),
     *             @OA\Property(property="job_place", type="string"),
     *             @OA\Property(property="post_tags", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Post created successfully"),
     * )
     */


    public function makePost(Request $request)
    {
        $request->validate([
            'post_author' => 'integer',
            'post_content' => 'string',
            'post_title' => 'string',
            'post_excerpt' => 'string',
            'post_status' => 'string',
            'post_type' => 'string',
            'post_mime_type' => 'string',
            'post_guid' => 'string',
            'post_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'job_salary' => 'string',
            'job_place' => 'string',
            'post_tags' => 'string'
        ]);

        $postImgPath = null;
        if($request->hasFile('post_img')){
            $postImg = $request->file('post_img');
            $postImgPath = $postImg->store('featured_img', 'custom');
        }

        // Extract relevant data from the request
        $postData = [
            'post_author' => $request->input('post_author'),
            'post_content' => $request->input('post_content'),
            'post_title' => $request->input('post_title'),
            'post_excerpt' => $request->input('post_excerpt'),
            'post_status' => $request->input('post_status'),
            'post_type' => $request->input('post_type'),
            'post_mime_type' => $request->input('post_mime_type'),
            'post_guid' => $request->input('post_guid'),
            'post_img' => $postImgPath,
            'job_salary' => $request->input('job_salary'),
            'job_place' => $request->input('job_place'),
            'post_tags' => $request->input('post_tags'),
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
