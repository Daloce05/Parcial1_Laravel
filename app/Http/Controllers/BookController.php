<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Muestra todos los libros con su categoría.
     */
    public function index()
    {
        // Incluye la categoría relacionada (JOIN automático)
        return Book::with('category')->get();
    }
        /**
     * Muestra solo los libros activos con su categoría.
     */
    public function activeBooks()
{
    $books = Book::query()
        ->where('book_status', true)
        ->with(['category' => function ($query) {
            $query->select('id_category', 'category_name');
        }])
        ->get(['id_book', 'book_name', 'book_author_name', 'book_price', 'book_status', 'category_id']);

    return response()->json($books);
}
public function booksByCategory($id)
    {
        // Busca los libros donde el campo category_id sea igual al id recibido
        $books = Book::where('category_id', $id)
            ->with('category:id_category,category_name')
            ->get(['id_book', 'book_name', 'book_author_name', 'book_price', 'book_status', 'category_id']);

        // Si no hay libros en esa categoría, devolvemos un mensaje
        if ($books->isEmpty()) {
            return response()->json(['message' => 'No hay libros en esta categoría'], 404);
        }

        return response()->json($books);
    }


    /**
     * Crea un nuevo libro.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_name' => 'required|string|max:255',
            'book_author_name' => 'required|string|max:255',
            'book_price' => 'required|numeric|min:0',
            'book_stock' => 'required|integer|min:0',
            'book_status' => 'required|boolean',
            'category_id' => 'nullable|exists:categories,id_category',
            'barcode' => 'required|string|max:255',
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    /**
     * Muestra un libro específico.
     */
    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        return response()->json($book);
    }

    /**
     * Actualiza un libro existente.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'book_name' => 'string|max:255',
            'book_author_name' => 'string|max:255',
            'book_price' => 'numeric|min:0',
            'book_stock' => 'integer|min:0',
            'book_status' => 'boolean',
            'category_id' => 'nullable|exists:categories,id_category',
            'barcode' => 'string|max:255',
        ]);

        $book->update($validated);
        return response()->json($book);
    }

    /**
     * Elimina un libro.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->noContent();
    }
}
