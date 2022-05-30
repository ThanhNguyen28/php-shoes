<?php

class TrademarkModel extends Model
{

   const TABLE = 'trademark';

   public function getAll()
   {
      return $this->show(self::TABLE, "ORDER BY id DESC");
   }

   public function add($data)
   {
      return $this->insertByID(self::TABLE, $data);
   }

   public function edit($data, $id)
   {
      return $this->update(self::TABLE, $data, $id);
   }

   public function deletes($id)
   {
      return $this->delete(self::TABLE, "id", $id);
   }

   public function search($key)
   {
      return $this->showSearch(self::TABLE, $key);
   }
}