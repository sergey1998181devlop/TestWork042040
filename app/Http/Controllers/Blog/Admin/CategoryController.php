<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Repositories\BlogCategoryRepository;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;
    public function __construct(BlogCategoryRepository $blogCategoryRepository){
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index' , compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit' , compact('item' , 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }
        //Создаю обьект , наполняю , но не добавляю в бд
        $item = new BlogCategory($data);
        $item->save();
        if($item){
            return redirect()->route('blog.admin.categories.edit' , [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id )
    {
//        $item = BlogCategory::findOrFail($id);
//        $categoryList = BlogCategory::all();
        //если вернется 404 внутри  - можно долго будет искать ошибку
        //поэтому репозиторий мы просто просим , а контроллер уже решает что с этим делать
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit' , compact('item' , 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        $rules = [
//            'title'     =>  'required|min:5|max:200',
//            'slug'     =>  'max:200',
//            'description'     =>  'string|min:3|max:500',
//            'parent_id'     =>  'required|integer|min:5|exists:blog_categories,id',
//        ];
//        $validatedData = $request->validate($rules);

        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();//вернуть старые инпуты для пользователя , если он ошибся  - чтбы не писать с нуля
        }
        $data  = $request->all();
        if(empty($data['slug'])){
            $data['slug'] = str_slug($data['title']);
        }

        $result = $item->update($data);
        if($result){
            return redirect()
                ->route('blog.admin.categories.edit' , $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['msg' => "Ошибка сохранения"])
                ->withInput();
        }
    }
}
