<?php
class Reviews extends CoreModel
{
    public function countReviews($where = "")
    {
        return $this->getRows("SELECT * FROM reviews a" . $where);
    }
    public function getOneReview($condition)
    {
        return $this->getOne($condition);
    }
    public function updateReviews($data, $condition)
    {
        return $this->update('reviews', $data, $condition);
    }
    public function getAllReviews($select)
    {
        return $this->getAll($select);
    }
    public function insertReviews($data)
    {
        return $this->insert('reviews', $data);
    }
    public function deleteReviews($condition)
    {
        return $this->delete('reviews', $condition);
    }
}