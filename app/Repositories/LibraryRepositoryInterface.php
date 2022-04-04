<?php


namespace App\Repositories;


interface LibraryRepositoryInterface
{
    public function getAllAuthors();
    public function getAuthorById(int $idAuthor);
    public function getAllAuthorsWithPaginate(array $params , int $perPage);
}
