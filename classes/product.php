<?php
include_once "inc/functions.php";

class Product
{
    private $pdo;
    const DB_NAME = 'myDatabase.db';

    private function createDatabase()
    {
        if (filesize(self::DB_NAME) == 0) {
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
        return $stmt->fetchAll();
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
        return $stmt->fetchAll();

    }

    public function updateData($id, $uploadfile, $title, $price)
    {
        $sql = "UPDATE catalog SET uploadfile='$uploadfile', title='$title', price='$price' WHERE id='$id'";
        $this->pdo->exec($sql);

    }

    public function getPicName($id)
    {
        $sql = "SELECT uploadfile FROM catalog WHERE id='$id'";
        $stmt = $this->pdo->query($sql);
        $stmt = $stmt->fetchAll();

        $file = $stmt[0]['uploadfile'];

        $re = "@gallery/(\\w+.[png|jpg|jpeg]*)$@";
        $subst = "$1";
        $result = preg_replace($re, $subst, $file, 1);
        return $result;
    }

    public function deleteFile($result)
    {
        $filename = "gallery/$result";


        if (file_exists($filename)) {
            unlink($filename); //удаляет файл
        } else {
            echo "Файл $filename не существует";
        }
    }

    public function deleleFromDB($id)
    {
        if (isset($_GET['id'])) {
            $sql = "DELETE FROM catalog WHERE id='$id'";
            $result = $this->pdo->exec($sql);

            return $result;
        }

    }


}