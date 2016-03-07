<?php
include_once "inc/functions.php";
require_once 'inc/data.php';
class Add{

    private $imgname;
    private $error;
    private $title;
    private $price;
    private $size;
    private $type;
    private $ext;
    private $pdo;
    private $errArray = [];

    public function __construct()
    {
        $this->imgname = $_FILES['userfile']['name'];
        $this->title = getData('title');
        $this->price = getData('price');
        $this->size = $_FILES['userfile']['size'];
        $this->type = $_FILES['userfile']['type'];
        $this->ext = ['image/jpeg', 'image/png'];
        $this->pdo = new PDO('sqlite:myDatabase.db');
    }

    protected function makeDir($uploaddir)
    {
        return $uploaddir . time() . '_' . basename($_FILES['userfile']['name']);
    }

    protected function isNotEmptyFields()
    {
        return isset($this->title, $this->price) ;
    }

    protected function userFileIsNotEmpty()
    {
        return $_FILES['userfile']['name'] != null;
    }

    protected function allStructures()
    {
        return $this->isNotEmptyFields() && $this->userFileIsNotEmpty() && in_array($this->type, $this->ext) && $this->size < 3000000 && $this->error == UPLOAD_ERR_OK;
    }

    protected function outputData($title, $price)
    {
        echo "Вы добавили товар $title, с ценой $price";
    }

    protected function error()
    {
        if($this->isNotEmptyFields()){
            if($this->userFileIsNotEmpty()){
                if(!in_array($this->type, $this->ext)){
                    if(!$this->size < 3000000){
                        $tmp = "размер больше 3мб";
                        $this->errArray[] = $tmp;
                    }
                    $tmp = "Не тот тип файла";
                    $this->errArray[] = $tmp;
                }
                $tmp = "вы не выбрали файл";
                $this->errArray[] = $tmp;
            }
            $tmp = "Не заполнены все поля";
            $this->errArray[] = $tmp;
        }
        $brSep = implode("<br>", $this->errArray);
        echo $brSep;

    }

    public function save ($uploadfile, $title, $price){
        $uploaddir = 'gallery/';
        $uploadfile = $this->makeDir($uploaddir);

        if(!($this->errArray) && $this->allStructures()){
            $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
                "VALUES (null , '$uploadfile' ,'$title', '$price')";
            $this->pdo->exec($sql);
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            $this->outputData($title,$price);

        }else{
            $this->error();
        }
    }
}
