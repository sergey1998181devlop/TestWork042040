<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Authors extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = ['id' , 'name', 'last_name', 'middle_name', 'date_birth', 'about_author', 'rating'];


    /**
     * @return BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Books::class)->as('authors_books_pivot')->withPivot('authors_id' , 'books_id');
    }
}
