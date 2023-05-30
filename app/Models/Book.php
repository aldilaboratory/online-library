<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'isbn';
    public $incrementing = false;
    protected $fillable = ['isbn', 'title', 'author_id', 'image_path', 'publisher', 'category', 'pages', 'language', 'publish_date', 'subjects', 'desc'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
