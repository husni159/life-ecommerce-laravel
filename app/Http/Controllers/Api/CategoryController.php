<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Response;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    use HttpResponses;
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    try {
            $categories = $this->categoryService->getAll();
            return $this->success($categories, 'Categories retrieved successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->create($request->validated());
            return $this->success($category, 'Category created successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = $this->categoryService->getById($id);

            if (!$category) {
                return $this->error(null,'Category not found', 404);
            }

            return $this->success($category, 'Category retrieved successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $category = $this->categoryService->update($id, $request->validated());
            return $this->success($category, 'Category updated successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $this->categoryService->delete($id);
            return $this->success(null, 'Category deleted successfully', 201);
        }catch(Exception $e){
            return $this->error(
                null,
                $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
