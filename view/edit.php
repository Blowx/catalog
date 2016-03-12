<?php
if (isPost()) {
    $AddPhotoToCatalog = new Add();
    $title = $_POST['title'];
    $price = $_POST['price'];
    $uploadfile = $_FILES['userfile']['name'];
    $AddPhotoToCatalog->updateData($id, $uploadfile, $title, $price);
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
            <input type="number" class="form-control" name="price" value="<?= $row['price'] ?>" placeholder="price">
        </div>
        <div class="form-group">
            <label for="InputFile">Pic</label>
            <input type="file" name="userfile" id="exampleInputFile" value="<?= $row['uploadfile'] ?>">
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

