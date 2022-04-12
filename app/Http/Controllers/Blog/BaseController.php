<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    //контроллер который унаследуется от базового - на случай если нашему *модулю блог * и всем методам потребуются
    //к примеру определенные свойства или методы в будущем
}
