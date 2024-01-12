<?php
class Pages extends Controller
{
  public function __construct()
  {

  }

  // Load Homepage
  public function index()
  {

    $this->view('pages/index');
  }

  public function AuthRegister()
  {
    $this->view('Auth/register');
  }
  public function AuthLogin()
  {
    $this->view('Auth/login');
  }

  public function PageCategories()
  {
    $CategoryModel = $this->model('Category');
    $categories = $CategoryModel->getAllCategories();

    $this->view('pages/DisplayCategories', ['categories' => $categories]);
  }

  public function dashboard()
  {
    $this->view('pages/Dashboard');
  }
  public function categorie()
  {
    $this->view('pages/category');
  }
  public function tag()
  {
    $this->view('pages/tags');
  }



  // public function getCategorie_sTags()
// {
//     $categories = $this->CategoryModel->getAllCategories();

  //     $data = [];

  //     foreach ($categories as $category) {
//         $categoryName = $category->category_name;

  //         $tagModel = $this->model('Tags');

  //         $tags = $tagModel->getTagsByCategory($category->category_id);

  //         $data['categories'][$categoryName] = [
//             'category_id' => $category->category_id,
//             'tags' => $tags,
//         ];
//     }
//     $this->view('pages/tags', ['Tagcategories' => $data]);

  // }
}