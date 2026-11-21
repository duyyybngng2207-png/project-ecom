<?php 
class Users extends CoreModel{
    public function __construct()
    {
        parent::__construct();
    }
    public function getAllUsers(){
        return $this->getAll("SELECT * FROM users");
    }

    public function insertUsers($data){
        return $this->insert('users',$data);
    }

    public function getCheckUserWishlist($product_id){
        return $this->getOne("SELECT * FROM users_wishlist WHERE product_id = $product_id");
    }

    public function getUserId($product_id){
        return $this->getOne("SELECT * FROM users WHERE id = $product_id");
    }

    public function insertUsersWishlist($data)
    {
        return $this->insert('users_wishlist', $data);
    }

    public function removeUsersWishlist($product_ids, $user_id)
    {
        return $this->delete('users_wishlist', "product_id IN ($product_ids) AND user_id = $user_id");
    }

    public function getCountUserWishlist($user_id)
    {
        $result = $this->getOne("SELECT count(product_id) as total FROM users_wishlist WHERE user_id = $user_id");
        return !empty($result['total']) ? $result['total'] : 0;
    }

    public function getListWishlist($user_id)
    {
        $sql = "SELECT products . * , users_wishlist.user_id FROM users_wishlist
                INNER JOIN products 
                ON users_wishlist.product_id = products.id
                WHERE products.is_status = 1
                AND users_wishlist.user_id = $user_id";
        return $this->getRows("$sql");
    }
}