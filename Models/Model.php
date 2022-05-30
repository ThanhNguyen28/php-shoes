<?php

class Model extends Database
{
    /* INSERT */
    public function insertByID($table, $data)
    {
        try {
            if ($data != []) {
                $keys = [];
                foreach ($data as $key => $values) {
                    array_push($keys, $key);
                }
                $key = implode(',', $keys); // chuyen mang thanh chuoi cat nhau boi dau ,
                $values = ':' . implode(',:', $keys);
                $sql = "INSERT INTO ${table} (${key}) VALUES (${values})";
                $conn = $this->connect();
                $query = $conn->prepare($sql);
                $query->execute($data);
                $last_id = $conn->lastInsertId();
                $this->disConnect();
                return $last_id;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    /* UPDATE */
    public function update($table, $data, $id)
    {
        try {
            if ($data != []) {
                $keys = [];
                foreach ($data as $key => $values) {
                    array_push($keys, $key . "=:" . $key);
                }
                $key = implode(',', $keys); // chuyen mang thanh chuoi cat nhau boi dau ,
                $sql = "UPDATE ${table} SET  ${key} WHERE id=:id";
                $data['id'] = $id; // them key id val $id vào cuối mảng $data
                $conn = $this->connect();
                $query = $conn->prepare($sql);
                $query->execute($data);
                $this->disConnect();
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    /* DELETE */
    public function delete($table, $key, $id)
    {
        $sql = "DELETE FROM ${table} WHERE $key= ?";
        $query = $this->connect()->prepare($sql);
        $query->execute([$id]);
        $this->disConnect();
    }
    /* SHOW ALL */
    public function show($table, $endpoint = "", $select = ['*'])
    {
        $colims = implode(',', $select);
        $sql = "SELECT ${colims} FROM ${table} ${endpoint}"; // endpoint = ORDER BY id DESC
        $query = $this->queryFetchAll($sql, null);
        return $query;
    }
    /* SEARCH */
    public function showSearch($table, $key)
    {
        $sql = "SELECT * FROM ${table} WHERE name LIKE :search";
        $query = $this->connect()->prepare($sql);
        $query->bindValue(':search', '%' . $key . '%');
        $query->execute();
        $this->disConnect();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /* LOGIN */
    public function login($table, $data)
    {
        try {
            if ($data != []) {
                $sql = "SELECT * FROM ${table} WHERE email=:email AND password=:password";
                $qr = $this->connect()->prepare($sql);
                $qr->execute($data);
                if ($qr->rowCount() > 0) {
                    $this->disConnect();
                    return $qr->fetch(PDO::FETCH_ASSOC);
                }
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function queryFetchAll($sql, $data)
    {
        $query = $this->connect()->prepare($sql);
        if (isset($data) && $data != null) {
            $query->execute(array($data));
        } else {
            $query->execute();
        }
        $this->disConnect();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryFetch($sql, $data)
    {
        $query = $this->connect()->prepare($sql);
        if (isset($data) && $data != null) {
            $query->execute(array($data));
        } else {
            $query->execute();
        }
        $this->disConnect();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}