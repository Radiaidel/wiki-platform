<?php
class AuthorController extends Controller
{
   private  $wikiModel;
    public function __construct()
    {
        $this->wikiModel = $this->model('Wiki');
    }
    public function AddNewWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize input data
            $imageWiki = "default.jpg"; // Default image in case no file is uploaded

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = "upload/";
                $targetPath = $targetDirectory . basename($_FILES['image']['name']);

                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imageWiki = "upload/" . $_FILES['image']['name'];
                } else {
                    // Handle the case where the file upload fails
                    flash('error', 'Sorry, there was a problem uploading the image.');
                    redirect('some_error_page');
                }
            }

            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $categoryId = intval($_POST['categoryId']);

            // Add the new wiki to the database
            $result = $this->wikiModel->addWiki($imageWiki, $title, $content, $categoryId);

            // Handle success or failure, show messages, redirect, etc.
            if ($result) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Wiki added successfully.'];
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Failed to add wiki. Please try again.'];
            }
        } 
        $this->view('Pages/index');
    }
}
?>