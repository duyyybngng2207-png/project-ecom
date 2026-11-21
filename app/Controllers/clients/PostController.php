<?php
class PostController extends BaseController
{
    private $postModel;
    private $commentModel;
    private $categoriesModel;

    public function __construct()
    {
        $this->postModel = new Posts();
        $this->commentModel = new Comments();
        $this->categoriesModel = new Categories();
    }

    public function detail()
    {
        $filter = filterData();
        $post = $this->postModel->getOnePost("id = " . $filter['id']);

        if (empty($post)) {
            redirect('/');
            return;
        }

        $idPost = $post['id'];
        $this->postModel->updatePosts(['views' => $post['views'] + 1], "id=$idPost");

        $comments = $this->commentModel->getCommentsByPost($idPost);
        $getAllPosts = $this->postModel->getAllPosts("SELECT * FROM posts");
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories");
        $getAllComments = $this->commentModel->getAllComments("SELECT * FROM comments");

        $data = [
            'post'     => $post,
            'comments' => $comments,
            'getAllPosts' => $getAllPosts,
            'getCategory' => $getCategory,
            'getAllComments' => $getAllComments
        ];

        $this->renderView('layouts/post-detail', $data);
    }

    public function comment()
    {
        if (isPost()) {

            $filterPost = filterData();


            $errors = [];
            if (empty(trim($filterPost['name']))) {
                $errors['name']['required'] = 'Tên bắt buộc phải nhập';
            }

            if (empty(trim($filterPost['comment']))) {
                $errors['comment']['required'] = 'Comment bắt buộc phải nhập';
            }

            if (!empty($errors)) {

                // $_SESSION['errors'] = $errors;
                // $_SESSION['old'] = $filterPost;

                setSessionFlash('msg_type', 'danger');
                setSessionFlash('errors', $errors);

                redirect('/post-detail?id=' . $filterPost['post_id']);

                return;
            }

            if (empty($errors)) {
                $data = [
                    'post_id'    => $filterPost['post_id'],
                    'fullname'   => $filterPost['name'],
                    'content'    => $filterPost['comment'],
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->commentModel->insertComment($data);

                redirect('/post-detail?id=' . $filterPost['post_id']);
                return;
            }
        }
    }

    public function category()
    {
        $filter = filterData();
        $category = $this->categoriesModel->getOneCategory("id = " . $filter['id']);
        if (empty($category)) {
            redirect('/');
            return;
        }

        $category = $this->categoriesModel->getOneCategory("SELECT * FROM categories");
        $data = [
            'getCategory' => $category
        ];
        $this->renderView('layouts/category-detail', $data);
    }

    public function searchKeywords()
    {
        $keyword = trim($_GET['keyword'] ?? '');

        $listPosts = $this->postModel->searchByKeyword($keyword);
        $getAllPosts = $this->postModel->getAllPosts("SELECT * FROM posts");
        $getCategory = $this->categoriesModel->getAllCategories("SELECT * FROM categories");

        $data = [
            'listPosts' => $listPosts,
            'getAllPosts' => $getAllPosts,
            'getCategory' => $getCategory
        ];
        $html = $this->renderView('layouts/search-result', $data);
        echo $html;
        exit;
    }

    public function viewMorePosts()
    {
        $filter = filterData();
        
        $page        = (int)$filter['page'] ?? 1;
        $category_id = (int)$filter['category_id'] ?? null;
        $limit       = 2;
        $offset      = max(0,  ($page - 1)) * $limit;

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
        $html = $this->renderView('layouts/view-more-posts', $data);
        echo $html;
        exit;
    }
}
