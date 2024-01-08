<?php
class WikiController extends Controller
{
    private $wikiModel;

    public function __construct()
    {
        $this->wikiModel = $this->model('Wiki');
    }

    public function index()
    {
        $wikis = $this->wikiModel->getAllWikis();

        $data = [
            'wikis' => $wikis,
        ];

        $this->view('pages/index', $data);
    }
}
