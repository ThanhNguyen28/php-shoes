<?php

class CustomerModel extends Model
{

    const TABLE = 'customer';

    public function addByID($data)
    {
        return $this->insertByID(self::TABLE, $data);
    }

    public function getAll()
    {
        return $this->show(self::TABLE);
    }

    public function getByIdCustomer($id)
    {
        $sql = "SELECT customer.name,customer.phone,customer.address,customer.email FROM " . self::TABLE . " , orders WHERE customer.id=orders.customer_id and orders.id = ?";
        return $this->queryFetch($sql, $id);
    }
}