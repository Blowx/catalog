<?php
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
?>

<h1>Редактирование товара</h1><br>

<div class="container">
    <div class="row">
        <?php foreach ($product->selectDirectData($id) as $row): ?>
            <div>
                <div class="col-md-2">
                    <img src="<?= $row['uploadfile'] ?>" style='width: 400px; height: 400px'>
                </div>
                <br>
                <div class="col-md-1" style="float: right; margin-right: 500px">
                    <h3><?= $row['title'] ?></h3>
                    <h4><?= $row['price'] ?>$</h4>
                    <?php if (isCookie('admin')): ?>
                        <div style="margin-top: 100px">
                            <a href="index.php?page=delete&id=<?= $row['id'] ?>">Удалить</a>
                        </div>
                    <?php endif; ?>
                </div>
                <br>
                <br>
                <br>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<form method="post" action="" enctype="multipart/form-data">
    <?php foreach ($product->selectDirectData($id) as $row): ?>
        <div class="form-group">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>" placeholder="title">
        </div>
        <div class="form-group">
            <label for="Price">Price:</label>
            <input type="text" class="form-control" name="price" value="<?= $row['price'] ?>" placeholder="price">
        </div>
        <div class="form-group">
            <label for="InputFile">Pic</label>
            <input type="file" name="userfile" id="exampleInputFile">
        </div>
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000"/>
        <button type="submit" name='submit' class="btn btn-default">Обновить</button>
        <br>
    <?php endforeach; ?>
    <br><br>
</form>

<ul class="list-group">
    <li class="list-group-item list-group-item-info">Все поля обязательны</li>
    <li class="list-group-item list-group-item-info">Вы можете сохранить файл в формате Jpeg или Png</li>
    <li class="list-group-item list-group-item-info">Вы можете соханить файл не более 3мб</li>
</ul>

