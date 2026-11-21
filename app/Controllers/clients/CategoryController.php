<?php
class CategoryController extends BaseController
{
    private $postModel;
    private $categoriesModel;

    public function __construct()
    {
        $this->postModel = new Posts();
        $this->categoriesModel = new Categories();
    }

    public function detail()
    {
        $filter = filterData();
        $category = $this->categoriesModel->getOneCategory("id = " . $filter['id']);

        if (empty($category)) {
            redirect('/');
            return;
        }

        $postsByCategory = $this->postModel->getAllPosts("SELECT * FROM posts WHERE category_id = " . $filter['id']);
        $getAllPosts = $this->postModel->getAllPosts("SELECT * FROM posts WHERE category_id = " . $filter['id']);
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories ");


        $data = [
            'postsByCategory' => $postsByCategory,
            'getAllPosts' => $getAllPosts,
            'category' => $category,
            'getCategory' => $getCategory
        ];
        $this->renderView('layouts/category-detail', $data);
    }

    public function viewMore()
    {
        $filter = filterData();
        $page        = $filter['page'] ?? 1;
        $category_id = $filter['category_id'] ?? null;
        $limit       = 4;
        $offset      = ($page - 1) * $limit;

        $totalPosts  = $this->postModel->countPostsByCategory($category_id);
        $totalPages  = ceil($totalPosts / $limit);
        $getAllPosts = $this->postModel->getPostsByCategory($category_id, $limit, $offset);
        $category = $this->categoriesModel->getOneCategory("id = " . $category_id);


        $data = [
            'category'    => $category,
            'getAllPosts' => $getAllPosts,
            'totalPosts'  => $totalPosts,
            'totalPages'  => $totalPages,
            'currentPage' => $page,
            'hasMore'     => $page < $totalPages
        ];
        $html = $this->renderView('layouts/view-more', $data);
        echo $html;
        exit;
    }

    
}
