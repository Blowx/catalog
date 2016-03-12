<?php
include_once "inc/functions.php";
require_once 'inc/data.php';
class Add{

    private $imgname;
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
        return ($this->title != null && $this->price != null && $this->imgname != null) ;
    }

    protected function allStructures()
    {
        return $this->isNotEmptyFields() && in_array($this->type, $this->ext) && $this->size < 3000000;
    }

    protected function outputData($title, $price)
    {
        echo "Вы добавили товар $title, с ценой $price";
    }

    public function error()
    {
        if(!$this->isNotEmptyFields()){
            $tmp = "Не заполнены все поля.";
            $this->errArray[] = $tmp;
            if($this->size > 3000000){
                $tmp = "Размер больше 3мб.";
                $this->errArray[] = $tmp;
            }
        }else{
            $tmp = "Неправильный тип файла. Только Jpeg и Png.";
            $this->errArray[] = $tmp;
        }
        $brSep = implode("<br>", $this->errArray);
        echo $brSep;
    }

    public function save ($uploadfile, $title, $price){
        $uploaddir = 'gallery/';
        $uploadfile = $this->makeDir($uploaddir);

        if($this->allStructures()){
            $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
                "VALUES (null , '$uploadfile' ,'$title', '$price')";
            $this->pdo->exec($sql);
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            $this->outputData($title,$price);
        }else{
            $this->error();
        }
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

    public function updateData($id, $uploadfile, $title, $price)
    {
        $uploaddir = 'gallery/';
        $uploadfile = $this->makeDir($uploaddir);
        if($this->allStructures()){
            $this->deleteFile($this->getPicName($id));
            $sql = "UPDATE catalog SET uploadfile='$uploadfile', title='$title', price='$price' WHERE id='$id'";
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            $this->pdo->exec($sql);
        }else{
            $this->error();
        }


    }
}
