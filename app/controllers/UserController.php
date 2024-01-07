<?php
class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlspecialchars(trim($_POST['name']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $profilePicture = "default.jpg";
            if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
                $targetDirectory = "upload/";
                $targetPath = $targetDirectory . basename($_FILES['profilePicture']['name']);

                if (!file_exists($targetDirectory)) {
                    mkdir($targetDirectory, 0755, true);
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetPath)) {
                    $profilePicture = "upload/" . $_FILES['profilePicture']['name'];
                } else {
                    $_SESSION['message'] = ['type' => 'error', 'text' => 'Sorry, there was a problem uploading your file.'];
                    return;
                }
            }
            $userModel = $this->model('User');

            if ($userModel->findByEmail($email)) {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Email is already registered.'];
                return;
            }

            $newuser = $userModel->registerUser($name, $email, $hashedPassword, $profilePicture);
            if ($newuser) {
                $_SESSION['message'] = ['type' => 'success', 'text' => 'Registration successful.'];
                header('Location: ' . URLROOT . '/Auth/login');
                exit();
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Registration failed. Please try again.'];
            }
        } else {
            $this->view('Auth/register');
        }
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['user_name'] = $user->username;
                $_SESSION['user_role'] = $user->role;
                $_SESSION['userprofile'] = $user->profile_picture;

                $_SESSION['message'] = ['type' => 'success', 'text' => 'Login successful.'];
                if ($_SESSION['user_role'] == "admin") {
                    header('Location: ' . URLROOT . '/Pages/dashboard');

                } elseif ($_SESSION['user_role'] == "auteur") {

                    header('Location: ' . URLROOT . '/Pages/index');
                }
                exit();
            } else {
                $_SESSION['message'] = ['type' => 'error', 'text' => 'Invalid email or password'];
                $this->view('Auth/login');
            }
        } else {
            $this->view('Auth/login');
        }
    }

}
?>