<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;//все у которых deleted_at не заполенные ) удаленные не берем

    public function category()
    {
        //статья принадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }

    public function user()
    {
        //Статья пренадлежит пользователю
        return $this->belongsTo(User::class);
    }
}
