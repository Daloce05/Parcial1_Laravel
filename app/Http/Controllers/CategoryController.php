<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        // Muestra todas las categorías
        return Category::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        // Crea una categoría
        return Category::create($request->validated());
    }

    public function show(Category $category)
    {
        // Muestra una categoría específica
        return $category;
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Actualiza una categoría
        $category->update($request->validated());
        return $category;
    }

    public function destroy(Category $category)
    {
        // Elimina una categoría
        $category->delete();
        return response()->noContent();
    }

    // Método adicional del parcial: categorías activas con sus libros
    public function activeWithBooks()
    {
        return Category::where('status', true)
                       ->with('books')
                       ->get();
    }
}
