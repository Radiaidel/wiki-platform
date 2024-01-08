<?php
  class Pages extends Controller{
    public function __construct(){
     
    }

    // Load Homepage
    public function index(){

      $this->view('pages/index');
    }
    
    public function AuthRegister(){
      $this->view('Auth/register');
    }
    public function AuthLogin(){
      $this->view('Auth/login');
    }
    public function dashboard(){
        $this->view('pages/Dashboard');
    }
    public function categorie(){
      $this->view('pages/category');
  }
  public function tag(){
    $this->view('pages/tags');
}
  }