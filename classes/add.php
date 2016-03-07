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
        return $this->title != null && $this->price != null;
    }

    public function insertInDB($uploadfile, $title, $price)
    {
        $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
            "VALUES (null , '$uploadfile' ,'$title', '$price')";
        $this->pdo->exec($sql);
    }


    public function save($uploadfile, $title, $price)
    {
        $uploaddir = 'gallery/';
        $uploadfile = $this->makeDir($uploaddir);
        if ($this->isNotEmptyFields()) {

            if ($_FILES['userfile']['name'] != null) {

                if (in_array($this->type, $this->ext) && $this->size < 3000000) {

                    if ($this->error == UPLOAD_ERR_OK) {
                        $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
                            "VALUES (null , '$uploadfile' ,'$title', '$price')";
                        $this->pdo->exec($sql);

                        move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);

                        echo "Готово, вы добавили товар." . '<br>';
                        echo "Название: $title" . '<br>';
                        echo "Цена: $price" . '<br>';

                    } else {
                        echo "Не-а, не залилось!\n";
                    }

                } else {
                    echo 'Недопустимый формат файла, вы должны сохранить файл в формате jpeg или png или размер больше 3мб';
                }

            } else {
                echo 'Вы не выбрали файл ';
            }

        } else {
            echo 'Вы не ввели Тайтл или цену';
        }
    }

}
