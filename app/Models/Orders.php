<?php
class Orders extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllOrders($select)
    {
        return $this->getAll($select);
    }

    public function getOneOrder($sql)
    {
        return $this->getOne($sql);
    }

    public function countOrders($where = '')
    {
        return $this->getRows("SELECT * FROM users_orders a" . $where);
    }

    public function updateOrder($data, $condition)
    {
        return $this->update('users_orders', $data, $condition);
    }
    public function deleteOrder($condition)
    {
        return $this->delete('users_orders', $condition);
    }
    public function getOrderWithDetails($order_id)
    {
        return $this->getAll(
            "SELECT o.*, p.name, p.discount_price 
            FROM orders o 
            JOIN products p ON p.id = o.product_id 
            WHERE o.users_order_id = $order_id"
        );
    }

    public function getOrderById($id)
    {
        return $this->getOne("SELECT * FROM users_orders WHERE id = $id");
    }
}