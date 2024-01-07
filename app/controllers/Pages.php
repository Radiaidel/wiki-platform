<?php
  class Pages extends Controller{
    public function __construct(){
     
    }

    // Load Homepage
    public function index(){
      //Set Data
      $data = [
        'title' => 'Welcome To SharePosts',
        'description' => 'Simple social network built on the TraversyMVC PHP framework'
      ];

      // Load homepage/index view
      $this->view('pages/index', $data);
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