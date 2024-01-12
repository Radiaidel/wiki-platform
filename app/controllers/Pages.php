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
  public function getCategorie_sTags()
  {
    $CategoryModel = $this->model('Category');

    $categories = $CategoryModel->getAllCategories();

    $data = [];

    foreach ($categories as $category) {
      $categoryName = $category->category_name;

      $tagModel = $this->model('Tags');

      $tags = $tagModel->getTagsByCategory($category->category_id);

      $data['categories'][$categoryName] = [
        'category_id' => $category->category_id,
        'tags' => $tags,
      ];
    }
    $this->view('pages/tags', ['Tagcategories' => $data]);

  }

  public function dashboard() {
    $CategoryModel = $this->model('Category');
    $UserModel = $this->model('User');
    $wikiModel= $this->model('Wiki');
    $tagModel=$this->model('Tags');


    $chartData = ['labels' => [], 'values' => []];

    $result = $CategoryModel->CategoriesByCountWiki();
    foreach ($result as $row) {
        $chartData['labels'][] = $row->category_name;
        $chartData['values'][] = $row->count;
    }

    $lineChartData = ['labels' => [], 'values' => []];

    $result = $wikiModel->WikisByDate(); // Replace WikiModel with your actual model name
    foreach ($result as $row) {
        $lineChartData['labels'][] = $row->date;
        $lineChartData['values'][] = $row->count;
    }

    // Additional counts
    $categoryCount = $CategoryModel->getCategoryCount();
    $wikiCount = $wikiModel->getWikiCount(); // Replace with the actual method in your model
    $tagCount = $tagModel->getTagCount(); // Replace with the actual method in your model
    $userCount = $UserModel->getUserCount(); // Replace with the actual method in your model

    $data = [
        'lineChartData' => $lineChartData,
        'chartData' => $chartData,
        'categoryCount' => $categoryCount,
        'wikiCount' => $wikiCount,
        'tagCount' => $tagCount,
        'userCount' => $userCount,
    ];

    // Load the view (replace 'dashboard' with your actual view name)
    $this->view('pages/dashboard', $data);
}

  public function categorie()
  {
    $this->view('pages/category');
  }
  public function tag()
  {
    $this->view('pages/tags');
  }

}