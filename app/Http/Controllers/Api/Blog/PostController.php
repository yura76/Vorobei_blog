<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostCollection;
use App\Http\Resources\BlogPostResource;
use App\Http\Resources\BlogPostShowResource;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $blogPostRepository;

    public function __construct()
    {
        $this->blogPostRepository = app(BlogPostRepository::class);
    }

    public function index(Request $request)
    {
        $perPage = 10;
        $posts = BlogPost::with(['user', 'category'])->paginate($perPage);

        return new BlogPostCollection($posts);
    }

    public function show($id)
    {
        $item = $this->blogPostRepository->getById($id);
        if (empty($item)) {
            abort(404);
        }
        return new BlogPostShowResource($item);
    }
}
