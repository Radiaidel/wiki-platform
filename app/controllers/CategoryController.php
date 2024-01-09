<?php
class CategoryController extends Controller
{
    private $CategoryModel;
    private $tagModel;


    public function __construct()
    {
        $this->CategoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tags');

    }

    public function GetAllCategories()
    {
        $categories = $this->CategoryModel->getAllCategories();

        $this->view('pages/category', ['categories' => $categories]);
    }

}
?>