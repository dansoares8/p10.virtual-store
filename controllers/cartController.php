<?php
class cartController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $store = new Store();
        $products = new Products();

        $dados = $store->getTemplateData();

        $this->loadTemplate('cart', $dados);
    }

    public function add() {

        if(!empty($_POST['id_product'])) {
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);

            echo "ID: ".$id;
            echo "QT: ".$qt;
        }
    }
















}

