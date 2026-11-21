<?php
class HomeController extends BaseController
{
    private $postModel;
    private $categoriesModel;
    private $productModel;
    public function __construct()
    {
        $this->postModel = new Posts();
        $this->categoriesModel = new Categories();
        $this->productModel = new Product();
    }
    public function index()
    {
        $filter      = filterData('get');
        $category_id = $filter['category_id'] ?? null;
        $getAllPosts = $this->postModel->getAllPosts("SELECT * FROM posts");
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories");
        $getAllProducts = $this->productModel->getAllProducts("SELECT * FROM products");
        $listProducts = $this->productModel->getAllProducts(
            "SELECT * FROM products" . (!empty($category_id) ? " WHERE category_id = $category_id" : ""). " LIMIT 6"
        );
        

        // dd($getAllProducts);

        $getAllPostsPopularNews = $this->postModel->getPostsNews(1, 4);

        $data = [
            'getAllPosts' => $getAllPosts,
            'getCategory' => $getCategory,
            'getAllProducts'=> $getAllProducts,
            'getAllPostsPopularNews' => $getAllPostsPopularNews,
            'listProducts' => $listProducts,
        ];
        $data['main_content'] = $this->renderViewHtml('layouts/home/index', $data);
        $this->renderViewLayout($data);
    }

    public function ajaxGetProductsByCategory()
    {
        $filter      = filterData('get');
        $category_id = $filter['category_id'] ?? null;
        $slug = $filter['slug'] ?? null;

        if (!empty($category_id)) {
            $listProducts = $this->productModel->getAllProducts(
                "SELECT * FROM products WHERE category_id = $category_id LIMIT 6"
            );
        } else {
            $listProducts = $this->productModel->getAllProducts(
                "SELECT * FROM products LIMIT 6"
            );
        }

        $html = $this->renderViewHtml('layouts/product/cat-dropdown', ['listProducts' => $listProducts, 'slug' => $slug]);

        echo json_encode([
            'status' => 'success',
            'html'   => $html
        ]);
        die();
    }

    // public function filterByCategory()
    // {
    //     $category_id = $_POST['category_id'] ?? null;

    //     $getAllPosts = $this->postModel->getAllPosts("SELECT * FROM posts WHERE category_id = $category_id LIMIT 6");

    //     $data = [
    //         'getAllPosts' => $getAllPosts,
    //         ];

    //     $html = $this->renderView('layouts/filter-by-category', $data);
    //     echo $html;
    //     exit();
    // }

    // public function viewMorePosts()
    // {
    //     $filter = filterData();
        
    //     $page        = (int)$filter['page'] ?? 1;
    //     $limit       = 2;

    //     $getAllPostsPopularNews = $this->postModel->getPostsNews($page, $limit);

    //     $data = [
    //         'getAllPostsPopularNews' => $getAllPostsPopularNews,
    //     ];

    //     $html = $this->renderView('layouts/view-more-posts', $data);
    //     echo $html;
    //     exit;
    // }   
}
