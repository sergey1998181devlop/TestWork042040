<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';

//    protected $fillable = ['name', 'description', 'release_date', 'count_page'];

    /**
     * @return BelongsToMany
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Authors::class)->as('authors_books_pivot')->withPivot('authors_id' , 'books_id');
    }
}
