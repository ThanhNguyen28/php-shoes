<?php

class OrderDetailModel extends Model
{

    const TABLE = 'order_detail';

    public function addByID($data)
    {
        return $this->insertByID(self::TABLE, $data);
    }

    public function getAll()
    {
        return $this->show(self::TABLE);
    }

    public function getOrderId($id)
    {
        $sql = "SELECT od.id,od.price,od.quantity,od.date,od.note,od.status,p.name,p.picture FROM " . self::TABLE . " AS od , product AS p WHERE od.product_id=p.id AND od.order_id = ?";
        return $this->queryFetchAll($sql, $id);
    }
}