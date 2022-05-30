<?php

class OrderModel extends Model
{

    const TABLE = 'orders';
    /* insert order trả về id */
    public function addByID($data)
    {
        return $this->insertByID(self::TABLE, $data);
    }
    /* Lấy tổng giá của 1 đơn hàng */
    public function getId($id)
    {
        $sql = "SELECT total_money FROM " . self::TABLE . " WHERE id = ?";
        return $this->queryFetch($sql, $id);
    }
    /* Lấy tất cả order */
    public function getAll()
    {
        $sql = "SELECT o.id, o.total_money, o.date,o.status,c.name FROM " . self::TABLE . " AS o,customer AS c WHERE o.customer_id = c.id ORDER BY id DESC";
        return $this->queryFetchAll($sql, null);
    }
    /* update status (trạng thái) order */
    public function edit($data, $id)
    {
        return $this->update(self::TABLE, $data, $id);
    }
    /* Lấy order theo status (trạng thái) */
    public function getByStatus($status)
    {
        $sql = "SELECT o.id, o.total_money, o.date,o.status,c.name FROM " . self::TABLE . " AS o,customer AS c WHERE o.customer_id = c.id AND o.status= ?";
        return $this->queryFetchAll($sql, $status);
    }
    /* Lấy order theo date (Ngày) */
    public function getByDate($date)
    {
        $sql = "SELECT o.id, o.total_money, o.date,o.status,c.name FROM " . self::TABLE . " AS o,customer AS c WHERE o.customer_id = c.id AND o.date ='" . $date . "'";
        return $this->queryFetchAll($sql, null);
    }
    /* Lấy order theo date begin -> date end  */
    public function getStatistics($begin, $end)
    {
        $sql = "SELECT SUM(total_money) AS total FROM " . self::TABLE . " WHERE date >= '" . $begin . "' AND date <= '" . $end . "'";
        return $this->queryFetchAll($sql, null);
    }
    /* xem order theo date begin -> date end  */
    public function getAllStatistics($begin, $end)
    {
        $sql = "SELECT o.id, o.total_money, o.date,o.status,c.name FROM " . self::TABLE . " AS o,customer AS c WHERE o.customer_id = c.id AND o.status=2 AND date >= '" . $begin . "' AND date <= '" . $end . "' ORDER BY id DESC";
        return $this->queryFetchAll($sql, null);
    }
}