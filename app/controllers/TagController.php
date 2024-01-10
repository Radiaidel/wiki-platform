<?php
class TagController extends Controller
{
    private $tagModel;


    public function __construct()
    {
        $this->tagModel = $this->model('Tags');

    }
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
        header('Location: ' . URLROOT . '/CategoryController/getCategorie_sTags');
        exit();
    }

    public function UD_Tag() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id_category = $_POST['categoryId'];
            $id_tag = $_POST['tagId'];
            $name_tag = $_POST['tagName'];

            if (isset($_POST['updatetagbtn'])) {
                $success= $this->tagModel->updateTag($id_tag,$id_category,$name_tag);
                if ($success) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Tag updated successfully.'];

                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];

                }
            } elseif (isset($_POST['deletetagbtn'])) {
                $success=$this->tagModel->deleteTag($id_tag);
                if ($success) {
                    $_SESSION['message'] = ['type' => 'success', 'text' => 'Tag deleted successfully.'];

                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Operation failed. Please try again.'];

                }
            }
        }
        header('Location: ' . URLROOT . '/CategoryController/getCategorie_sTags');
        exit();
    }
}
?>