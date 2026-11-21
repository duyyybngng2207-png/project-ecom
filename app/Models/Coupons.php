<?php
class Coupons extends CoreModel
{
    public function getAllCoupons($select)
    {
        return $this->getAll($select);
    }

    public function getOneCoupon($sql)
    {
        return $this->getOne($sql);
    }

    public function countCoupons($where = '')
    {
        return $this->getRows("SELECT * FROM coupons a" . $where);
    }

    public function getCouponByCode($code)
    {
        return $this->getRows("SELECT * FROM coupons WHERE code = '$code'");
    }

    public function insertCoupon($data)
    {
        return $this->insert('coupons', $data);
    }

    public function updateCoupon($data, $condition)
    {
        return $this->update('coupons', $data, $condition);
    }

    public function deleteCoupon($condition)
    {
        return $this->delete('coupons', $condition);
    }
}