<?php
include_once "../inc/functions.php";

class product
{
    private $pdo;
    const DB_NAME = 'myDatabase.db';

    private function createDatabase()
    {
        if (filesize(DB_NAME) == 0) {
            $sql = 'CREATE TABLE catalog (
            id INTEGER PRIMARY KEY   AUTOINCREMENT,
            uploadfile TEXT,
            title TEXT,
            price INTEGER
        )';

            $this->pdo->exec($sql);
        }
    }

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:myDatabase.db');

        $this->createDatabase();
    }

    public function __destruct()
    {
        unset($this->pdo);
    }

    public function insertInDB($uploadfile, $title, $price)
    {
        $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
            "VALUES (null , '$uploadfile' ,'$title', '$price')";
        $this->pdo->exec($sql);
    }

    public function selectData()
    {
        $sql = "SELECT * FROM catalog ORDER BY id, title, price";
        $stmt = $this->pdo->query($sql);
        return $this->fetchData($stmt);
    }

    public function fetchData($result)
    {
        $temp = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $temp[] = $row;
        }
        return $temp;
    }

    public function escapeString($str)
    {
        $stmt = $this->pdo->quote($str);
        return $stmt;
    }

    public function selectDirectData($id)
    {
        $sql = "SELECT * FROM catalog WHERE id='$id'";
        $stmt = $this->pdo->query($sql);
        return $this->fetchData($stmt);
    }

    public function updateData($id,$uploadfile, $title, $price)
    {
        $sql = "UPDATE catalog SET uploadfile='$uploadfile', title='$title', price='$price' WHERE id='$id'";
        $this->pdo->exec($sql);

    }

    public function del($id)
    {
        //$id = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';
        if (isset($_GET['id'])) {
            $sql = "DELETE FROM catalog WHERE id='$id'";
            $result = $this->pdo->query($sql);


        return $result;

        }

    }
}