<?php
error_reporting(E_ALL);

/*
 *
 *
 * edit: select ^ where id=$id
 *
 * где из гет параметра будет узнаваться ид
потом будет идти запрос в бд select * where id=%id%
потом update
*/
require "classes/product.php";
require_once 'inc/data.php';
require_once 'inc/functions.php';
$product = new Product();

if (isPost()) {
    $imgName = $_FILES['photo']['name'];
    $uploaddir = 'gallery/';
    $uploadfile =$uploaddir .time() . '_' . basename($_FILES['userfile']['name']);
    $error = $_FILES['photo']['error'];
    $title = $product->escapeString(getData('title'));
    $price = $product->escapeString(getData('price'));
    $size = $_FILES['userfile']['size'];
    $type = $_FILES['userfile']['type'];
    if($title !=null && $price != null){

        if($_FILES['userfile']['name']!= null){

            if(in_array($type, $ext)){

                if ($error == UPLOAD_ERR_OK) {
                    $title = $_POST['title'];
                    $price = $_POST['price'];
                    $uploadfile =$uploaddir .time() . '_' . basename($_FILES['userfile']['name']);
                    $product->insertInDB($uploadfile, $title, $price);

                    move_uploaded_file( $_FILES['userfile']['tmp_name'], $uploadfile);

                    echo "Готово, вы добавили товар." . '<br>';
                    echo "Название: $title". '<br>';
                    echo "Цена: $price". '<br>';

                }
                else {
                    echo "Не-а, не залилось!\n";
                }

            }else {
                echo 'Недопустимый формат файла, вы должны сохранить файл в формате jpeg или png';
            }

        }else{
            echo 'Вы не выбрали файл ';
        }

    }else{
        echo 'Вы не ввели Тайтл или цену';
    }
}
?>

<?php if (! isCookie('admin')): ?>
    <h1 style="color: red">Чтобы добавлять товары зайдите в админку</h1><br>
<?php endif; ?>

<?php if($product->selectData()): ?>
<div>
    <div>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>Price</th>
                <th>dir</th>
                <?php if(isCookie('admin')): ?>
                    <th>Изменить</th>
                    <th>Удалить</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($product->selectData() as $row ): ?>

                <tr>

                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><img src="<?= $row['uploadfile'] ?>" alt="" style='width: 50px; height: 50px'></td>

                    <?php if(isCookie('admin')): ?>
                        <td><a href="index.php?page=edit&id=<?= $row['id'] ?>">Изменить <?= $row['id'] ?></a></td>
                        <td><a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить <?= $row['id'] ?></a></td>
                    <?php endif; ?>

                </tr>

            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

<?php if(isCookie('admin')): ?>

    <form   method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" value=""  placeholder="title">
        </div>
        <div class="form-group">
            <label for="Price">Price:</label>
            <input type="text" class="form-control" name="price" value="" placeholder="price">
        </div>
        <div class="form-group">
            <label for="InputFile">Pic</label>
            <input type="file" name="userfile" id="exampleInputFile">
        </div>
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
        <button type="submit" name='submit' class="btn btn-default">Загрузить</button>
        <br><br>
    </form>

    <ul class="list-group">
        <li class="list-group-item list-group-item-info">Все поля обязательны</li>
        <li class="list-group-item list-group-item-info">Вы можете сохранить файл в формате Jpeg или Png</li>
        <li class="list-group-item list-group-item-info">Вы можете соханить файл не более 3мб</li>
    </ul>

<?php endif; ?>


