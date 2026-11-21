<?php
class Comments extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCommentsByPost($post_id)
    {
        return $this->getAll("SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY created_at DESC");
    }

    public function insertComment($data)
    {
        return $this->insert('comments', $data);
    }
    public function countComments($where = "")
    {
        return $this->getRows("SELECT * FROM comments a" . $where);
    }
    public function getOneComment($condition)
    {
        return $this->getOne($condition);
    }
    public function updateComments($data, $condition)
    {
        return $this->update('comments', $data, $condition);
    }
    public function getAllComments($select)
    {
        return $this->getAll($select);
    }
    public function insertComments($data)
    {
        return $this->insert('comments', $data);
    }
    public function deleteComments($condition)
    {
        return $this->delete('comments', $condition);
    }
}