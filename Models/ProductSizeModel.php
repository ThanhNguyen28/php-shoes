<?php

class ProductSizeModel extends Model
{

    const TABLE = 'product_size';

    public function addByID($data)
    {
        return $this->insertByID(self::TABLE, $data);
    }

    public function getAll()
    {
        return $this->show(self::TABLE, "ORDER BY id DESC");
    }

    public function getByIdProduct($id)
    {
        $sql = "SELECT size FROM " . self::TABLE . " WHERE  product_id = ?";
        return $this->queryFetchAll($sql, $id);
    }

    public function del($id)
    {
        return $this->delete(self::TABLE, 'product_id', $id);
    }
}