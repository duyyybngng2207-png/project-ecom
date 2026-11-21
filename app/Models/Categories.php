<?php
class Categories extends CoreModel
{
    public function countCategories($where = "")
    {
        return $this->getRows("SELECT * FROM categories a" . $where);
    }
    public function getOneCategory($condition)
    {
        return $this->getOne("SELECT * FROM categories WHERE " . $condition);
    }
    public function updateCategories($data, $condition)
    {
        return $this->update('categories', $data, $condition);
    }
    public function getAllCategories($select)
    {
        return $this->getAll($select);
    }
    public function insertCategories($data)
    {
        return $this->insert('categories', $data);
    }
    public function deleteCategories($condition)
    {
        return $this->delete('categories', $condition);
    }
}
