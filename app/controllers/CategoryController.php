<?php
class CategoryController extends Controller
{
    private $CategoryModel;

    public function __construct()
    {
        $this->CategoryModel = $this->model('Category');
    }

    public function GetAllCategories() {
        $categoryModel = $this->model('Category');
        $categories = $categoryModel->getAllCategories();
    
        $this->view('pages/category', ['categories' => $categories]);
    }
}
?>