<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'author', 'published_at', 'isbn', 'category_id',
        'description', 'cover', 'pdf_file',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}