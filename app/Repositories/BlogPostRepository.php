<?php
namespace App\Repositories;
use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogPostRepository extends CoreRepository{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function getAllWithPaginate(){
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'user_id',
            'category_id',
            'published_at'
        ];
        $result = $this->startConditions()
                    ->select($columns)
                    ->orderBy('id' , 'DESC')
                    ->with([
                        'category:id,title',
                        'user:id,name'
                    ])
                    ->paginate(10);
        return $result;
    }

    /**
     * Получить модель категорий для редактирования в админке
     * @param $id
     * @return \App\Models\BlogCategory
     */
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }
}
