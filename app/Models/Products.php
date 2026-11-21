<?php
class Product extends CoreModel
{
    public function countProducts($where = "")
    {
        return $this->getRows("SELECT * FROM products a" . $where);
    }
    public function getOneProduct($condition)
    {
        return $this->getOne($condition);
    }
    public function updateProducts($data, $condition)
    {
        return $this->update('products', $data, $condition);
    }
    public function getAllProducts($select)
    {
        return $this->getAll($select);
    }
    public function insertProducts($data)
    {
        return $this->insert('products', $data);
    }
    public function deleteProducts($condition)
    {
        return $this->delete('products', $condition);
    }
    public function buyProducts($condition)
    {
        return $this->buyProducts('products', $condition);
    }
    public function getProductsWishlist($user_id)
    {
        $sql = "SELECT products . * , users_wishlist.user_id FROM users_wishlist
                INNER JOIN products 
                ON users_wishlist.product_id = products.id
                WHERE products.is_status = 1
                AND users_wishlist.user_id = $user_id";
        return $this->getAll($sql);
    }

    public function getListProductsByIds($product_ids)
    {
        $sql = "SELECT * FROM products WHERE id IN ($product_ids)";
        return $this->getAll($sql);
    }
    
    public function getDetailProductById($product_id)
    {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        return $this->getOne($sql);
    }
}