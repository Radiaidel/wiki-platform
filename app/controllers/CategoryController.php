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
    public function New_wiki()
    {
        $categories = $this->CategoryModel->getAllCategories();

        // Fetch tags for each category
        $categoryTags = [];
        foreach ($categories as $category) {
            $tags =  $this->tagModel->getTagsByCategory($category->category_id);
            $categoryTags[$category->category_id] = $tags;
        }

        // Pass data to the view
        $data = [
            'categories' => $categories,
            'categoryTags' => $categoryTags,
        ];
        $this->view('Pages/index', $data);
        echo '<script >
        document.getElementById("AddWiki").classList.remove("hidden");
        document.getElementById("closeModalBtnwiki").addEventListener("click", function() {
            document.getElementById("AddWiki").classList.add("hidden");
        });
      </script>';
    }
}
?>