<?php
require_once 'inc/functions.php';
require_once 'inc/data.php';
require_once "classes/product.php";

$product = new Product;
/*const DB_NAME ='myDatabase.db';
$database = new SQLite3(DB_NAME);*/

$id = (isset($_GET['id']))? strip_tags($_GET['id']) : 'id';

/*$sqls = "SELECT * FROM catalog WHERE id='$id'";

$result = $database->query($sqls);*/


/*
 *
 * запилиь проверку на ид с регулярками
 * regex101
*/

//$id = (isset($_GET['id']));

/*$sql = "SELECT * FROM CATALOG WHERE id='$id'";

$product->exec($sql);*/
<<<<<<< 5570eb779fc32c7b361b46c1216c297106bfaa28
=======




if (isPost()) {
    $imgName = $_FILES['photo']['name'];
    $uploaddir = 'gallery/';
    $uploadfile = $uploaddir . time() . '_' . basename($_FILES['userfile']['name']);
    $error = $_FILES['photo']['error'];
    $title = $product->escapeString(getData('title'));
    $price = $product->escapeString(getData('price'));
    $size = $_FILES['userfile']['size'];
    $type = $_FILES['userfile']['type'];
    if ($title != null && $price != null) {

        if ($_FILES['userfile']['name'] != null) {

            if (in_array($type, $ext)) {
>>>>>>> add edit and delete functions && it works

                if ($error == UPLOAD_ERR_OK) {
                    $title = $_POST['title'];
                    $price = $_POST['price'];
                    $uploadfile = $uploaddir . time() . '_' . basename($_FILES['userfile']['name']);
                    $product->updateData($id, $uploadfile, $title, $price);

                    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);

                    echo "Готово, вы изменили товар." . '<br>';
                    echo "Название: $title" . '<br>';
                    echo "Цена: $price" . '<br>';

                } else {
                    echo "Не-а, не залилось!\n";
                }

            } else {
                echo 'Недопустимый формат файла, вы должны сохранить файл в формате jpeg или png';
            }

        } else {
            echo 'Вы не выбрали файл ';
        }

    } else {
        echo 'Вы не ввели Тайтл или цену';
    }

}



//echo $id;

echo $id;

?>



<h1>Изменение товара <?= $id; ?></h1>

<div>
    <div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>Price</th>
                <th>dir</th>

            </tr>
            <?php foreach ($product->selectDirectData($id) as $row ): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><img src="<?= $row['uploadfile'] ?>" alt="" style='width: 50px; height: 50px'></td>
                </tr>
                <?php
                    endforeach;
                ?>
        </table>
    </div>

<<<<<<< 5570eb779fc32c7b361b46c1216c297106bfaa28
=======
    
    <?php foreach ($product->selectDirectData($id) as $row): ?>
>>>>>>> add edit and delete functions && it works
<form  method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="Title">Title</label>
        <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>"  placeholder="title">
    </div>
    <div class="form-group">
        <label for="Price">Price:</label>
        <input type="text" class="form-control" name="price" value="<?= $row['price'] ?>" placeholder="price">
    </div>
    <div class="form-group">
        <label for="InputFile">Pic</label>
        <input type="file" name="userfile" id="exampleInputFile">
    </div>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <!--<a href=""></a>-->
    <button type="submit" name='submit' class="btn btn-default">Обновить</button>
<<<<<<< 5570eb779fc32c7b361b46c1216c297106bfaa28
=======
    <br>
    <!--<a href="index.php?page=delete&id=<?/*= $id */?>">Удалить <?/*= $id */?></a>-->
    <?php endforeach; ?>
>>>>>>> add edit and delete functions && it works
    <br><br>
</form>

<ul class="list-group">
    <li class="list-group-item list-group-item-info">Все поля обязательны</li>
    <li class="list-group-item list-group-item-info">Вы можете сохранить файл в формате Jpeg или Png</li>
    <li class="list-group-item list-group-item-info">Вы можете соханить файл не более 3мб</li>
</ul>

