<?php
namespace App\Repositories;

use App\Models\Books as ModelBook;
use App\Models\Authors as ModelAuthors;
use Illuminate\Database\Eloquent\Collection;

class LibraryRepository implements LibraryRepositoryInterface{

    public function getAllAuthors(){
        $columns = ['id' , 'name', 'last_name', 'middle_name', 'date_birth', 'about_author', 'rating'];
        $result  = ModelAuthors::select($columns)->toBase()->get();
        return $result;
    }
    public function getAuthorById($idAuthor){
        $columns = ['id' ,'name', 'last_name', 'middle_name', 'date_birth', 'about_author', 'rating'];
        $result = ModelAuthors::where('id' , $idAuthor)
                                ->select($columns)
                                ->with('books')
                                ->get()
                                ->first();
        return $result;
    }
    public function getAllAuthorsWithPaginate($params , $page = null){
        $columns = ['id' , 'name', 'last_name', 'middle_name', 'date_birth', 'about_author', 'rating'];
        $result = ModelAuthors::select($columns)
            ->where($params)
            ->with('books')
            ->paginate($page);

        return $result;
    }
}
