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

<form  method="post" action="" enctype="multipart/form-data">
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

