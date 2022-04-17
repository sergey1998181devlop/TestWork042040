<?php
namespace App\Repositories;
use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository{
    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * Получить модель категорий для редактирования в админке
     * @param $id
     * @return Model
     */
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вывода в выпадающем списке
     * @return Collection
     */
    public function getForComboBox(){
        $columns = implode(', ', [
           'id',
           'CONCAT (id, ". ", title) AS id_title'
        ]);
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()//не нужно оборачивать в объекты блок категории  - получаем только данные
            ->get();

        return $result;
    }

    /**
     *
     */
    public function getAllWithPaginate($perPage = false){
        $fields = ['id', 'title', 'parent_id' ];
        $result = $this
            ->startConditions()
            ->select($fields)
            ->with([
                'parentCategory:id,title'
            ])
            ->paginate($perPage);
        return $result;
    }
}
