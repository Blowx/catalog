<?php
require "view/product.php";
$product = new Product();

require_once "inc/functions.php";


$ext = [
    'image/jpeg', 'image/png'
];

if (isPost()) {
    $imgName = $_FILES['photo']['name'];
    $uploaddir = 'gallery/';
    $uploadfile =$uploaddir .time() . '_' . basename($_FILES['userfile']['name']);
    $error = $_FILES['photo']['error'];
    $title = getData('title');
    $price = getData('price');
    $size = $_FILES['userfile']['size'];
    $type = $_FILES['userfile']['type'];
    if($title !=null && $price != null){

        if($_FILES['userfile']['name']!= null){

            if(in_array($type, $ext)){

                if ($error == UPLOAD_ERR_OK) {
                    $title = $_POST['title'];
                    $price = $_POST['price'];
                    $uploadfile =$uploaddir .time() . '_' . basename($_FILES['userfile']['name']);
                    $sql = "INSERT INTO catalog (id, uploadfile , title, price)" .
                        "VALUES (null , '$uploadfile' ,'$title', '$price')";
                    $database->exec($sql);

                    move_uploaded_file( $_FILES['userfile']['tmp_name'], $uploadfile);

                    echo "Готово, вы добавили товар." . '<br>';
                    echo "Название: $title". '<br>';
                    echo "Цена: $price". '<br>';

                }
                else {
                    echo "Возможная атака с помощью файловой загрузки!\n";
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
            <td><a href="test1.php?edit=id<?= $row['id'] ?>">Изменить <?= $row['id'] ?></a></td>
            <td><a href="test1.php?delete=id<?= $row['id'] ?>">Удалить <?= $row['id'] ?></a></td>
        <?php endif; ?>
    </tr>
    <?php
    if (isset($_GET[$row['name']])) {
        $pere = $row['name'];
        delete($pere);
    }
    ?>
<?php endforeach; ?>
</table>
</div>

<?php if(isCookie('admin')): ?>

    <form   method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" value=""  placeholder="title">
        </div>
        <div class="form-group">
            <label for="Price">Price:</label>
            <input type="text" class="form-control" name="price" value="" placeholder="price">
            <!--<textarea class="form-control" name="description" id="desc" placeholder="description" cols="30" rows="10"></textarea>-->
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