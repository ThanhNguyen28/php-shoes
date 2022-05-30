<?php

class SizeModel extends Model
{

    const TABLE = 'size';

    public function getAll()
    {
        return $this->show(self::TABLE, "ORDER BY id DESC");
    }

    public function add($data)
    {
        return $this->insertByID(self::TABLE, $data);
    }

    public function getAllSize()
    {
        $sql = "SELECT * FROM " . self::TABLE;
        return $this->queryFetchAll($sql, null);
    }

    public function deletes($id)
    {
        return $this->delete(self::TABLE, "id", $id);
    }

    public function search($keywords)
    {
        return $this->showSearch(self::TABLE, $keywords);
    }
}