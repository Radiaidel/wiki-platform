<?php
class AdminController extends Controller
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = $this->model('Category');
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
                    header('Location: ' . URLROOT . '/pages/categorie');
                }
            } else {
                // Gestion des erreurs d'upload
                $_SESSION['message'] = ['type' => 'error', 'text' => 'No file uploaded.'];
                header('Location: ' . URLROOT . '/pages/categorie');
            }

            $added = $this->categoryModel->addCategory($categoryName, $categoryPicture);

            if ($added) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'New category added successfully.'];
                header('Location: ' . URLROOT . '/pages/categorie');
                exit();
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];
            }
        } else {
            header('Location: ' . URLROOT . '/pages/categorie');
            exit();
        }
    }
}
?>