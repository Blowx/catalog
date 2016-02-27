<?php
include_once "../inc/functions.php";

class product
{
    private $db;
    const DB_NAME = 'myDatabase.db';

    private function createDatabase(){
        if(filesize(DB_NAME) == 0 ){
            $sql = 'CREATE TABLE catalog (
            id INTEGER PRIMARY KEY   AUTOINCREMENT,
            uploadfile TEXT,
            title TEXT,
            price INTEGER
        )';

            $this->db->exec($sql);
        }
    }

    public function __construct () {
        $this->db = new SQLite3(static::DB_NAME);

        $this->createDatabase();
    }

    public function __destruct () {
        unset($this->db);
    }

    public function insertInDB ($uploadfile, $title, $price) {
        $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
            "VALUES (null , '$uploadfile' ,'$title', '$price')";
        $this->db->exec($sql);
    }

    public function selectData() {
        $sql = "SELECT * FROM catalog ORDER BY id, title, price";
        $result = $this->db->query($sql);

        return $this->fetchData($result);
    }

    public function fetchData($result){
        $temp = [];
        while ($row = $result->fetchArray()){
            $temp[] = $row;
        }
        return $temp;
    }

}