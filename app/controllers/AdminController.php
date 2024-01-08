<?php
class AdminController extends Controller
{
    private $categoryModel;
    private $tagModel;

    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
        $this->tagModel = $this->model('Tags');

    }
    public function AddNewCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryName = htmlspecialchars(trim($_POST['categoryName']));

            if (isset($_FILES['categorypicture']) && $_FILES['categorypicture']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = "upload/";
                $targetPath = $targetDirectory . basename($_FILES['categorypicture']['name']);

                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                if (move_uploaded_file($_FILES['categorypicture']['tmp_name'], $targetPath)) {
                    $categoryPicture = "upload/" . $_FILES['categorypicture']['name'];
                } else {
                    echo 'Sorry, there was a problem uploading your file.';
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Sorry, there was a problem uploading your file.'];
                    header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
                }
            } else {
                // Gestion des erreurs d'upload
                $_SESSION['message'] = ['type' => 'error', 'text' => 'No file uploaded.'];
                header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
            }

            $added = $this->categoryModel->addCategory($categoryName, $categoryPicture);

            if ($added) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'New category added successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];
            }
        } else {
            header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
            exit();
        }
        header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');

    }

    public function UpdateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryId = $_POST['categoryId'];
            $categoryName = htmlspecialchars(trim($_POST['categoryName']));

            if (isset($_FILES['Inputcategorypicture']) && $_FILES['Inputcategorypicture']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = "upload/";
                $targetPath = $targetDirectory . basename($_FILES['Inputcategorypicture']['name']);

                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                if (move_uploaded_file($_FILES['Inputcategorypicture']['tmp_name'], $targetPath)) {
                    $categoryPicture = "upload/" . $_FILES['Inputcategorypicture']['name'];
                } else {
                    echo 'Sorry, there was a problem uploading your file.';
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Sorry, there was a problem uploading your file.'];
                    header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
                }
            } else {
                // Gestion des erreurs d'upload
                $_SESSION['message'] = ['type' => 'error', 'text' => 'No file uploaded.'];
                header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
            }

            $categoryModel = $this->model('Category');
            $success = $categoryModel->updateCategory($categoryId, $categoryName, $categoryPicture);

            if ($success) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Category Updated successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];

            }
        } else {
            header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
            exit();
        }
        header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');

    }

    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryId = $_POST['categoryId'];

            $deleted = $this->categoryModel->deleteCategoryById($categoryId);

            if ($deleted) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Category deleted successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to delete category. Please try again.'];
            }


        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to delete category. Please try again.'];
        }
        header('Location: ' . URLROOT . '/CategoryController/GetAllCategories');
        exit();
    }

    public function getCategoriesAndTags()
    {
        $categories = $this->categoryModel->getAllCategories();

        $data = [];

        foreach ($categories as $category) {
            $categoryName = $category->category_name;
            $tags = $this->tagModel->getTagsByCategory($category->category_id);

            $data['categories'][$categoryName] = [
                'category_id' => $category->category_id,
                'tags' => $tags,
            ];
        }
        $this->view('pages/tags', ['Tagcategories' => $data]);

    }

    // AdminController.php

    public function addNewTag()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['categoryId'], $_POST['tagName'])) {
                $categoryId = $_POST['categoryId'];
                $tagName = htmlspecialchars(trim($_POST['tagName']));

                $success = $this->tagModel->addNewTag($categoryId, $tagName);

                if ($success) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'New tag added successfully.'];

                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];

                }
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];
            }
        }
        header('Location: ' . URLROOT . '/AdminController/getCategoriesAndTags');
        exit();
    }


}
?>