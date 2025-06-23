<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Resources\BlogCategoryCollection;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Str;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    public function index()
    {
        $data = $this->blogCategoryRepository->getAll();
        return new BlogCategoryCollection($data);
    }

    public function delete(string $id)
    {
        return BlogCategory::destroy($id);
    }

    public function create()
    {
        return $this->blogCategoryRepository->getForComboBox();
    }

    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        return (new BlogCategory())->create($data);
    }

    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);
        }

        $data = $request->all();

        $result = $item->update($data);

        return $result;
    }
}
