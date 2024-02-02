<?php
class Pages extends Controller
{
  public function __construct()
  {

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
  public function dashboard()
  {
    $CategoryModel = $this->model('Category');
    $UserModel = $this->model('User');
    $wikiModel = $this->model('Wiki');
    $tagModel = $this->model('Tags');


    $chartData = ['labels' => [], 'values' => []];

    $result = $CategoryModel->CategoriesByCountWiki();
    foreach ($result as $row) {
      $chartData['labels'][] = $row->category_name;
      $chartData['values'][] = $row->count;
    }

    $lineChartData = ['labels' => [], 'values' => []];

    $result = $wikiModel->WikisByDate(); 
    foreach ($result as $row) {
      $lineChartData['labels'][] = $row->date;
      $lineChartData['values'][] = $row->count;
    }

    $categoryCount = $CategoryModel->getCategoryCount();
    $wikiCount = $wikiModel->getWikiCount();
    $tagCount = $tagModel->getTagCount();
    $userCount = $UserModel->getUserCount();

    $data = [
      'lineChartData' => $lineChartData,
      'chartData' => $chartData,
      'categoryCount' => $categoryCount,
      'wikiCount' => $wikiCount,
      'tagCount' => $tagCount,
      'userCount' => $userCount,
    ];

    $this->view('pages/dashboard', $data);
  }
  public function index()
  {
    $CategoryModel = $this->model('Category');
    $wikiModel = $this->model('Wiki');
    $tagModel = $this->model('Tags');
    $wikis = $wikiModel->getAllWikis();

    $categories = $CategoryModel->getAllCategories();

    $categoryTags = [];
    foreach ($categories as $category) {
      $tags = $tagModel->getTagsByCategory($category->category_id);
      $categoryTags[$category->category_id] = $tags;
    }

    $data = [
      'categories' => $categories,
      'categoryTags' => $categoryTags,
      'wikis' => $wikis,
    ];
    $this->view('Pages/index', $data);

    if (isset($_GET['url']) && $_GET['url'] === 'Pages/index/addForm') {

      echo '<script >
        document.getElementById("AddWiki").classList.remove("hidden");
        document.getElementById("closeModalBtnwiki").addEventListener("click", function() {
            document.getElementById("AddWiki").classList.add("hidden");
        });
      </script>';
    }
  }

  public function singleWiki($wikiId)
  {
    $wikiModel = $this->model('Wiki');

    $wikiDetails = $wikiModel->getWikiById($wikiId);

    if ($wikiDetails) {
      $data = [
        'wiki' => $wikiDetails,
      ];

      $this->view('pages/single_wiki', $data);
    } else {
      echo "Wiki not found!";
    }
  }

  public function search()
  {
    $searchTerm = $_POST['searchTerm'];
    $context = $_POST['context'];
    $searchResults = [];


    $CategoryModel = $this->model('Category');
    $wikiModel = $this->model('Wiki');
    $tagModel = $this->model('Tags');
   
    switch ($context) {
      case 'categories':
        $searchResults = $CategoryModel->searchCategories($searchTerm);
        break;
      case 'tags':
        $searchResults = $tagModel->searchTags($searchTerm);
        break;
      default:
    
        $searchResults =$wikiModel->searchAllData($searchTerm);
      break;
    }

    echo json_encode($searchResults); 
  }


}