<?php

class UserModel extends Model
{

    const TABLE = 'user';

    public function getAll()
    {
        return $this->show(self::TABLE, "ORDER BY id DESC");
    }

    public function userId($id)
    {
        $sql = " SELECT * FROM " . self::TABLE . " WHERE id = ?";
        return $this->queryFetch($sql, $id);
    }

    public function add($data)
    {
        return $this->insertByID(self::TABLE, $data);
    }

    public function edit($data, $id)
    {
        return $this->update(self::TABLE, $data, $id);
    }

    public function del($id)
    {
        return $this->delete(self::TABLE, "id", $id);
    }

    public function signin($data)
    {
        return $this->login(self::TABLE, $data);
    }

    public function search($key)
    {
        return $this->showSearch(self::TABLE, $key);
    }
}