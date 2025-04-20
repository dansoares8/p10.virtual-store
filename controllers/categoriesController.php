<?php
class categoriesController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        /*
        $dados = array();

        $products = new Products();
        $categories = new Categories();

        $currentPage = 1;
        $offset = 0;
        $limit = 3;

        if(!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $dados['list'] = $products->getList($offset, 3);
        $dados['totalItems'] = $products->getTotal();
        $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
        $dados['currentPage'] = $currentPage;

        $dados['categories'] = $categories->getList();

        $this->loadTemplate('home', $dados);
        */
    }


    public function enter($id){
        $dados = array();

        $this->loadTemplate('categories', $dados);
    }

}