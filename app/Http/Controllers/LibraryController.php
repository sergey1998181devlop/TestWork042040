<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Repositories\LibraryRepository;
use App\Rules\CheckFilter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LibraryController extends BaseController
{
    private $libraryRepository;

    public function __construct(LibraryRepository $libraryRepository){
        $this->libraryRepository = $libraryRepository;
    }
    public function getAllAuthors(){
        $AllAuthors = $this->libraryRepository->getAllAuthors();
        return $AllAuthors;
    }
    public function getAuthorById($id){
        return $this->libraryRepository->getAuthorById($id);
    }
    public function getAllAuthorsWithPaginate(Request $request){
        $params = $request->all();
        $page = $params['page'] ? $params['page'] : null;
        $params = $request->validate([
            'rating' => 'numeric|min:0|not_in:0|max:5',
            'name' => 'string|max:20',
            'last_name' => 'string|max:30',
        ]);
        $paginator = $this->libraryRepository->getAllAuthorsWithPaginate($params , $page);
        return $paginator;
    }
}
