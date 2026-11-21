<?php
class Posts extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAllPosts($select)
    {
        return $this->getAll($select);
    }
    public function getOnePost($condition)
    {
        return $this->getOne("SELECT * FROM posts WHERE $condition");
    }
    public function getRowPosts()
    {
        return $this->getRows("SELECT * FROM posts");
    }
    public function insertPosts($data)
    {
        return $this->insert('posts', $data);
    }
    public function updatePosts($data, $condition)
    {
        return $this->update('posts', $data, $condition);
    }
    public function deletePosts($condition)
    {
        return $this->delete('posts', $condition);
    }
    public function countPosts($where = "")
    {
        return $this->getRows("SELECT * FROM posts a" . $where);
    }
    public function countPostsByCategory($category_id)
    {
        return $this->getRows("SELECT * FROM posts a WHERE a.category_id = " . $category_id);
    }
    public function getPostsByCategory($category_id, $limit, $offset)
    {
        return $this->getAll("SELECT * FROM posts a WHERE a.category_id = " . $category_id . " LIMIT " . $limit . " OFFSET " . $offset);
    }
    public function getPostsNews($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        return $this->getAll("SELECT * FROM posts a LIMIT " . $limit . " OFFSET " . $offset);
    }
    
    public function searchByKeyword($keyword)
    {
        return $this->getAll("SELECT id , title, created_at FROM posts  WHERE title LIKE '%$keyword%' LIMIT 8");
    }
}
