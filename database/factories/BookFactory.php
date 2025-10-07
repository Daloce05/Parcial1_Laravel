<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Book;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        // Busca una categoría aleatoria (ya creada por el CategorySeeder)
        $category = Category::inRandomOrder()->first();

        return [
            'book_name' => $this->faker->sentence(3),
            'book_author_name' => $this->faker->name(),
            'book_price' => $this->faker->randomFloat(2, 10, 200),
            'book_stock' => $this->faker->numberBetween(1, 100),
            'book_status' => $this->faker->boolean(),
            'category_id' => $category ? $category->id_category : null, // 👈 asigna categoría
            'barcode' => $this->faker->bothify('??###??###'), // 👈 genera código aleatorio
        ];
    }
}
