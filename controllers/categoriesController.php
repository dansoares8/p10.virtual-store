<?php
class categoriesController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header("Location: ".BASE_URL);
    }


    public function enter($id){
        $dados = array();

        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        $dados['category_name'] = $categories->getCategoryName($id);

        if(!empty($dados['category_name'])){

            $currentPage = 1;
            $offset = 0;
            $limit = 3;

            if(!empty($_GET['p'])){
                $currentPage = $_GET['p'];
            }
            $offset = ($currentPage * $limit) - $limit;

/*  Logo abaixo estou adicionando código que o Gemini me deu, para corrigir o erro, e corrigiu o erro, mas não sei se outros erros podem vir a aparecer, 
*   Fica aqui esse comentário, para registro.
*/

            // Pega filtros da URL, se existirem (igual no homeController)
            $filters_selected = array(); 
            if (!empty($_GET['filter']) && is_array($_GET['filter'])) {
            $filters_selected = $_GET['filter'];
            }
            // Garante que o filtro de categoria atual esteja sempre ativo
            $filters_selected['category'] = $id; 

            $dados['category_filter'] = $categories->getCategoryTree($id);   

            // Passa os filtros selecionados para getList e getTotal
            $dados['list'] = $products->getList($offset, $limit, $filters_selected); 
            $dados['totalItems'] = $products->getTotal($filters_selected);

            $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
            $dados['currentPage'] = $currentPage;

            $dados['id_category'] = $id; 

            $dados['categories'] = $categories->getList();

            // Carrega os filtros disponíveis com base nos filtros selecionados
            $dados['filters'] = $f->getFilters($filters_selected); // <-- Adicione esta linha
            $dados['filters_selected'] = $filters_selected; // <-- Adicione esta linha

            $this->loadTemplate('categories', $dados); // Passa os dados atualizados

            } else {
            header("Location: ".BASE_URL);
        }
    }

}



            /*
            // Isso eu adicionei durante as aulas, há um erro não consegui resolver.

            $filters = array('category'=>$id);

            $dados['category_filter'] = $categories->getCategoryTree($id);   
            
            $dados['list'] = $products->getList($offset, $limit, $filters);

            $dados['totalItems'] = $products->getTotal($filters);
            $dados['numberOfPages'] = ceil($dados['totalItems'] / $limit);
            $dados['currentPage'] = $currentPage;

            $dados['id_category'] = $id;

            $dados['categories'] = $categories->getList();

            $this->loadTemplate('categories', $dados);

        } else {
            header("Location: ".BASE_URL);
        }
    }

}*/

