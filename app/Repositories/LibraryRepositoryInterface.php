<?php


namespace App\Repositories;


interface LibraryRepositoryInterface
{
    public function getAuthorById(int $idAuthor);
    public function getAllAuthorsWithPaginate(int $perPage);
}
