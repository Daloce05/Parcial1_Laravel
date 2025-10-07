<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos algunas categorías si no existen
        if (Category::count() === 0) {
            Category::factory(5)->create();
        }

        // Traemos todas las categorías creadas
        $categories = Category::all();

        // Creamos 20 libros y les asignamos una categoría aleatoria
        Book::factory(20)->create()->each(function ($book) use ($categories) {
            $book->update([
                'category_id' => $categories->random()->id_category,
            ]);
        });
    }
}
