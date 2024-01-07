<?php
class CategoryController extends Controller
{
    private $CategoryModel;

    public function __construct()
    {
        $this->CategoryModel = $this->model('Category');
    }
}
?>