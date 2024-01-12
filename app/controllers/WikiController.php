<?php
class WikiController extends Controller
{
    private $wikiModel;
    private $CategoryModel;

    private $tagModel;
    private $userModel;


    public function __construct()
    {
        $this->wikiModel = $this->model('Wiki');
        $this->CategoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tags');
        $this->userModel = $this->model('User');
        
    }


    public function index()
    {
        $wikis = $this->wikiModel->getAllWikis();

        $categories = $this->CategoryModel->getAllCategories();

        $categoryTags = [];
        foreach ($categories as $category) {
            $tags = $this->tagModel->getTagsByCategory($category->category_id);
            $categoryTags[$category->category_id] = $tags;
        }

        $data = [
            'categories' => $categories,
            'categoryTags' => $categoryTags,
            'wikis' => $wikis,
        ];
        $this->view('Pages/index', $data);

        if (isset($_GET['url']) && $_GET['url'] === 'WikiController/index/addForm') {

            echo '<script >
            document.getElementById("AddWiki").classList.remove("hidden");
            document.getElementById("closeModalBtnwiki").addEventListener("click", function() {
                document.getElementById("AddWiki").classList.add("hidden");
            });
          </script>';
        }
    }
    

    public function Mywikis()
    {
        $wikis = $this->wikiModel->getMyWikis();

        $categories = $this->CategoryModel->getAllCategories();

        $categoryTags = [];
        foreach ($categories as $category) {
            $tags = $this->tagModel->getTagsByCategory($category->category_id);
            $categoryTags[$category->category_id] = $tags;
        }

        $data = [
            'categories' => $categories,
            'categoryTags' => $categoryTags,
            'wikis' => $wikis,
        ];
        $this->view('Pages/MyWikis', $data);
    }
    public function singleWiki($wikiId)
    {
        $wikiDetails = $this->wikiModel->getWikiById($wikiId);

        if ($wikiDetails) {
            $data = [
                'wiki' => $wikiDetails,
            ];

            $this->view('pages/single_wiki', $data);
        } else {
            echo "Wiki not found!";
        }
    }
    public function AddNewWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imageWiki = "default.jpg";

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = "upload/";
                $targetPath = $targetDirectory . basename($_FILES['image']['name']);

                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imageWiki = "upload/" . $_FILES['image']['name'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Sorry, there was a problem uploading the image.'];
                }
            }

            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $categoryId = intval($_POST['categoryId']);

            $wikiId = $this->wikiModel->addWiki($imageWiki, $title, $content, $categoryId);

            if ($wikiId) {

                $selectedTags = isset($_POST['selectedTags']) ? json_decode($_POST['selectedTags'], true) : [];

                foreach ($selectedTags as $tagId) {

                    $this->wikiModel->addWikiTags($wikiId, $tagId);
                }

                $_SESSION['message'] = ['type' => 'success', 'text' => 'Wiki added successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to add wiki. Please try again.'];
            }
        }
        header('Location: ' . URLROOT . '/WikiController/Mywikis');
        exit();
    }

    public function editWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $wikiId = intval($_POST['wikiId']);
            $editTitle = filter_var($_POST['editTitle'], FILTER_SANITIZE_STRING);
            $editContent = filter_var($_POST['editContent'], FILTER_SANITIZE_STRING);
            $editCategoryId = intval($_POST['editCategoryId']);
            $imageWiki = null;



            if (isset($_FILES['editImage']) && $_FILES['editImage']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = "upload/";
                $targetPath = $targetDirectory . basename($_FILES['editImage']['name']);

                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                if (move_uploaded_file($_FILES['editImage']['tmp_name'], $targetPath)) {
                    $imageWiki = "upload/" . $_FILES['editImage']['name'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Sorry, there was a problem uploading the image.'];
                }
            }
            $wikiUpdated = $this->wikiModel->updateWiki($wikiId, $editTitle, $editContent, $editCategoryId, $imageWiki);

            if ($wikiUpdated) {

                $selectedTags = isset($_POST['editSelectedTags']) ? json_decode($_POST['editSelectedTags'], true) : [];

                if ($selectedTags != NULL) {
                    $this->wikiModel->DeleteWikiTags($wikiId);

                    foreach ($selectedTags as $tagId) {
                        $this->wikiModel->addWikiTags($wikiId, $tagId);
                    }
                }

                $_SESSION['message'] = ['type' => 'success', 'text' => 'Wiki Updated successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to add wiki. Please try again.'];
            }
        }
        header('Location: ' . URLROOT . '/WikiController/Mywikis');
        exit();
    }
    public function DeleteWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wikiId = $_POST['wikiId'];

            $result = $this->wikiModel->deleteWiki($wikiId);

            if ($result) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Wiki deleted successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to delete wiki. Please try again.'];
            }

        }
        header('Location: ' . URLROOT . '/WikiController/Mywikis');
        exit();
    }
    public function archiveWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $wikiId = $_POST['wikiId'];

            $archived = $this->wikiModel->archiveWikiById($wikiId);
            if ($archived) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Wiki  archived successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to archive wiki. Please try again.'];
            }
        }
        header("Location: " . URLROOT . "/WikiController/index");
        exit();
    }
    public function search() {
        // Check if it's an AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchTerm'])) {
            $searchTerm = $_POST['searchTerm'];
    
            $searchResults = $this->searchWikiTagCategory($searchTerm);
    
            echo json_encode($searchResults);
            exit;
        }

    }

    public function searchWikiTagCategory($searchTerm) {
        $searchResults = [];
    
        // Search by Wiki
        $wikiResults = $this->wikiModel->searchWiki($searchTerm);
        $searchResults['wikis'] = $wikiResults;
    
        // Search by Tag
        $tagResults = $this->wikiModel->searchTag($searchTerm);
        $searchResults['tags'] = $tagResults;
    
        // Search by Category
        $categoryResults = $this->wikiModel->searchCategory($searchTerm);
        $searchResults['categories'] = $categoryResults;
    
        return $searchResults;
    }
}
