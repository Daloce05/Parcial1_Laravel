<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id_book';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'book_name',
        'book_author_name',
        'book_price',
        'book_stock',
        'book_status',
        'category_id',  // 👈 Nuevo campo
        'barcode',      // 👈 Nuevo campo

    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id_category');
    }
}
