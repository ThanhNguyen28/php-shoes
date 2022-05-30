<?php

class ProductModel extends Model
{

   const TABLE = 'product';

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

   public function getProductNew()
   {
      $sql = "SELECT * FROM " . self::TABLE . " ORDER BY id DESC LIMIT 8";
      return $this->queryFetchAll($sql, null);
   }

   public function getProductDetail($id)
   {
      $sql = "SELECT * FROM " . self::TABLE . " WHERE id = ?";
      return $this->queryFetch($sql, $id);
   }

   public function getProductCategory($id)
   {
      $sql = "SELECT * FROM " . self::TABLE . " WHERE trademark_id = ? LIMIT 4";
      return $this->queryFetchAll($sql, $id);
   }

   public function getAllProductCategory($id)
   {
      $sql = "SELECT * FROM " . self::TABLE . " WHERE trademark_id = ?";
      return $this->queryFetchAll($sql, $id);
   }

   public function getPrice($i)
   {
      $sql = "";
      switch ($i) {
         case 1:
            $sql = "SELECT * FROM " . self::TABLE . " WHERE price < 1000000";
            break;
         case 2:
            $sql = "SELECT * FROM " . self::TABLE . " WHERE price > 1000000 AND price < 4000000";
            break;
         case 3:
            $sql = "SELECT * FROM " . self::TABLE . " WHERE price > 4000000 AND price < 8000000";
            break;
         case 4:
            $sql = "SELECT * FROM " . self::TABLE . " WHERE price > 8000000 AND price < 12000000";
            break;
         case 5:
            $sql = "SELECT * FROM " . self::TABLE . " WHERE price > 12000000";
            break;
         default:
            return;
      }
      return $this->queryFetchAll($sql, null);
   }

   public function search($key)
   {
      return $this->showSearch(self::TABLE, $key);
   }
}