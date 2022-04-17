<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
//use Rinvex\Category;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;


    public function __construct(
        CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('s');
        $productCategories = $this->categoryService->fetchTreeByName(CategoryService::BASE_CAT_PRODUCTS);
        $flatProductCategories = $this->categoryService->fetchTreeByName(CategoryService::BASE_CAT_PRODUCTS, true);
        //dd($productCategories); 
        $categories = $this->categoryService->formatJqTree($productCategories->toArray());
        $bootstrapCategories = $this->categoryService->formatForBootStrap($productCategories->toArray());

        //dd($categories);

        return view('category.list', compact('categories', 'bootstrapCategories', 'productCategories', 'flatProductCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @todo validation
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId)
    {
        $data=$request->all();
        $category =  $this->categoryService->fetchById($categoryId);
        
        //dd($category);
        $this->categoryService->update($category, $data);
        session()->flash('message-success', "Category {$category->name} has been updated");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}

